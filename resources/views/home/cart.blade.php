<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <title>Alışveriş Sepetim</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap');
        
        body { 
            font-family: 'Poppins', sans-serif; 
            /* Ahşap Arka Plan ve İkonlar */
            background-color: #1a1a1a;
            background-image:
                url('data:image/svg+xml;utf8,<svg xmlns="http://www.w3.org/2000/svg" width="100" height="100" viewBox="0 0 100 100"><path fill="%23b87333" d="M20,10 L30,20 L20,30 L10,20 Z" opacity="0.3"/></svg>'),
                url('https://images.unsplash.com/photo-1579751626657-72bc17010498?q=80&w=1000');
            background-blend-mode: overlay;
            background-size: cover;
            background-attachment: fixed;
            color: #fdfaf6; 
            margin: 0; 
            padding: 40px; 
        }

        .container { 
            max-width: 1000px; 
            margin: 0 auto; 
            background-color: rgba(93, 64, 55, 0.85); /* Yarı saydam koyu kahve */
            padding: 40px; 
            border-radius: 20px; 
            box-shadow: 0 10px 30px rgba(0,0,0,0.5); 
            backdrop-filter: blur(5px);
        }

        .title { font-size: 32px; color: #fdfaf6; margin-bottom: 20px; border-bottom: 2px solid rgba(243, 156, 18, 0.5); padding-bottom: 10px; text-shadow: 1px 1px 3px rgba(0,0,0,0.5); }
        
        .btn-back { display: inline-block; margin-bottom: 20px; color: #5d4037; text-decoration: none; font-weight: 600; background: #efebe9; padding: 8px 15px; border-radius: 20px; transition: 0.3s; }
        .btn-back:hover { background: #f39c12; color: white; }
        
        /* Tablo Tasarımı */
        table { width: 100%; border-collapse: collapse; margin-bottom: 30px; }
        th, td { padding: 15px; text-align: left; border-bottom: 1px solid rgba(253, 250, 246, 0.1); vertical-align: middle; }
        th { background-color: rgba(0, 0, 0, 0.3); color: #f39c12; font-weight: 600; text-transform: uppercase; font-size: 14px; letter-spacing: 1px; }
        .text-center { text-align: center; }
        .text-right { text-align: right; }
        
        /* Butonlar ve Inputlar */
        .quantity-input { width: 60px; padding: 6px; text-align: center; border: 1px solid #795548; border-radius: 6px; background: rgba(253, 250, 246, 0.9); color: #333; font-family: 'Poppins', sans-serif; font-weight: bold; outline: none; }
        
        .btn-update { background-color: #f39c12; color: white; border: none; padding: 8px 15px; border-radius: 6px; cursor: pointer; transition: 0.2s; font-weight: 600; font-family: 'Poppins', sans-serif; }
        .btn-update:hover { background-color: #d68910; }
        
        .btn-delete { background-color: #e74c3c; color: white; border: none; padding: 8px 12px; border-radius: 6px; cursor: pointer; transition: 0.2s; font-weight: bold; font-family: 'Poppins', sans-serif; }
        .btn-delete:hover { background-color: #c0392b; }
        
        .btn-checkout { display: inline-block; padding: 15px 30px; background-color: #2e7d32; color: white; text-decoration: none; border-radius: 8px; font-size: 18px; font-weight: bold; transition: 0.3s; box-shadow: 0 4px 10px rgba(0,0,0,0.3); }
        .btn-checkout:hover { background-color: #1b5e20; transform: translateY(-2px); }
        .btn-start-shopping { background-color: #f39c12; display: inline-block; padding: 12px 25px; color: white; text-decoration: none; border-radius: 6px; font-weight: bold; transition: 0.3s; }
        .btn-start-shopping:hover { background-color: #d68910; }
        
        /* Uyarı Mesajları */
        .alert-success { background-color: rgba(46, 125, 50, 0.2); color: #a5d6a7; padding: 15px; border-radius: 8px; margin-bottom: 20px; border: 1px solid #4caf50; font-weight: 600; }
        .alert-error { background-color: rgba(231, 76, 60, 0.2); color: #f5b7b1; padding: 15px; border-radius: 8px; margin-bottom: 20px; border: 1px solid #e74c3c; font-weight: 600; }
    </style>
</head>
<body>

    <div style="max-width: 1000px; margin: 0 auto; text-align: left;">
        <a href="{{ route('home') }}" class="btn-back">
            ⬅ Menüye Dön
        </a>
    </div>

    <div class="container">
        <h1 class="title">🛒 Alışveriş Sepetim</h1>

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
                                    <img src="{{ asset('images/' . $item->product->image) }}" alt="{{ $item->product->title }}" style="width: 65px; height: 65px; object-fit: cover; border-radius: 8px; box-shadow: 0 2px 5px rgba(0,0,0,0.5);">
                                @else
                                    <img src="https://via.placeholder.com/65" alt="Görsel Yok" style="border-radius: 8px;">
                                @endif
                            </td>
                            <td>
                                <strong style="font-size: 16px;">{{ $item->product->title ?? 'Ürün Silinmiş' }}</strong>
                            </td>
                            <td class="text-center">
                                {{ number_format($item->price, 2) }} ₺
                            </td>
                            <td class="text-center" style="width: 160px;">
                                <form action="{{ route('cart.update', $item->id) }}" method="POST" style="display: flex; gap: 10px; justify-content: center; align-items: center;">
                                    @csrf
                                    <input type="number" name="quantity" value="{{ $item->quantity }}" min="1" class="quantity-input">
                                    <button type="submit" class="btn-update">↻</button>
                                </form>
                            </td>
                            <td class="text-center">
                                <strong style="color: #f39c12; font-size: 16px;">{{ number_format($lineTotal, 2) }} ₺</strong>
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
                        <td colspan="4" class="text-right" style="font-size: 18px; padding-top: 25px;"><strong>Ara Toplam:</strong></td>
                        <td colspan="2" style="font-size: 24px; color: #a5d6a7; padding-top: 25px;"><strong>{{ number_format($subtotal, 2) }} ₺</strong></td>
                    </tr>
                </tfoot>
            </table>

            <div class="text-right" style="margin-top: 20px;">
                <a href="{{ route('checkout') }}" class="btn-checkout">
                    Siparişi Tamamla &rarr;
                </a>
            </div>
        @else
            <div style="text-align: center; padding: 50px 0;">
                <div style="font-size: 50px; margin-bottom: 20px;">☕</div>
                <h3 style="color: #d7ccc8; margin-bottom: 25px; font-weight: 300;">Sepetiniz şu an boş.</h3>
                <a href="{{ url('/') }}" class="btn-start-shopping">Alışverişe Başla</a>
            </div>
        @endif
    </div>

</body>
</html>