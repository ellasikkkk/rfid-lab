@extends('layouts.app')
@section('title', 'Ambil Absensi Jurnal')
@section('content')
<div class="container py-4">
    <div class="card mb-4">
        <div class="card-header">
            <h4 class="mb-0">Detail Jurnal</h4>
        </div>
        <div class="card-body">
            <p><strong>Guru:</strong> {{ $jurnal->nama_guru }}</p>
            <p><strong>Kelas:</strong> {{ $jurnal->kelas }}</p>
            <p><strong>Mapel:</strong> {{ $jurnal->mata_pelajaran }}</p>
            <p><strong>Materi:</strong> {{ $jurnal->materi }}</p>
        </div>
    </div>

    <div class="card">
        <div class="card-header">
            <h4 class="mb-0">Absensi Siswa</h4>
        </div>
        <div class="card-body">
            <form action="{{ route('jurnal.absensi.store', $jurnal->id) }}" method="POST">
                @csrf
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Hadir</th>
                                <th>Nama Siswa</th>
                                <th>UID</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($siswaDiKelas as $siswa)
                            <tr>
                                <td>
                                    <input class="form-check-input" 
                                           type="checkbox" 
                                           name="siswa_ids[]" 
                                           value="{{ $siswa->id }}"
                                           {{ in_array($siswa->id, $siswaSudahHadirIds) ? 'checked' : '' }}>
                                </td>
                                <td>{{ $siswa->nama }}</td>
                                <td>{{ $siswa->uid }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <button type="submit" class="btn btn-primary mt-3">Simpan Absensi</button>
            </form>
        </div>
    </div>
</div>
@endsection