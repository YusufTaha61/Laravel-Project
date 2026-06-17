<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <title>Kategori Yönetimi - Admin Paneli</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap');
        body { font-family: 'Poppins', sans-serif; background-color: #1a1a1a; color: #fdfaf6; margin: 0; padding: 40px; }
        .container { max-width: 900px; margin: 0 auto; background-color: rgba(93, 64, 55, 0.85); padding: 40px; border-radius: 20px; box-shadow: 0 10px 30px rgba(0,0,0,0.5); backdrop-filter: blur(5px); }
        .header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px; border-bottom: 2px solid #f39c12; padding-bottom: 10px; }
        .btn-add { background: #27ae60; color: white; padding: 10px 20px; text-decoration: none; border-radius: 8px; font-weight: bold; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { padding: 15px; text-align: left; border-bottom: 1px solid rgba(255,255,255,0.1); }
        th { color: #f39c12; }
        .btn-edit { background: #3498db; color: white; padding: 6px 12px; text-decoration: none; border-radius: 5px; font-size: 14px; }
        .btn-delete { background: #e74c3c; color: white; padding: 6px 12px; text-decoration: none; border-radius: 5px; font-size: 14px; border: none; cursor: pointer; }
        .alert { background: #27ae60; color: white; padding: 15px; border-radius: 8px; margin-bottom: 20px; }
    </style>
</head>
<body>
    <div class="container">
        @if(session('success')) <div class="alert">{{ session('success') }}</div> @endif
        
        <div class="header">
            <h2>Kategoriler</h2>
            <div>
                <a href="{{ url('/dashboard') }}" style="color:white; margin-right:15px; text-decoration:none;">⬅ Panele Dön</a>
                <a href="{{ route('admin.category.create') }}" class="btn-add">+ Yeni Kategori Ekle</a>
            </div>
        </div>

        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Kategori Adı</th>
                    <th>İşlemler</th>
                </tr>
            </thead>
            <tbody>
                @foreach($categories as $cat)
                <tr>
                    <td>#{{ $cat->id }}</td>
                    <td>{{ $cat->title }}</td>
                    <td style="display: flex; gap: 10px;">
                        <a href="{{ route('admin.category.edit', $cat->id) }}" class="btn-edit">Düzenle</a>
                        <form action="{{ route('admin.category.destroy', $cat->id) }}" method="POST" onsubmit="return confirm('Silmek istediğine emin misin?');">
                            @csrf @method('DELETE')
                            <button type="submit" class="btn-delete">Sil</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>
</html>