@extends('layouts.app')
@section('title', 'Manajemen Lab')
@section('content')
<div class="container py-4">
    <h2 class="fw-bold text-gradient text-primary mb-4">Manajemen Ruangan Lab</h2>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="card shadow-sm border-0">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Daftar Lab</h5>
            <a href="{{ route('labs.create') }}" class="btn btn-primary"><i class="bi bi-plus-circle me-2"></i>Tambah Lab Baru</a>
        </div>
        <div class="card-body">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nama Lab</th>
                        <th>Lokasi</th>
                        <th class="text-end">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($labs as $lab)
                    <tr>
                        <td>{{ $lab->id }}</td>
                        <td>{{ $lab->nama_lab }}</td>
                        <td>{{ $lab->lokasi ?? '-' }}</td>
                        <td class="text-end">
                            <a href="{{ route('labs.edit', $lab->id) }}" class="btn btn-sm btn-outline-primary">Edit</a>
                            <form action="{{ route('labs.destroy', $lab->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('Yakin ingin menghapus lab ini?')">Hapus</button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="text-center">Belum ada data lab.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection