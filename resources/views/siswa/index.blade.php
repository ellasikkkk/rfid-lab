@extends('layouts.app')

@section('title', 'Data Siswa')

@section('content')
<div class="container-fluid py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="fw-bold text-gradient text-primary mb-1">Daftar Siswa</h2>
            <p class="text-muted">Manajemen data siswa dan uid RFID</p>
        </div>
        <div>
            <a href="{{ route('tambah.index') }}" class="btn btn-success btn-lg">
                <i class="bi bi-plus-circle me-2"></i>Tambah Siswa
            </a>
        </div>
    </div>
    
    <ul class="nav nav-pills nav-fill mb-4">
        <li class="nav-item">
            <a class="nav-link {{ !$kelasFilter ? 'active' : '' }}" 
               href="{{ route('siswa.index') }}">
               Semua Kelas
            </a>
        </li>
        @foreach ($kelasList as $kelas)
        <li class="nav-item">
            <a class="nav-link {{ $kelasFilter == $kelas ? 'active' : '' }}" 
               href="{{ route('siswa.index', ['kelas' => $kelas]) }}">
               {{ $kelas }}
            </a>
        </li>
        @endforeach
    </ul>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="card shadow-sm border-0 mb-4">
        <div class="card-body">
            <form method="GET" action="{{ route('siswa.index') }}">
                @if($kelasFilter)
                    <input type="hidden" name="kelas" value="{{ $kelasFilter }}">
                @endif
                <div class="input-group">
                    <input type="text" name="nama" value="{{ $namaFilter }}" class="form-control" placeholder="Cari nama siswa di kelas ini...">
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-search"></i> Cari
                    </button>
                </div>
            </form>
        </div>
    </div>

    <div class="card shadow-sm border-0">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Menampilkan Siswa: {{ $kelasFilter ?? 'Semua Kelas' }}</h5>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th class="ps-4">ID</th>
                            <th>Nama Siswa</th>
                            <th>Kelas</th>
                            <th>Tag RFID</th>
                            <th class="text-end pe-4">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($siswa as $item)
                            <tr>
                                <td class="ps-4 fw-medium">{{ $item->id }}</td>
                                <td>{{ $item->nama }}</td>
                                <td>{{ $item->kelas }}</td>
                                <td>
                                    <span class="badge bg-light text-dark">
                                        <i class="bi bi-tag-fill me-1"></i>{{ $item->uid }}
                                    </span>
                                </td>
                                <td class="text-end pe-4">
                                    <button type="button" class="btn btn-sm btn-outline-primary" data-bs-toggle="modal" data-bs-target="#editModal{{ $item->id }}">
                                        Edit
                                    </button>
                                    
                                    <form action="{{ route('siswa.destroy', $item->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('Yakin ingin menghapus data siswa ini?')">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center py-5">
                                    <p class="text-muted">Tidak ada siswa yang ditemukan.</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@foreach ($siswa as $item)
<div class="modal fade" id="editModal{{ $item->id }}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form action="{{ route('siswa.update', $item->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-header">
                    <h5 class="modal-title">Edit Data Siswa</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="nama" class="form-label">Nama Lengkap</label>
                        <input type="text" name="nama" class="form-control" value="{{ $item->nama }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="kelas" class="form-label">Kelas</label>
                        <select name="kelas" class="form-select" required>
                            @foreach (config('kelas.list') as $kelas)
                                <option value="{{ $kelas }}" {{ $item->kelas == $kelas ? 'selected' : '' }}>
                                    {{ $kelas }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="uid" class="form-label">UID RFID</label>
                        <input type="text" name="uid" class="form-control" value="{{ $item->uid }}" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endforeach
@endsection