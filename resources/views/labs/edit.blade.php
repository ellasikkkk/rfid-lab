@extends('layouts.app')
@section('title', 'Edit Lab')
@section('content')
<div class="container py-4">
    <h2 class="fw-bold text-gradient text-primary mb-4">Edit Lab</h2>
    <div class="card shadow-sm border-0">
        <div class="card-body">
            <form action="{{ route('labs.update', $lab->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <label for="nama_lab" class="form-label">Nama Lab</label>
                    <input type="text" name="nama_lab" id="nama_lab" class="form-control" value="{{ $lab->nama_lab }}" required>
                </div>
                <div class="mb-3">
                    <label for="lokasi" class="form-label">Lokasi (Opsional)</label>
                    <input type="text" name="lokasi" id="lokasi" class="form-control" value="{{ $lab->lokasi }}">
                </div>
                <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                <a href="{{ route('labs.index') }}" class="btn btn-outline-secondary">Batal</a>
            </form>
        </div>
    </div>
</div>
@endsection