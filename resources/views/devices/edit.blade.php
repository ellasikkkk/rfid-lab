@extends('layouts.app')
@section('title', 'Edit Perangkat')
@section('content')
<div class="container py-4">
    <h2 class="fw-bold text-gradient text-primary mb-4">Edit Perangkat</h2>
    <div class="card shadow-sm border-0">
        <div class="card-body">
            <form action="{{ route('devices.update', $device->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <label for="unique_id" class="form-label">ID Unik (Sesuai di Arduino)</label>
                    <input type="text" name="unique_id" id="unique_id" class="form-control" value="{{ $device->unique_id }}" required>
                </div>
                <div class="mb-3">
                    <label for="nama_perangkat" class="form-label">Nama Perangkat</label>
                    <input type="text" name="nama_perangkat" id="nama_perangkat" class="form-control" value="{{ $device->nama_perangkat }}" required>
                </div>
                <div class="mb-3">
                    <label for="lab_id" class="form-label">Lokasi Lab</label>
                    <select name="lab_id" id="lab_id" class="form-select" required>
                        <option value="">-- Pilih Lab --</option>
                        @foreach ($labs as $lab)
                            <option value="{{ $lab->id }}" {{ $device->lab_id == $lab->id ? 'selected' : '' }}>
                                {{ $lab->nama_lab }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                <a href="{{ route('devices.index') }}" class="btn btn-outline-secondary">Batal</a>
            </form>
        </div>
    </div>
</div>
@endsection