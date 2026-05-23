<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;

class AdminProductController extends Controller
{
    public function index()
    {
        $products = Product::all();
        return view('admin.product.index', compact('products'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('admin.product.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $data = new Product();
        $data->category_id = $request->category_id;
        $data->user_id = 1; // Senin admin ID'n
        $data->title = $request->title;
        $data->keywords = $request->keywords;
        $data->description = $request->description;
        $data->detail = $request->detail;
        $data->price = $request->price;
        $data->stock = $request->stock ?? 0;
        $data->minstock = $request->minstock ?? 0;
        $data->discount = $request->discount ?? 0;
        $data->status = $request->status ? 1 : 0;

        if ($request->file('image')) {
            $file = $request->file('image');
            $filename = date('YmdHi') . $file->getClientOriginalName();
            $file->move(public_path('images'), $filename);
            $data->image = $filename;
        }

        $data->save();
        return redirect()->route('admin.product.index');
    }

    public function show($id)
    {
        // İleride ürün detay sayfası yaparsak kullanacağız
    }

    public function edit($id)
    {
        $data = Product::find($id);
        $categories = Category::all();
        return view('admin.product.edit', compact('data', 'categories'));
    }

    public function update(Request $request, $id)
    {
        $data = Product::find($id);
        $data->category_id = $request->category_id;
        $data->title = $request->title;
        $data->price = $request->price;
        $data->stock = $request->stock ?? 0;

        if ($request->file('image')) {
            $file = $request->file('image');
            $filename = date('YmdHi') . $file->getClientOriginalName();
            $file->move(public_path('images'), $filename);
            $data->image = $filename;
        }

        $data->save();
        return redirect()->route('admin.product.index');
    }

    public function destroy($id)
    {
        $data = Product::find($id);
        $data->delete();
        return redirect()->route('admin.product.index');
    }
}