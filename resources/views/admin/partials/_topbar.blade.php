<header class="topbar" data-navbarbg="skin6">
    <nav class="navbar top-navbar navbar-expand-lg">
        <div class="navbar-header" data-logobg="skin6">
            <!-- Konten Navbar -->
            <a class="nav-toggler waves-effect waves-light d-block d-lg-none" href="javascript:void(0)">
                <i class="ti-menu ti-close"></i>
            </a>
            <div class="navbar-brand d-flex justify-content-center align-items-center w-100 px-5" style="margin-top: 10px;">
                <!-- Image in the center with more space on the sides -->
                <img src="{{ asset('images/logo.jpg') }}" alt="Logo" class="navbar-logo mx-2 logo-animate" style="height: 45px; margin-left: 15px;">
                <!-- Text Logo with "Admin" under "Dashboard" -->
                <a href="/" class="text-decoration-none">
                    <h1 class="text-dark fw-bold m-0 logo-text-animate" style="font-size: 1.5rem; font-family: 'Arial', sans-serif;">
                        <span style="color: #3085d6;">Dashboard</span>
                    </h1>
                    <h2 class="text-dark fw-bold m-0 logo-text-animate" style="font-size: 1rem; font-family: 'Arial', sans-serif;">
                        <span style="color: #d33;">Admin</span>
                    </h2>
                </a>
            </div>
            <a class="topbartoggler d-block d-lg-none waves-effect waves-light" href="javascript:void(0)"
                data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <i class="ti-more"></i>
            </a>
        </div>
        <div class="navbar-collapse collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle flex items-center" href="javascript:void(0)"
                        data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <div class="d-flex align-items-center">
                            <!-- Foto Profile atau Icon Default -->
                            <div class="profile-image me-2">
                                @if(Auth::user()->photo)
                                    <img src="{{ asset('storage/profile-photos/'.Auth::user()->photo) }}" 
                                         alt="Profile Photo" 
                                         class="rounded-circle"
                                         style="width: 32px; height: 32px; object-fit: cover;">
                                @else
                                    <i class="fas fa-user text-xl"></i>
                                @endif
                            </div>

                            <!-- Nama dan Hello -->
                            <span class="ms-1 d-none d-lg-inline-block">
                                <span>Hello,</span>
                                <span class="text-dark font-semibold">{{ Auth::user()->name }}</span>
                                <i data-feather="chevron-down" class="svg-icon text-sm"></i>
                            </span>
                        </div>
                    </a>
                    <div class="dropdown-menu dropdown-menu-end shadow-lg border-0 rounded-lg py-2 mt-2 w-48 bg-white">
                        <!-- Profile Section -->
                        <a class="dropdown-item d-flex items-center px-4 py-2 hover:bg-gray-100 transition-colors"
                            href="{{ url('/profile') }}">
                            <i data-feather="user" class="svg-icon me-2 text-primary"></i> Profile
                        </a>
                        <!-- Logout Section -->
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                        <a class="dropdown-item d-flex items-center px-4 py-2 hover:bg-gray-100 transition-colors"
                            href="javascript:void(0)" id="logout-btn">
                            <i data-feather="power" class="svg-icon me-2 text-danger"></i> Logout
                        </a>
                    </div>
                </li>
            </ul>
        </div>
    </nav>
</header>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script type="text/javascript">
document.getElementById('logout-btn').addEventListener('click', function(e) {
    e.preventDefault();
    Swal.fire({
        title: 'Apakah Anda yakin?',
        text: "Anda akan keluar dari akun Anda. Pastikan Anda memiliki informasi login Anda, karena Anda harus login lagi untuk melanjutkan.",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Ya, keluar!'
    }).then((result) => {
        if (result.isConfirmed) {
            document.getElementById('logout-form').submit();
        }
    })
});
</script>

<!-- Add CSS animations for logos -->
<style>
    /* Animation for the image logo */
    .logo-animate {
        opacity: 0;
        animation: fadeInLogo 1.5s forwards;
    }

    @keyframes fadeInLogo {
        0% { opacity: 0; }
        100% { opacity: 1; }
    }

    /* Animation for the text logos */
    .logo-text-animate {
        opacity: 0;
        transform: translateY(20px);
        animation: slideInText 1s forwards;
        animation-delay: 0.5s; /* Delays the text animation */
    }

    @keyframes slideInText {
        0% {
            opacity: 0;
            transform: translateY(20px);
        }
        100% {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .profile-image {
        display: flex;
        align-items: center;
    }

    .profile-image img {
        border: 2px solid #fff;
        box-shadow: 0 2px 4px rgba(0,0,0,0.1);
    }

    .profile-image .fas {
        font-size: 1.25rem;
        width: 32px;
        height: 32px;
        display: flex;
        align-items: center;
        justify-content: center;
        background: #e9ecef;
        border-radius: 50%;
        color: #6c757d;
    }

    /* Optional: Hover effects */
    .profile-image img:hover,
    .profile-image .fas:hover {
        transform: scale(1.05);
        transition: transform 0.2s ease;
    }
</style>
