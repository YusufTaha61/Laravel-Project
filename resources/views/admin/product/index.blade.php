<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <title>Kahve Dükkanı - Yönetim Paneli</title>
</head>
<body>
    <h2>Menüdeki Kahveler</h2>
    
    <a href="{{ route('admin.product.create') }}">
        <button style="margin-bottom: 10px; padding: 5px 10px;">+ Yeni Kahve Ekle</button>
    </a>

    <table border="1" width="100%" cellpadding="10" style="border-collapse: collapse; text-align: left;">
        <tr style="background-color: #f2f2f2;">
            <th>ID</th>
            <th>Ürün Adı</th>
            <th>Fiyat</th>
            <th>Stok</th>
            <th>İşlemler</th>
        </tr>
        
        @foreach($products as $rs)
        <tr>
            <td>{{ $rs->id }}</td>
            <td>{{ $rs->title }}</td>
            <td>{{ $rs->price }} ₺</td>
            <td>{{ $rs->stock }}</td>
            <td>
                <a href="{{ route('admin.product.edit', $rs->id) }}" style="color: blue;">Düzenle</a> 
                <form action="{{ route('admin.product.destroy', $rs->id) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" style="color: red; border: none; background: none; cursor: pointer; text-decoration: underline; font-size: 16px;">
                        Sil
                    </button>
                </form>
            </td>
        </tr>
        @endforeach
    </table>
</body>
</html>