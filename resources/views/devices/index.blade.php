@extends('layouts.app')
@section('title', 'Manajemen Perangkat')
@section('content')
<div class="container py-4">
    <h2 class="fw-bold text-gradient text-primary mb-4">Manajemen Perangkat RFID</h2>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="card shadow-sm border-0">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Daftar Perangkat</h5>
            <a href="{{ route('devices.create') }}" class="btn btn-primary"><i class="bi bi-plus-circle me-2"></i>Tambah Perangkat Baru</a>
        </div>
        <div class="card-body">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>ID Unik (di Arduino)</th>
                        <th>Nama Perangkat</th>
                        <th>Lokasi Lab</th>
                        <th class="text-end">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($devices as $device)
                    <tr>
                        <td><span class="badge bg-secondary">{{ $device->unique_id }}</span></td>
                        <td>{{ $device->nama_perangkat }}</td>
                        <td>{{ $device->lab->nama_lab ?? 'Lab tidak ditemukan' }}</td>
                        <td class="text-end">
                            <a href="{{ route('devices.edit', $device->id) }}" class="btn btn-sm btn-outline-primary">Edit</a>
                            <form action="{{ route('devices.destroy', $device->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('Yakin ingin menghapus perangkat ini?')">Hapus</button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="text-center">Belum ada data perangkat.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection