@extends('layouts.app')
@section('title', 'Tambah Jadwal Baru')
@section('content')
<div class="container py-4">
    <h2 class="fw-bold text-gradient text-primary mb-4">Tambah Jadwal Baru</h2>

   @if ($errors->any())
    <div class="alert alert-danger">
        <strong>Whoops! Sepertinya ada yang salah dengan input Anda:</strong>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

    <div class="card shadow-sm border-0">
        <div class="card-body">
            <form action="{{ route('jadwal.store') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="hari" class="form-label">Hari</label>
                    <select name="hari" id="hari" class="form-select" required>
                        <option value="">-- Pilih Hari --</option>
                        <option value="Monday">Senin</option>
                        <option value="Tuesday">Selasa</option>
                        <option value="Wednesday">Rabu</option>
                        <option value="Thursday">Kamis</option>
                        <option value="Friday">Jumat</option>
                        <option value="Saturday">Sabtu</option>
                        <option value="Sunday">Minggu</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label for="lab_id" class="form-label">Ruangan Lab</label>
                    <select name="lab_id" id="lab_id" class="form-select" required>
                        <option value="">-- Pilih Lab --</option>
                        @foreach ($labs as $lab)
                            <option value="{{ $lab->id }}">{{ $lab->nama_lab }}</option>
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
                        <option value="">-- Pilih Jurusan --</option>
                        <option value="TKJ">TKJ</option>
                        <option value="Perhotelan">Perhotelan</option>
                        <option value="Boga">Boga</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="mapel" class="form-label">Mata Pelajaran</label>
                    <label for="mapel" class="form-label">Mata Pelajaran</label>
<select name="mapel" id="mapel" class="form-select" required>
    <option value="">-- Pilih Mata Pelajaran --</option>
    @foreach ($mataPelajarans as $mapel)
        <option value="{{ $mapel->nama_mapel }}" {{ (old('mapel', $jadwal->mapel ?? '')) == $mapel->nama_mapel ? 'selected' : '' }}>
            {{ $mapel->nama_mapel }}
        </option>
    @endforeach
</select>
                </div>
                
                <!-- ============================================= -->
                <!-- ===== INPUT NAMA GURU DITAMBAHKAN DI SINI ===== -->
                <!-- ============================================= -->
                <div class="mb-3">
    <label for="nama_guru" class="form-label">Nama Guru </label>
    <label for="nama_guru" class="form-label">Nama Guru</label>
<select name="nama_guru" id="nama_guru" class="form-select" required>
    <option value="">-- Pilih Guru --</option>
    @foreach ($gurus as $guru)
        <option value="{{ $guru->nama_guru }}" {{ (old('nama_guru', $jadwal->nama_guru ?? '')) == $guru->nama_guru ? 'selected' : '' }}>
            {{ $guru->nama_guru }}
        </option>
    @endforeach
</select>
</div>
                <!-- ============================================= -->

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="jam_mulai" class="form-label">Jam Mulai</label>
                        <input type="time" name="jam_mulai" id="jam_mulai" class="form-control" value="{{ old('jam_mulai') }}" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="jam_selesai" class="form-label">Jam Selesai</label>
                        <input type="time" name="jam_selesai" id="jam_selesai" class="form-control" value="{{ old('jam_selesai') }}" required>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Simpan Jadwal</button>
                <a href="{{ route('jadwal.index') }}" class="btn btn-outline-secondary">Batal</a>
            </form>
        </div>
    </div>
</div>
@endsection