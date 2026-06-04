<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <title>{{ $data->title }} - Kahve Detayı</title>
    <style>
        body { font-family: 'Segoe UI', sans-serif; background-color: #f8f9fa; padding: 40px; }
        .container { max-width: 900px; margin: 0 auto; background: white; padding: 30px; border-radius: 12px; box-shadow: 0 4px 15px rgba(0,0,0,0.05); display: flex; gap: 40px; }
        .product-image { width: 50%; max-height: 400px; object-fit: cover; border-radius: 8px; }
        .product-info { width: 50%; display: flex; flex-direction: column; justify-content: center; }
        .title { font-size: 32px; color: #333; margin-bottom: 10px; }
        .price { font-size: 24px; color: #28a745; font-weight: bold; margin-bottom: 20px; }
        .description { font-size: 16px; color: #666; line-height: 1.6; margin-bottom: 30px; }
        .btn-back { display: inline-block; margin-bottom: 20px; color: #007bff; text-decoration: none; font-weight: bold; }
        .btn-cart { padding: 12px 20px; background-color: #795548; color: white; border: none; border-radius: 6px; font-size: 18px; cursor: pointer; font-weight: bold; transition: 0.2s; }
        .btn-cart:hover { background-color: #5d4037; }
    </style>
</head>
<body>

    <div style="max-width: 900px; margin: 0 auto;">
        <a href="{{ url('/') }}" class="btn-back">Geri Dön</a>
    </div>

    <div class="container">
        @if($data->image)
            <img src="{{ asset('images/' . $data->image) }}" class="product-image" alt="{{ $data->title }}">
        @else
            <img src="https://via.placeholder.com/400" class="product-image" alt="Görsel Yok">
        @endif

        <div class="product-info">
            <h1 class="title">{{ $data->title }}</h1>
            <div class="price">{{ $data->price }} ₺</div>
            <p class="description">{{ $data->description ?? 'Bu harika kahve için henüz bir açıklama girilmemiş.' }}</p>
            
            <button class="btn-cart">Sepete Ekle</button>
        </div>
    </div>

</body>
</html>