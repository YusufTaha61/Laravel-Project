<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <title>Kahve Dükkanım</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap');
        body { font-family: 'Poppins', sans-serif; background-color: #fdfaf6; padding: 40px; text-align: center; color: #4a4a4a; margin: 0; }
        
        .top-nav { text-align: right; padding: 15px 40px; }
        .top-nav a { text-decoration: none; color: #333; font-weight: bold; margin-left: 20px; }
        
        .filter-nav { margin: 30px 0; }
        .filter-nav a { margin: 0 10px; text-decoration: none; font-weight: 600; color: #5d4037; padding: 10px 20px; border-radius: 25px; background: #efebe9; transition: 0.3s; }
        .filter-nav a:hover { background: #795548; color: white; }
        
        .product-card { background: white; padding: 20px; margin: 15px; display: inline-block; width: 250px; border-radius: 15px; box-shadow: 0 4px 15px rgba(0,0,0,0.1); }
        .alert-success { background-color: #d4edda; color: #155724; padding: 15px; border-radius: 10px; margin: 20px auto; width: 80%; border: 1px solid #c3e6cb; font-weight: 600; }
        
        /* Admin Paneli Stili */
        .admin-panel { background: #fff3e0; padding: 20px; border-radius: 15px; margin: 20px auto; width: 80%; border: 1px solid #ffe0b2; text-align: left; }
    </style>
</head>
<body>

    <div class="top-nav">
        <a href="{{ route('cart.index') }}" style="color: #795548;">🛒 Sepetim</a>
        @if (Route::has('login'))
            @auth
                <a href="{{ url('/dashboard') }}">Dashboard</a>
            @else
                <a href="{{ route('login') }}">Log in</a>
                <a href="{{ route('register') }}">Register</a>
            @endauth
        @endif
    </div>

    @if(session('success'))
        <div class="alert-success">{{ session('success') }}</div>
    @endif

    @if(auth()->check() && auth()->user()->role == 'admin')
    <div class="admin-panel" style="background: #fff3e0; padding: 20px; border-radius: 15px; margin: 20px auto; width: 80%; border: 1px solid #ffe0b2;">
        <h2 style="color: #e65100; text-align: center; margin-bottom: 20px;">🛠 Admin Sipariş Paneli</h2>
        <table style="width: 100%; border-collapse: collapse; background: white; border-radius: 10px; overflow: hidden; table-layout: fixed;">
            <thead>
                <tr style="background: #ffe0b2; color: #5d4037;">
                    <th style="padding: 12px; text-align: center;">Müşteri Adı</th>
                    <th style="padding: 12px; text-align: center;">Tutar</th>
                    <th style="padding: 12px; text-align: center;">İşlem</th>
                </tr>
            </thead>
            <tbody>
                @foreach($orders as $order)
                <tr style="border-bottom: 1px solid #eee;">
                    <td style="padding: 12px; text-align: center; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">{{ $order->name }}</td>
                    <td style="padding: 12px; text-align: center;">{{ $order->total }} ₺</td>
                    <td style="padding: 12px; text-align: center;">
                        <a href="{{ route('admin.orders.show', $order->id) }}" style="color: #d84315; font-weight: bold; text-decoration: none;">Detay</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @endif

    <h1>☕ Kahve Dükkanımıza Hoş Geldiniz!</h1>

    <nav class="filter-nav">
        <a href="{{ route('home') }}">Tümünü Gör</a>
        <a href="{{ route('home', ['category_id' => 1]) }}">☕ Sıcak</a>
        <a href="{{ route('home', ['category_id' => 2]) }}">❄️ Soğuk</a>
    </nav>

    @foreach($products as $rs)
    <div class="product-card">
        <a href="{{ route('product.detail', ['id' => $rs->id]) }}" style="text-decoration: none; color: inherit;">
            @if($rs->image)
                <img src="{{ asset('images/'.$rs->image) }}" height="150" style="border-radius: 10px;">
            @endif
            <h3>{{ $rs->title }}</h3>
        </a>
        
        <p style="
            font-size: 12px; 
            color: #5d4037; 
            line-height: 1.4; 
            margin: 10px; 
            padding: 10px; 
            background-color: #fdf5e6; 
            border-radius: 8px; 
            text-align: justify;">
            {{ $rs->description }}
        </p>

        <p style="color: #2e7d32; font-weight: bold; font-size: 20px;">{{ $rs->price }} ₺</p>
        
        <form action="{{ route('cart.add', $rs->id) }}" method="POST">
            @csrf
            <input type="hidden" name="quantity" value="1">
            <button type="submit" style="padding: 10px 20px; background-color: #795548; color: white; border: none; border-radius: 4px; cursor: pointer; font-weight: 600;">
                Sepete Ekle
            </button>
        </form>
    </div>
    @endforeach

</body>
</html>