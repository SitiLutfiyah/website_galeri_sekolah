<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Galeri Sekolah</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('css/welcome.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />

</head>

<body>
    <!-- Topbar -->
    <div class="topbar">
        <div class="logo-section">
            <img src="{{ asset('images/logo.jpg') }}" alt="Logo SMK 4 Kota Bogor">
            <div class="text-container">
                <div class="text">SMKN 4 BOGOR</div>
            </div>
        </div>
        <div class="categories-login">
            <div class="categories">
                <a href="/" class="{{ Request::is('/') ? 'active' : '' }}">Beranda</a>
                @foreach($categories as $category)
                <a href="/category/{{ $category->id }}"
                    class="{{ Request::is('category/'.$category->id) ? 'active' : '' }}">{{ $category->title }}</a>
                @endforeach
                <a href="#contact-section" class="scroll-to-contact">Kontak Kami</a>
            </div>
            <div class="login">
                <a href="/login">Login</a>
            </div>
        </div>
    </div>

    <!-- Hero Section -->
    <div class="hero"
        style="background: url('{{ asset('images/smkn4bogor_2.jpg') }}') no-repeat center center; background-size: cover;">
        <div class="hero-overlay"></div>
        <div class="hero-content">
            <h1 class="animate-text">Selamat Datang<span class="highlight"> Di Website Galeri SMKN 4 BOGOR</span></h1>
            <div class="tagline-container">
                <p class="animate-tagline">
                    <span class="tag">KR4BAT (KEJURUAN EMPAT HEBAT)</span>
                </p>
            </div>
            <div class="buttons">
                <a href="#profile-section" class="learn-more">Tentang Sekolah</a>
                <a href="/login" class="enrollment">Login Admin</a>
            </div>
        </div>
    </div>

    <div class="container" id="profile-section">
        <!-- Profile and Video Section -->
        <div class="profile-video-section">
            <h2>Profil Sekolah</h2>

            <div class="profile-content" id="profile-content">
                @if ($profile->count() > 0)
                <div class="profile-card">
                    <div class="profile-flex-container">
                        <div class="profile-text">
                            <h3>{{ optional($profile[0])->judul }}</h3>
                            <p>{{ optional($profile[0])->isi }}</p>
                        </div>

                        <div class="video-container">
                            <div class="video-card">
                                <video controls autoplay muted>
                                    <source src="{{ asset('images/smkn4bogor.mp4') }}" type="video/mp4">
                                    Your browser does not support the video tag.
                                </video>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card-container">
                @if ($profile->count() > 1)
                <div class="profile-card">
                    <h3>{{ optional($profile[1])->judul }}</h3>
                    <p>{{ optional($profile[1])->isi }}</p>
                    <h3>{{ optional($profile[2])->judul }}</h3>
                    <p>{!! nl2br(e(optional($profile[2])->isi)) !!}</p>
                </div>
                @endif

                @else
                <div class="profile-card">
                    <h3>Profil Sekolah</h3>
                    <p>Profil sekolah belum tersedia.</p>
                </div>
                @endif
            </div>

            <!-- Kepala Sekolah Card -->
            <div class="profile-card">
                <h3 class="kepala-sekolah-title">Kepala Sekolah</h3>
                <div class="kepala-sekolah">
                    <div class="kepala-sekolah-photo">
                        <img src="{{ asset('images/kepala_sekolah.jpg') }}" alt="Kepala Sekolah"
                            class="kepala-sekolah-img">
                    </div>
                    <div class="kepala-sekolah-info">
                        <h3>{{ optional($profile[3])->judul }}</h3>
                        <p>{{ optional($profile[3])->isi }}</p>
                    </div>
                </div>
            </div>

            <!-- Kompetensi Keahlian -->
            <div class="profile-card">
                <h3 class="kompetensi-title">Kompetensi Keahlian</h3>
                <div class="kompetensi-container">
                    <div class="kompetensi-grid">
                        <div class="kompetensi-item">
                            <img src="{{ asset('images/rpl.jpg') }}" alt="TKJ" class="kompetensi-img">
                            <h4>{{ optional($profile[4])->judul }}</h4>
                            <p>{{ optional($profile[4])->isi }}</p>
                        </div>
                        <div class="kompetensi-item">
                            <img src="{{ asset('images/tkj.jpg') }}" alt="RPL" class="kompetensi-img">
                            <h4>{{ optional($profile[5])->judul }}</h4>
                            <p>{{ optional($profile[5])->isi }}</p>
                        </div>
                        <div class="kompetensi-item">
                            <img src="{{ asset('images/to.jpg') }}" alt="MM" class="kompetensi-img">
                            <h4>{{ optional($profile[6])->judul }}</h4>
                            <p>{{ optional($profile[6])->isi }}</p>
                        </div>
                        <div class="kompetensi-item">
                            <img src="{{ asset('images/tp.jpg') }}" alt="BC" class="kompetensi-img">
                            <h4>{{ optional($profile[7])->judul }}</h4>
                            <p>{{ optional($profile[7])->isi }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Cuplikan Informasi Terkini -->
            <div class="profile-card">
                <h3 class="section-title">
                    <i class="fas fa-newspaper"></i> Informasi Terkini
                </h3>
                <div class="preview-container">
                    <div class="preview-slider" id="informasi-slider">
                        @if($informasiTerkini->isNotEmpty())
                            @foreach($informasiTerkini->take(3) as $post)
                                <div class="preview-group info-slide">
                                    <div class="preview-item">
                                        <div class="preview-content">
                                            <div class="image-wrapper">
                                                @if($post->galleries->isNotEmpty() && $post->galleries->first()->images->isNotEmpty())
                                                    <img src="{{ asset('images/' . $post->galleries->first()->images->first()->file) }}" 
                                                         alt="{{ $post->title }}" 
                                                         class="info-image"
                                                         onerror="this.src='{{ asset('images/no-image.jpg') }}'">
                                                @else
                                                    <img src="{{ asset('images/no-image.jpg') }}" 
                                                         alt="No Image" 
                                                         class="info-image">
                                                @endif
                                            </div>
                                            <div class="info-text">
                                                <div class="content-wrapper">
                                                    <div class="agenda-header">
                                                        <h4>{{ Str::limit($post->title, 50) }}</h4>
                                                        <div class="preview-meta">
                                                            <i class="far fa-calendar-alt"></i>
                                                            {{ \Carbon\Carbon::parse($post->created_at)->format('d M Y') }}
                                                        </div>
                                                    </div>
                                                    <p>{{ Str::limit($post->content, 150) }}</p>
                                                </div>
                                                <div class="footer-wrapper">
                                                    <a href="{{ route('category.show', ['category' => $post->category_id]) }}" class="read-more-btn">
                                                        Lihat Selengkapnya <i class="fas fa-arrow-right"></i>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <p class="no-content">Belum ada informasi terkini.</p>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Cuplikan Agenda Sekolah -->
            <div class="profile-card">
                <h3 class="section-title">
                    <i class="fas fa-calendar-check"></i> Agenda Sekolah
                </h3>
                <div class="preview-container">
                    <div class="preview-slider" id="agenda-slider">
                        @if($agendaSekolah->isNotEmpty())
                            @foreach($agendaSekolah as $post)
                                <div class="preview-group info-slide">
                                    <div class="preview-item">
                                        <div class="preview-content">
                                            <div class="image-wrapper">
                                                @if($post->galleries->isNotEmpty() && $post->galleries->first()->images->isNotEmpty())
                                                    <img src="{{ asset('images/' . $post->galleries->first()->images->first()->file) }}" 
                                                         alt="{{ $post->title }}" 
                                                         class="info-image"
                                                         onerror="this.src='{{ asset('images/no-image.jpg') }}'">
                                                @else
                                                    <img src="{{ asset('images/no-image.jpg') }}" 
                                                         alt="No Image" 
                                                         class="info-image">
                                                @endif
                                            </div>
                                            <div class="info-text">
                                                <div class="content-wrapper">
                                                    <div class="agenda-header">
                                                        <h4>{{ Str::limit($post->title, 50) }}</h4>
                                                        <div class="preview-meta">
                                                            <i class="far fa-calendar-alt"></i>
                                                            {{ \Carbon\Carbon::parse($post->created_at)->format('d M Y') }}
                                                        </div>
                                                    </div>
                                                    <p>{{ Str::limit($post->content, 150) }}</p>
                                                </div>
                                                <div class="footer-wrapper">
                                                    <a href="{{ route('category.show', ['category' => $post->category_id]) }}" class="read-more-btn">
                                                        Lihat Selengkapnya <i class="fas fa-arrow-right"></i>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <p class="no-content">Belum ada agenda sekolah.</p>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Cuplikan Galeri Sekolah -->
            <div class="profile-card">
                <h3 class="section-title">
                    <i class="fas fa-images"></i> Galeri Sekolah
                </h3>
                <div class="preview-container">
                    <div class="preview-slider" id="galeri-slider">
                        @if($galeriSekolah->isNotEmpty())
                            @foreach($galeriSekolah as $post)
                                <div class="preview-group info-slide">
                                    <div class="preview-item">
                                        <div class="preview-content">
                                            <div class="image-wrapper">
                                                @if($post->galleries->isNotEmpty() && $post->galleries->first()->images->isNotEmpty())
                                                    <img src="{{ asset('images/' . $post->galleries->first()->images->first()->file) }}" 
                                                         alt="{{ $post->title }}" 
                                                         class="info-image"
                                                         onerror="this.src='{{ asset('images/no-image.jpg') }}'">
                                                @else
                                                    <img src="{{ asset('images/no-image.jpg') }}" 
                                                         alt="No Image" 
                                                         class="info-image">
                                                @endif
                                            </div>
                                            <div class="info-text">
                                                <div class="content-wrapper">
                                                    <div class="agenda-header">
                                                        <h4>{{ Str::limit($post->title, 50) }}</h4>
                                                        <div class="preview-meta">
                                                            <i class="far fa-calendar-alt"></i>
                                                            {{ \Carbon\Carbon::parse($post->created_at)->format('d M Y') }}
                                                        </div>
                                                    </div>
                                                    <p>{{ Str::limit($post->content, 150) }}</p>
                                                </div>
                                                <div class="footer-wrapper">
                                                    <a href="{{ route('category.show', ['category' => $post->category_id]) }}" class="read-more-btn">
                                                        Lihat Selengkapnya <i class="fas fa-arrow-right"></i>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <p class="no-content">Belum ada galeri.</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>



    <!-- Contact Section -->
    <div class="contact-section" id="contact-section">
        <h2>Kontak Kami</h2>
        <div class="contact-container">
            <div class="contact-info">
                <!-- Alamat -->
                <div class="contact-card">
                    <h3><i class="fas fa-map-marker-alt"></i> Alamat</h3>
                    <div class="contact-details">
                        <p>Jl. Raya Tajur, Kp. Buntar RT.02/RW.08, Muarasari</p>
                        <p>Kec. Bogor Sel., Kota Bogor</p>
                        <p>Jawa Barat 16137</p>
                    </div>
                </div>

                <!-- Kontak -->
                <div class="contact-card">
                    <h3><i class="fas fa-phone-alt"></i> Hubungi Kami</h3>
                    <div class="contact-details">
                        <p><i class="fas fa-phone"></i> +62 251 7547381</p>
                        <p><i class="fas fa-envelope"></i> info@smkn4bogor.sch.id</p>
                        <p><i class="fas fa-globe"></i> www.smkn4bogor.sch.id</p>
                    </div>
                </div>

                <!-- Social Media -->
                <div class="contact-card">
                    <h3><i class="fas fa-share-alt"></i> Media Sosial</h3>
                    <div class="social-links">
                        <a href="https://www.facebook.com/people/SMK-NEGERI-4-KOTA-BOGOR/100054636630766/"
                            class="social-link facebook" target="_blank">
                            <div class="social-icon">
                                <i class="fab fa-facebook-f"></i>
                            </div>
                            <span>Facebook</span>
                        </a>

                        <a href="https://www.instagram.com/smkn4bogor.official/" class="social-link instagram"
                            target="_blank">
                            <div class="social-icon">
                                <i class="fab fa-instagram"></i>
                            </div>
                            <span>Instagram</span>
                        </a>

                        <a href="https://www.youtube.com/@smkn4kotabogor6324" class="social-link youtube"
                            target="_blank">
                            <div class="social-icon">
                                <i class="fab fa-youtube"></i>
                            </div>
                            <span>YouTube</span>
                        </a>

                        <a href="https://wa.me/+6282111465865" class="social-link whatsapp" target="_blank">
                            <div class="social-icon">
                                <i class="fab fa-whatsapp"></i>
                            </div>
                            <span>WhatsApp</span>
                        </a>
                    </div>
                </div>
            </div>

            <div class="map-container">
                <iframe
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3963.4565114533897!2d106.82147500000002!3d-6.637217!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69c8b16ee07ef5%3A0x14ab253dd267de49!2sSMK%20Negeri%204%20Bogor%20(Nebrazka)!5e0!3m2!1sid!2sid!4v1680000000000!5m2!1sid!2sid"
                    allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade">
                </iframe>
            </div>
        </div>
    </div>

    <!-- Copyright Section -->
    <div class="copyright-section">
        <div class="copyright-content">
            <div class="copyright-text">
                <i class="fas fa-code"></i>
                <p>Copyright © 2024 | Siti Lutfiyah XII PPLG 1 || SMKN 4 BOGOR</p>
                <i class="fas fa-heart"></i>
            </div>
        </div>
    </div>

    <script src="{{ asset('js/welcome.js') }}"></script>
    
</body>

</html>