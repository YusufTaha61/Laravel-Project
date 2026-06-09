<!DOCTYPE html>

<html lang="tr">

<head>

    <meta charset="UTF-8">

    <title>{{ $data->title }} - Kahve Detayı</title>

    <style>

        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap');

       

        body { font-family: 'Poppins', sans-serif; background-color: #fdfaf6; padding: 40px; color: #4a4a4a; margin: 0; }

       

        .container {

            max-width: 900px; margin: 0 auto; background: white; padding: 40px;

            border-radius: 20px; box-shadow: 0 10px 30px rgba(0,0,0,0.05);

            display: flex; gap: 40px; align-items: flex-start;

        }

       

        /* Bildirim Kutusu Stili */

        .alert-success {

            background-color: #d4edda; color: #155724; padding: 15px;

            border-radius: 10px; margin: 0 auto 20px auto; max-width: 900px;

            border: 1px solid #c3e6cb; text-align: center; font-weight: 600;

        }

       

        .product-image { width: 50%; height: auto; object-fit: cover; border-radius: 15px; }

       

        .product-info { width: 50%; display: flex; flex-direction: column; }

       

        .title { font-size: 32px; color: #3e2723; margin-top: 0; margin-bottom: 15px; font-weight: 600; }

       

        .price { font-size: 28px; color: #2e7d32; font-weight: bold; margin-bottom: 25px; }

       

        .description {

            font-size: 16px; color: #5d4037; line-height: 1.8;

            margin-bottom: 30px; border-left: 4px solid #795548; padding-left: 20px; font-style: italic;

        }



        .btn-back { display: inline-block; margin-bottom: 20px; color: #795548; text-decoration: none; font-weight: 600; }

        .btn-back:hover { text-decoration: underline; }



        .btn-cart {

            padding: 15px 30px; background-color: #795548; color: white; border: none;

            border-radius: 8px; font-size: 18px; cursor: pointer; transition: 0.3s; width: 100%; font-weight: 600;

        }

        .btn-cart:hover { background-color: #5d4037; }

    </style>

</head>

<body>



    <div style="text-align: left; margin: 20px 40px;">

        <a href="{{ route('home') }}" style="text-decoration: none; color: #5d4037; font-weight: 600; font-size: 14px; background: #efebe9; padding: 8px 15px; border-radius: 20px; display: inline-block; transition: 0.3s; margin-bottom: 20px;">

            ⬅ Geri Dön

        </a>

    </div>



    @if(session('success'))

        <div class="alert-success">

            {{ session('success') }}

        </div>

    @endif



    <div class="container">

        @if($data->image)

            <img src="{{ asset('images/' . $data->image) }}" class="product-image" alt="{{ $data->title }}">

        @else

            <img src="https://via.placeholder.com/400" class="product-image" alt="Görsel Yok">

        @endif



        <div class="product-info">

            <h1 class="title">{{ $data->title }}</h1>

            <div class="price">{{ $data->price }} ₺</div>

           

            <p class="description">

                {{ $data->description ?? 'Bu harika kahve için henüz bir açıklama girilmemiş.' }}

            </p>

           

            <form action="{{ route('cart.add', $data->id) }}" method="POST">

                @csrf

                <div style="margin-bottom: 20px;">

                    <label style="font-weight: 600; margin-right: 10px;">Adet: </label>

                    <input type="number" name="quantity" value="1" min="1" max="{{ $data->stock }}" style="width: 70px; padding: 8px; border: 1px solid #ddd; border-radius: 5px; text-align: center;">

                </div>

               

                <button type="submit" class="btn-cart">

                    Sepete Ekle

                </button>

            </form>

        </div>

    </div>



</body>

</html>"