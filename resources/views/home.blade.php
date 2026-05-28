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