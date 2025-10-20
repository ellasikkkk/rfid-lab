@extends('layouts.app')
@section('title', 'Tambah Guru')
@section('content')
<div class="container py-4">
    <h2 class="fw-bold mb-4">Tambah Guru Baru</h2>
    <div class="card shadow-sm">
        <div class="card-body">
            <form action="{{ route('guru.store') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="nama_guru" class="form-label">Nama Guru</label>
                    <input type="text" name="nama_guru" id="nama_guru" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="nip" class="form-label">NIP (Opsional)</label>
                    <input type="text" name="nip" id="nip" class="form-control">
                </div>
                <button type="submit" class="btn btn-primary">Simpan</button>
                <a href="{{ route('guru.index') }}" class="btn btn-secondary">Batal</a>
            </form>
        </div>
    </div>
</div>
@endsection