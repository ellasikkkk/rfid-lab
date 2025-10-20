@extends('layouts.app')
@section('title', 'Edit Guru')
@section('content')
<div class="container py-4">
    <h2 class="fw-bold mb-4">Edit Data Guru</h2>
    <div class="card shadow-sm">
        <div class="card-body">
            <form action="{{ route('guru.update', $guru->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <label for="nama_guru" class="form-label">Nama Guru</label>
                    <input type="text" name="nama_guru" id="nama_guru" class="form-control" value="{{ $guru->nama_guru }}" required>
                </div>
                <div class="mb-3">
                    <label for="nip" class="form-label">NIP (Opsional)</label>
                    <input type="text" name="nip" id="nip" class="form-control" value="{{ $guru->nip }}">
                </div>
                <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                <a href="{{ route('guru.index') }}" class="btn btn-secondary">Batal</a>
            </form>
        </div>
    </div>
</div>
@endsection