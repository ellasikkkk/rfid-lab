@extends('layouts.app')
@section('title', 'Tambah Mata Pelajaran')
@section('content')
<div class="container py-4">
    <h2 class="fw-bold mb-4">Tambah Mata Pelajaran Baru</h2>
    <div class="card shadow-sm">
        <div class="card-body">
            <form action="{{ route('mata-pelajaran.store') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="nama_mapel" class="form-label">Nama Mata Pelajaran</label>
                    <input type="text" name="nama_mapel" id="nama_mapel" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="jurusan" class="form-label">Jurusan Terkait (Opsional)</label>
                    <select name="jurusan" id="jurusan" class="form-select">
                        <option value="">-- Umum --</option>
                        <option value="TKJ">TKJ</option>
                        <option value="Perhotelan">Perhotelan</option>
                        <option value="Boga">Boga</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">Simpan</button>
                <a href="{{ route('mata-pelajaran.index') }}" class="btn btn-secondary">Batal</a>
            </form>
        </div>
    </div>
</div>
@endsection