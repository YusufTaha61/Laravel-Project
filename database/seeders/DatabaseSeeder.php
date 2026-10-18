<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Admin account
        $admin = User::create([
            'name' => 'Yusuf Taha Çebi',
            'email' => 'yusuf@test.com',
            'password' => Hash::make('12345677'),
            'role' => 'admin', 
        ]);

        // 2. Kategorileri Oluşturma
        $sicak = Category::create(['title' => 'Sıcak Kahveler']);
        $soguk = Category::create(['title' => 'Soğuk Kahveler']);

        // 3. Menüdeki Kahveler
        // Veritabanındaki resim eşleşmelerinin düzelmesi için 'image' alanlarına klasöründeki dosya isimlerini yazdım
        $products = [
            ['category_id' => $sicak->id, 'title' => 'Filter Coffee', 'price' => 85.00, 'stock' => 50, 'description' => 'Özenle seçilmiş çekirdeklerden taze demlenmiş, yumuşak içimli filtre kahve.', 'image' => '202606081414Flat_W.jpg', 'status' => 1],
            ['category_id' => $soguk->id, 'title' => 'Cold Brew', 'price' => 120.00, 'stock' => 76, 'description' => '16 saat boyunca soğuk suda demlenmiş, asiditesi düşük, yoğun ve pürüzsüz kahve deneyimi.', 'image' => '202606081452Iced_L.jpg', 'status' => 1],
            ['category_id' => $sicak->id, 'title' => 'Caramel Macchiato', 'price' => 110.00, 'stock' => 70, 'description' => 'Karamel şurubu, sıcak süt ve espressonun tatlı uyumu.', 'image' => '202606081425Iced_M.jpg', 'status' => 1],
            ['category_id' => $soguk->id, 'title' => 'Iced Americano', 'price' => 110.00, 'stock' => 58, 'description' => 'Buzlu suyun üzerine eklenen taze espresso shotları ile ferahlatıcı, sert ve net bir tat.', 'image' => '202606040101Iced_A.jpg', 'status' => 1],
            ['category_id' => $sicak->id, 'title' => 'Flat White', 'price' => 95.00, 'stock' => 45, 'description' => 'İnce köpüklü sıcak süt ve yoğun espressonun mükemmel dengesi.', 'image' => '202606081441Hot_Ch.jpg', 'status' => 1],
            ['category_id' => $soguk->id, 'title' => 'Iced Latte', 'price' => 110.00, 'stock' => 55, 'description' => 'Buz gibi taze süt ve yoğun espressonun ferahlatıcı buluşması.', 'image' => '202606081446Lime_Br.jpg', 'status' => 1],
            ['category_id' => $soguk->id, 'title' => 'Iced Mocha', 'price' => 115.00, 'stock' => 38, 'description' => 'Zengin çikolata sosu, espresso ve soğuk sütün enfes karışımı.', 'image' => '202606081448Sky.jpg', 'status' => 1],
            ['category_id' => $sicak->id, 'title' => 'Turkish Coffee', 'price' => 90.00, 'stock' => 74, 'description' => 'Geleneksel usullerle ağır ağır pişirilmiş bol köpüklü Türk kahvesi.', 'image' => '202606081437Turkish.jpg', 'status' => 1],
            ['category_id' => $sicak->id, 'title' => 'Hot Chocolate', 'price' => 80.00, 'stock' => 60, 'description' => 'Gerçek çikolata parçacıkları ve buharla ısıtılmış sütün içinizi ısıtan kıvamı.', 'image' => '202606081450Affogat.jpg', 'status' => 1],
            ['category_id' => $soguk->id, 'title' => 'Lime Breeze', 'price' => 85.00, 'stock' => 50, 'description' => 'Taze misket limonu ve kahvenin şaşırtıcı derecede uyumlu, buz gibi ferahlatıcı lezzeti.', 'image' => '202606081446Lime_Br.jpg', 'status' => 1],
            ['category_id' => $soguk->id, 'title' => 'Sky', 'price' => 130.00, 'stock' => 39, 'description' => 'Özel reçetemizle hazırlanan, görseli ve tadıyla sizi bulutların üzerine çıkaracak imza soğuk içeceğimiz.', 'image' => '202606081448Sky.jpg', 'status' => 1],
            ['category_id' => $soguk->id, 'title' => 'Affogato', 'price' => 125.00, 'stock' => 65, 'description' => 'Bir top vanilyalı dondurma üzerine dökülen sıcak espresso ile tatlı ve kahve krizine son.', 'image' => '202606081450Affogat.jpg', 'status' => 1],
        ];

        foreach ($products as $product) {
            $product['user_id'] = $admin->id; 
            Product::create($product);
        }
    }
}