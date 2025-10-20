@extends('layouts.app')

@section('content')
<style>
    :root {
        --primary: #4361ee;
        --secondary: #3f37c9;
        --success: #4cc9f0;
        --warning: #f72585;
        --info: #4895ef;
        --danger: #e63946;
        --light: #f8f9fa;
        --dark: #212529;
        --card-shadow: 0 7px 14px rgba(0, 0, 0, 0.1), 0 5px 5px rgba(0, 0, 0, 0.04);
        --transition: all 0.3s ease;
    }
    
    body {
        background-color: #f5f7fb;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        min-height: 100vh;
    }
    
    .container {
        max-width: 1200px;
    }
    
    h2 {
        color: var(--dark);
        font-weight: 600;
        position: relative;
        padding-bottom: 12px;
        margin-bottom: 25px;
    }
    
    h2::after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 0;
        width: 70px;
        height: 4px;
        background: var(--primary);
        border-radius: 2px;
        transition: var(--transition);
    }
    
    h2:hover::after {
        width: 120px;
    }
    
    /* Form Styles */
    .dashboard-form {
        background: white;
        padding: 25px;
        border-radius: 15px;
        box-shadow: var(--card-shadow);
        margin-bottom: 30px;
        transition: var(--transition);
        border: 1px solid rgba(67, 97, 238, 0.1);
    }
    
    .dashboard-form:hover {
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.15);
        transform: translateY(-2px);
    }
    
    .form-label {
        font-weight: 600;
        margin-bottom: 8px;
        color: #495057;
        font-size: 0.9rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }
    
    .form-control, .form-select {
        border-radius: 10px;
        padding: 12px 16px;
        border: 2px solid #e9ecef;
        transition: var(--transition);
        font-size: 0.95rem;
    }
    
    .form-control:focus, .form-select:focus {
        border-color: var(--primary);
        box-shadow: 0 0 0 0.25rem rgba(67, 97, 238, 0.15);
        transform: scale(1.02);
    }
    
    .btn-primary {
        background: linear-gradient(135deg, var(--primary), var(--secondary));
        border: none;
        border-radius: 10px;
        padding: 12px 24px;
        font-weight: 600;
        transition: var(--transition);
        box-shadow: 0 4px 15px rgba(67, 97, 238, 0.3);
    }
    
    .btn-primary:hover {
        transform: translateY(-3px);
        box-shadow: 0 8px 25px rgba(67, 97, 238, 0.4);
        background: linear-gradient(135deg, var(--secondary), var(--primary));
    }
    
    /* Table Styles */
    .table-container {
        background: white;
        border-radius: 15px;
        overflow: hidden;
        box-shadow: var(--card-shadow);
        transition: var(--transition);
        border: 1px solid rgba(67, 97, 238, 0.1);
    }
    
    .table-container:hover {
        box-shadow: 0 15px 35px rgba(0, 0, 0, 0.15);
        transform: translateY(-3px);
    }
    
    .table {
        margin-bottom: 0;
        border-collapse: separate;
        border-spacing: 0;
        width: 100%;
    }
    
    .table thead th {
        background: linear-gradient(135deg, var(--primary), var(--secondary));
        color: white;
        padding: 18px 15px;
        font-weight: 600;
        border: none;
        position: sticky;
        top: 0;
        text-transform: uppercase;
        font-size: 0.85rem;
        letter-spacing: 0.5px;
    }
    
    .table thead th:first-child {
        border-top-left-radius: 15px;
    }
    
    .table thead th:last-child {
        border-top-right-radius: 15px;
    }
    
    .table tbody tr {
        transition: var(--transition);
        background-color: white;
        opacity: 0;
        animation: fadeInUp 0.6s ease forwards;
    }
    
    .table tbody tr:hover {
        background: linear-gradient(135deg, rgba(67, 97, 238, 0.05), rgba(76, 201, 240, 0.05));
        transform: translateX(5px);
        box-shadow: 5px 0 15px rgba(67, 97, 238, 0.1);
    }
    
    .table tbody td {
        padding: 18px 15px;
        vertical-align: middle;
        border-bottom: 1px solid rgba(0,0,0,0.05);
        font-size: 0.95rem;
    }
    
    .table tbody tr:last-child td {
        border-bottom: none;
    }
    
    /* Badge Styles */
    .badge {
        padding: 8px 16px;
        border-radius: 25px;
        font-weight: 600;
        font-size: 0.8rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        transition: var(--transition);
    }
    
    .badge:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 15px rgba(0,0,0,0.2);
    }
    
    .bg-warning {
        background: linear-gradient(135deg, #ff9a00, #ff6a00) !important;
        box-shadow: 0 4px 15px rgba(255, 154, 0, 0.3) !important;
    }
    
    .bg-success {
        background: linear-gradient(135deg, #2ecc71, #27ae60) !important;
        box-shadow: 0 4px 15px rgba(46, 204, 113, 0.3) !important;
    }
    
    .bg-secondary {
        background: linear-gradient(135deg, #6c757d, #495057) !important;
        box-shadow: 0 4px 15px rgba(108, 117, 125, 0.3) !important;
    }
    
    /* Animations */
    @keyframes fadeInUp {
        from { 
            opacity: 0; 
            transform: translateY(20px); 
        }
        to { 
            opacity: 1; 
            transform: translateY(0); 
        }
    }
    
    @keyframes pulse {
        0%, 100% { transform: scale(1); }
        50% { transform: scale(1.05); }
    }
    
    .table-container {
        animation: fadeInUp 0.8s ease forwards;
    }
    
    .table tbody tr:nth-child(1) { animation-delay: 0.1s; }
    .table tbody tr:nth-child(2) { animation-delay: 0.2s; }
    .table tbody tr:nth-child(3) { animation-delay: 0.3s; }
    .table tbody tr:nth-child(4) { animation-delay: 0.4s; }
    .table tbody tr:nth-child(5) { animation-delay: 0.5s; }
    .table tbody tr:nth-child(6) { animation-delay: 0.6s; }
    .table tbody tr:nth-child(7) { animation-delay: 0.7s; }
    .table tbody tr:nth-child(8) { animation-delay: 0.8s; }
    .table tbody tr:nth-child(9) { animation-delay: 0.9s; }
    .table tbody tr:nth-child(10) { animation-delay: 1.0s; }
    
    /* Empty state */
    .empty-state {
        padding: 60px 30px;
        text-align: center;
    }
    
    .empty-state i {
        font-size: 4rem;
        color: var(--primary);
        margin-bottom: 20px;
        animation: pulse 2s infinite;
    }
    
    .empty-state h5 {
        color: var(--dark);
        font-weight: 600;
        margin-bottom: 10px;
    }
    
    .empty-state p {
        color: #6c757d;
        font-style: italic;
        margin-bottom: 0;
    }
    
    /* Header enhancements */
    .page-header {
        background: linear-gradient(135deg, rgba(67, 97, 238, 0.1), rgba(76, 201, 240, 0.1));
        padding: 30px;
        border-radius: 15px;
        margin-bottom: 30px;
        border: 1px solid rgba(67, 97, 238, 0.2);
    }
    
    .page-header h2 {
        margin-bottom: 10px;
        background: linear-gradient(135deg, var(--primary), var(--secondary));
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }
    
    .page-header p {
        color: #6c757d;
        margin-bottom: 0;
        font-size: 1.1rem;
    }
    
    /* Filter form enhancements */
    .filter-section {
        display: flex;
        gap: 20px;
        align-items: end;
        flex-wrap: wrap;
    }
    
    .filter-section > div {
        flex: 1;
        min-width: 200px;
    }
    
    /* Responsive adjustments */
    @media (max-width: 768px) {
        .dashboard-form {
            padding: 20px;
        }
        
        .filter-section {
            flex-direction: column;
            gap: 15px;
        }
        
        .filter-section > div {
            width: 100%;
            min-width: unset;
        }
        
        .table thead th,
        .table tbody td {
            padding: 12px 8px;
            font-size: 0.85rem;
        }
        
        .badge {
            font-size: 0.7rem;
            padding: 6px 12px;
        }
        
        h2 {
            font-size: 1.5rem;
        }
    }
    
    /* Custom scrollbar */
    .table-container::-webkit-scrollbar {
        height: 8px;
    }
    
    .table-container::-webkit-scrollbar-track {
        background: #f1f1f1;
        border-radius: 10px;
    }
    
    .table-container::-webkit-scrollbar-thumb {
        background: linear-gradient(135deg, var(--primary), var(--secondary));
        border-radius: 10px;
    }
    
    .table-container::-webkit-scrollbar-thumb:hover {
        background: linear-gradient(135deg, var(--secondary), var(--primary));
    }
    
    /* Loading animation for form submission */
    .btn-primary.loading {
        position: relative;
        color: transparent;
    }
    
    .btn-primary.loading::after {
        content: "";
        position: absolute;
        width: 20px;
        height: 20px;
        top: 50%;
        left: 50%;
        margin-left: -10px;
        margin-top: -10px;
        border: 2px solid #ffffff;
        border-radius: 50%;
        border-top-color: transparent;
        animation: spin 1s linear infinite;
    }
    
    @keyframes spin {
        to {
            transform: rotate(360deg);
        }
    }
</style>

<div class="container py-4">
    <!-- Page Header -->
    <div class="page-header">
        <h2 class="mb-2">
            <i class="fas fa-laptop-code me-3"></i>
            Dashboard Absensi Lab 
        </h2>
        <p class="mb-0">Kelola dan pantau absensi siswa di laboratorium komputer secara real-time</p>
    </div>

    <!-- Filter Form -->
    <form method="GET" class="dashboard-form">
        <div class="filter-section">
            <div>
                <label class="form-label">
                    <i class="fas fa-calendar-alt me-2"></i>Tanggal
                </label>
                <input type="date" name="tanggal" class="form-control" value="{{ $tanggal }}" required>
            </div>
            <div>
                <label class="form-label">
                    <i class="fas fa-filter me-2"></i>Filter Status
                </label>
                <select name="status" class="form-select">
                    <option value="semua" {{ $filterStatus === 'semua' ? 'selected' : '' }}>
                        <i class="fas fa-list"></i> Semua Status
                    </option>
                    <option value="masih" {{ $filterStatus === 'masih' ? 'selected' : '' }}>
                        <i class="fas fa-laptop"></i> Masih di Lab
                    </option>
                    <option value="keluar" {{ $filterStatus === 'keluar' ? 'selected' : '' }}>
                        <i class="fas fa-sign-out-alt"></i> Sudah Keluar
                    </option>
                    <option value="belum" {{ $filterStatus === 'belum' ? 'selected' : '' }}>
                        <i class="fas fa-clock"></i> Belum Absen
                    </option>
                </select>
            </div>
            <div>
                <button type="submit" class="btn btn-primary" id="filterBtn">
                    <i class="fas fa-search me-2"></i>Tampilkan Data
                </button>
            </div>
        </div>
    </form>

    <!-- Data Table -->
    <div class="table-container">
        <div class="table-responsive">
    <table class="table align-middle">
    <thead>
        <tr>
            <th><i class="fas fa-hashtag me-2"></i>No</th>
            <th><i class="fas fa-user me-2"></i>Nama Siswa</th>
            <th><i class="fas fa-chalkboard-teacher me-2"></i>Kelas</th>
            <th><i class="fas fa-book me-2"></i>Aktivitas</th> <th><i class="fas fa-sign-in-alt me-2"></i>Jam Masuk</th>
            <th><i class="fas fa-sign-out-alt me-2"></i>Jam Keluar</th>
            <th><i class="fas fa-flag me-2"></i>Status</th>
            <th><i class="fas fa-cogs me-2"></i>Aksi</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($siswa as $index => $item)
            <tr>
                <td class="fw-bold text-primary">{{ $index + 1 }}</td>
                <td class="fw-semibold">{{ $item->nama }}</td>
                <td>
                    <span class="badge bg-primary text-white">{{ $item->kelas }}</span>
                </td>

                <td>
                    @if ($item->mata_pelajaran)
                        <div class="fw-bold">{{ $item->mata_pelajaran }}</div>
                        <small class="text-muted">
                            <i class="bi bi-geo-alt-fill me-1"></i>{{ $item->nama_lab }}
                        </small>
                    @else
                        -
                    @endif
                </td>

                <td>
                    @if($item->jam_masuk)
                        <span class="text-success fw-bold">
                            {{ \Carbon\Carbon::parse($item->jam_masuk)->format('H:i') }}
                        </span>
                    @else
                        <span class="text-muted">-</span>
                    @endif
                </td>
                <td>
                    @if($item->jam_keluar)
                        <span class="text-warning fw-bold">
                            {{ \Carbon\Carbon::parse($item->jam_keluar)->format('H:i') }}
                        </span>
                    @else
                        <span class="text-muted">-</span>
                    @endif
                </td>
                <td>
                    {{-- Tampilkan Status Badge --}}
                    @if ($item->status === 'Sudah Keluar')
                        <span class="badge bg-success">{{ $item->status }}</span>
                    @elseif ($item->status === 'Masih di Lab')
                        <span class="badge bg-warning">{{ $item->status }}</span>
                    @else
                        <span class="badge bg-secondary">{{ $item->status }}</span>
                    @endif
                </td>
                <td>
                    {{-- Tombol Checkout Manual --}}
                    @if ($item->status === 'Masih di Lab')
                        <form action="{{ route('absensi.checkout', $item->absensi_id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <button type="submit" class="btn btn-sm btn-outline-danger" title="Checkout Manual">
                                <i class="bi bi-box-arrow-right"></i>
                            </button>
                        </form>
                    @endif
                </td>
            </tr>
        @empty
            <tr>
                {{-- Sesuaikan colspan menjadi 8 karena ada 8 kolom --}}
                <td colspan="8" class="text-center py-5">
                    <h5>Tidak ada data siswa</h5>
                </td>
            </tr>
        @endforelse
    </tbody>
</table>
</div>
            </table>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Form submission loading state
    const form = document.querySelector('form');
    const filterBtn = document.getElementById('filterBtn');
    
    form.addEventListener('submit', function() {
        filterBtn.classList.add('loading');
        filterBtn.disabled = true;
    });
    
    // Add hover effects to table rows
    const tableRows = document.querySelectorAll('.table tbody tr');
    tableRows.forEach((row, index) => {
        row.addEventListener('mouseenter', function() {
            this.style.transform = 'translateX(10px)';
        });
        
        row.addEventListener('mouseleave', function() {
            this.style.transform = 'translateX(0)';
        });
    });
    
    // Smooth scroll to table after form submission
    if (window.location.search) {
        setTimeout(() => {
            document.querySelector('.table-container').scrollIntoView({
                behavior: 'smooth',
                block: 'start'
            });
        }, 500);
    }
    
    // Auto-focus on date input when page loads
    const dateInput = document.querySelector('input[name="tanggal"]');
    if (dateInput && !dateInput.value) {
        dateInput.focus();
    }
});
</script>
@endsection