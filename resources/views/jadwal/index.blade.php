@extends('layouts.app')
@section('title', 'Manajemen Jadwal Lab')

@section('content')
<div class="container py-4">
    <h2 class="fw-bold text-gradient text-primary mb-4">Manajemen Jadwal Lab</h2>

    <ul class="nav nav-pills nav-fill mb-4">
        <li class="nav-item">
            <a class="nav-link {{ $labFilterId == 'semua' ? 'active' : '' }}" 
               href="{{ route('jadwal.index', ['lab' => 'semua']) }}">
               Semua Lab
            </a>
        </li>
        @foreach ($labs as $lab)
        <li class="nav-item">
            <a class="nav-link {{ $labFilterId == $lab->id ? 'active' : '' }}" 
               href="{{ route('jadwal.index', ['lab' => $lab->id]) }}">
               {{ $lab->nama_lab }}
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

    <div class="card shadow-sm">
        <div class="card-header bg-light d-flex justify-content-between align-items-center">
            {{-- Mengambil nama lab yang sedang difilter --}}
            <h5 class="mb-0">Daftar Jadwal {{ $labFilterId != 'semua' ? 'untuk ' . \App\Models\Lab::find($labFilterId)->nama_lab : 'untuk Semua Lab' }}</h5>
            <a href="{{ route('jadwal.create') }}" class="btn btn-success">
                <i class="bi bi-plus-lg me-1"></i> Tambah Jadwal
            </a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Mapel</th>
                            <th>Nama Guru</th>
                            <th>Kelas</th>
                            <th>Hari</th>
                            <th>Jam</th>
                            <th>Waktu</th>
                            <th>Ruangan Lab</th> <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($jadwals as $index => $jadwal)
                        <tr>
                            <td class="text-center">{{ $index + 1 }}</td>
                            <td>{{ $jadwal->mapel }}</td>
                            <td>{{ $jadwal->nama_guru ?? 'N/A' }}</td>
                            <td class="text-center">{{ $jadwal->kelas }}</td>
                            <td class="text-center">{{ $jadwal->hari_indo }}</td>
                            <td class="text-center">{{ $jadwal->jam_ke ?? '-' }}</td>
                            <td class="text-center">
                                {{ \Carbon\Carbon::parse($jadwal->jam_mulai)->format('H:i') }} s/d 
                                {{ \Carbon\Carbon::parse($jadwal->jam_selesai)->format('H:i') }}
                            </td>
                            
                            <td class="text-center">
                                <span class="badge bg-info">{{ $jadwal->lab->nama_lab ?? 'N/A' }}</span>
                            </td>
                            <td class="text-center">
                                <a href="{{ route('jadwal.edit', $jadwal->id) }}" class="btn btn-sm btn-primary" title="Edit">
                                    <i class="bi bi-pencil-fill"></i>
                                </a>
                                <form action="{{ route('jadwal.destroy', $jadwal->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Yakin ingin menghapus jadwal ini?')" title="Hapus">
                                        <i class="bi bi-trash-fill"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="9" class="text-center py-4">
                                <p class="text-muted">Belum ada data jadwal untuk lab ini.</p>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection