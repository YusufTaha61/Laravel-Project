<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <title>Kahve Dükkanı - Yönetim Paneli</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap');
        
        body { font-family: 'Poppins', sans-serif; background-color: #f4f6f9; padding: 40px; color: #333; margin: 0; }
        .container { max-width: 1000px; margin: 0 auto; background: white; padding: 30px; border-radius: 12px; box-shadow: 0 4px 15px rgba(0,0,0,0.05); }
        
        h2 { color: #4e73df; border-bottom: 2px solid #edf2f7; padding-bottom: 15px; margin-top: 0; margin-bottom: 25px; }
        
        .btn-add { background-color: #2e7d32; color: white; padding: 10px 20px; text-decoration: none; border-radius: 8px; font-weight: 600; display: inline-block; margin-bottom: 20px; transition: 0.3s; box-shadow: 0 2px 4px rgba(0,0,0,0.1); border: none; cursor: pointer; }
        .btn-add:hover { background-color: #1b5e20; }
        
        table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        th, td { padding: 15px; text-align: left; border-bottom: 1px solid #edf2f7; vertical-align: middle; }
        th { background-color: #f8f9fc; color: #4e73df; font-weight: 600; }
        tr:hover { background-color: #f8fafc; transition: background-color 0.2s; }
        
        /* İşlem Butonları */
        .btn-edit { background-color: #4e73df; color: white; padding: 6px 12px; text-decoration: none; border-radius: 6px; font-size: 13px; font-weight: 600; transition: 0.2s; display: inline-block; }
        .btn-edit:hover { background-color: #2e59d9; }
        
        .btn-delete { background-color: #e74a3b; color: white; padding: 6px 12px; text-decoration: none; border-radius: 6px; font-size: 13px; font-weight: 600; transition: 0.2s; border: none; cursor: pointer; display: inline-block; }
        .btn-delete:hover { background-color: #be2617; }
        
        .stock-badge { background: #e8f5e9; color: #2e7d32; padding: 5px 10px; border-radius: 12px; font-size: 13px; font-weight: bold; display: inline-block; }
    </style>
</head>
<body>
    
    <div class="container">
        <div style="text-align: left; margin-bottom: 20px;">
            <a href="{{ route('home') }}" style="text-decoration: none; color: #5d4037; font-weight: 600; font-size: 14px; background: #efebe9; padding: 8px 15px; border-radius: 20px; display: inline-block; transition: 0.3s;">
                ⬅ Ana Sayfaya Dön
            </a>
        </div>

        <h2>☕ Menüdeki Kahveler</h2>
        
        <a href="{{ route('admin.product.create') }}" style="text-decoration: none;">
            <button class="btn-add">➕ Yeni Kahve Ekle</button>
        </a>

        <table>
            <thead>
                <tr>
                    <th style="width: 50px;">ID</th>
                    <th>Ürün Adı</th>
                    <th>Fiyat</th>
                    <th>Stok</th>
                    <th style="text-align: center;">İşlemler</th>
                </tr>
            </thead>
            <tbody>
                @foreach($products as $rs)
                <tr>
                    <td style="color: #666;"><strong>#{{ $rs->id }}</strong></td>
                    <td style="font-weight: 600; color: #5d4037;">{{ $rs->title }}</td>
                    <td style="color: #2e7d32; font-weight: bold; font-size: 15px;">{{ number_format($rs->price, 2) }} ₺</td>
                    <td><span class="stock-badge">{{ $rs->stock }} Adet</span></td>
                    <td style="text-align: center;">
                        <a href="{{ route('admin.product.edit', $rs->id) }}" class="btn-edit">Düzenle</a> 
                        <form action="{{ route('admin.product.destroy', $rs->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn-delete" onclick="return confirm('Bu kahveyi silmek istediğinize emin misiniz?')">Sil</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

</body>
</html>