document.addEventListener('DOMContentLoaded', function() {
    // Animate elements on load
    const animateElements = () => {
        // Animate heading
        const heading = document.querySelector('.hero-content h1');
        heading.style.opacity = '0';
        heading.style.transform = 'translateY(20px)';
        
        setTimeout(() => {
            heading.style.transition = 'all 0.8s ease';
            heading.style.opacity = '1';
            heading.style.transform = 'translateY(0)';
        }, 300);

        // Animate tags
        const tags = document.querySelectorAll('.tag');
        tags.forEach((tag, index) => {
            tag.style.opacity = '0';
            tag.style.transform = 'translateY(20px)';
            
            setTimeout(() => {
                tag.style.transition = 'all 0.6s ease';
                tag.style.opacity = '1';
                tag.style.transform = 'translateY(0)';
            }, 800 + (index * 200));
        });

        // Animate buttons
        const buttons = document.querySelector('.buttons');
        buttons.style.opacity = '0';
        buttons.style.transform = 'translateY(20px)';
        
        setTimeout(() => {
            buttons.style.transition = 'all 0.6s ease';
            buttons.style.opacity = '1';
            buttons.style.transform = 'translateY(0)';
        }, 1400);
    };

    animateElements();

    // Parallax effect on scroll
    let hero = document.querySelector('.hero');
    let heroContent = document.querySelector('.hero-content');
    
    window.addEventListener('scroll', function() {
        let scroll = window.pageYOffset;
        hero.style.backgroundPosition = `center ${scroll * 0.5}px`;
        heroContent.style.transform = `translateY(${scroll * 0.3}px)`;
    });

    // Tambahkan efek hover yang lebih interaktif untuk tags
    document.querySelectorAll('.tag').forEach(tag => {
        tag.addEventListener('mousemove', function(e) {
            const rect = tag.getBoundingClientRect();
            const x = e.clientX - rect.left;
            const y = e.clientY - rect.top;
            
            tag.style.setProperty('--x', `${x}px`);
            tag.style.setProperty('--y', `${y}px`);
            
            const shine = tag.querySelector('.shine');
            if (shine) {
                shine.style.setProperty('--x', `${x}px`);
                shine.style.setProperty('--y', `${y}px`);
            }
        });
    });

    // Tambahkan efek typing untuk text
    const text = document.querySelector('.hero-content h1');
    const originalText = text.textContent;
    text.textContent = '';
    
    let charIndex = 0;
    function typeText() {
        if(charIndex < originalText.length) {
            text.textContent += originalText.charAt(charIndex);
            charIndex++;
            setTimeout(typeText, 100);
        }
    }
    
    setTimeout(typeText, 500);

    // Tambahkan smooth scroll untuk link Kontak Kami
    document.querySelector('.scroll-to-contact').addEventListener('click', function(e) {
        e.preventDefault();
        document.querySelector('#contact-section').scrollIntoView({
            behavior: 'smooth'
        });
    });

    // Tambahkan kode ini
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            e.preventDefault();
            
            document.querySelector(this.getAttribute('href')).scrollIntoView({
                behavior: 'smooth',
                block: 'start'
            });
        });
    });

    // Fungsi untuk menginisialisasi slider
    function initializeSlider(sliderId) {
        const slider = document.getElementById(sliderId);
        if (!slider) return;

        const slides = slider.querySelectorAll('.preview-group');
        if (slides.length === 0) return;

        // Cek apakah ini slider galeri
        const isGallerySlider = sliderId === 'galeri-slider';
        
        const prevButton = !isGallerySlider ? slider.parentElement.querySelector('.prev-slide') : null;
        const nextButton = !isGallerySlider ? slider.parentElement.querySelector('.next-slide') : null;
        
        // Buat container untuk dots
        let dotsContainer = slider.parentElement.querySelector('.slider-dots');
        if (!dotsContainer) {
            dotsContainer = document.createElement('div');
            dotsContainer.className = 'slider-dots';
            slider.parentElement.appendChild(dotsContainer);
        }

        let currentSlide = 0;
        let slideInterval;

        function showSlide(index) {
            slides.forEach((slide, i) => {
                slide.style.display = 'none';
                slide.classList.remove('active');
            });
            
            slides[index].style.display = 'block';
            setTimeout(() => {
                slides[index].classList.add('active');
            }, 50);

            // Update dots
            const dots = dotsContainer.querySelectorAll('.dot');
            dots.forEach((dot, i) => {
                dot.classList.toggle('active', i === index);
            });
        }

        // Buat dots untuk setiap slide
        slides.forEach((_, index) => {
            const dot = document.createElement('div');
            dot.classList.add('dot');
            if (index === 0) dot.classList.add('active');
            dot.addEventListener('click', () => {
                currentSlide = index;
                showSlide(currentSlide);
                resetInterval();
            });
            dotsContainer.appendChild(dot);
        });

        // Event listeners untuk tombol navigasi (kecuali galeri)
        if (!isGallerySlider) {
            if (prevButton) {
                prevButton.addEventListener('click', () => {
                    currentSlide = (currentSlide - 1 + slides.length) % slides.length;
                    showSlide(currentSlide);
                    resetInterval();
                });
            }

            if (nextButton) {
                nextButton.addEventListener('click', () => {
                    currentSlide = (currentSlide + 1) % slides.length;
                    showSlide(currentSlide);
                    resetInterval();
                });
            }
        }

        function resetInterval() {
            clearInterval(slideInterval);
            slideInterval = setInterval(() => {
                currentSlide = (currentSlide + 1) % slides.length;
                showSlide(currentSlide);
            }, 5000); // 3 detik
        }

        // Inisialisasi
        showSlide(0);
        resetInterval();

        // Hentikan autoplay saat hover
        slider.parentElement.addEventListener('mouseenter', () => {
            clearInterval(slideInterval);
        });

        slider.parentElement.addEventListener('mouseleave', () => {
            resetInterval();
        });
    }

    // Inisialisasi semua slider saat dokumen dimuat
    initializeSlider('informasi-slider');
    initializeSlider('agenda-slider');
    initializeSlider('galeri-slider');

    // Animasi untuk copyright section
    const copyrightText = document.querySelector('.copyright-text p');
    
    if (copyrightText) {
        copyrightText.style.opacity = '0';
        copyrightText.style.transform = 'translateY(20px)';
        
        setTimeout(() => {
            copyrightText.style.transition = 'all 0.8s ease';
            copyrightText.style.opacity = '1';
            copyrightText.style.transform = 'translateY(0)';
        }, 500);
    }
    
    // Tambahkan efek hover pada ikon
    const icons = document.querySelectorAll('.copyright-text i');
    icons.forEach(icon => {
        icon.addEventListener('mouseover', function() {
            this.style.transform = 'rotate(360deg) scale(1.2)';
            this.style.transition = 'all 0.5s ease';
        });
        
        icon.addEventListener('mouseout', function() {
            this.style.transform = 'rotate(0) scale(1)';
        });
    });
});

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
    const modalContent = modal.querySelector('.modal-text');
    const galleryContainer = modal.querySelector('.gallery-container');
    
    // Set konten modal
    modalTitle.textContent = title;
    modalContent.textContent = content;
    
    // Bersihkan container galeri
    galleryContainer.innerHTML = '';

    // Tambahkan semua gambar ke galeri
    if (images && images.length > 0) {
        images.forEach(image => {
            const galleryItem = document.createElement('div');
            galleryItem.className = 'gallery-item loading';
            
            const img = document.createElement('img');
            img.src = `/images/${image.file}`;
            img.alt = image.title || title;
            
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
    }

    // Tampilkan modal
    modal.style.display = 'block';
    modal.classList.add('show');
    document.body.classList.add('modal-open');
}

function showSlide(slides, index, currentSlide) {
    slides.forEach((slide, i) => {
        slide.classList.remove('active', 'prev');
        if (i === currentSlide) {
            slide.classList.add('prev');
        }
    });
    
    slides[index].classList.add('active');
}
