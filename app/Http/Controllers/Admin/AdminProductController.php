<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class AdminProductController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::with(['category', 'images']);

        if ($request->search) {
            $query->where('name', 'like', '%' . $request->search . '%')
                  ->orWhere('sku', 'like', '%' . $request->search . '%');
        }

        if ($request->category) {
            $query->where('category_id', $request->category);
        }

        if ($request->status === 'active') {
            $query->where('is_active', true);
        } elseif ($request->status === 'inactive') {
            $query->where('is_active', false);
        }

        $products = $query->latest()->paginate(10);
        $categories = Category::where('is_active', true)->get();

        return view('admin.products.index', compact('products', 'categories'));
    }

    public function create()
    {
        $categories = Category::where('is_active', true)->get();
        return view('admin.products.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'sku' => 'required|string|max:50|unique:products,sku',
            'price' => 'required|numeric|min:0',
            'compare_price' => 'nullable|numeric|min:0',
            'cost_price' => 'nullable|numeric|min:0',
            'quantity' => 'required|integer|min:0',
            'short_description' => 'nullable|string|max:500',
            'description' => 'nullable|string',
            'is_active' => 'boolean',
            'is_featured' => 'boolean',
            'delivery_type' => 'required|in:free,fixed',
            'delivery_charge' => 'nullable|numeric|min:0|required_if:delivery_type,fixed',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'image_urls' => 'nullable|string',
        ]);

        $validated['slug'] = Str::slug($request->name) . '-' . Str::random(6);
        $validated['is_active'] = $request->boolean('is_active', true);
        $validated['is_featured'] = $request->boolean('is_featured', false);
        $validated['published_at'] = now();

        $product = Product::create($validated);

        $imageIndex = 0;
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $index => $image) {
                $path = $image->store('products', 'public');
                ProductImage::create([
                    'product_id' => $product->id,
                    'image' => $path,
                    'is_primary' => $imageIndex === 0,
                    'sort_order' => $imageIndex,
                ]);
                $imageIndex++;
            }
        }

        if ($request->image_urls) {
            $urls = json_decode($request->image_urls, true) ?? [];
            foreach ($urls as $url) {
                if (filter_var($url, FILTER_VALIDATE_URL)) {
                    ProductImage::create([
                        'product_id' => $product->id,
                        'image' => $url,
                        'is_primary' => $imageIndex === 0,
                        'sort_order' => $imageIndex,
                        'is_external' => true,
                    ]);
                    $imageIndex++;
                }
            }
        }

        return redirect()->route('admin.products.index')
            ->with('success', 'Product created successfully.');
    }

    public function edit(Product $product)
    {
        $categories = Category::where('is_active', true)->get();
        $product->load('images');
        return view('admin.products.edit', compact('product', 'categories'));
    }

    public function update(Request $request, Product $product)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'sku' => 'required|string|max:50|unique:products,sku,' . $product->id,
            'price' => 'required|numeric|min:0',
            'compare_price' => 'nullable|numeric|min:0',
            'cost_price' => 'nullable|numeric|min:0',
            'quantity' => 'required|integer|min:0',
            'short_description' => 'nullable|string|max:500',
            'description' => 'nullable|string',
            'is_active' => 'boolean',
            'is_featured' => 'boolean',
            'delivery_type' => 'required|in:free,fixed',
            'delivery_charge' => 'nullable|numeric|min:0|required_if:delivery_type,fixed',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'image_urls' => 'nullable|string',
        ]);

        $validated['is_active'] = $request->boolean('is_active', true);
        $validated['is_featured'] = $request->boolean('is_featured', false);

        $product->update($validated);

        $maxSortOrder = $product->images()->max('sort_order') ?? 0;
        $imageIndex = $maxSortOrder + 1;

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $index => $image) {
                $path = $image->store('products', 'public');
                ProductImage::create([
                    'product_id' => $product->id,
                    'image' => $path,
                    'is_primary' => false,
                    'sort_order' => $imageIndex,
                ]);
                $imageIndex++;
            }
        }

        if ($request->image_urls) {
            $urls = json_decode($request->image_urls, true) ?? [];
            foreach ($urls as $url) {
                if (filter_var($url, FILTER_VALIDATE_URL)) {
                    ProductImage::create([
                        'product_id' => $product->id,
                        'image' => $url,
                        'is_primary' => false,
                        'sort_order' => $imageIndex,
                        'is_external' => true,
                    ]);
                    $imageIndex++;
                }
            }
        }

        return redirect()->route('admin.products.index')
            ->with('success', 'Product updated successfully.');
    }

    public function destroy(Product $product)
    {
        foreach ($product->images as $image) {
            if (!$image->is_external) {
                Storage::disk('public')->delete($image->image);
            }
        }
        $product->delete();

        return redirect()->route('admin.products.index')
            ->with('success', 'Product deleted successfully.');
    }

    public function toggleStatus(Product $product)
    {
        $product->update(['is_active' => !$product->is_active]);

        return back()->with('success', 'Product status updated.');
    }

    public function deleteImage(Request $request, ProductImage $image)
    {
        if (!$image->is_external) {
            Storage::disk('public')->delete($image->image);
        }
        $image->delete();

        return response()->json(['success' => true]);
    }

    public function setPrimaryImage(ProductImage $image)
    {
        $image->product->images()->update(['is_primary' => false]);
        $image->update(['is_primary' => true]);

        return response()->json(['success' => true]);
    }
}
