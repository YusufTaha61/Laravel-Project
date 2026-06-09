<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <title>Kahve Dükkanı - Yönetim Paneli</title>
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
        
        h2 { 
            color: #fdfaf6; 
            border-bottom: 2px solid rgba(243, 156, 18, 0.5); 
            padding-bottom: 15px; 
            margin-top: 0; 
            margin-bottom: 25px; 
            text-shadow: 1px 1px 3px rgba(0,0,0,0.5); 
        }
        
        .btn-back { display: inline-block; margin-bottom: 20px; color: #5d4037; text-decoration: none; font-weight: 600; background: #efebe9; padding: 8px 15px; border-radius: 20px; transition: 0.3s; }
        .btn-back:hover { background: #f39c12; color: white; }
        
        .btn-add { background-color: #2e7d32; color: white; padding: 12px 24px; text-decoration: none; border-radius: 8px; font-weight: 600; display: inline-block; margin-bottom: 20px; transition: 0.3s; box-shadow: 0 4px 10px rgba(0,0,0,0.3); border: none; cursor: pointer; font-family: 'Poppins', sans-serif; font-size: 15px; }
        .btn-add:hover { background-color: #1b5e20; transform: translateY(-2px); }
        
        /* Tablo Tasarımı */
        table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        th, td { padding: 15px; text-align: left; border-bottom: 1px solid rgba(253, 250, 246, 0.1); vertical-align: middle; }
        th { background-color: rgba(0, 0, 0, 0.3); color: #f39c12; font-weight: 600; text-transform: uppercase; font-size: 14px; letter-spacing: 1px; }
        tr:hover { background-color: rgba(0, 0, 0, 0.1); transition: background-color 0.2s; }
        
        /* İşlem Butonları */
        .btn-edit { background-color: #2980b9; color: white; padding: 8px 14px; text-decoration: none; border-radius: 6px; font-size: 13px; font-weight: 600; transition: 0.2s; display: inline-block; border: none; font-family: 'Poppins', sans-serif; }
        .btn-edit:hover { background-color: #1f618d; }
        
        .btn-delete { background-color: #e74c3c; color: white; padding: 8px 14px; text-decoration: none; border-radius: 6px; font-size: 13px; font-weight: 600; transition: 0.2s; border: none; cursor: pointer; display: inline-block; font-family: 'Poppins', sans-serif; }
        .btn-delete:hover { background-color: #c0392b; }
        
        /* Stok Rozeti */
        .stock-badge { background: rgba(46, 125, 50, 0.2); color: #a5d6a7; border: 1px solid #4caf50; padding: 5px 12px; border-radius: 12px; font-size: 13px; font-weight: bold; display: inline-block; }
    </style>
</head>
<body>
    
    <div class="container">
        <div style="text-align: left; margin-bottom: 20px;">
            <a href="{{ route('home') }}" class="btn-back">
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
                    <td style="color: #d7ccc8;"><strong>#{{ $rs->id }}</strong></td>
                    <td style="font-weight: 600; color: #fdfaf6; font-size: 16px;">{{ $rs->title }}</td>
                    <td style="color: #a5d6a7; font-weight: bold; font-size: 16px;">{{ number_format($rs->price, 2) }} ₺</td>
                    <td><span class="stock-badge">{{ $rs->stock }} Adet</span></td>
                    <td style="text-align: center; white-space: nowrap;">
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