document.addEventListener('DOMContentLoaded', function() {
    // Animasi counter
    const counters = document.querySelectorAll('.counter');
    
    counters.forEach(counter => {
        const target = parseInt(counter.innerText);
        const duration = 1000; // 1 detik
        const increment = target / (duration / 16); // 60fps
        let current = 0;

        const updateCounter = () => {
            current += increment;
            if (current < target) {
                counter.innerText = Math.ceil(current);
                requestAnimationFrame(updateCounter);
            } else {
                counter.innerText = target;
            }
        };

        updateCounter();
    });

    // Hover effect untuk card yang bisa diklik
    const clickableCards = document.querySelectorAll('.card.clickable');
    clickableCards.forEach(card => {
        card.addEventListener('mouseenter', function() {
            this.style.transform = 'translateY(-10px)';
        });

        card.addEventListener('mouseleave', function() {
            this.style.transform = 'translateY(0)';
        });
    });

    // Fungsi untuk update waktu
    function updateDateTime() {
        const dateTimeElement = document.getElementById('current-datetime');
        const now = new Date();
        
        const options = {
            weekday: 'long',
            year: 'numeric',
            month: 'long',
            day: 'numeric',
            hour: '2-digit',
            minute: '2-digit'
        };
        
        const dateTimeString = now.toLocaleDateString('id-ID', options);
        dateTimeElement.textContent = dateTimeString;
    }

    // Update setiap menit
    setInterval(updateDateTime, 60000);
    updateDateTime(); // Inisialisasi pertama
}); 