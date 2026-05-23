<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <title>Yeni Kahve Ekle</title>
    <style>
        body { font-family: sans-serif; padding: 20px; }
        .form-group { margin-bottom: 15px; }
        label { display: block; margin-bottom: 5px; font-weight: bold; }
        input, select { width: 100%; max-width: 400px; padding: 8px; }
        button { padding: 10px 15px; background-color: #28a745; color: white; border: none; cursor: pointer; }
    </style>
</head>
<body>
    <h2>Menüye Yeni Kahve Ekle</h2>

    <a href="{{ route('admin.product.index') }}">← Listeye Dön</a>
    <br><br>

    <form action="{{ route('admin.product.store') }}" method="POST" enctype="multipart/form-data">
        @csrf <div class="form-group">
            <label>Kategori Seçin:</label>
            <select name="category_id" required>
                <option value="">Seçiniz...</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->title }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label>Kahve Adı (Title):</label>
            <input type="text" name="title" required>
        </div>

        <div class="form-group">
            <label>Fiyat (₺):</label>
            <input type="number" step="0.01" name="price" required>
        </div>

        <div class="form-group">
            <label>Stok Adedi:</label>
            <input type="number" name="stock" value="0">
        </div>

        <div class="form-group">
            <label>Ürün Görseli:</label>
            <input type="file" name="image">
        </div>

        <button type="submit">Veritabanına Kaydet</button>
    </form>
</body>
</html>