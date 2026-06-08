<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Order;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        // 1. Ürün Filtreleme (Kategoriye göre)
        if ($request->has('category_id')) {
            $products = Product::where('status', 1)
                               ->where('category_id', $request->category_id)
                               ->get();
        } else {
            $products = Product::where('status', 1)->get();
        }

        // 2. Admin Kontrolü ve Siparişleri Çekme
        $orders = [];
        if (auth()->check() && auth()->user()->role == 'admin') {
            $orders = Order::all(); 
        }
        
        return view('home', compact('products', 'orders'));
    }

    public function detail($id)
    {
        $data = Product::find($id);
        return view('product_detail', compact('data'));
    }
}