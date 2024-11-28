<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $category->title }}</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('css/welcome.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        .post-images {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 10px;
            margin-bottom: 15px;
        }

        .post-image {
            aspect-ratio: 16/9;
            overflow: hidden;
            border-radius: 8px;
        }

        .post-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .view-more-images {
            position: relative;
            cursor: pointer;
            background: rgba(0, 0, 0, 0.5);
            display: flex;
            align-items: center;
            justify-content: center;
            aspect-ratio: 16/9;
            border-radius: 8px;
        }

        .view-more-text {
            color: white;
            font-weight: bold;
        }

        .additional-images {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 10px;
            margin-top: 10px;
        }

        .post-card {
            background: #fff;
            border-radius: 12px;
            padding: 20px;
            margin-bottom: 30px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
            cursor: pointer;
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }

        .post-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.3);
        }

        .post-images-container {
            display: flex;
            flex-direction: column;
            gap: 10px;
            margin-bottom: 20px;
        }

        .main-image {
            width: 100%;
            height: 400px;
            border-radius: 8px;
            overflow: hidden;
        }

        .main-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .thumbnail-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 10px;
        }

        .thumbnail {
            position: relative;
            aspect-ratio: 1;
            border-radius: 8px;
            overflow: hidden;
        }

        .thumbnail img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .view-more-images {
            position: relative;
            cursor: pointer;
        }

        .overlay {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0, 0, 0, 0.6);
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .view-more-text {
            color: white;
            font-weight: bold;
            font-size: 16px;
        }

        .additional-images {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 10px;
            margin-top: 10px;
        }

        .post-content {
            padding-top: 15px;
        }

        .post-content h2 {
            font-size: 24px;
            margin-bottom: 12px;
            color: #333;
        }

        .post-content p {
            color: #666;
            line-height: 1.6;
            margin-bottom: 15px;
        }

        .post-meta {
            color: #888;
            font-size: 14px;
        }

        .post-meta i {
            margin-right: 5px;
        }

        /* Modal styles */
        .modal {
            display: none;
            position: fixed;
            z-index: 1000;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.95);
            overflow-y: auto;
            padding: 50px 0;
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .modal.show {
            opacity: 1;
        }

        .modal-content {
            position: relative;
            margin: auto;
            padding: 30px;
            width: 90%;
            max-width: 1400px;
            background: rgba(255, 255, 255, 0.05);
            border-radius: 20px;
            backdrop-filter: blur(10px);
        }

        .close-modal {
            position: fixed;
            right: 30px;
            top: 20px;
            color: #fff;
            font-size: 40px;
            font-weight: 300;
            cursor: pointer;
            z-index: 1001;
            width: 50px;
            height: 50px;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.3s ease;
        }

        .close-modal:hover {
            background: rgba(255, 255, 255, 0.2);
            transform: rotate(90deg);
        }

        .gallery-container {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(350px, 1fr));
            gap: 25px;
            padding: 20px 0;
        }

        .gallery-item {
            position: relative;
            width: 100%;
            aspect-ratio: 1;
            overflow: hidden;
            border-radius: 15px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
            cursor: pointer;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .gallery-item:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.3);
        }

        .gallery-item img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.5s ease;
        }

        .gallery-item:hover img {
            transform: scale(1.08);
        }

        /* Custom scrollbar untuk modal */
        .modal::-webkit-scrollbar {
            width: 10px;
        }

        .modal::-webkit-scrollbar-track {
            background: rgba(255, 255, 255, 0.1);
            border-radius: 5px;
        }

        .modal::-webkit-scrollbar-thumb {
            background: rgba(255, 255, 255, 0.3);
            border-radius: 5px;
        }

        .modal::-webkit-scrollbar-thumb:hover {
            background: rgba(255, 255, 255, 0.4);
        }

        /* Loading animation untuk gambar */
        .gallery-item::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(45deg, 
                rgba(255,255,255,0.1) 25%, 
                rgba(255,255,255,0.2) 50%, 
                rgba(255,255,255,0.1) 75%
            );
            background-size: 200% 200%;
            animation: shimmer 1.5s infinite;
            pointer-events: none;
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .gallery-item.loading::before {
            opacity: 1;
        }

        @keyframes shimmer {
            0% { background-position: -200% 0; }
            100% { background-position: 200% 0; }
        }

        body.modal-open {
            overflow: hidden;
            padding-right: 15px; /* Mencegah layout shift saat scrollbar hilang */
        }

        .post-card {
            cursor: pointer;
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }

        .post-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 4px 15px rgba(0,0,0,0.15);
        }

        .modal {
            display: none;
            position: fixed;
            z-index: 1000;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.95);
            overflow-y: auto;
            padding: 50px 0;
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .modal.show {
            opacity: 1;
        }

        .modal-content {
            position: relative;
            margin: auto;
            padding: 30px;
            width: 90%;
            max-width: 1400px;
            background: rgba(255, 255, 255, 0.05);
            border-radius: 20px;
            backdrop-filter: blur(10px);
        }

        .modal-title {
            color: #fff;
            font-size: 32px;
            margin-bottom: 25px;
            text-align: center;
        }

        .gallery-container {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(350px, 1fr));
            gap: 25px;
            padding: 20px 0;
        }

        .gallery-item {
            position: relative;
            width: 100%;
            aspect-ratio: 1;
            overflow: hidden;
            border-radius: 15px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
            cursor: pointer;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .gallery-item:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.3);
        }

        .gallery-item img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.5s ease;
        }

        .gallery-item:hover img {
            transform: scale(1.08);
        }

        .modal-post-content {
            color: #fff;
            font-size: 18px;
            line-height: 1.6;
            margin-top: 25px;
            padding: 20px;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 15px;
        }

        .close-modal {
            position: fixed;
            right: 30px;
            top: 20px;
            color: #fff;
            font-size: 40px;
            font-weight: 300;
            cursor: pointer;
            z-index: 1001;
            width: 50px;
            height: 50px;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.3s ease;
        }

        .close-modal:hover {
            background: rgba(255, 255, 255, 0.2);
            transform: rotate(90deg);
        }

        /* Style dasar untuk semua kategori */
        .posts-grid {
            padding: 20px;
            gap: 20px;
        }

        /* Style khusus untuk kategori 1 - Grid 2 kolom dengan gambar besar */
        .category-1 .posts-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
        }
        
        .category-1 .post-card .main-image {
            height: 500px;
        }

        /* Style khusus untuk kategori 2 - Grid 3 kolom dengan efek hover zoom */
        .category-2 .posts-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
        }
        
        .category-2 .post-card:hover {
            transform: scale(1.05);
        }

        /* Style khusus untuk kategori 3 - Layout masonry */
        .category-3 .posts-grid {
            columns: 3;
            column-gap: 20px;
        }
        
        .category-3 .post-card {
            break-inside: avoid;
            margin-bottom: 20px;
        }

        /* Style khusus untuk kategori 4 - List view dengan gambar di samping */
        .category-4 .posts-grid {
            display: flex;
            flex-direction: column;
        }
        
        .category-4 .post-card {
            display: grid;
            grid-template-columns: 40% 60%;
            gap: 20px;
        }
        
        .category-4 .post-images-container {
            margin-bottom: 0;
        }

        /* Style khusus untuk kategori 5 - Layout masonry (sama seperti category 3) */
        .category-5 .posts-grid {
            columns: 3;
            column-gap: 20px;
            padding: 20px;
        }

        .category-5 .post-card {
            break-inside: avoid;
            margin-bottom: 20px;
            background: #ffffff;
            border-radius: 12px;
            padding: 20px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }

        .category-5 .post-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 4px 15px rgba(0,0,0,0.15);
        }

        /* Responsive */
        @media (max-width: 768px) {
            .category-5 .posts-grid {
                grid-template-columns: 1fr;
                gap: 30px;
                padding: 20px;
            }
            
            .category-5 .main-image {
                height: 250px;
            }
            
            .category-5 .post-content {
                padding: 20px;
            }
            
            .category-5 .thumbnail-grid {
                padding: 0 20px 20px 20px;
                gap: 8px;
            }
        }

        /* Style untuk modal */
        .modal {
            background-color: rgba(0, 0, 0, 0.95);
        }

        .modal-content {
            max-width: 1200px;
            margin: 30px auto;
            background: #fff;
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 25px 50px rgba(0,0,0,0.3);
        }

        .modal-title {
            font-size: 32px;
            font-weight: 600;
            color: #1a1a1a;
            padding: 30px 40px;
            margin: 0;
            border-bottom: 1px solid #eee;
        }

        .modal-post-content {
            padding: 30px 40px;
            background: #fff;
            margin: 0;
        }

        .modal-post-content p {
            font-size: 18px;
            line-height: 1.8;
            color: #444;
            margin-bottom: 20px;
            white-space: pre-line;
        }

        .gallery-container {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 20px;
            padding: 30px 40px;
            background: #f8f9fa;
        }

        .gallery-item {
            aspect-ratio: 1;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
        }

        .gallery-item img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.4s ease;
        }

        .gallery-item:hover img {
            transform: scale(1.1);
        }

        .close-modal {
            position: fixed;
            top: 20px;
            right: 20px;
            width: 40px;
            height: 40px;
            background: #fff;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 24px;
            color: #333;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }

        .close-modal:hover {
            background: #f8f9fa;
            transform: rotate(90deg);
        }

        /* Animasi modal */
        .modal.show {
            animation: modalFadeIn 0.4s ease forwards;
        }

        @keyframes modalFadeIn {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Responsive design */
        @media (max-width: 768px) {
            .modal-content {
                margin: 15px;
            }
            
            .modal-title {
                font-size: 24px;
                padding: 20px;
            }
            
            .modal-post-content {
                padding: 20px;
            }
            
            .modal-post-content p {
                font-size: 16px;
            }
            
            .gallery-container {
                padding: 20px;
                grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
                gap: 15px;
            }
        }
    </style>
</head>
<body>
    <!-- Topbar -->
    <div class="topbar">
        <div class="logo-section">
            <img src="{{ asset('images/logo.jpg') }}" alt="Logo SMK 4 Kota Bogor">
            <div class="text-container">
                <div class="text">SMKN 4 Kota Bogor</div>
            </div>
        </div>
        <div class="categories-login">
            <div class="categories">
                <a href="/" class="{{ Request::is('/') ? 'active' : '' }}">Beranda</a>
                @foreach($categories as $cat)
                <a href="/category/{{ $cat->id }}" 
                   class="{{ Request::is('category/'.$cat->id) ? 'active' : '' }}">
                    {{ $cat->title }}
                </a>
                @endforeach
                <a href="#contact-section" class="scroll-to-contact">Kontak Kami</a>
            </div>
            <div class="login">
                <a href="/login">Login</a>
            </div>
        </div>
    </div>

    <!-- Category Content -->
    <div class="category-page category-{{ $category->id }}">
        <div class="category-header">
            <h1>{{ $category->title }}</h1>
        </div>
        
        <div class="posts-grid">
            @forelse($posts->where('status', 'publish')->sortByDesc('created_at') as $post)
                <div class="post-card" onclick="showFullPost('{{ $post->id }}', '{{ $post->title }}', '{{ $post->content }}', {{ $post->galleries->flatMap->images->toJson() }})">
                    @if($post->galleries->isNotEmpty())
                        @php
                            $allImages = collect();
                            foreach($post->galleries as $gallery) {
                                $allImages = $allImages->concat($gallery->images->sortBy('order'));
                            }
                        @endphp
                        
                        @if($allImages->isNotEmpty())
                            <div class="post-images-container">
                                <!-- Gambar Utama (Besar) -->
                                <div class="main-image">
                                    <img src="{{ asset('images/' . $allImages->first()->file) }}" 
                                         alt="{{ $allImages->first()->title }}"
                                         onerror="this.src='{{ asset('images/no-image.jpg') }}'">
                                </div>

                                <!-- Grid Gambar Kecil -->
                                @if($allImages->count() > 1)
                                    <div class="thumbnail-grid">
                                        @foreach($allImages->skip(1)->take(3) as $image)
                                            <div class="thumbnail">
                                                <img src="{{ asset('images/' . $image->file) }}" 
                                                     alt="{{ $image->title }}"
                                                     onerror="this.src='{{ asset('images/no-image.jpg') }}'">
                                            </div>
                                        @endforeach
                                        
                                        @if($allImages->count() > 4)
                                            <div class="thumbnail view-more-images" data-post-id="{{ $post->id }}" data-post-title="{{ $post->title }}" data-images="{{ $allImages->toJson() }}">
                                                <div class="overlay">
                                                    <span class="view-more-text">+{{ $allImages->count() - 4 }} Foto</span>
                                                </div>
                                            </div>
                                        @endif
                                    </div>
                                @endif

                                <!-- Gambar Tambahan (Hidden) -->
                                <div id="additional-images-{{ $post->id }}" class="additional-images" style="display: none;">
                                    @foreach($allImages->skip(4) as $image)
                                        <div class="thumbnail">
                                            <img src="{{ asset('images/' . $image->file) }}" 
                                                 alt="{{ $image->title }}"
                                                 onerror="this.src='{{ asset('images/no-image.jpg') }}'">
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endif
                    @endif

                    <div class="post-content">
                        <h2>{{ $post->title }}</h2>
                        <p>{{ $post->content }}</p>
                        <div class="post-meta">
                            <i class="far fa-calendar-alt"></i>
                            {{ \Carbon\Carbon::parse($post->created_at)->format('d M Y') }}
                        </div>
                    </div>
                </div>
            @empty
                <div class="alert alert-warning">Tidak ada post dalam kategori ini.</div>
            @endforelse
        </div>

        <div class="d-flex justify-content-center mt-4">
            {{ $posts->links() }}
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
                           class="social-link facebook" 
                           target="_blank">
                            <div class="social-icon">
                                <i class="fab fa-facebook-f"></i>
                            </div>
                            <span>Facebook</span>
                        </a>
                        
                        <a href="https://www.instagram.com/smkn4bogor.official/" 
                           class="social-link instagram" 
                           target="_blank">
                            <div class="social-icon">
                                <i class="fab fa-instagram"></i>
                            </div>
                            <span>Instagram</span>
                        </a>
                        
                        <a href="https://www.youtube.com/@smkn4kotabogor6324" 
                           class="social-link youtube" 
                           target="_blank">
                            <div class="social-icon">
                                <i class="fab fa-youtube"></i>
                            </div>
                            <span>YouTube</span>
                        </a>
                        
                        <a href="https://wa.me/+6282111465865" 
                           class="social-link whatsapp" 
                           target="_blank">
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
                    allowfullscreen=""
                    loading="lazy"
                    referrerpolicy="no-referrer-when-downgrade">
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
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Event listener untuk tombol close
            const closeButtons = document.querySelectorAll('.close-modal');
            closeButtons.forEach(button => {
                button.addEventListener('click', function(e) {
                    e.stopPropagation(); // Menghentikan event bubbling
                    closeModal();
                });
            });

            // Event listener untuk klik di luar modal
            const modal = document.getElementById('postModal');
            modal.addEventListener('click', function(e) {
                if (e.target === modal) {
                    closeModal();
                }
            });

            // Event listener untuk tombol ESC
            document.addEventListener('keydown', function(e) {
                if (e.key === 'Escape') {
                    closeModal();
                }
            });
        });

        function closeModal() {
            const modal = document.getElementById('postModal');
            modal.classList.remove('show');
            setTimeout(() => {
                modal.style.display = 'none';
                document.body.classList.remove('modal-open');
            }, 300);
        }

        function showGallery(postId, images, postTitle) {
            const modal = document.getElementById('galleryModal');
            const galleryContainer = modal.querySelector('.gallery-container');
            const galleryTitle = modal.querySelector('.gallery-title');
            
            // Set judul post
            galleryTitle.textContent = postTitle;
            
            // Bersihkan container
            galleryContainer.innerHTML = '';

            // Buat elemen untuk setiap gambar
            images.forEach(image => {
                const galleryItem = document.createElement('div');
                galleryItem.className = 'gallery-item loading';
                
                const img = document.createElement('img');
                img.src = `/images/${image.file}`;
                img.alt = image.title || postTitle;
                
                // Hapus kelas loading setelah gambar dimuat
                img.onload = function() {
                    galleryItem.classList.remove('loading');
                };
                
                img.onerror = function() {
                    this.src = '/images/no-image.jpg';
                    galleryItem.classList.remove('loading');
                };
                
                galleryItem.appendChild(img);
                galleryContainer.appendChild(galleryItem);
            });

            // Tampilkan modal
            modal.style.display = 'block';
            // Trigger reflow
            modal.offsetHeight;
            // Tambahkan kelas show untuk animasi
            modal.classList.add('show');
            document.body.classList.add('modal-open');
        }

        function closeGalleryModal() {
            const modal = document.getElementById('galleryModal');
            modal.classList.remove('show');
            setTimeout(() => {
                modal.style.display = 'none';
                document.body.classList.remove('modal-open');
            }, 300);
        }

        function showFullPost(postId, title, content, images) {
            const modal = document.getElementById('postModal');
            const modalTitle = modal.querySelector('.modal-title');
            const modalContent = modal.querySelector('.modal-post-content');
            const galleryContainer = modal.querySelector('.gallery-container');
            
            // Set konten modal
            modalTitle.textContent = title;
            
            // Format konten dengan paragraf yang rapi
            const formattedContent = content.split('\n').map(paragraph => 
                `<p>${paragraph}</p>`
            ).join('');
            modalContent.innerHTML = formattedContent;
            
            // Bersihkan container galeri
            galleryContainer.innerHTML = '';

            // Tambahkan semua gambar ke galeri
            images.forEach(image => {
                const galleryItem = document.createElement('div');
                galleryItem.className = 'gallery-item';
                
                const img = document.createElement('img');
                img.src = `/images/${image.file}`;
                img.alt = image.title || title;
                
                // Tambahkan lightbox functionality
                img.onclick = () => {
                    openLightbox(image.file);
                };
                
                galleryItem.appendChild(img);
                galleryContainer.appendChild(galleryItem);
            });

            // Tampilkan modal dengan animasi
            modal.style.display = 'block';
            document.body.classList.add('modal-open');
            
            // Trigger reflow
            modal.offsetHeight;
            
            // Tambahkan kelas show untuk animasi
            modal.classList.add('show');
        }

        // Fungsi untuk lightbox (opsional)
        function openLightbox(imagePath) {
            const lightbox = document.createElement('div');
            lightbox.className = 'lightbox';
            lightbox.innerHTML = `
                <div class="lightbox-content">
                    <img src="/images/${imagePath}" alt="">
                </div>
            `;
            
            lightbox.onclick = () => {
                lightbox.remove();
            };
            
            document.body.appendChild(lightbox);
        }

        // Tambahkan fungsi untuk animasi berbeda per kategori
        function initializeCategoryEffects() {
            const categoryId = document.querySelector('.category-page').classList[1].split('-')[1];
            
            switch(categoryId) {
                case '1':
                    // Efek fade in untuk kategori 1
                    document.querySelectorAll('.post-card').forEach((card, index) => {
                        card.style.animation = `fadeIn 0.5s ease forwards ${index * 0.2}s`;
                    });
                    break;
                    
                case '2':
                    // Efek slide in dari kanan untuk kategori 2
                    document.querySelectorAll('.post-card').forEach((card, index) => {
                        card.style.animation = `slideInRight 0.5s ease forwards ${index * 0.1}s`;
                    });
                    break;
                    
                case '3':
                case '5': // Tambahkan category 5 untuk menggunakan animasi yang sama
                    // Efek pop up untuk kategori 3 dan 5
                    document.querySelectorAll('.post-card').forEach((card, index) => {
                        card.style.animation = `popUp 0.5s ease forwards ${index * 0.15}s`;
                    });
                    break;
                    
                case '4':
                    // Efek slide in dari kiri untuk kategori 4
                    document.querySelectorAll('.post-card').forEach((card, index) => {
                        card.style.animation = `slideInLeft 0.5s ease forwards ${index * 0.1}s`;
                    });
                    break;
            }
        }

        // Panggil fungsi saat halaman dimuat
        document.addEventListener('DOMContentLoaded', initializeCategoryEffects);

        // Tambahkan keyframes untuk animasi
        const styleSheet = document.createElement('style');
        styleSheet.textContent = `
            @keyframes fadeIn {
                from { opacity: 0; transform: translateY(20px); }
                to { opacity: 1; transform: translateY(0); }
            }
            
            @keyframes slideInRight {
                from { opacity: 0; transform: translateX(50px); }
                to { opacity: 1; transform: translateX(0); }
            }
            
            @keyframes slideInLeft {
                from { opacity: 0; transform: translateX(-50px); }
                to { opacity: 1; transform: translateX(0); }
            }
            
            @keyframes popUp {
                from { opacity: 0; transform: scale(0.8); }
                to { opacity: 1; transform: scale(1); }
            }
            
            @keyframes rotateIn {
                from { opacity: 0; transform: rotate(-180deg) scale(0.3); }
                to { opacity: 1; transform: rotate(0) scale(1); }
            }
        `;
        document.head.appendChild(styleSheet);
    </script>

    <!-- Tambahkan modal di akhir body -->
    <div id="galleryModal" class="modal">
        <span class="close-modal">&times;</span>
        <div class="modal-content">
            <div class="gallery-container"></div>
        </div>
    </div>

    <!-- Modal untuk menampilkan post lengkap -->
    <div id="postModal" class="modal">
        <div class="close-modal">&times;</div>
        <div class="modal-content">
            <h2 class="modal-title"></h2>
            <div class="modal-post-content">
                <p class="modal-text"></p>
            </div>
            <div class="gallery-container"></div>
        </div>
    </div>
</body>
</html> 