<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MenuController extends Controller
{
    public function index()
    {
        $menu = [
            'burjo' => [
                'title' => 'Burjo Spesial',
                'description' => 'Bubur kacang hijau pilihan dengan kuah santan gurih.',
                'items' => [
                    [
                        'name' => 'Burjo Original',
                        'price' => 7000,
                        'image' => 'Bubur Kacang Ijo.jpeg'
                    ],
                    [
                        'name' => 'Burjo Ketan Hitam',
                        'price' => 8000,
                        'image' => 'Bubur ketan hitam____.jpeg'
                    ],
                    [
                        'name' => 'Burjo Spesial (Komplit)',
                        'price' => 11000,
                        'image' => 'download (1).jpeg'
                    ]
                ]
            ],
            'indomie' => [
                'title' => 'Indomie Kekinian',
                'description' => 'Indomie dengan racikan bumbu rahasia warkop.',
                'items' => [
                    [
                        'name' => 'Indomie Rebus / Goreng',
                        'price' => 7000,
                        'image' => 'indomie rebus.jpeg'
                    ],
                    [
                        'name' => 'Indomie + Telur',
                        'price' => 10000,
                        'image' => 'indomie__.jpeg'
                    ],
                    [
                        'name' => 'Indomie Telur Kornet',
                        'price' => 13000,
                        'image' => 'Indomie Goreng Kornet.jpeg'
                    ]
                ]
            ],
            'nasi' => [
                'title' => 'Nasi Telur & Roti',
                'description' => 'Menu kenyang harga mahasiswa.',
                'items' => [
                    [
                        'name' => 'Nasi Telur Dadar / Ceplok',
                        'price' => 10000,
                        'image' => 'Try Making Kai Jeow, the Thai Omelet Infused with Umami Flavor.jpeg'
                    ],
                    [
                        'name' => 'Nasi Orak-arik Sosis',
                        'price' => 12000,
                        'image' => 'nasi telur.jpeg'
                    ],
                    [
                        'name' => 'Roti Bakar Keju',
                        'price' => 8000,
                        'image' => 'Roti Bakar Keju.jpeg'
                    ],
                     [
                        'name' => 'Pancong Coklat Keju',
                        'price' => 8000,
                        'image' => 'pisang coklat keju.jpeg'
                    ]
                ]
            ],
             'minuman' => [
                'title' => 'Minuman Segar',
                'description' => 'Pelepas dahaga setelah makan.',
                'items' => [
                    [
                        'name' => 'Es Teh Manis',
                        'price' => 5000,
                        'image' => 'es teh manis.jpeg'
                    ],
                    [
                        'name' => 'Kopi Hitam',
                        'price' => 4000,
                        'image' => 'Wajib tau manfaat KOPI HITAM.jpeg'
                    ],
                    [
                        'name' => 'Kopi Susu',
                        'price' => 5000,
                        'image' => 'Embrace Caramel Almond Milk Iced Coffee Joy!.jpeg'
                    ],
                     [
                        'name' => 'Es Jeruk',
                        'price' => 6000,
                        'image' => 'Es jeruk.jpeg'
                    ]
                ]
            ]
        ];

        return view('home', compact('menu'));
    }
}
