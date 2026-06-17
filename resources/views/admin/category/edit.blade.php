<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <title>Kategori Düzenle</title>
    <style>
        body { font-family: sans-serif; background: #1a1a1a; color: white; padding: 40px; display: flex; justify-content: center; }
        .box { background: rgba(93, 64, 55, 0.85); padding: 40px; border-radius: 20px; width: 400px; }
        input { width: 100%; padding: 10px; margin: 10px 0; border-radius: 5px; border: none; box-sizing: border-box;}
        button { width: 100%; padding: 10px; background: #27ae60; color: white; border: none; border-radius: 5px; font-weight: bold; cursor: pointer; }
    </style>
</head>
<body>
    <div class="box">
        <a href="{{ route('admin.category.index') }}" style="color:#f39c12; text-decoration:none;">⬅ Geri</a>
        <h2 style="border-bottom: 2px solid #f39c12; padding-bottom:10px;">Kategori Düzenle</h2>
        <form action="{{ route('admin.category.update', $category->id) }}" method="POST">
            @csrf @method('PUT')
            <label>Kategori Adı</label>
            <input type="text" name="title" value="{{ $category->title }}" required>
            <button type="submit">Güncelle</button>
        </form>
    </div>
</body>
</html>