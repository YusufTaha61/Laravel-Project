<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <title>Sipariş Detayı #{{ $order->id }} - Admin Paneli</title>
    <style>
        body { font-family: 'Segoe UI', sans-serif; background-color: #f4f6f9; padding: 40px; color: #333; }
        .container { max-width: 1100px; margin: 0 auto; }
        
        /* Üst Başlık Alanı */
        .header-area { display: flex; justify-content: space-between; align-items: center; margin-bottom: 30px; }
        .header-area h2 { margin: 0; color: #222; }
        .btn-secondary { background-color: #6c757d; color: white; padding: 10px 20px; text-decoration: none; border-radius: 6px; font-weight: bold; transition: 0.2s; }
        .btn-secondary:hover { background-color: #5a6268; }
        
        /* Kart Yapısı */
        .row { display: flex; gap: 30px; margin-bottom: 30px; }
        .col-6 { flex: 1; }
        .card { background: white; border-radius: 8px; box-shadow: 0 4px 12px rgba(0,0,0,0.05); overflow: hidden; border: 1px solid #e3e6f0; }
        .card-header { background-color: #4e73df; color: white; padding: 15px; font-size: 18px; font-weight: bold; }
        .card-body { padding: 20px; }
        
        /* Tablo Yapıları */
        table { width: 100%; border-collapse: collapse; }
        table.info-table th, table.info-table td { padding: 12px 15px; text-align: left; border-bottom: 1px solid #edf2f7; }
        table.info-table th { background-color: #f8f9fc; color: #4e73df; width: 160px; }
        
        table.items-table th, table.items-table td { padding: 15px; text-align: left; border-bottom: 1px solid #eee; }
        table.items-table th { background-color: #f8f9fa; font-weight: bold; }
        .text-center { text-align: center; }
        .text-right { text-align: right; }
        
        /* Rozetler (Badges) */
        .badge { padding: 6px 12px; border-radius: 20px; font-size: 14px; font-weight: bold; color: white; display: inline-block; }
        .bg-primary { background-color: #4e73df; }
        .bg-info { background-color: #36b9cc; color: #fff; }
        .bg-danger { background-color: #e74a3b; }
        .bg-warning { background-color: #f6c23e; color: #333; }
        .bg-success { background-color: #1cc88a; }
        
        /* Durum Güncelleme Formu */
        .status-form { display: flex; gap: 10px; margin-top: 15px; background: #f8f9fc; padding: 15px; border-radius: 6px; border: 1px solid #e3e6f0; }
        .form-control { flex: 1; padding: 10px; border: 1px solid #d1d5db; border-radius: 6px; font-family: inherit; font-size: 15px; }
        .btn-success { background-color: #1cc88a; color: white; border: none; padding: 10px 20px; border-radius: 6px; font-weight: bold; cursor: pointer; transition: 0.2s; }
        .btn-success:hover { background-color: #17a673; }
        
        /* Bildirim */
        .alert-success { background-color: #d4edda; color: #155724; padding: 15px; border-radius: 6px; margin-bottom: 20px; border: 1px solid #c3e6cb; }
    </style>
</head>
<body>

<div class="container">

    <div class="header-area">
        <h2>Sipariş Detayı #{{ $order->id }}</h2>
        <a href="{{ route('admin.orders.index') }}" class="btn-secondary">&larr; Sipariş Listesine Dön</a>
    </div>

    @if(session('success'))
        <div class="alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="row">
        <div class="col-6">
            <div class="card">
                <div class="card-header">Müşteri Bilgileri</div>
                <div class="card-body" style="padding: 0;">
                    <table class="info-table">
                        <tr><th>Ad Soyad</th><td>{{ $order->name }}</td></tr>
                        <tr><th>E-posta</th><td>{{ $order->email }}</td></tr>
                        <tr><th>Telefon</th><td>{{ $order->phone }}</td></tr>
                        <tr><th>Adres</th><td>{{ $order->address }}</td></tr>
                        <tr><th>Şehir</th><td>{{ $order->city }}</td></tr>
                        <tr><th>Posta Kodu</th><td>{{ $order->zip_code }}</td></tr>
                    </table>
                </div>
            </div>
        </div>

        <div class="col-6">
            <div class="card">
                <div class="card-header">Sipariş Bilgileri</div>
                <div class="card-body" style="padding: 0;">
                    <table class="info-table">
                        <tr>
                            <th>Mevcut Durum</th>
                            <td>
                                @if($order->status == 'New') <span class="badge bg-primary">Yeni Sipariş</span>
                                @elseif($order->status == 'Accepted') <span class="badge bg-info">Onaylandı</span>
                                @elseif($order->status == 'Cancelled') <span class="badge bg-danger">İptal Edildi</span>
                                @elseif($order->status == 'Onshipping') <span class="badge bg-warning">Kargoda</span>
                                @elseif($order->status == 'Completed') <span class="badge bg-success">Tamamlandı</span>
                                @else <span class="badge bg-secondary">{{ $order->status }}</span>
                                @endif
                            </td>
                        </tr>
                        <tr><th>Ödeme Yöntemi</th><td>{{ $order->payment_method }}</td></tr>
                        <tr><th>Kargo Yöntemi</th><td>{{ $order->shipping_method }}</td></tr>
                        <tr><th>Sipariş Tarihi</th><td>{{ $order->created_at->format('d/m/Y H:i') }}</td></tr>
                    </table>
                    
                    <form action="{{ route('admin.orders.updateStatus', $order->id) }}" method="POST" class="status-form">
                        @csrf
                        <select name="status" class="form-control">
                            @foreach ($statuses as $status)
                                <option value="{{ $status }}" {{ $order->status == $status ? 'selected' : '' }}>
                                    {{ $status }}
                                </option>
                            @endforeach
                        </select>
                        <button type="submit" class="btn-success">Güncelle</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-header" style="background-color: #5a5c69;">Sipariş İçeriği (Ürünler)</div>
        <div class="card-body" style="padding: 0;">
            <table class="items-table">
                <thead>
                    <tr>
                        <th>Ürün ID</th>
                        <th>Ürün Adı</th>
                        <th class="text-center">Birim Fiyat</th>
                        <th class="text-center">Adet</th>
                        <th class="text-right">Toplam</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($order->items as $item)
                    <tr>
                        <td>{{ $item->product_id }}</td>
                        <td><strong>{{ $item->product_title }}</strong></td>
                        <td class="text-center">{{ number_format($item->price, 2) }} ₺</td>
                        <td class="text-center">{{ $item->quantity }}</td>
                        <td class="text-right" style="font-weight: bold; color: #4e73df;">{{ number_format($item->total, 2) }} ₺</td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="text-center" style="padding: 20px; color: #666;">Bu siparişe ait ürün bulunamadı.</td>
                    </tr>
                    @endforelse
                </tbody>
                <tfoot>
                    <tr>
                        <th colspan="4" class="text-right">Ara Toplam:</th>
                        <th class="text-right">{{ number_format($order->subtotal, 2) }} ₺</th>
                    </tr>
                    <tr>
                        <th colspan="4" class="text-right">Kargo Ücreti:</th>
                        <th class="text-right">{{ number_format($order->shipping_price, 2) }} ₺</th>
                    </tr>
                    <tr>
                        <th colspan="4" class="text-right" style="font-size: 18px;">Genel Toplam:</th>
                        <th class="text-right" style="font-size: 20px; color: #1cc88a;">{{ number_format($order->total, 2) }} ₺</th>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>

</div>

</body>
</html>