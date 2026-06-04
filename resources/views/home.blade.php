<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <title>Kahve Dükkanına Hoş Geldiniz</title>
    <style>
        body { font-family: Arial; padding: 20px; text-align: center; }
        .product-card { border: 1px solid #ccc; padding: 15px; margin: 10px; display: inline-block; width: 250px; }
    </style>
</head>
<body>
    <div style="text-align: right; padding: 15px;">
        @if (Route::has('login'))
            @auth
                <a href="{{ url('/dashboard') }}" style="text-decoration: none; color: #333; font-weight: bold;">Dashboard (Yönetim Paneli)</a>
            @else
                <a href="{{ route('login') }}" style="text-decoration: none; color: #333; font-weight: bold;">Log in (Giriş)</a>

                @if (Route::has('register'))
                    <a href="{{ route('register') }}" style="margin-left: 20px; text-decoration: none; color: #333; font-weight: bold;">Register (Kayıt Ol)</a>
                @endif
            @endauth
        @endif
    </div>
    <h1>☕ Kahve Dükkanımıza Hoş Geldiniz!</h1>
    <p>İşte en taze ürünlerimiz:</p>

    <hr>

    @foreach($products as $rs)
    <div class="product-card">
        <a href="{{ route('product.detail', ['id' => $rs->id]) }}" style="text-decoration: none; color: inherit;">
            
            @if($rs->image)
                <img src="{{ asset('images/'.$rs->image) }}" height="150">
            @endif
            
            <h3>{{ $rs->title }}</h3>
            
        </a>
        <p style="color: green; font-weight: bold; font-size: 20px;">{{ $rs->price }} ₺</p>
        <button>Sepete Ekle</button>
    </div>
    @endforeach

</body>
</html>