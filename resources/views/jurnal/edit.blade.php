@extends('layouts.app')
@section('title', 'Edit Jurnal')

@section('content')
<div class="container py-4">
    <h2 class="fw-bold">Edit Jurnal Mengajar</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Whoops! Terjadi kesalahan:</strong>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="card">
        <div class="card-body">
            <form action="{{ route('jurnal.update', $jurnal->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="nama_guru" class="form-label">Nama Guru</label>
                        <input type="text" name="nama_guru" class="form-control" value="{{ $jurnal->nama_guru }}" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="tanggal" class="form-label">Tanggal</label>
                        <input type="date" name="tanggal" class="form-control" value="{{ $jurnal->tanggal }}" required>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="jam_mulai" class="form-label">Jam Mulai</label>
                        <input type="time" name="jam_mulai" class="form-control" value="{{ \Carbon\Carbon::parse($jurnal->jam_mulai)->format('H:i') }}" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="jam_selesai" class="form-label">Jam Selesai</label>
                        <input type="time" name="jam_selesai" class="form-control" value="{{ \Carbon\Carbon::parse($jurnal->jam_selesai)->format('H:i') }}" required>
                    </div>
                </div>
                <div class="row">
                     <div class="col-md-6 mb-3">
                        <label for="kelas" class="form-label">Kelas</label>
                        <select name="kelas" class="form-select" required>
                            <option value="">-- Pilih Kelas --</option>
                            @foreach($kelasList as $kelas)
                                <option value="{{ $kelas }}" {{ $jurnal->kelas == $kelas ? 'selected' : '' }}>
                                    {{ $kelas }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="mata_pelajaran" class="form-label">Mata Pelajaran</label>
                        <input type="text" name="mata_pelajaran" class="form-control" value="{{ $jurnal->mata_pelajaran }}" required>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="materi" class="form-label">Materi</label>
                    <textarea name="materi" class="form-control" rows="3" required>{{ $jurnal->materi }}</textarea>
                </div>
                <div class="mb-3">
                    <label for="foto_kegiatan" class="form-label">Ganti Foto Kegiatan (Opsional)</label>
                    <input type="file" name="foto_kegiatan" class="form-control">
                    @if($jurnal->foto_kegiatan)
                        <small class="form-text text-muted">Foto saat ini: <a href="{{ Storage::url($jurnal->foto_kegiatan) }}" target="_blank">Lihat foto</a></small>
                    @endif
                </div>
                <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                <a href="{{ route('jurnal.index') }}" class="btn btn-outline-secondary">Batal</a>
            </form>
        </div>
    </div>
</div>
@endsection