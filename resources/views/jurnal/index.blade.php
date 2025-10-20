@extends('layouts.app')
@section('title', 'Data Jurnal Mengajar')

@section('content')
<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold text-gradient text-primary">Data Jurnal Praktek</h2>
        <a href="{{ route('jurnal.create') }}" class="btn btn-primary"><i class="bi bi-plus-circle me-2"></i>Tambah Jurnal</a>
    </div>

    <div class="card shadow-sm mb-4">
        <div class="card-header">
            <h5 class="mb-0">Filter Data Jurnal</h5>
        </div>
        <div class="card-body">
            <form method="GET" action="{{ route('jurnal.index') }}" class="row align-items-end">
                <div class="col-md-5">
                    <label for="tanggal_awal" class="form-label">Tanggal Awal</label>
                    {{-- Nilai akan terisi otomatis sesuai filter terakhir --}}
                    <input type="date" name="tanggal_awal" id="tanggal_awal" class="form-control" value="{{ $tanggalAwal ?? '' }}">
                </div>
                <div class="col-md-5">
                    <label for="tanggal_akhir" class="form-label">Tanggal Akhir</label>
                    {{-- Nilai akan terisi otomatis sesuai filter terakhir --}}
                    <input type="date" name="tanggal_akhir" id="tanggal_akhir" class="form-control" value="{{ $tanggalAkhir ?? '' }}">
                </div>
                <div class="col-md-2">
                    <button type="submit" class="btn btn-primary w-100">Tampilkan Data</button>
                </div>
            </form>
        </div>
    </div>
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="card shadow-sm">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>No</th>
                            <th>Tanggal</th>
                            <th>Guru</th>
                            <th>Kelas</th>
                            <th>Mata Pelajaran</th>
                            <th>Materi</th>
                            <th>Siswa Hadir</th>
                            <th>Foto</th>
                            <th class="text-end">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($jurnals as $index => $jurnal)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ \Carbon\Carbon::parse($jurnal->tanggal)->format('d M Y') }}</td>
                            <td>{{ $jurnal->nama_guru }}</td>
                            <td>{{ $jurnal->kelas }}</td>
                            <td>{{ $jurnal->mata_pelajaran }}</td>
                            <td>{{ Str::limit($jurnal->materi, 50) }}</td>
                            <td>
                                <span class="badge bg-primary">{{ $jurnal->siswaHadir->count() }} siswa</span>
                            </td>
                            <td>
                                @if($jurnal->foto_kegiatan)
                                    <a href="{{ Storage::url($jurnal->foto_kegiatan) }}" target="_blank">
                                        <img src="{{ Storage::url($jurnal->foto_kegiatan) }}" alt="Foto Kegiatan" style="width: 80px; height: 50px; object-fit: cover; border-radius: 5px;">
                                    </a>
                                @else
                                    -
                                @endif
                            </td>
                            <td class="text-end">
                                <a href="{{ route('jurnal.show', $jurnal->id) }}" class="btn btn-sm btn-info" title="Ambil Absen">
                                    <i class="bi bi-person-check"></i> Absen
                                </a>
                                <a href="{{ route('jurnal.edit', $jurnal->id) }}" class="btn btn-sm btn-outline-primary" title="Edit Jurnal">
                                    <i class="bi bi-pencil"></i>
                                </a>
                                <form action="{{ route('jurnal.destroy', $jurnal->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('Yakin ingin menghapus jurnal ini?')" title="Hapus Jurnal">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="9" class="text-center py-5">
                                <p class="text-muted">Tidak ada data jurnal untuk rentang tanggal yang dipilih.</p>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection