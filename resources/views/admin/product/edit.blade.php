<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <title>Kahve Bilgilerini Düzenle</title>
    <style>
        body { font-family: sans-serif; padding: 20px; }
        .form-group { margin-bottom: 15px; }
        label { display: block; margin-bottom: 5px; font-weight: bold; }
        input, select { width: 100%; max-width: 400px; padding: 8px; }
        button { padding: 10px 15px; background-color: #007bff; color: white; border: none; cursor: pointer; }
    </style>
</head>
<body>
    <h2>Kahve Bilgilerini Düzenle</h2>

    <a href="{{ route('admin.product.index') }}">← Listeye Dön</a>
    <br><br>

    <form action="{{ route('admin.product.update', $data->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT') <div class="form-group">
            <label>Kategori Seçin:</label>
            <select name="category_id" required>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}" @if($category->id == $data->category_id) selected @endif>
                        {{ $category->title }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label>Kahve Adı (Title):</label>
            <input type="text" name="title" value="{{ $data->title }}" required>
        </div>

        <div class="form-group">
            <label>Fiyat (₺):</label>
            <input type="number" step="0.01" name="price" value="{{ $data->price }}" required>
        </div>

        <div class="form-group">
            <label>Stok Adedi:</label>
            <input type="number" name="stock" value="{{ $data->stock }}">
        </div>

        <div class="form-group">
            <label>Mevcut Görsel:</label><br>
            @if($data->image)
                <img src="{{ asset('images/'.$data->image) }}" height="100" alt="Kahve Resmi"><br><br>
            @endif
            
            <label>Yeni Görsel Yükle (Değiştirmek istemiyorsan boş bırak):</label>
            <input type="file" name="image">
        </div>

        <button type="submit">Güncelle ve Kaydet</button>
    </form>
</body>
</html>