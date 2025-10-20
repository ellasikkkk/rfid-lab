@extends('layouts.app')
@section('title', 'Buat Jurnal Baru')
@section('content')
<div class="container py-4">
    <h2 class="fw-bold">Buat Jurnal Mengajar Baru</h2>
    <div class="card">
        <div class="card-body">
            <form action="{{ route('jurnal.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="nama_guru" class="form-label">Nama Guru</label>
                        <input type="text" name="nama_guru" class="form-control" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="tanggal" class="form-label">Tanggal</label>
                        <input type="date" name="tanggal" class="form-control" value="{{ now()->toDateString() }}" required>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="jam_mulai" class="form-label">Jam Mulai</label>
                        <input type="time" name="jam_mulai" class="form-control" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="jam_selesai" class="form-label">Jam Selesai</label>
                        <input type="time" name="jam_selesai" class="form-control" required>
                    </div>
                </div>
                <div class="row">
                     <div class="col-md-6 mb-3">
                        <label for="kelas" class="form-label">Kelas</label>
                        <select name="kelas" class="form-select" required>
                            <option value="">-- Pilih Kelas --</option>
                            @foreach($kelasList as $kelas)
                                <option value="{{ $kelas }}">{{ $kelas }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="mata_pelajaran" class="form-label">Mata Pelajaran</label>
                        <input type="text" name="mata_pelajaran" class="form-control" required>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="materi" class="form-label">Materi</label>
                    <textarea name="materi" class="form-control" rows="3" required></textarea>
                </div>
                <div class="mb-3">
                    <label for="foto_kegiatan" class="form-label">Foto Kegiatan (Opsional)</label>
                    <input type="file" name="foto_kegiatan" class="form-control">
                </div>
                <button type="submit" class="btn btn-primary">Simpan dan Lanjutkan ke Absensi</button>
            </form>
        </div>
    </div>
</div>
@endsection