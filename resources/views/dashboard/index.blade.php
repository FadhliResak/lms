@extends('layouts.app')

@section('content')
<div class="row g-1 dashboard-grid">
    <div class="col-12">
        <div class="card welcome-card">
            <div class="card-body">
                <h5 class="card-title mb-0">Selamat datang, {{ $user->name }}</h5>
                <div class="text-muted">Peran: {{ $user->role }}</div>
            </div>
        </div>
    </div>

    @auth
    @if(in_array(Auth::user()->role, ['wakil_kurikulum','tenaga_administrasi']))
    <div class="col-12 col-sm-6 col-md-4 col-lg-4">
        <div class="card h-100 dashboard-card">
            <div class="card-body">
                <h6>Akademik</h6>
                <p class="text-muted">Kurikulum, jadwal, nilai, absensi.</p>
                <div class="mt-1"><span class="badge rounded-pill bg-warning text-dark badge-anim" data-bs-toggle="tooltip" title="Jumlah Mapel & Rekap nilai">M: {{ $stats['courses'] ?? 0 }} • R: {{ $stats['records'] ?? 0 }}</span></div>
                <a href="/akademik" class="btn btn-sm btn-primary" data-bs-toggle="tooltip" title="Kelola kurikulum, jadwal, nilai & absensi">Buka</a>
            </div>
        </div>
    </div>
    @endif
    @if(in_array(Auth::user()->role, ['wakil_kesiswaan','tenaga_administrasi']))
    <div class="col-12 col-sm-6 col-md-4 col-lg-4">
        <div class="card h-100 dashboard-card">
            <div class="card-body">
                <h6>Kesiswaan</h6>
                <p class="text-muted">Data siswa, PPDB, prestasi, BK, ekstrakurikuler.</p>
                <div class="mt-1"><span class="badge rounded-pill bg-info text-dark badge-anim" data-bs-toggle="tooltip" title="Jumlah siswa terdaftar">Siswa {{ $stats['students'] ?? 0 }}</span></div>
                <a href="/kesiswaan" class="btn btn-sm btn-primary" data-bs-toggle="tooltip" title="Kelola data siswa, PPDB, prestasi, BK & ekskul">Buka</a>
            </div>
        </div>
    </div>
    @endif
    @if(in_array(Auth::user()->role, ['tenaga_administrasi','kepala_sekolah','wakil_kurikulum','wakil_kesiswaan','wakil_sarpras','wakil_humas']))
    <div class="col-12 col-sm-6 col-md-4 col-lg-4">
        <div class="card h-100 dashboard-card">
            <div class="card-body">
                <h6>Kepegawaian</h6>
                <p class="text-muted">Data guru/tenaga kependidikan, absensi, cuti.</p>
                <div class="mt-1"><span class="badge rounded-pill bg-secondary text-white badge-anim" data-bs-toggle="tooltip" title="Jumlah pegawai (guru & tenaga kependidikan)">Pegawai {{ $stats['staff'] ?? 0 }}</span></div>
                <a href="/kepegawaian" class="btn btn-sm btn-primary" data-bs-toggle="tooltip" title="Kelola data pegawai, absensi & cuti">Buka</a>
            </div>
        </div>
    </div>
    @endif
    @if(in_array(Auth::user()->role, ['wakil_sarpras','tenaga_administrasi']))
    <div class="col-12 col-sm-6 col-md-4 col-lg-4">
        <div class="card h-100 dashboard-card">
            <div class="card-body">
                <h6>Sarana & Prasarana</h6>
                <p class="text-muted">Inventaris, pemeliharaan, pengadaan.</p>
                <div class="mt-1"><span class="badge rounded-pill bg-dark text-white badge-anim" data-bs-toggle="tooltip" title="Jumlah inventaris sarpras">Inventaris {{ $stats['assets'] ?? 0 }}</span></div>
                <a href="/sarpras" class="btn btn-sm btn-primary" data-bs-toggle="tooltip" title="Kelola inventaris, pemeliharaan & pengadaan">Buka</a>
            </div>
        </div>
    </div>
    @endif

    @if(in_array(Auth::user()->role, ['guru_pembimbing_pkl','tenaga_administrasi','wakil_humas']))
    <div class="col-12 col-sm-6 col-md-4 col-lg-4">
        <div class="card h-100 dashboard-card">
            <div class="card-body">
                <h6>PKL</h6>
                <p class="text-muted">Penempatan, monitoring, penilaian, kerjasama.</p>
                <div class="mt-1"><span class="badge rounded-pill bg-success text-white badge-anim" data-bs-toggle="tooltip" title="Jumlah penempatan PKL">PKL {{ $stats['internships'] ?? 0 }}</span></div>
                <a href="/pkl" class="btn btn-sm btn-primary" data-bs-toggle="tooltip" title="Kelola PKL: penempatan, monitoring & penilaian">Buka</a>
            </div>
        </div>
    </div>
    @endif
    @if(in_array(Auth::user()->role, ['wakil_humas','tenaga_administrasi']))
    <div class="col-12 col-sm-6 col-md-4 col-lg-4">
        <div class="card h-100 dashboard-card">
            <div class="card-body">
                <h6>Humas & Kemitraan</h6>
                <p class="text-muted">Surat, dokumentasi, komunikasi stakeholder.</p>
                <div class="mt-1"><span class="badge rounded-pill bg-primary text-white badge-anim" data-bs-toggle="tooltip" title="Jumlah kerjasama & surat masuk/keluar">K: {{ $stats['partnerships'] ?? 0 }} • S: {{ $stats['letters'] ?? 0 }}</span></div>
                <a href="/humas" class="btn btn-sm btn-primary" data-bs-toggle="tooltip" title="Kelola humas: kerjasama & surat">Buka</a>
            </div>
        </div>
    </div>
    @endif
    @if(in_array(Auth::user()->role, ['wakil_kesiswaan','tenaga_administrasi']))
    <div class="col-12 col-sm-6 col-md-4 col-lg-4">
        <div class="card h-100 dashboard-card">
            <div class="card-body">
                <h6>Kelulusan & Alumni</h6>
                <p class="text-muted">Kelulusan, ijazah, tracer study, database alumni.</p>
                <div class="mt-1"><span class="badge rounded-pill bg-success text-white badge-anim" data-bs-toggle="tooltip" title="Jumlah alumni dalam database">Alumni {{ $stats['alumni'] ?? 0 }}</span></div>
                <a href="/alumni" class="btn btn-sm btn-primary" data-bs-toggle="tooltip" title="Kelola kelulusan, ijazah & tracer study">Buka</a>
            </div>
        </div>
    </div>
    @endif
    @if(in_array(Auth::user()->role, ['tenaga_administrasi']))
    <div class="col-12 col-sm-6 col-md-4 col-lg-4">
        <div class="card h-100 dashboard-card">
            <div class="card-body">
                <h6>Perpustakaan</h6>
                <p class="text-muted">Katalog, peminjaman, pengembalian, kunjungan.</p>
                <div class="mt-1"><span class="badge rounded-pill bg-secondary text-white badge-anim" data-bs-toggle="tooltip" title="Jumlah buku & peminjaman aktif">B: {{ $stats['books'] ?? 0 }} • P: {{ $stats['loans'] ?? 0 }}</span></div>
                <a href="/perpustakaan" class="btn btn-sm btn-primary" data-bs-toggle="tooltip" title="Kelola katalog, peminjaman & pengembalian">Buka</a>
            </div>
        </div>
    </div>
    @endif
    @endauth
</div>
@endsection