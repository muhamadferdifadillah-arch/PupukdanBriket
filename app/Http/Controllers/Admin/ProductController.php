<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * Display a listing of products
     */
    public function index()
{
    $products = Product::with('category')->latest()->paginate(10);
    $categories = Category::all(); // TAMBAHKAN BARIS INI
    
    return view('admin.products.index', compact('products', 'categories'));
}

    /**
     * Show the form for creating a new product
     */
    public function create()
    {
        $categories = Category::where('status', 'active')->get();
        return view('admin.products.create', compact('categories'));
    }

    /**
     * Store a newly created product in database
     */
    public function store(Request $request)
    {
        // Validasi input
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'discount_price' => 'nullable|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'sku' => 'nullable|string|unique:products,sku',
            'category_id' => 'nullable|exists:categories,id',
            'status' => 'required|in:active,inactive,out_of_stock',
            'is_featured' => 'nullable|boolean',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'meta_title' => 'nullable|string',
            'meta_description' => 'nullable|string',
        ]);

        // Generate slug dari name
        $validated['slug'] = Str::slug($request->name);
        
        // Generate SKU otomatis jika tidak diisi
        if (empty($validated['sku'])) {
            $validated['sku'] = 'PRD-' . strtoupper(Str::random(8));
        }

        // Handle upload image
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->move(public_path('uploads/products'), $imageName);
            $validated['image'] = 'uploads/products/' . $imageName;
        }

        // Set default untuk is_featured
        $validated['is_featured'] = $request->has('is_featured') ? true : false;

        // Simpan ke database
        Product::create($validated);

        return redirect()->route('admin.products.index')
                        ->with('success', 'Product created successfully!');
    }

    /**
     * Display the specified product
     */
    public function show(Product $product)
    {
        return view('admin.products.show', compact('product'));
    }

    /**
     * Show the form for editing the specified product
     */
    public function edit(Product $product)
    {
        $categories = Category::where('status', 'active')->get();
        return view('admin.products.edit', compact('product', 'categories'));
    }

    /**
     * Update the specified product in database
     */
    public function update(Request $request, Product $product)
    {
        // Validasi input
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'discount_price' => 'nullable|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'sku' => 'nullable|string|unique:products,sku,' . $product->id,
            'category_id' => 'nullable|exists:categories,id',
            'status' => 'required|in:active,inactive,out_of_stock',
            'is_featured' => 'nullable|boolean',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'meta_title' => 'nullable|string',
            'meta_description' => 'nullable|string',
        ]);

        // Update slug jika name berubah
        $validated['slug'] = Str::slug($request->name);

        // Handle upload image baru
        if ($request->hasFile('image')) {
            // Hapus image lama jika ada
            if ($product->image && file_exists(public_path($product->image))) {
                unlink(public_path($product->image));
            }

            $image = $request->file('image');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->move(public_path('uploads/products'), $imageName);
            $validated['image'] = 'uploads/products/' . $imageName;
        }

        // Set is_featured
        $validated['is_featured'] = $request->has('is_featured') ? true : false;

        // Update product
        $product->update($validated);

        return redirect()->route('admin.products.index')
                        ->with('success', 'Product updated successfully!');
    }

    /**
     * Remove the specified product from database
     */
    public function destroy(Product $product)
    {
        // Hapus image jika ada
        if ($product->image && file_exists(public_path($product->image))) {
            unlink(public_path($product->image));
        }

        $product->delete();

        return redirect()->route('admin.products.index')
                        ->with('success', 'Product deleted successfully!');
    }
}