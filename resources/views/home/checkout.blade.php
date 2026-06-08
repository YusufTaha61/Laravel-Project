<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <title>Siparişi Tamamla</title>
    <style>
        body { font-family: 'Segoe UI', sans-serif; background-color: #f8f9fa; padding: 40px; }
        .container { max-width: 1000px; margin: 0 auto; background: white; padding: 30px; border-radius: 12px; box-shadow: 0 4px 15px rgba(0,0,0,0.05); }
        .title { font-size: 28px; color: #333; border-bottom: 2px solid #eee; padding-bottom: 10px; margin-bottom: 20px; }
        .btn-back { display: inline-block; margin-bottom: 20px; color: #007bff; text-decoration: none; font-weight: bold; }
        
        .row { display: flex; gap: 40px; }
        .col-md-6 { flex: 1; }
        
        /* Form Elemanları */
        .form-group { margin-bottom: 15px; }
        .form-group label { display: block; margin-bottom: 5px; font-weight: bold; color: #555; }
        .input { width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 6px; box-sizing: border-box; font-family: inherit; }
        
        /* Sipariş Özeti Tablosu */
        table { width: 100%; border-collapse: collapse; margin-bottom: 20px; }
        th, td { padding: 12px; text-align: left; border-bottom: 1px solid #eee; }
        th { background-color: #f8f9fa; color: #333; }
        .text-right { text-align: right; }
        .text-center { text-align: center; }
        
        /* Butonlar ve Hata Mesajları */
        .btn-place-order { width: 100%; padding: 15px; background-color: #28a745; color: white; border: none; border-radius: 6px; font-size: 18px; font-weight: bold; cursor: pointer; transition: 0.2s; }
        .btn-place-order:hover { background-color: #218838; }
        .alert-error { background-color: #f8d7da; color: #721c24; padding: 15px; border-radius: 6px; margin-bottom: 20px; border: 1px solid #f5c6cb; }
    </style>
</head>
<body>

    <div style="max-width: 1000px; margin: 0 auto;">
        <a href="{{ route('cart.index') }}" class="btn-back">&larr; Sepete Dön</a>
    </div>

    <div class="container">
        @if(session('error'))
            <div class="alert-error">{{ session('error') }}</div>
        @endif
        @if ($errors->any())
            <div class="alert-error">
                <ul style="margin: 0; padding-left: 20px;">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('place.order') }}" method="POST">
            @csrf
            <div class="row">
                <div class="col-md-6">
                    <h3 class="title">Teslimat Bilgileri</h3>
                    
                    <div class="form-group">
                        <label>Ad Soyad</label>
                        <input class="input" type="text" name="name" value="{{ auth()->user()->name ?? '' }}" required>
                    </div>
                    <div class="form-group">
                        <label>E-posta Adresi</label>
                        <input class="input" type="email" name="email" value="{{ auth()->user()->email ?? '' }}" required>
                    </div>
                    <div class="form-group">
                        <label>Telefon Numarası</label>
                        <input class="input" type="tel" name="phone" required>
                    </div>
                    <div class="form-group">
                        <label>Açık Adres</label>
                        <input class="input" type="text" name="address" required>
                    </div>
                    
                    <div style="display: flex; gap: 10px;">
                        <div class="form-group" style="flex: 1;">
                            <label>Şehir</label>
                            <input class="input" type="text" name="city" required>
                        </div>
                        <div class="form-group" style="flex: 1;">
                            <label>Posta Kodu</label>
                            <input class="input" type="text" name="zip_code">
                        </div>
                    </div>

                    <input type="hidden" name="country" value="Türkiye">
                    <input type="hidden" name="shipping_method" value="Free Shipping">
                    <input type="hidden" name="payment_method" value="Cash on Delivery">
                </div>

                <div class="col-md-6">
                    <h3 class="title">Sipariş Özeti</h3>
                    
                    <table>
                        <thead>
                            <tr>
                                <th>Ürün</th>
                                <th class="text-center">Adet</th>
                                <th class="text-right">Toplam</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($cartItems as $item)
                            <tr>
                                <td>{{ $item->product->title ?? 'Bilinmeyen Ürün' }}</td>
                                <td class="text-center">{{ $item->quantity }}</td>
                                <td class="text-right">{{ number_format($item->price * $item->quantity, 2) }} ₺</td>
                            </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <th colspan="2">Ara Toplam:</th>
                                <th class="text-right">{{ number_format($subtotal, 2) }} ₺</th>
                            </tr>
                            <tr>
                                <th colspan="2">Kargo:</th>
                                <th class="text-right" style="color: #28a745;">Ücretsiz</th>
                            </tr>
                            <tr>
                                <th colspan="2" style="font-size: 18px;">Genel Toplam:</th>
                                <th class="text-right" style="font-size: 18px; color: #28a745;">{{ number_format($total, 2) }} ₺</th>
                            </tr>
                        </tfoot>
                    </table>

                    <div style="background-color: #f8f9fa; padding: 15px; border-radius: 6px; border: 1px solid #ddd; margin-bottom: 20px;">
                        <strong>Ödeme Yöntemi:</strong> Kapıda Ödeme / Havale
                    </div>

                    <button type="submit" class="btn-place-order">
                        Siparişi Onayla ve Bitir
                    </button>
                </div>
            </div>
        </form>
    </div>

</body>
</html>