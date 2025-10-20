@extends('layouts.app')
@section('title', 'Edit Jadwal')
@section('content')
<div class="container py-4">
    <h2 class="fw-bold text-gradient text-primary mb-4">Edit Jadwal</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="card shadow-sm border-0">
        <div class="card-body">
            <form action="{{ route('jadwal.update', $jadwal->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <label for="hari" class="form-label">Hari</label>
                    <select name="hari" id="hari" class="form-select" required>
                        <option value="Monday" {{ $jadwal->hari == 'Monday' ? 'selected' : '' }}>Senin</option>
                        <option value="Tuesday" {{ $jadwal->hari == 'Tuesday' ? 'selected' : '' }}>Selasa</option>
                        <option value="Wednesday" {{ $jadwal->hari == 'Wednesday' ? 'selected' : '' }}>Rabu</option>
                        <option value="Thursday" {{ $jadwal->hari == 'Thursday' ? 'selected' : '' }}>Kamis</option>
                        <option value="Friday" {{ $jadwal->hari == 'Friday' ? 'selected' : '' }}>Jumat</option>
                        <option value="Saturday" {{ $jadwal->hari == 'Saturday' ? 'selected' : '' }}>Sabtu</option>
                        <option value="Sunday" {{ $jadwal->hari == 'Sunday' ? 'selected' : '' }}>Minggu</option>
                    </select>
                </div>
                
                <div class="mb-3">
                    <label for="lab_id" class="form-label">Ruangan Lab</label>
                    <select name="lab_id" id="lab_id" class="form-select" required>
                        <option value="">-- Pilih Lab --</option>
                        @foreach ($labs as $lab)
                            <option value="{{ $lab->id }}" {{ $jadwal->lab_id == $lab->id ? 'selected' : '' }}>
                                {{ $lab->nama_lab }}
                            </option>
                        @endforeach
                    </select>
                </div>
                
                {{-- Input untuk Kelas --}}
<div class="mb-3">
    <label for="kelas" class="form-label">Kelas</label>
    <select name="kelas" id="kelas" class="form-select" required>
        <option value="">-- Pilih Kelas --</option>
        {{-- Mengambil daftar kelas dari config atau variabel lain --}}
        @foreach (config('kelas.list') as $kelasOption)
            {{-- Logika 'selected' untuk form edit --}}
            <option value="{{ $kelasOption }}" {{ (old('kelas', $jadwal->kelas ?? '')) == $kelasOption ? 'selected' : '' }}>
                {{ $kelasOption }}
            </option>
        @endforeach
    </select>
</div>

{{-- Input untuk Jam Ke- --}}
<div class="mb-3">
    <label for="jam_ke" class="form-label">Jam Ke- (Contoh: 1 s/d 3)</label>
    <input type="text" name="jam_ke" id="jam_ke" class="form-control" value="{{ old('jam_ke', $jadwal->jam_ke ?? '') }}">
</div>
                <div class="mb-3">
                    <label for="jurusan" class="form-label">Jurusan</label>
                    <select name="jurusan" id="jurusan" class="form-select" required>
                        <option value="TKJ" {{ $jadwal->jurusan == 'TKJ' ? 'selected' : '' }}>TKJ</option>
                        <option value="Perhotelan" {{ $jadwal->jurusan == 'Perhotelan' ? 'selected' : '' }}>Perhotelan</option>
                        <option value="Boga" {{ $jadwal->jurusan == 'Boga' ? 'selected' : '' }}>Boga</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="mapel" class="form-label">Mata Pelajaran</label>
                    <input type="text" name="mapel" id="mapel" class="form-control" value="{{ $jadwal->mapel }}" required>
                </div>

                <div class="mb-3">
                    <label for="nama_guru" class="form-label">Nama Guru</label>
                    <input type="text" name="nama_guru" id="nama_guru" class="form-control" value="{{ $jadwal->nama_guru }}">
                </div>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="jam_mulai" class="form-label">Jam Mulai</label>
                        <input type="time" name="jam_mulai" id="jam_mulai" class="form-control" value="{{ $jadwal->jam_mulai }}" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="jam_selesai" class="form-label">Jam Selesai</label>
                        <input type="time" name="jam_selesai" id="jam_selesai" class="form-control" value="{{ $jadwal->jam_selesai }}" required>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                <a href="{{ route('jadwal.index') }}" class="btn btn-outline-secondary">Batal</a>
            </form>
        </div>
    </div>
</div>
@endsection