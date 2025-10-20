@extends('layouts.app')
@section('title', 'Tambah Lab Baru')
@section('content')
<div class="container py-4">
    <h2 class="fw-bold text-gradient text-primary mb-4">Tambah Lab Baru</h2>
    <div class="card shadow-sm border-0">
        <div class="card-body">
            <form action="{{ route('labs.store') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="nama_lab" class="form-label">Nama Lab</label>
                    <input type="text" name="nama_lab" id="nama_lab" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="lokasi" class="form-label">Lokasi (Opsional)</label>
                    <input type="text" name="lokasi" id="lokasi" class="form-control">
                </div>
                <button type="submit" class="btn btn-primary">Simpan Lab</button>
                <a href="{{ route('labs.index') }}" class="btn btn-outline-secondary">Batal</a>
            </form>
        </div>
    </div>
</div>
@endsection