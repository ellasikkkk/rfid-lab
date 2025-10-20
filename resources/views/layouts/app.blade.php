<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>@yield('title') - Absensi RFID</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }
        .sidebar {
            width: 250px;
            height: 100vh;
            background: linear-gradient(to bottom, #2c3e50, #34495e);
            color: white;
            position: fixed;
        }
        .sidebar .nav-link {
            color: white;
        }
        .sidebar .nav-link:hover,
        .sidebar .nav-link.active {
            background-color: #1abc9c;
            color: white;
        }
        .content {
            margin-left: 250px;
            padding: 20px;
        }
        .toggle-sidebar-btn {
            position: absolute;
            top: 10px;
            left: 10px;
            z-index: 1001;
        }
        @media (max-width: 768px) {
            .sidebar {
                transform: translateX(-100%);
                transition: transform 0.3s ease;
            }
            .sidebar.show {
                transform: translateX(0);
            }
            .content {
                margin-left: 0;
            }
        }
    </style>
</head>
<body>

<!-- Toggle button (mobile only) -->
<button class="btn btn-outline-light toggle-sidebar-btn d-md-none">
    <i class="bi bi-list"></i>
</button>

<!-- Sidebar -->
<div class="sidebar p-3" id="sidebarMenu">
    <h4 class="mb-4">Absensi RFID</h4>
    <ul class="nav flex-column">
        <li class="nav-item">
            <a href="{{ route('dashboard') }}" class="nav-link {{ request()->is('dashboard') ? 'active' : '' }}">
    <i class="bi bi-house me-2"></i> Home
</a>

        </li>

        @php $isKelas = request()->is('kelas*'); @endphp
        @php $isLab = request()->is('lab*'); @endphp
<li class="nav-item mt-3">
    <a class="nav-link d-flex justify-content-between align-items-center {{ $isLab ? '' : 'collapsed' }}" 
       data-bs-toggle="collapse" 
       href="#submenuLab" 
       role="button" 
       aria-expanded="{{ $isLab ? 'true' : 'false' }}" 
       aria-controls="submenuLab">
        <span><i class="bi bi-pc-display-horizontal me-2"></i> Lab</span>
        <i class="bi bi-chevron-down"></i>
    </a>
    <div class="collapse {{ $isLab ? 'show' : '' }}" id="submenuLab">
        <ul class="nav flex-column ms-3">
            @foreach(['TKJ', 'PERHOTELAN', 'BOGA'] as $lab)
                <li class="nav-item">
                    <a class="nav-link text-white {{ request()->is('lab/' . $lab) ? 'active' : '' }}" 
                       href="{{ url('lab/' . $lab) }}">
                        {{ $lab }}
                    </a>
                </li>
            @endforeach
        </ul>
    </div>
</li>


        <li class="nav-item">
                    <a class="nav-link {{ request()->is('siswa') ? 'active' : '' }}" href="{{ route('siswa.index') }}">
                        <i class="bi bi-people me-2"></i> Data Siswa
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('uid-baru') ? 'active' : '' }}" href="{{ route('tambah.index') }}">
                        <i class="bi bi-plus-circle me-2"></i> UID Baru
                    </a>
                </li>
<li class="nav-item">
    <a class="nav-link" href="{{ route('devices.index') }}">
        <i class="bi bi-cpu"></i>
        <span>Manajemen Perangkat</span>
    </a>
</li>
<li class="nav-item">
    <a class="nav-link" href="{{ route('labs.index') }}">
        <i class="bi bi-door-open"></i>
        <span>Manajemen Lab</span>
    </a>
</li>
<li class="nav-item">
    <a class="nav-link {{ request()->is('jurnal*') ? 'active' : '' }}" href="{{ route('jurnal.index') }}">
        <i class="bi bi-journal-text me-2"></i>
        <span>Jurnal Praktek</span>
    </a>
</li>
<li class="nav-item">
    <a class="nav-link" href="{{ route('mata-pelajaran.index') }}">
        <i class="bi bi-book"></i>
        <span>Data Master Mapel</span>
    </a>
</li>
<li class="nav-item">
    <a class="nav-link" href="{{ route('guru.index') }}">
        <i class="bi bi-person-badge"></i>
        <span>Data Guru</span>
    </a>
</li>
                <li class="nav-item">
    <a class="nav-link" href="{{ route('jadwal.index') }}">
        <i class="bi bi-calendar-week"></i>
        <span>Manajemen Jadwal</span>
    </a>
</li>
    <hr class="sidebar-divider">

    <li class="nav-item">
    <form method="POST" action="{{ route('logout') }}">
        @csrf
        <a href="{{ route('logout') }}" 
           class="nav-link"  {{-- Pindahkan class nav-link ke sini --}}
           onclick="event.preventDefault(); this.closest('form').submit();"
           title="Logout">
            <i class="bi bi-box-arrow-right"></i>
            <span>Logout</span>
        </a>
    </form>
</li>
</ul>
    </ul>
</div>

<!-- Main content -->
<div class="content">
    @yield('content')
</div>

<!-- Bootstrap 5 JS (wajib untuk collapse) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

<!-- Sidebar toggle script -->
<script>
    const toggleBtn = document.querySelector('.toggle-sidebar-btn');
    const sidebar = document.getElementById('sidebarMenu');

    toggleBtn.addEventListener('click', () => {
        sidebar.classList.toggle('show');
    });
</script>

</body>
</html>
