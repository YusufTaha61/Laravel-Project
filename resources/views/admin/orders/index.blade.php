<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <title>Gelen Siparişler - Admin Paneli</title>
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
            max-width: 1200px; 
            margin: 0 auto; 
            background-color: rgba(93, 64, 55, 0.85); /* Yarı saydam koyu kahve */
            padding: 40px; 
            border-radius: 20px; 
            box-shadow: 0 10px 30px rgba(0,0,0,0.5); 
            backdrop-filter: blur(5px);
        }
        
        h2 { 
            margin-top: 0; 
            color: #fdfaf6; 
            border-bottom: 2px solid rgba(243, 156, 18, 0.5); 
            padding-bottom: 15px; 
            margin-bottom: 25px; 
            text-shadow: 1px 1px 3px rgba(0,0,0,0.5); 
        }
        
        .btn-back { display: inline-block; margin-bottom: 20px; color: #5d4037; text-decoration: none; font-weight: 600; background: #efebe9; padding: 8px 15px; border-radius: 20px; transition: 0.3s; }
        .btn-back:hover { background: #f39c12; color: white; }

        /* Tablo Tasarımı */
        table { width: 100%; border-collapse: collapse; margin-bottom: 20px; }
        th, td { padding: 15px; text-align: left; border-bottom: 1px solid rgba(253, 250, 246, 0.1); vertical-align: middle; }
        th { background-color: rgba(0, 0, 0, 0.3); color: #f39c12; font-weight: 600; text-transform: uppercase; font-size: 14px; letter-spacing: 1px; }
        .text-center { text-align: center; }
        
        /* Rozetler */
        .badge { padding: 6px 12px; border-radius: 20px; font-size: 13px; font-weight: bold; color: white; display: inline-block; text-align: center; min-width: 80px; box-shadow: 0 2px 4px rgba(0,0,0,0.2); }
        .bg-primary { background-color: #2980b9; } /* Yeni Sipariş Mavi */
        .bg-info { background-color: #8e44ad; }    /* Onaylandı Mor */
        .bg-danger { background-color: #c0392b; }  /* İptal Kırmızı */
        .bg-warning { background-color: #f39c12; color: #333; } /* Kargoda Turuncu */
        .bg-success { background-color: #27ae60; } /* Tamamlandı Yeşil */
        .bg-secondary { background-color: #7f8c8d; }
        
        /* Butonlar */
        .btn-info-action { background-color: #f39c12; color: white; padding: 8px 16px; text-decoration: none; border-radius: 6px; font-weight: bold; transition: 0.2s; display: inline-block; }
        .btn-info-action:hover { background-color: #d68910; }
        
        /* Uyarı Mesajı */
        .alert-success { background-color: rgba(46, 125, 50, 0.2); color: #a5d6a7; padding: 15px; border-radius: 8px; margin-bottom: 20px; border: 1px solid #4caf50; font-weight: 600; }
    </style>
</head>
<body>

<div class="container">
    
    <div style="text-align: left; margin-bottom: 20px;">
        <a href="{{ route('home') }}" class="btn-back">
            ⬅ Ana Sayfaya Dön
        </a>
    </div>

    <h2>📋 Gelen Siparişler</h2>

    @if(session('success'))
        <div class="alert-success">
            {{ session('success') }}
        </div>
    @endif

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Müşteri</th>
                <th>Telefon</th>
                <th>Tutar</th>
                <th class="text-center">Durum</th>
                <th>Tarih</th>
                <th class="text-center">İşlemler</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($orders as $order)
            <tr>
                <td><strong>#{{ $order->id }}</strong></td>
                <td>
                    <strong style="color: #fdfaf6;">{{ $order->name }}</strong><br>
                    <small style="color: #d7ccc8;">{{ $order->email }}</small>
                </td>
                <td>{{ $order->phone }}</td>
                <td><strong style="color: #a5d6a7; font-size: 16px;">{{ number_format($order->total, 2) }} ₺</strong></td>
                <td class="text-center">
                    @if($order->status == 'New') <span class="badge bg-primary">Yeni Sipariş</span>
                    @elseif ($order->status == 'Accepted') <span class="badge bg-info">Onaylandı</span>
                    @elseif ($order->status == 'Cancelled') <span class="badge bg-danger">İptal Edildi</span>
                    @elseif ($order->status == 'Onshipping') <span class="badge bg-warning">Kargoda</span>
                    @elseif ($order->status == 'Completed') <span class="badge bg-success">Tamamlandı</span>
                    @else <span class="badge bg-secondary">{{ $order->status }}</span>
                    @endif
                </td>
                <td style="font-size: 14px; color: #d7ccc8;">{{ $order->created_at->format('d/m/Y H:i') }}</td>
                <td class="text-center">
                    <a href="{{ route('admin.orders.show', $order->id) }}" class="btn-info-action">Detay &rarr;</a>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="7" class="text-center" style="padding: 50px; color: #d7ccc8; font-size: 18px; font-weight: 300;">
                    <div style="font-size: 40px; margin-bottom: 15px;">📦</div>
                    Henüz hiç sipariş bulunmuyor. Yeni siparişler geldiğinde burada listelenecektir.
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

</body>
</html>