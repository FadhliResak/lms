<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>LMS SMKN 1 Tanjung Baru</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-light">
    <nav class="navbar navbar-dark bg-primary sticky-top shadow">
        <div class="container-fluid">
            <a class="navbar-brand" href="/dashboard">LMS SMKN 1 Tanjung Baru</a>
            <button class="navbar-toggler d-md-none" type="button" data-bs-toggle="collapse" data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            
        </div>
    </nav>

    <div class="container-fluid">
        <div class="row">
            <nav id="sidebarMenu" class="col-md-3 col-lg-3 col-xl-2 d-md-block bg-primary text-white sidebar sidebar-primary collapse show">
                <div class="position-sticky pt-3 sidebar-sticky">
                    <ul class="nav flex-column">
                        <li class="nav-item"><a class="nav-link {{ request()->is('dashboard') ? 'active' : '' }}" href="/dashboard"><span class="menu-label"><i class="bi bi-speedometer2"></i> Dashboard</span></a></li>
                        @auth
                            @if(in_array(Auth::user()->role, ['wakil_kurikulum','tenaga_administrasi']))
                                <li class="nav-item"><a class="nav-link {{ (request()->is('akademik') || request()->is('courses*') || request()->is('records*')) ? 'active' : '' }}" href="/akademik"><span class="menu-label"><i class="bi bi-journal-text"></i> Akademik</span> <span class="badge rounded-pill bg-warning text-dark ms-1">M: {{ $navCounts['courses'] ?? 0 }} • R: {{ $navCounts['records'] ?? 0 }}</span></a></li>
                            @endif
                            @if(in_array(Auth::user()->role, ['wakil_kesiswaan','tenaga_administrasi']))
                                <li class="nav-item"><a class="nav-link {{ (request()->is('kesiswaan') || request()->is('students*')) ? 'active' : '' }}" href="/kesiswaan"><span class="menu-label"><i class="bi bi-people"></i> Kesiswaan</span> <span class="badge rounded-pill bg-info text-dark ms-1">{{ $navCounts['students'] ?? 0 }}</span></a></li>
                            @endif
                            @if(in_array(Auth::user()->role, ['tenaga_administrasi','kepala_sekolah','wakil_kurikulum','wakil_kesiswaan','wakil_sarpras','wakil_humas']))
                                <li class="nav-item"><a class="nav-link {{ (request()->is('kepegawaian') || request()->is('staff*')) ? 'active' : '' }}" href="/kepegawaian"><span class="menu-label"><i class="bi bi-person-badge"></i> Kepegawaian</span> <span class="badge rounded-pill bg-secondary text-white ms-1">{{ $navCounts['staff'] ?? 0 }}</span></a></li>
                            @endif
                            @if(in_array(Auth::user()->role, ['wakil_sarpras','tenaga_administrasi']))
                                <li class="nav-item"><a class="nav-link {{ (request()->is('sarpras') || request()->is('assets*')) ? 'active' : '' }}" href="/sarpras"><span class="menu-label"><i class="bi bi-building"></i> Sarana & Prasarana</span> <span class="badge rounded-pill bg-dark text-white ms-1">{{ $navCounts['assets'] ?? 0 }}</span></a></li>
                            @endif
                            @if(in_array(Auth::user()->role, ['guru_pembimbing_pkl','tenaga_administrasi','wakil_humas']))
                                <li class="nav-item"><a class="nav-link {{ (request()->is('pkl') || request()->is('internships*')) ? 'active' : '' }}" href="/pkl"><span class="menu-label"><i class="bi bi-briefcase"></i> PKL</span> <span class="badge rounded-pill bg-success text-white ms-1">{{ $navCounts['internships'] ?? 0 }}</span></a></li>
                            @endif
                            @if(in_array(Auth::user()->role, ['wakil_humas','tenaga_administrasi']))
                                <li class="nav-item"><a class="nav-link {{ (request()->is('humas') || request()->is('partnerships*') || request()->is('letters*')) ? 'active' : '' }}" href="/humas"><span class="menu-label"><i class="bi bi-diagram-3"></i> Humas & Kemitraan</span> <span class="badge rounded-pill bg-primary text-white ms-1">K: {{ $navCounts['partnerships'] ?? 0 }} • S: {{ $navCounts['letters'] ?? 0 }}</span></a></li>
                            @endif
                            @if(in_array(Auth::user()->role, ['wakil_kesiswaan','tenaga_administrasi']))
                                <li class="nav-item"><a class="nav-link {{ (request()->is('alumni') || request()->is('alumni*')) ? 'active' : '' }}" href="/alumni"><span class="menu-label"><i class="bi bi-mortarboard"></i> Kelulusan & Alumni</span> <span class="badge rounded-pill bg-success text-white ms-1">{{ $navCounts['alumni'] ?? 0 }}</span></a></li>
                            @endif
                            @if(in_array(Auth::user()->role, ['tenaga_administrasi']))
                                <li class="nav-item"><a class="nav-link {{ (request()->is('perpustakaan') || request()->is('books*') || request()->is('loans*')) ? 'active' : '' }}" href="/perpustakaan"><span class="menu-label"><i class="bi bi-book"></i> Perpustakaan</span> <span class="badge rounded-pill bg-secondary text-white ms-1">B: {{ $navCounts['books'] ?? 0 }} • P: {{ $navCounts['loans'] ?? 0 }}</span></a></li>
                            @endif
                            <li class="nav-item"><a class="nav-link {{ request()->is('messages*') ? 'active' : '' }}" href="{{ route('messages.index') }}"><span class="menu-label"><i class="bi bi-chat-dots"></i> Messenger</span> <span class="badge rounded-pill bg-danger text-white ms-1">{{ $navCounts['messages_unread'] ?? 0 }}</span></a></li>
                        @endauth
                    </ul>
                    @auth
                    <div class="logout-area mt-auto p-3">
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button class="btn btn-outline-light w-100" type="submit">Keluar</button>
                        </form>
                    </div>
                    @endauth
                </div>
            </nav>

            <main class="col-md-9 ms-sm-auto col-lg-9 col-xl-10 px-md-4 content-area">
                @yield('content')
            </main>
        </div>
    </div>
</body>
</html>