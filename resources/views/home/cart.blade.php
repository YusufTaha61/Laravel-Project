<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <title>Alışveriş Sepetim</title>
    <style>
        body { font-family: 'Segoe UI', sans-serif; background-color: #f8f9fa; padding: 40px; }
        .container { max-width: 1000px; margin: 0 auto; background: white; padding: 30px; border-radius: 12px; box-shadow: 0 4px 15px rgba(0,0,0,0.05); }
        .title { font-size: 32px; color: #333; margin-bottom: 20px; border-bottom: 2px solid #eee; padding-bottom: 10px; }
        .btn-back { display: inline-block; margin-bottom: 20px; color: #007bff; text-decoration: none; font-weight: bold; }
        
        /* Tablo Tasarımı */
        table { width: 100%; border-collapse: collapse; margin-bottom: 30px; }
        th, td { padding: 15px; text-align: left; border-bottom: 1px solid #eee; vertical-align: middle; }
        th { background-color: #f8f9fa; color: #333; font-weight: bold; }
        .text-center { text-align: center; }
        .text-right { text-align: right; }
        
        /* Butonlar */
        .btn-update { background-color: #007bff; color: white; border: none; padding: 6px 12px; border-radius: 4px; cursor: pointer; transition: 0.2s; }
        .btn-update:hover { background-color: #0056b3; }
        .btn-delete { background-color: #dc3545; color: white; border: none; padding: 6px 12px; border-radius: 4px; cursor: pointer; transition: 0.2s; font-weight: bold; }
        .btn-delete:hover { background-color: #c82333; }
        .btn-checkout { display: inline-block; padding: 12px 25px; background-color: #28a745; color: white; text-decoration: none; border-radius: 6px; font-size: 18px; font-weight: bold; transition: 0.2s; }
        .btn-checkout:hover { background-color: #218838; }
        
        /* Uyarı Mesajları */
        .alert-success { background-color: #d4edda; color: #155724; padding: 15px; border-radius: 6px; margin-bottom: 20px; border: 1px solid #c3e6cb; }
        .alert-error { background-color: #f8d7da; color: #721c24; padding: 15px; border-radius: 6px; margin-bottom: 20px; border: 1px solid #f5c6cb; }
    </style>
</head>
<body>

    <div style="max-width: 1000px; margin: 0 auto;">
        <a href="{{ url('/') }}" class="btn-back">&larr; Alışverişe Dön</a>
    </div>

    <div class="container">
        <h1 class="title">Alışveriş Sepetim</h1>

        @if(session('success'))
            <div class="alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="alert-error">
                {{ session('error') }}
            </div>
        @endif

        @if ($cartItems->count() > 0)
            <table>
                <thead>
                    <tr>
                        <th>Görsel</th>
                        <th>Ürün Adı</th>
                        <th class="text-center">Birim Fiyat</th>
                        <th class="text-center">Adet</th>
                        <th class="text-center">Toplam</th>
                        <th class="text-center">İşlem</th>
                    </tr>
                </thead>
                <tbody>
                    @php $subtotal = 0; @endphp
                    
                    @foreach ($cartItems as $item)
                        @php
                            $lineTotal = $item->price * $item->quantity;
                            $subtotal += $lineTotal;
                        @endphp
                        <tr>
                            <td style="width: 80px;">
                                @if($item->product && $item->product->image)
                                    <img src="{{ asset('images/' . $item->product->image) }}" alt="{{ $item->product->title }}" style="width: 60px; border-radius: 6px;">
                                @else
                                    <img src="https://via.placeholder.com/60" alt="Görsel Yok" style="border-radius: 6px;">
                                @endif
                            </td>
                            <td>
                                <strong>{{ $item->product->title ?? 'Ürün Silinmiş' }}</strong>
                            </td>
                            <td class="text-center">
                                {{ number_format($item->price, 2) }} ₺
                            </td>
                            <td class="text-center" style="width: 150px;">
                                <form action="{{ route('cart.update', $item->id) }}" method="POST" style="display: flex; gap: 8px; justify-content: center;">
                                    @csrf
                                    <input type="number" name="quantity" value="{{ $item->quantity }}" min="1" style="width: 60px; padding: 4px; text-align: center; border: 1px solid #ccc; border-radius: 4px;">
                                    <button type="submit" class="btn-update">Yenile</button>
                                </form>
                            </td>
                            <td class="text-center">
                                <strong style="color: #795548;">{{ number_format($lineTotal, 2) }} ₺</strong>
                            </td>
                            <td class="text-center">
                                <form action="{{ route('cart.remove', $item->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn-delete">X</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="4" class="text-right" style="font-size: 18px;"><strong>Ara Toplam:</strong></td>
                        <td colspan="2" style="font-size: 22px; color: #28a745;"><strong>{{ number_format($subtotal, 2) }} ₺</strong></td>
                    </tr>
                </tfoot>
            </table>

            <div class="text-right">
                <a href="{{ route('checkout') }}" class="btn-checkout">
                    Siparişi Tamamla &rarr;
                </a>
            </div>
        @else
            <div style="text-align: center; padding: 40px 0;">
                <h3 style="color: #666; margin-bottom: 20px;">Sepetiniz şu an boş.</h3>
                <a href="{{ url('/') }}" class="btn-checkout" style="background-color: #007bff;">Alışverişe Başla</a>
            </div>
        @endif
    </div>

</body>
</html>