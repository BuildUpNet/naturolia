<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductImage;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;


class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with('images')->get();
        return view('Admin.view-product', compact('products'));
    }

    public function create()
    {
        return view('Admin.create-product', ['product' => new Product()]);
    }

    public function store(Request $request)
    {
        $data = $this->validateData($request);

        $product = Product::create($data);

        // Upload images to /public/products
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $filename = time() . '_' . $image->getClientOriginalName();
                $image->move(public_path('products'), $filename);
                $product->images()->create(['image_path' => 'products/' . $filename]);
            }
        }

        return redirect()->route('admin.products.create')->with('success', 'Product created successfully.');
    }

    public function edit(Product $product)
    {
        $product->load('images');
        return view('Admin.create-product', compact('product'));
    }

    public function update(Request $request, Product $product)
    {
        $data = $this->validateData($request, $product->id);

        $product->update($data);

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $filename = time() . '_' . $image->getClientOriginalName();
                $image->move(public_path('products'), $filename);
                $product->images()->create(['image_path' => 'products/' . $filename]);
            }
        }

        return redirect()
            ->route('admin.products.edit', $product->id)
            ->with('success', 'Product updated successfully.');
    }


    public function destroy(Product $product)
    {
        // Delete images from public folder
        foreach ($product->images as $image) {
            $imagePath = public_path($image->image_path);
            if (file_exists($imagePath)) {
                unlink($imagePath);
            }
            $image->delete();
        }

        $product->delete();

        return redirect()->route('admin.products.index')->with('success', 'Product deleted successfully.');
    }

    public function deleteImage(Product $product, ProductImage $image)
    {
        if ($image->product_id !== $product->id) {
            abort(403);
        }

        $imagePath = public_path($image->image_path);
        if (file_exists($imagePath)) {
            unlink($imagePath);
        }

        $image->delete();

        return back()->with('success', 'Image deleted successfully.');
    }

    private function validateData(Request $request, $id = null)
    {
        return $request->validate([
            'title' => 'string|max:255',
            'slug' => ['nullable', 'string', 'max:255', Rule::unique('products', 'slug')->ignore($id)],
            'short_description' => 'nullable|string|max:255',
            'key_benefits' => 'nullable|string',
            'description' => 'nullable|string',
            'ingredient' => 'nullable|string',
            'price' => 'numeric|min:0',
            'mrp_price' => 'nullable|numeric|min:0',
              'qnty' => 'nullable|string|max:100',
            'discount' => 'nullable|numeric|min:0|max:100',
            'meta_title' => 'nullable|string|max:255',
            'meta_keywords' => 'nullable|string|max:255',
            'images.*' => 'nullable|image|mimes:jpg,jpeg,png,webp',
        ]);
    }

    public function show($slug)
    {
        $product = Product::where('slug', $slug)->with('images')->firstOrFail();
        $bestSellers = Product::where('best_product', 1)->with('images')->get();
        return view('product-detail', compact('product', 'bestSellers'));
    }

    public function toggleBestProduct($id)
    {
        $product = Product::findOrFail($id);


        $product->best_product = !$product->best_product;
        $product->save();

        return response()->json([
            'status' => 'success',
            'best_product' => $product->best_product
        ]);
    }
    public function toggleFeatured($imageId)
{
    $image = ProductImage::findOrFail($imageId);
    $productId = $image->product_id;

   
    ProductImage::where('product_id', $productId)->update(['top_image' => 0]);

   
    $image->top_image = 1;
    $image->save();

    return response()->json(['status' => 'success']);
}
}
