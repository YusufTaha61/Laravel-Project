<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function index()
    {
        $cartItems = Cart::with('product')->where('user_id', Auth::id())->get();
        return view('home.cart', compact('cartItems'));
    }

    public function add(Request $request, $productId)
    {
        $request->validate([
            'quantity' => 'nullable|integer|min:1',
        ]);
        
        $product = Product::findOrFail($productId);
        $quantity = $request->quantity ?? 1;

        if ($product->stock < $quantity) {
            return back()->with('error', 'Ürün stokta yeterli değil.');
        }

        $cart = Cart::where('user_id', Auth::id())->where('product_id', $product->id)->first();

        if ($cart) {
            $newQuantity = $cart->quantity + $quantity;
            
            if ($product->stock < $newQuantity) {
                return back()->with('error', 'Ürün stokta yeterli değil.');
            }
            
            $cart->update([
                'quantity' => $newQuantity,
                'price' => $product->price
            ]);
        } else {
            Cart::create([
                'user_id' => Auth::id(),
                'product_id' => $product->id,
                'quantity' => $quantity,
                'price' => $product->price,
            ]);
        }
        
        // Müşteriyi anasayfada tutuyoruz ve başarı mesajını gönderiyoruz
        return back()->with('success', 'Ürün sepete başarıyla eklendi!');
    }

    public function update(Request $request, $id)
    {
        $cart = Cart::find($id);
        
        // Adet 1'den küçük olmasın
        if ($request->quantity > 0) {
            $cart->quantity = $request->quantity;
            $cart->save();
        }
        
        return redirect()->back()->with('success', 'Sepet güncellendi!');
    }

    public function remove($cartId)
    {
        $cart = Cart::where('user_id', Auth::id())->findOrFail($cartId);
        $cart->delete();
        
        // Müşteriye silme işleminin sonucunu bildiriyoruz
        return back()->with('success', 'Ürün sepetten silindi.');
    }
}