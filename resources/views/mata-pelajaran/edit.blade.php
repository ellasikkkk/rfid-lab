@extends('layouts.app')
@section('title', 'Edit Mata Pelajaran')
@section('content')
<div class="container py-4">
    <h2 class="fw-bold mb-4">Edit Mata Pelajaran</h2>
    <div class="card shadow-sm">
        <div class="card-body">
            <form action="{{ route('mata-pelajaran.update', $mataPelajaran->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <label for="nama_mapel" class="form-label">Nama Mata Pelajaran</label>
                    <input type="text" name="nama_mapel" id="nama_mapel" class="form-control" value="{{ $mataPelajaran->nama_mapel }}" required>
                </div>
                <div class="mb-3">
                    <label for="jurusan" class="form-label">Jurusan Terkait (Opsional)</label>
                    <select name="jurusan" id="jurusan" class="form-select">
                        <option value="" {{ !$mataPelajaran->jurusan ? 'selected' : '' }}>-- Umum --</option>
                        <option value="TKJ" {{ $mataPelajaran->jurusan == 'TKJ' ? 'selected' : '' }}>TKJ</option>
                        <option value="Perhotelan" {{ $mataPelajaran->jurusan == 'Perhotelan' ? 'selected' : '' }}>Perhotelan</option>
                        <option value="Boga" {{ $mataPelajaran->jurusan == 'Boga' ? 'selected' : '' }}>Boga</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                <a href="{{ route('mata-pelajaran.index') }}" class="btn btn-secondary">Batal</a>
            </form>
        </div>
    </div>
</div>
@endsection