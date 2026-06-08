<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <title>Yeni Kahve Ekle - Yönetim Paneli</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap');
        
        body { 
            font-family: 'Poppins', sans-serif; 
            background-color: #f4f6f9; 
            color: #333; 
            margin: 0; 
            padding: 40px; 
            display: flex; 
            justify-content: center; /* Formu sayfanın tam ortasına alır */
        }
        
        .container { 
            background: white; 
            padding: 40px; 
            border-radius: 15px; 
            box-shadow: 0 4px 20px rgba(0,0,0,0.05); 
            width: 100%; 
            max-width: 600px; /* Form çok yayılmasın diye maksimum genişlik verildi */
        }

        /* Geri Dön Butonu */
        .back-btn { 
            text-decoration: none; 
            color: #5d4037; 
            font-weight: 600; 
            font-size: 14px; 
            background: #efebe9; 
            padding: 8px 15px; 
            border-radius: 20px; 
            display: inline-block; 
            transition: 0.3s; 
            margin-bottom: 25px; 
        }
        .back-btn:hover { background: #d7ccc8; }
        
        h2 { 
            color: #4e73df; 
            border-bottom: 2px solid #edf2f7; 
            padding-bottom: 15px; 
            margin-top: 0; 
            margin-bottom: 25px; 
            text-align: center;
        }
        
        .form-group { margin-bottom: 20px; }
        
        label { 
            display: block; 
            margin-bottom: 8px; 
            font-weight: 600; 
            color: #5d4037; 
            font-size: 14px; 
        }
        
        /* Modern Input (Giriş) Alanları */
        input[type="text"], 
        input[type="number"], 
        select, 
        input[type="file"] { 
            width: 100%; 
            padding: 12px 15px; 
            border: 1px solid #d1d5db; 
            border-radius: 8px; 
            font-family: 'Poppins', sans-serif; 
            font-size: 14px; 
            box-sizing: border-box; /* Padding'in genişliği bozmasını engeller */
            transition: border-color 0.3s, box-shadow 0.3s; 
            background-color: #fafafa;
        }
        
        input:focus, select:focus { 
            border-color: #4e73df; 
            outline: none; 
            box-shadow: 0 0 0 3px rgba(78, 115, 223, 0.15); 
            background-color: #ffffff;
        }

        /* Dosya Yükleme Alanı Özel Ayarı */
        input[type="file"] {
            padding: 9px;
            background-color: #fff;
            cursor: pointer;
        }
        
        /* Kaydet Butonu */
        .btn-submit { 
            width: 100%; 
            padding: 14px; 
            background-color: #2e7d32; 
            color: white; 
            border: none; 
            border-radius: 8px; 
            font-weight: 600; 
            font-size: 16px; 
            cursor: pointer; 
            transition: 0.3s; 
            margin-top: 10px; 
            box-shadow: 0 4px 10px rgba(46, 125, 50, 0.2);
        }
        .btn-submit:hover { 
            background-color: #1b5e20; 
            transform: translateY(-2px);
        }
    </style>
</head>
<body>

    <div class="container">
        
        <div style="text-align: left;">
            <a href="{{ route('admin.product.index') }}" class="back-btn">⬅ Listeye Dön</a>
        </div>

        <h2>☕ Menüye Yeni Kahve Ekle</h2>

        <form action="{{ route('admin.product.store') }}" method="POST" enctype="multipart/form-data">
            @csrf 
            
            <div class="form-group">
                <label>Kategori Seçin</label>
                <select name="category_id" required>
                    <option value="">Lütfen Bir Kategori Seçiniz...</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->title }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label>Kahve Adı (Title)</label>
                <input type="text" name="title" placeholder="Örn: Caramel Macchiato" required>
            </div>

            <div class="form-group">
                <label>Fiyat (₺)</label>
                <input type="number" step="0.01" name="price" placeholder="Örn: 120.00" required>
            </div>

            <div class="form-group">
                <label>Başlangıç Stok Adedi</label>
                <input type="number" name="stock" value="0" min="0">
            </div>

            <div class="form-group">
                <label>Ürün Görseli Yükle</label>
                <input type="file" name="image" accept="image/*">
            </div>

            <div class="form-group">
                <label>Ürün Durumu</label>
                <select name="status">
                    <option value="1" selected>Aktif (Vitrinde Göster)</option> 
                    <option value="0">Pasif (Gizle)</option>
                </select>
            </div>

            <button type="submit" class="btn-submit">Veritabanına Kaydet ✔</button>
        </form>
    </div>

</body>
</html>