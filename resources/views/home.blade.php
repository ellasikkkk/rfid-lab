@extends('layouts.app')

@section('content')
<div class="container-fluid px-4 py-3">
    <!-- Header Section -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h3 mb-0 text-gray-800 fw-bold">
                <i class="bi bi-speedometer2 me-2 text-primary"></i>
                Dashboard Absensi Lab
            </h1>
            <p class="text-muted mb-0">Pantau kehadiran siswa lab secara real-time</p>
        </div>
        <div class="text-end">
            <small class="text-muted">
                <i class="bi bi-calendar3 me-1"></i>
                {{ \Carbon\Carbon::now()->format('d M Y') }}
            </small>
            <br>
            <small class="text-muted">
                <i class="bi bi-clock me-1"></i>
                <span id="current-time">{{ \Carbon\Carbon::now()->format('H:i:s') }}</span>
            </small>
        </div>
    </div>

    <!-- Statistics Cards with Animation -->
    <div class="row g-4 mb-4">
        <div class="col-xl-3 col-md-6">
            <div class="card border-0 shadow-sm h-100 card-hover">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Total Siswa
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800 counter" data-target="{{ $totalSiswa }}">
                                0
                            </div>
                        </div>
                        <div class="col-auto">
                            <div class="icon-circle bg-primary">
                                <i class="bi bi-people text-white"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6">
            <div class="card border-0 shadow-sm h-100 card-hover">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                Keluar Hari Ini
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800 counter" data-target="{{ $pulangHariIni }}">
                                0
                            </div>
                        </div>
                        <div class="col-auto">
                            <div class="icon-circle bg-warning">
                                <i class="bi bi-box-arrow-right text-white"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6">
            <div class="card border-0 shadow-sm h-100 card-hover">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                Masih di Lab
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800 counter" data-target="{{ $masihDiLab }}">
                                0
                            </div>
                        </div>
                        <div class="col-auto">
                            <div class="icon-circle bg-info">
                                <i class="bi bi-laptop text-white"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6">
            <div class="card border-0 shadow-sm h-100 card-hover">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">
                                Belum Hadir
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800 counter" data-target="{{ $tidakHadir }}">
                                0
                            </div>
                        </div>
                        <div class="col-auto">
                            <div class="icon-circle bg-danger">
                                <i class="bi bi-person-x text-white"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Class Performance Cards -->
    <div class="card shadow-sm border-0 mb-4">
    <div class="card-header bg-gradient-primary text-white">
        <h6 class="m-0 font-weight-bold"><i class="bi bi-calendar-day me-2"></i> Jadwal Lab Hari Ini ({{ \Carbon\Carbon::now()->translatedFormat('l, d F Y') }})</h6>
    </div>
    <div class="card-body">
        @forelse ($jadwalHariIni as $jadwal)
            <div class="list-group-item d-flex justify-content-between align-items-center">
                <div>
                    <h5 class="mb-1 fw-bold text-primary">{{ $jadwal->mapel }}</h5>
                    <p class="mb-1 text-muted">
                        <i class="bi bi-person-badge me-1"></i> {{ $jadwal->nama_guru ?? 'Belum diatur' }}
                        <span class="mx-2">|</span>
                        <i class="bi bi-door-open me-1"></i> {{ $jadwal->lab->nama_lab ?? 'N/A' }}
                    </p>
                </div>
                <div class="text-end">
                    <span class="badge bg-dark rounded-pill fs-6">
                        <i class="bi bi-clock me-1"></i>
                        {{ \Carbon\Carbon::parse($jadwal->jam_mulai)->format('H:i') }} - {{ \Carbon\Carbon::parse($jadwal->jam_selesai)->format('H:i') }}
                    </span>
                </div>
            </div>
        @empty
            <div class="text-center py-4">
                <i class="bi bi-info-circle display-4 text-muted"></i>
                <h5 class="mt-3 text-muted">Tidak ada jadwal lab untuk hari ini.</h5>
            </div>
        @endforelse
    </div>
</div>

    <!-- Recent Attendance Table -->
    <div class="card border-0 shadow-sm">
        <div class="card-header bg-gradient-primary text-white border-0">
            <div class="d-flex justify-content-between align-items-center">
                <h6 class="m-0 font-weight-bold">
                    <i class="bi bi-clock-history me-2"></i>
                    Absensi Terbaru Hari Ini
                </h6>
                
            </div>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead class="table-light">
                        <tr>
                            <th class="border-0">
                                <i class="bi bi-person me-1"></i>Nama
                            </th>
                            <th class="border-0">
                                <i class="bi bi-building me-1"></i>Kelas
                            </th>
                            <th class="border-0">
                                <i class="bi bi-box-arrow-in-right me-1"></i>Jam Masuk
                            </th>
                            <th class="border-0">
                                <i class="bi bi-box-arrow-right me-1"></i>Jam Keluar
                            </th>
                            <th class="border-0">
                                <i class="bi bi-flag me-1"></i>Status
                            </th>
                            <th class="border-0">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
    @forelse($latest as $index => $absen)
        <tr class="table-row-fade-in" style="animation-delay: {{ $index * 0.1 }}s">
            <td class="align-middle">
                <div class="d-flex align-items-center">
                    <div class="avatar avatar-sm me-3">
                        <div class="avatar-initial rounded-circle bg-label-primary">
                            {{-- Mengambil huruf pertama dari nama siswa --}}
                            {{ substr($absen->siswa->nama ?? 'N', 0, 1) }}
                        </div>
                    </div>
                    <div>
                        <h6 class="mb-0">{{ $absen->siswa->nama ?? '-' }}</h6>
                    </div>
                </div>
            </td>
            <td class="align-middle">
                <span class="badge bg-light text-dark">{{ $absen->siswa->kelas ?? '-' }}</span>
            </td>
            <td class="align-middle">
                @if($absen->jam_masuk)
                    <span class="text-success fw-bold">
                        <i class="bi bi-clock me-1"></i>
                        {{ \Carbon\Carbon::parse($absen->jam_masuk)->format('H:i') }}
                    </span>
                @else
                    <span class="text-muted">-</span>
                @endif
            </td>
            <td class="align-middle">
                @if($absen->jam_keluar)
                    <span class="text-warning fw-bold">
                        <i class="bi bi-clock me-1"></i>
                        {{ \Carbon\Carbon::parse($absen->jam_keluar)->format('H:i') }}
                    </span>
                @else
                    <span class="text-muted">-</span>
                @endif
            </td>
            <td class="align-middle">
                @if($absen->jam_keluar)
                    <span class="badge bg-success">
                        <i class="bi bi-check-circle me-1"></i>Selesai
                    </span>
                @else
                    <span class="badge bg-info">
                        <i class="bi bi-laptop me-1"></i>Masih di Lab
                    </span>
                @endif
            </td>
            
            <td class="align-middle">
                @if(is_null($absen->jam_keluar))
                    {{-- Jika belum checkout, tampilkan tombol --}}
                    <form action="{{ route('absensi.checkout', $absen->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <button type="submit" class="btn btn-sm btn-warning" title="Checkout Manual Siswa Ini">
                            <i class="bi bi-box-arrow-right me-1"></i> Akhiri sesi
                        </button>
                    </form>
                @else
                    {{-- Jika sudah checkout, tampilkan centang --}}
                    <span class="text-success" title="Sudah Selesai">
                        <i class="bi bi-check-circle-fill fs-5"></i>
                    </span>
                @endif
            </td>
            </tr>
    @empty
        <tr>
            <td colspan="6" class="text-center py-5">
                <div class="empty-state">
                    <i class="bi bi-inbox display-4 text-muted"></i>
                    <h5 class="mt-3 text-muted">Belum ada absensi hari ini</h5>
                    <p class="text-muted">Data absensi akan muncul ketika ada siswa yang melakukan check-in</p>
                </div>
            </td>
        </tr>
    @endforelse
</tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<style>
/* Custom Styles for Enhanced UI */
.card-hover {
    transition: all 0.3s ease;
}

.card-hover:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 20px rgba(0,0,0,0.1) !important;
}

.icon-circle {
    width: 60px;
    height: 60px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.5rem;
}

.border-left-success {
    border-left: 4px solid #1cc88a !important;
}

.border-left-danger {
    border-left: 4px solid #e74a3b !important;
}

.bg-gradient-primary {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
}

.avatar {
    width: 40px;
    height: 40px;
}

.avatar-initial {
    width: 100%;
    height: 100%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: 600;
    text-transform: uppercase;
}

.bg-label-primary {
    background-color: rgba(105, 108, 255, 0.16);
    color: #696cff;
}

.table-row-fade-in {
    animation: fadeInUp 0.5s ease forwards;
    opacity: 0;
    transform: translateY(20px);
}

@keyframes fadeInUp {
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.counter {
    transition: all 0.3s ease;
}

.empty-state {
    padding: 2rem;
}

.progress-bar-animated {
    animation: progress-bar-stripes 1s linear infinite;
}

.text-xs {
    font-size: 0.75rem;
}

.font-weight-bold {
    font-weight: 700 !important;
}

.text-gray-800 {
    color: #5a5c69 !important;
}

/* Responsive adjustments */
@media (max-width: 768px) {
    .container-fluid {
        padding: 1rem;
    }
    
    .card-hover:hover {
        transform: none;
    }
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Animate counters
    const counters = document.querySelectorAll('.counter');
    const animateCounter = (counter) => {
        const target = parseInt(counter.getAttribute('data-target'));
        const increment = target / 50;
        let current = 0;
        
        const updateCounter = () => {
            if (current < target) {
                current += increment;
                counter.textContent = Math.floor(current);
                setTimeout(updateCounter, 30);
            } else {
                counter.textContent = target;
            }
        };
        
        updateCounter();
    };
    
    // Intersection Observer for counter animation
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                animateCounter(entry.target);
                observer.unobserve(entry.target);
            }
        });
    });
    
    counters.forEach(counter => {
        observer.observe(counter);
    });
    
    // Update current time
    function updateTime() {
        const now = new Date();
        const timeString = now.toLocaleTimeString('id-ID', {
            hour: '2-digit',
            minute: '2-digit',
            second: '2-digit'
        });
        document.getElementById('current-time').textContent = timeString;
    }
    
    setInterval(updateTime, 1000);
    
    // Add loading states for interactive elements
    document.querySelectorAll('.dropdown-toggle').forEach(dropdown => {
        dropdown.addEventListener('click', function() {
            this.innerHTML = '<span class="spinner-border spinner-border-sm me-1"></span>Loading...';
            setTimeout(() => {
                this.innerHTML = '<i class="bi bi-three-dots"></i>';
            }, 500);
        });
    });
});
</script>
@endsection