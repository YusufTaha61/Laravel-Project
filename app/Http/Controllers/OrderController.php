<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Exception;

class OrderController extends Controller
{
    public function checkout()
    {
        $cartItems = Cart::with('product')->where('user_id', Auth::id())->get();

        if ($cartItems->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'Sepetiniz şu an boş.');
        }

        $subtotal = $cartItems->sum(function ($item) {
            return $item->price * $item->quantity;
        });

        $shippingPrice = 0;
        $total = $subtotal + $shippingPrice;

        return view('home.checkout', compact('cartItems', 'subtotal', 'shippingPrice', 'total'));
    }

    public function placeOrder(Request $request)
    {
        // 1. Formdan gelen verileri doğrula
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:30',
            'address' => 'required|string',
            'city' => 'nullable|string|max:255',
            'country' => 'nullable|string|max:255',
            'zip_code' => 'nullable|string|max:50',
            'shipping_method' => 'required|string|max:255',
            'payment_method' => 'required|string|max:255',
        ]);

        // 2. Müşterinin sepetini getir
        $cartItems = Cart::with('product')->where('user_id', Auth::id())->get();

        if ($cartItems->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'Sepetiniz şu an boş.');
        }

        try {
            // 3. Veritabanı işlemini başlat (Hata çıkarsa tüm işlemi geri alır)
            DB::transaction(function () use ($request, $cartItems) {
                
                $subtotal = $cartItems->sum(function ($item) {
                    return $item->price * $item->quantity;
                });

                // Kargo Ücreti Mantığı
                $shippingPrice = $request->shipping_method === 'Standard Shipping' ? 4.00 : 0;
                $total = $subtotal + $shippingPrice;

                // Siparişi Oluştur
                $order = Order::create([
                    'user_id' => Auth::id(),
                    'name' => $request->name,
                    'email' => $request->email,
                    'phone' => $request->phone,
                    'address' => $request->address,
                    'city' => $request->city,
                    'country' => $request->country,
                    'zip_code' => $request->zip_code,
                    'subtotal' => $subtotal,
                    'shipping_price' => $shippingPrice,
                    'total' => $total,
                    'shipping_method' => $request->shipping_method,
                    'payment_method' => $request->payment_method,
                    'status' => 'New',
                ]);

                // Sepetteki ürünleri sipariş detaylarına aktar ve STOK DÜŞÜR
                foreach ($cartItems as $item) {
                    $product = $item->product;

                    // Yeterli stok var mı kontrolü
                    if ($product->stock < $item->quantity) {
                        throw new Exception("Üzgünüz, {$product->title} ürününde yeterli stok bulunmuyor. (Kalan: {$product->stock})");
                    }

                    OrderItem::create([
                        'order_id' => $order->id,
                        'product_id' => $product->id,
                        'product_title' => $product->title,
                        'price' => $item->price,
                        'quantity' => $item->quantity,
                        'total' => $item->price * $item->quantity,
                    ]);

                    // Ürün sipariş edildiği an stoğunu düş
                    $product->decrement('stock', $item->quantity);
                }

                // Alışveriş bittiği için müşterinin sepetini boşalt
                Cart::where('user_id', Auth::id())->delete();
            });

            // Başarılı olursa ana sayfaya yönlendir
            return redirect()->route('home')->with('success', 'Siparişiniz başarıyla alındı! Teşekkür ederiz.');

        } catch (Exception $e) {
            // Stok hatası veya veritabanı hatası olursa kullanıcıya mesaj göster (işlemleri geri alır)
            return redirect()->route('cart.index')->with('error', $e->getMessage());
        }
    }
}