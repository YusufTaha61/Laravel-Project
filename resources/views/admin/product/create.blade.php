<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <title>Yeni Kahve Ekle - Yönetim Paneli</title>
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
            display: flex; 
            flex-direction: column;
            justify-content: center; 
            align-items: center;
            min-height: 100vh;
        }
        
        .container { 
            background-color: rgba(93, 64, 55, 0.85); /* Yarı saydam koyu kahve */
            padding: 40px; 
            border-radius: 20px; 
            box-shadow: 0 10px 30px rgba(0,0,0,0.5); 
            width: 100%; 
            max-width: 600px; 
            backdrop-filter: blur(5px);
            border: 1px solid rgba(255, 255, 255, 0.1);
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
        .back-btn:hover { background: #f39c12; color: white; }
        
        h2 { 
            color: #fdfaf6; 
            border-bottom: 2px solid rgba(243, 156, 18, 0.5); 
            padding-bottom: 15px; 
            margin-top: 0; 
            margin-bottom: 25px; 
            text-align: center;
            text-shadow: 1px 1px 3px rgba(0,0,0,0.5);
        }
        
        .form-group { margin-bottom: 20px; text-align: left; }
        
        label { 
            display: block; 
            margin-bottom: 8px; 
            font-weight: 600; 
            color: #f39c12; 
            font-size: 14px; 
            letter-spacing: 0.5px;
        }
        
        /* Modern Cam Tipi Giriş Alanları */
        input[type="text"], 
        input[type="number"], 
        select, 
        input[type="file"] { 
            width: 100%; 
            padding: 12px 15px; 
            border: 1px solid rgba(255, 255, 255, 0.2); 
            border-radius: 8px; 
            font-family: 'Poppins', sans-serif; 
            font-size: 14px; 
            box-sizing: border-box; 
            transition: border-color 0.3s, box-shadow 0.3s, background-color 0.3s; 
            background-color: rgba(255, 255, 255, 0.1);
            color: white;
        }
        
        input[type="text"]::placeholder, 
        input[type="number"]::placeholder {
            color: rgba(253, 250, 246, 0.4);
        }
        
        input:focus, select:focus { 
            border-color: #f39c12; 
            outline: none; 
            box-shadow: 0 0 10px rgba(243, 156, 18, 0.3);
            background-color: rgba(255, 255, 255, 0.15);
        }

        /* Seçenekler Paneli Arka Planı */
        select option {
            background-color: #5d4037;
            color: white;
        }

        /* Dosya Yükleme Alanı Ayarı */
        input[type="file"] {
            padding: 9px;
            cursor: pointer;
        }

        input[type="file"]::file-selector-button {
            padding: 4px 12px;
            border-radius: 6px;
            border: none;
            background: #795548;
            color: white;
            cursor: pointer;
            transition: 0.3s;
            font-family: 'Poppins', sans-serif;
            font-weight: 600;
            font-size: 12px;
        }
        input[type="file"]::file-selector-button:hover { background: #f39c12; }
        
        /* Kaydet Butonu */
        .btn-submit { 
            width: 100%; 
            padding: 14px; 
            background-color: #27ae60; 
            color: white; 
            border: none; 
            border-radius: 8px; 
            font-weight: 600; 
            font-size: 16px; 
            cursor: pointer; 
            transition: 0.3s; 
            margin-top: 10px; 
            box-shadow: 0 4px 10px rgba(46, 125, 50, 0.3);
            font-family: 'Poppins', sans-serif;
        }
        .btn-submit:hover { 
            background-color: #219653; 
            transform: translateY(-2px);
            box-shadow: 0 6px 15px rgba(46, 125, 50, 0.5);
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