<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <title>Gelen Siparişler - Admin Paneli</title>
    <style>
        body { font-family: 'Segoe UI', sans-serif; background-color: #f4f6f9; padding: 40px; color: #333; }
        .container { max-width: 1200px; margin: 0 auto; background: white; padding: 30px; border-radius: 8px; box-shadow: 0 4px 12px rgba(0,0,0,0.05); }
        
        h2 { margin-top: 0; color: #4e73df; border-bottom: 2px solid #edf2f7; padding-bottom: 15px; margin-bottom: 25px; }
        
        table { width: 100%; border-collapse: collapse; }
        th, td { padding: 15px; text-align: left; border-bottom: 1px solid #edf2f7; vertical-align: middle; }
        th { background-color: #f8f9fc; color: #4e73df; font-weight: bold; }
        
        .text-center { text-align: center; }
        
        /* Rozetler */
        .badge { padding: 6px 12px; border-radius: 20px; font-size: 13px; font-weight: bold; color: white; display: inline-block; text-align: center; min-width: 80px; }
        .bg-primary { background-color: #4e73df; }
        .bg-info { background-color: #36b9cc; }
        .bg-danger { background-color: #e74a3b; }
        .bg-warning { background-color: #f6c23e; color: #333; }
        .bg-success { background-color: #1cc88a; }
        .bg-secondary { background-color: #858796; }
        
        /* Butonlar */
        .btn-info-action { background-color: #36b9cc; color: white; padding: 8px 16px; text-decoration: none; border-radius: 6px; font-weight: bold; transition: 0.2s; display: inline-block; }
        .btn-info-action:hover { background-color: #2c9faf; }
        
        /* Uyarı Mesajı */
        .alert-success { background-color: #d4edda; color: #155724; padding: 15px; border-radius: 6px; margin-bottom: 20px; border: 1px solid #c3e6cb; font-weight: bold; }
    </style>
</head>
<body>

<div class="container">
    
    <div style="text-align: left; margin-bottom: 20px;">
        <a href="{{ route('home') }}" style="text-decoration: none; color: #5d4037; font-weight: 600; font-size: 14px; background: #efebe9; padding: 8px 15px; border-radius: 20px; display: inline-block;">
            ⬅ Ana Sayfaya Dön
        </a>
    </div>

    <h2>Gelen Siparişler</h2>

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
                    <strong>{{ $order->name }}</strong><br>
                    <small style="color: #858796;">{{ $order->email }}</small>
                </td>
                <td>{{ $order->phone }}</td>
                <td><strong style="color: #1cc88a;">{{ number_format($order->total, 2) }} ₺</strong></td>
                <td class="text-center">
                    @if($order->status == 'New') <span class="badge bg-primary">Yeni Sipariş</span>
                    @elseif ($order->status == 'Accepted') <span class="badge bg-info">Onaylandı</span>
                    @elseif ($order->status == 'Cancelled') <span class="badge bg-danger">İptal Edildi</span>
                    @elseif ($order->status == 'Onshipping') <span class="badge bg-warning">Kargoda</span>
                    @elseif ($order->status == 'Completed') <span class="badge bg-success">Tamamlandı</span>
                    @else <span class="badge bg-secondary">{{ $order->status }}</span>
                    @endif
                </td>
                <td>{{ $order->created_at->format('d/m/Y H:i') }}</td>
                <td class="text-center">
                    <a href="{{ route('admin.orders.show', $order->id) }}" class="btn-info-action">Detay &rarr;</a>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="7" class="text-center" style="padding: 40px; color: #858796; font-size: 16px;">
                    Henüz hiç sipariş bulunmuyor. Yeni siparişler geldiğinde burada listelenecektir.
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

</body>
</html>