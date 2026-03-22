<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ProductImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class FileManagerController extends Controller
{
    public function index(Request $request)
    {
        $images = $this->getSystemImages();
        
        $search = $request->filled('search') ? strtolower($request->search) : null;
        
        if ($search) {
            $images = collect($images)->filter(function ($img) use ($search) {
                return str_contains(strtolower($img['product'] ?? ''), $search) ||
                       str_contains(strtolower($img['filename'] ?? ''), $search);
            })->values();
        }
        
        $perPage = 24;
        $total = $images->count();
        $lastPage = ceil($total / $perPage);
        $page = min($request->get('page', 1), $lastPage);
        $offset = ($page - 1) * $perPage;
        
        $paginatedImages = $images->slice($offset, $perPage)->values();

        return response()->json([
            'images' => $paginatedImages,
            'pagination' => [
                'current_page' => (int) $page,
                'last_page' => (int) $lastPage,
                'per_page' => $perPage,
                'total' => $total,
            ]
        ]);
    }

    public function getAll()
    {
        $images = $this->getSystemImages();
        
        return response()->json($images);
    }

    private function getSystemImages()
    {
        $images = [];
        
        $dbImages = ProductImage::with('product')
            ->where('is_external', false)
            ->whereNotNull('image')
            ->latest()
            ->get();
        
        foreach ($dbImages as $image) {
            $url = $image->url;
            if (!str_starts_with($url, 'http')) {
                $url = url($url);
            }
            $images[$url] = [
                'id' => $image->id,
                'url' => $url,
                'thumb' => $url,
                'product' => $image->product ? $image->product->name : null,
                'filename' => basename($image->image),
                'source' => 'database',
            ];
        }
        
        $storagePath = storage_path('app/public/products');
        if (file_exists($storagePath)) {
            $files = File::allFiles($storagePath);
            foreach ($files as $file) {
                if (in_array(strtolower($file->getExtension()), ['jpg', 'jpeg', 'png', 'gif', 'webp'])) {
                    $path = 'products/' . $file->getFilename();
                    $url = url(Storage::url($path));
                    
                    if (!isset($images[$url])) {
                        $images[$url] = [
                            'id' => 'storage_' . md5($path),
                            'url' => $url,
                            'thumb' => $url,
                            'product' => null,
                            'filename' => $file->getFilename(),
                            'source' => 'storage',
                        ];
                    }
                }
            }
        }
        
        return collect(array_values($images));
    }
}
