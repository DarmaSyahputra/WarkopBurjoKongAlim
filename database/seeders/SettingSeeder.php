<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $settings = [
            [
                'key' => 'warkop_name',
                'value' => 'Warkop Burjo Kong Alim',
                'label' => 'Nama Warkop',
                'type' => 'text'
            ],
            [
                'key' => 'warkop_description',
                'value' => 'Tempat nongkrong asik dengan citarasa istimewa dan harga mahasiswa.',
                'label' => 'Deskripsi Warkop',
                'type' => 'textarea'
            ],
            [
                'key' => 'warkop_address',
                'value' => 'Jl. Pendidikan No. 123, Sleman, Yogyakarta',
                'label' => 'Alamat',
                'type' => 'text'
            ],
            [
                'key' => 'warkop_phone',
                'value' => '082311867343',
                'label' => 'Nomor Telepon',
                'type' => 'text'
            ],
            [
                'key' => 'warkop_email',
                'value' => 'info@warkopkongalim.com',
                'label' => 'Email',
                'type' => 'text'
            ],
            [
                'key' => 'warkop_hours',
                'value' => 'Buka 24 Jam',
                'label' => 'Jam Operasional',
                'type' => 'text'
            ],
            [
                'key' => 'social_instagram',
                'value' => 'https://instagram.com/warkopkongalim',
                'label' => 'Link Instagram',
                'type' => 'text'
            ],
            [
                'key' => 'social_whatsapp',
                'value' => 'https://wa.me/6282311867343',
                'label' => 'Link WhatsApp',
                'type' => 'text'
            ],
            [
                'key' => 'social_tiktok',
                'value' => 'https://tiktok.com/@warkopkongalim',
                'label' => 'Link TikTok',
                'type' => 'text'
            ],
        ];

        foreach ($settings as $setting) {
            Setting::create($setting);
        }
    }
}
