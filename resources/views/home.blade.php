<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $settings['warkop_name'] }} - Nongkrong Enak & Murah</title>
    
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600&family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
    
    <!-- FontAwesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <style>
        .menu-category { margin-bottom: 50px; }
        .menu-category h3 { font-size: 1.8rem; margin-bottom: 10px; text-align: center; color: var(--primary-color); }
        .menu-category > p { text-align: center; margin-bottom: 30px; color: #666; }
        .menu-image { width: 100%; height: 200px; object-fit: cover; border-radius: 10px; margin-bottom: 15px; }
        .price { display: block; margin-top: 10px; font-weight: 700; color: var(--primary-color); font-size: 1.1rem; }
        .contact-form { max-width: 600px; margin: 0 auto; background: white; padding: 30px; border-radius: 15px; box-shadow: 0 10px 30px rgba(0,0,0,0.05); }
        .form-group { margin-bottom: 20px; }
        .form-group label { display: block; margin-bottom: 8px; font-weight: 600; }
        .form-group input, .form-group textarea { width: 100%; padding: 12px; border: 1px solid #ddd; border-radius: 8px; outline: none; transition: border 0.3s; }
        .form-group input:focus, .form-group textarea:focus { border-color: var(--primary-color); }
        .alert-success { background: #ecfdf5; color: #065f46; padding: 15px; border-radius: 8px; margin-bottom: 20px; border: 1px solid #a7f3d0; }
    </style>
</head>
<body>

    <!-- Navbar -->
    <nav class="navbar">
        <div class="container nav-container">
            <a href="#" class="logo">{{ $settings['warkop_name'] }}</a>
            <ul class="nav-links">
                <li><a href="#tentang">Tentang</a></li>
                <li><a href="#menu">Menu</a></li>
                <li><a href="#lokasi">Lokasi</a></li>
                <li><a href="#kontak" class="btn-contact">Kontak</a></li>
                @auth
                    <li><a href="{{ route('admin.dashboard') }}" class="btn-primary" style="padding: 8px 16px; font-size: 0.8rem; line-height: 1; color: var(--white) !important; display: inline-block; vertical-align: middle;">Admin</a></li>
                @else
                    <li><a href="{{ route('login') }}" style="font-size: 0.8rem; color: #666;">Login</a></li>
                @endauth
            </ul>
            <div class="hamburger">
                <i class="fas fa-bars"></i>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <header class="hero">
        <div class="container hero-content">
            <h1>Tempat Nongkrong <br><span>Paling Asik</span></h1>
            <p>{{ $settings['warkop_description'] ?? 'Lebih dari sekadar warung burjo.' }}</p>
            <a href="#menu" class="btn-primary">Lihat Menu</a>
        </div>
    </header>

    <!-- Tentang Kami -->
    <section id="tentang" class="section-padding">
        <div class="container">
            <div class="section-header">
                <h2>Tentang Kami</h2>
                <p>Lebih dari sekadar warung burjo.</p>
            </div>
            <div class="about-content">
                <p>
                    Berdiri dari semangat menyajikan kehangatan dalam setiap porsi, <strong>{{ $settings['warkop_name'] }}</strong> hadir lebih dari sekadar tempat makan biasa. Kami adalah ruang bersahabat di mana tawa, cerita, dan inspirasi menyatu, ditemani nikmatnya racikan kopi khas dan sajian burjo andalan yang selalu membangkitkan selera kangen.
                </p>
                <p style="margin-top: 15px;">
                    Dengan suasana yang santuy banget, tempat yang nyaman, dan harga yang sudah pasti akrab dengan kantong mahasiswa maupun pekerja, kami siap menyempurnakan setiap momen Anda. Silakan duduk, pesan varian pamungkasmu, dan anggap saja {{ $settings['warkop_name'] }} ini rumah keduamu!
                </p>
            </div>
        </div>
    </section>

    <!-- Menu Section -->
    <section id="menu" class="section-padding bg-light">
        <div class="container">
            <div class="section-header">
                <h2>Menu Andalan</h2>
                <p>Pilihan favorit pelanggan setia kami.</p>
            </div>
            
            @foreach($categories as $category)
            <div class="menu-category">
                <h3>{{ $category->name }}</h3>
                
                <div class="menu-grid">
                    @foreach($category->menus as $item)
                    <div class="menu-card">
                        @if($item->image)
                            <img src="{{ $item->image_url }}" alt="{{ $item->name }}" class="menu-image">
                        @else
                            <div class="icon-box"><i class="fas fa-utensils"></i></div>
                        @endif
                        <h4>{{ $item->name }}</h4>
                        <p style="font-size: 0.8rem; color: #888; height: 40px; overflow: hidden;">{{ $item->description }}</p>
                        <span class="price">Rp {{ number_format($item->price, 0, ',', '.') }}</span>
                    </div>
                    @endforeach
                </div>
            </div>
            @endforeach

        </div>
    </section>

    <!-- Lokasi -->
    <section id="lokasi" class="section-padding">
        <div class="container">
            <div class="section-header">
                <h2>Lokasi & Jam Operasional</h2>
            </div>
            <div class="location-grid">
                <!-- Map Embed -->
                <div class="map-container">
                    <iframe 
                        src="https://maps.google.com/maps?q=Warung%20burjo%20kong%20alim,%20Jl.%20H.%20Sairi,%20Tugu,%20Kec.%20Cimanggis,%20Kota%20Depok,%20Jawa%20Barat%2016451&t=&z=15&ie=UTF8&iwloc=&output=embed" 
                        allowfullscreen="" 
                        loading="lazy" 
                        referrerpolicy="no-referrer-when-downgrade">
                    </iframe>
                </div>
                
                <div class="info-box">
                    <i class="fas fa-map-marker-alt"></i>
                    <p><strong>Alamat:</strong> {{ $settings['warkop_address'] }}</p>
                    <p><strong>Buka:</strong> {{ $settings['warkop_hours'] }}</p>
                    <p><strong>WhatsApp:</strong> {{ $settings['warkop_phone'] }}</p>
                    <div style="margin-top: 20px;">
                        <a href="https://maps.app.goo.gl/7N6QSR16or4w54DW7?g_st=aw" target="_blank" class="btn-primary">
                            <i class="fas fa-directions" style="margin-right: 8px;"></i>Petunjuk Arah
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Kontak Section -->
    <section id="kontak" class="section-padding bg-light">
        <div class="container">
            <div class="section-header">
                <h2>Hubungi Kami</h2>
                <p>Punya pertanyaan atau masukan? Kirim pesan kepada kami.</p>
            </div>

            @if(session('success'))
                <div class="alert-success">
                    {{ session('success') }}
                </div>
            @endif

            <div class="contact-form">
                <form action="{{ route('contact.store') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label>Nama Lengkap</label>
                        <input type="text" name="name" required placeholder="Masukkan nama Anda">
                    </div>
                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" name="email" required placeholder="email@contoh.com">
                    </div>
                    <div class="form-group">
                        <label>Nomor Telepon</label>
                        <input type="text" name="phone" placeholder="08xxxxxx">
                    </div>
                    <div class="form-group">
                        <label>Pesan</label>
                        <textarea name="message" rows="5" required placeholder="Tuliskan pesan Anda di sini..."></textarea>
                    </div>
                    <button type="submit" class="btn-primary" style="width: 100%; border: none; cursor: pointer;">Kirim Pesan</button>
                </form>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer>
        <div class="container footer-content">
            <div class="footer-left">
                <h3>{{ $settings['warkop_name'] }}</h3>
                <p>Nongkrong hemat, perut kenyang. Tempat nongkrong asyik dengan suasana yang bersahabat.</p>
            </div>
            <div class="footer-contact">
                <h4>Ikuti Kami</h4>
                <div class="social-links" style="margin-top: 10px;">
                    <a href="{{ $settings['social_whatsapp'] }}" target="_blank" style="color: white; font-size: 1.5rem;"><i class="fab fa-whatsapp"></i></a>
                </div>
            </div>
        </div>
        <div class="footer-bottom">
            <p>&copy; 2026 {{ $settings['warkop_name'] }}. All rights reserved.</p>
        </div>
    </footer>

    <script src="{{ asset('js/script.js') }}"></script>
</body>
</html>
