<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product; // Kahvelerimizi çekmek için bu şart

class HomeController extends Controller
{
    public function index()
    {
        $products = Product::where('status', 1)->get();
        
        return view('home', compact('products'));
    }

    public function detail($id)
    {
        $data = Product::find($id); // Tıklanan kahveyi ID'sinden veritabanında bulur
        return view('product_detail', compact('data')); // Detay sayfasına veriyi gönderir
    }
}