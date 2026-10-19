<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        return Product::all();
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $validate = $request->validate([
            'name'=> 'required|string|max:255',
            'price'=> 'required|numeric',
        ]);

        $product = Product::create($validate);

        return response()->json($product, 201);
    }

    public function show(Product $product)
    {
        // تم تصحيح الخطأ وإزالة find($id) وحفظ العلاقة بالجمع
        $users = $product->users;

        return response()->json([
            'product' => $product,
            'users' => $users
        ]);
    }

    public function edit(Product $product)
    {
        //
    }

    public function update(Request $request, Product $product)
    {
        $validate = $request->validate([
            'name'=> 'required|string|max:255',
            'price'=> 'required|numeric',
        ]);

        $product->update($validate);

        return response()->json($product);
    }

    public function destroy(Product $product)
    {
        $product->delete();
        return response()->json(['message' => 'تم الحذف بنجاح']);
    }

    public function AddToCard(Request $request, $id)
    {
        $user = User::findOrFail($id);

        // ربط المنتج بالمستخدم في جدول كسر العلاقة
        $user->products()->attach($request->product_id);

        return response()->json([
            'message' => 'تمت الإضافة للسلة بنجاح',
            'user' => $user->load('products')
        ]);
    }
}
