<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\Review;
use App\Models\Wishlist;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::with('images')->active()->published();

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', '%' . $search . '%')
                    ->orWhere('description', 'like', '%' . $search . '%')
                    ->orWhereHas('category', function ($cq) use ($search) {
                        $cq->where('name', 'like', '%' . $search . '%');
                    });
            });
        }

        if ($request->category) {
            $category = Category::where('slug', $request->category)->first();
            if ($category) {
                $categoryIds = $category->descendants()->pluck('id')->toArray();
                $categoryIds[] = $category->id;
                $query->whereIn('category_id', $categoryIds);
            }
        }

        if ($request->min_price) {
            $query->where('price', '>=', $request->min_price);
        }

        if ($request->max_price) {
            $query->where('price', '<=', $request->max_price);
        }

        if ($request->has('size')) {
            $query->whereHas('sizes', function ($q) use ($request) {
                $q->where('size', $request->size)->where('stock', '>', 0);
            });
        }

        $sortOptions = [
            'latest' => ['Newest First', fn($q) => $q->latest()],
            'price_low' => ['Price: Low to High', fn($q) => $q->orderBy('price', 'asc')],
            'price_high' => ['Price: High to Low', fn($q) => $q->orderBy('price', 'desc')],
            'name_asc' => ['Name: A to Z', fn($q) => $q->orderBy('name', 'asc')],
        ];

        $sort = $request->sort ?? 'latest';
        $sortOptions[$sort][1]($query);

        $products = $query->paginate(12)->withQueryString();
        $categories = Category::with(['children' => function ($q) {
            $q->where('is_active', true);
        }])->whereNull('parent_id')->where('is_active', true)->get();

        $selectedCategory = $request->category ? Category::where('slug', $request->category)->first() : null;
        $searchQuery = $request->search;

        $recentlyViewedIds = session()->get('recently_viewed', []);
        $recentlyViewedProducts = Product::with('images')
            ->whereIn('id', $recentlyViewedIds)
            ->active()
            ->get()
            ->sortBy(function($p) use ($recentlyViewedIds) {
                return array_search($p->id, $recentlyViewedIds);
            });

        return view('shop.index', compact('products', 'categories', 'selectedCategory', 'sortOptions', 'sort', 'searchQuery', 'recentlyViewedProducts'));
    }

    public function show($slug)
    {
        $product = Product::with(['images', 'category', 'sizes'])->where('slug', $slug)->active()->firstOrFail();
        
        // Add to recently viewed
        $recentlyViewed = session()->get('recently_viewed', []);
        if (!in_array($product->id, $recentlyViewed)) {
            array_unshift($recentlyViewed, $product->id);
            $recentlyViewed = array_slice($recentlyViewed, 0, 4);
            session()->put('recently_viewed', $recentlyViewed);
        }

        $relatedProducts = Product::with('images')
            ->where('category_id', $product->category_id)
            ->where('id', '!=', $product->id)
            ->active()
            ->limit(4)
            ->get();

        $reviews = Review::where('product_id', $product->id)
            ->where('is_approved', true)
            ->with('user')
            ->latest()
            ->paginate(10);

        $avgRating = Review::where('product_id', $product->id)
            ->where('is_approved', true)
            ->avg('rating') ?? 0;

        $ratingCounts = Review::where('product_id', $product->id)
            ->where('is_approved', true)
            ->selectRaw('rating, count(*) as count')
            ->groupBy('rating')
            ->pluck('count', 'rating');

        $isInWishlist = auth()->check() 
            ? Wishlist::where('user_id', auth()->id())->where('product_id', $product->id)->exists()
            : false;

        return view('shop.show', compact('product', 'relatedProducts', 'reviews', 'avgRating', 'ratingCounts', 'isInWishlist'));
    }

    public function search(Request $request)
    {
        $query = $request->q;

        $products = Product::with('images')
            ->active()
            ->where(function ($q) use ($query) {
                $q->where('name', 'like', '%' . $query . '%')
                    ->orWhereHas('category', function ($cq) use ($query) {
                        $cq->where('name', 'like', '%' . $query . '%');
                    });
            })
            ->paginate(12);

        return view('shop.index', compact('products', 'query'));
    }

    public function addToWishlist(Product $product)
    {
        try {
            if (!auth()->check()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Please login to add items to your wishlist.'
                ]);
            }

            $exists = Wishlist::where('user_id', auth()->id())->where('product_id', $product->id)->exists();

            if ($exists) {
                Wishlist::where('user_id', auth()->id())->where('product_id', $product->id)->delete();
                return response()->json([
                    'success' => true,
                    'message' => 'Removed from wishlist.',
                    'added' => false
                ]);
            }

            Wishlist::create([
                'user_id' => auth()->id(),
                'product_id' => $product->id,
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Added to wishlist!',
                'added' => true
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Something went wrong. Please try again.'
            ], 500);
        }
    }

    public function removeFromWishlist(Product $product)
    {
        try {
            if (!auth()->check()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Please login.'
                ]);
            }

            Wishlist::where('user_id', auth()->id())->where('product_id', $product->id)->delete();

            return response()->json([
                'success' => true,
                'message' => 'Removed from wishlist.'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Something went wrong. Please try again.'
            ], 500);
        }
    }

    public function storeReview(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'rating' => 'required|integer|min:1|max:5',
            'title' => 'nullable|string|max:255',
            'comment' => 'nullable|string|max:1000',
        ]);

        $product = Product::findOrFail($request->product_id);

        $existingReview = Review::where('user_id', auth()->id())
            ->where('product_id', $product->id)
            ->first();

        if ($existingReview) {
            return back()->with('error', 'You have already reviewed this product.');
        }

        Review::create([
            'user_id' => auth()->id(),
            'product_id' => $product->id,
            'rating' => $request->rating,
            'title' => $request->title,
            'comment' => $request->comment,
            'is_approved' => false,
        ]);

        return back()->with('success', 'Thank you! Your review has been submitted and will be visible after approval.');
    }
}
