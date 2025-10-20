@extends('layouts.app')
@section('title', 'Data Mata Pelajaran')
@section('content')
<div class="container py-4">
    <h2 class="fw-bold text-gradient text-primary mb-4">Data Master: Mata Pelajaran</h2>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="card shadow-sm border-0">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Daftar Mata Pelajaran</h5>
            <a href="{{ route('mata-pelajaran.create') }}" class="btn btn-primary"><i class="bi bi-plus-circle me-2"></i>Tambah Mapel Baru</a>
        </div>
        <div class="card-body">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Mata Pelajaran</th>
                        <th>Jurusan Terkait</th>
                        <th class="text-end">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($mataPelajarans as $index => $mapel)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $mapel->nama_mapel }}</td>
                        <td>{{ $mapel->jurusan ?? '-' }}</td>
                        <td class="text-end">
                            <a href="{{ route('mata-pelajaran.edit', $mapel->id) }}" class="btn btn-sm btn-outline-primary">Edit</a>
                            <form action="{{ route('mata-pelajaran.destroy', $mapel->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('Yakin ingin menghapus mata pelajaran ini?')">Hapus</button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="text-center">Belum ada data mata pelajaran.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection