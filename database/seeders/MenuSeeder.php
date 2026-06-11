<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Menu;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

class MenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Ensure storage directory exists
        $destPath = public_path('storage/menus');
        if (!File::exists($destPath)) {
            File::makeDirectory($destPath, 0755, true, true);
        }

        $categories = [
            'Kopi' => [
                [
                    'name' => 'Kopi Hitam',
                    'price' => 4000,
                    'image' => 'Wajib tau manfaat KOPI HITAM.jpeg',
                    'description' => 'Kopi hitam murni hangat pelepas penat.'
                ],
                [
                    'name' => 'Kopi Susu',
                    'price' => 5000,
                    'image' => 'Embrace Caramel Almond Milk Iced Coffee Joy!.jpeg',
                    'description' => 'Kopi hitam dengan paduan susu kental manis yang pas.'
                ]
            ],
            'Non Kopi' => [
                [
                    'name' => 'Es Teh Manis',
                    'price' => 5000,
                    'image' => 'es teh manis.jpeg',
                    'description' => 'Es teh manis segar penyegar dahaga.'
                ],
                [
                    'name' => 'Es Jeruk',
                    'price' => 6000,
                    'image' => 'Es jeruk.jpeg',
                    'description' => 'Es jeruk peras segar kaya vitamin C.'
                ]
            ],
            'Burjo' => [
                [
                    'name' => 'Burjo Original',
                    'price' => 7000,
                    'image' => 'Bubur Kacang Ijo.jpeg',
                    'description' => 'Bubur kacang hijau pilihan dengan kuah santan gurih.'
                ],
                [
                    'name' => 'Burjo Ketan Hitam',
                    'price' => 8000,
                    'image' => 'Bubur ketan hitam____.jpeg',
                    'description' => 'Bubur ketan hitam manis legit dengan kuah santan gurih.'
                ],
                [
                    'name' => 'Burjo Spesial (Komplit)',
                    'price' => 11000,
                    'image' => 'download (1).jpeg',
                    'description' => 'Bubur kacang hijau, ketan hitam, dan potongan roti tawar.'
                ]
            ],
            'Indomie' => [
                [
                    'name' => 'Indomie Rebus / Goreng',
                    'price' => 7000,
                    'image' => 'indomie rebus.jpeg',
                    'description' => 'Indomie dengan racikan bumbu khas warkop.'
                ],
                [
                    'name' => 'Indomie + Telur',
                    'price' => 10000,
                    'image' => 'indomie__.jpeg',
                    'description' => 'Indomie rebus atau goreng disajikan dengan telur.'
                ],
                [
                    'name' => 'Indomie Telur Kornet',
                    'price' => 13000,
                    'image' => 'Indomie Goreng Kornet.jpeg',
                    'description' => 'Indomie rebus atau goreng lengkap dengan telur dan kornet sapi.'
                ]
            ],
            'Nasi & Roti' => [
                [
                    'name' => 'Nasi Telur Dadar / Ceplok',
                    'price' => 10000,
                    'image' => 'Try Making Kai Jeow, the Thai Omelet Infused with Umami Flavor.jpeg',
                    'description' => 'Nasi hangat dengan telur dadar atau ceplok khas Burjo.'
                ],
                [
                    'name' => 'Nasi Orak-arik Sosis',
                    'price' => 12000,
                    'image' => 'nasi telur.jpeg',
                    'description' => 'Nasi hangat dengan telur orak-arik dan potongan sosis.'
                ],
                [
                    'name' => 'Roti Bakar Keju',
                    'price' => 8000,
                    'image' => 'Roti Bakar Keju.jpeg',
                    'description' => 'Roti bakar kering renyah dengan taburan keju melimpah.'
                ],
                [
                    'name' => 'Pancong Coklat Keju',
                    'price' => 8000,
                    'image' => 'pisang coklat keju.jpeg',
                    'description' => 'Kue pancong manis dengan taburan mesis cokelat dan keju parut.'
                ]
            ]
        ];

        foreach ($categories as $catName => $items) {
            $category = Category::where('name', $catName)->first();
            if ($category) {
                foreach ($items as $item) {
                    // Copy image to storage if it exists in public/images
                    $srcFile = public_path('images/' . $item['image']);
                    if (File::exists($srcFile)) {
                        File::copy($srcFile, $destPath . '/' . $item['image']);
                    }
                    
                    Menu::create([
                        'category_id' => $category->id,
                        'name' => $item['name'],
                        'price' => $item['price'],
                        'image' => $item['image'],
                        'description' => $item['description'],
                        'is_available' => true
                    ]);
                }
            }
        }
    }
}
