@php
    // Mendapatkan URI route saat ini
    $current_route = Route::current()->uri();

    // Memecah URI menjadi segment
    $segments = explode('/', $current_route);

    $modul = $segments[0];
    if ($segments[0] == 'wali_murid') {
        $modul = 'walmur';
    }

    $sub_modul = '';
    if (isset($segments[1])) {
        $sub_modul = $segments[1];
    }

    if ($sub_modul == 'laporan') {
        $sub_modul = isset($segments[2]) ? $sub_modul . '/' . $segments[2] : $sub_modul;
    }
@endphp

<ul class="navbar-nav sidebar accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center"
        href="{{ route($modul . '.dashboard.index') }}">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-laugh-wink"></i>
        </div>
        <div class="sidebar-brand-text mx-3">SIPA</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">
    <!-- Nav Item - Dashboard -->
    <li class="nav-item {{ $sub_modul == '' || $sub_modul == 'dashboard' ? 'active' : '' }}">
        <a class="nav-link" href="{{ route($modul . '.dashboard.index') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>

    @if (auth()->user()->role_id == 1)
        <!-- Divider -->
        <hr class="sidebar-divider">

        <!-- Heading -->
        <div class="sidebar-heading">
            Master Data
        </div>

        <li class="nav-item {{ $sub_modul == 'periode' ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('admin.periode.index') }}">
                <i class="fas fa-fw fa-tachometer-alt"></i>
                <span>Periode</span></a>
        </li>
        <li class="nav-item {{ $sub_modul == 'sekolah' ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('admin.sekolah.index') }}">
                <i class="fas fa-fw fa-tachometer-alt"></i>
                <span>Sekolah</span></a>
        </li>
        <li class="nav-item {{ $sub_modul == 'kamar' ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('admin.kamar.index') }}">
                <i class="fas fa-fw fa-tachometer-alt"></i>
                <span>Kamar</span></a>
        </li>
        <li class="nav-item {{ $sub_modul == 'kegiatan' ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('admin.kegiatan.index') }}">
                <i class="fas fa-fw fa-tachometer-alt"></i>
                <span>Kegiatan</span></a>
        </li>
        <li class="nav-item {{ $sub_modul == 'jadwal' ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('admin.jadwal.index') }}">
                <i class="fas fa-fw fa-tachometer-alt"></i>
                <span>Jadwal</span></a>
        </li>

        <li
            class="nav-item {{ $sub_modul == 'iuran' || $sub_modul == 'jenis_iuran' || $sub_modul == 'keringanan' ? 'active' : '' }}">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#iuran"
                aria-expanded="true" aria-controls="iuran">
                <i class="fas fa-fw fa-folder"></i>
                <span>Iuran</span>
            </a>
            <div id="iuran"
                class="collapse {{ $sub_modul == 'iuran' || $sub_modul == 'jenis_iuran' || $sub_modul == 'keringanan' ? 'show' : '' }}"
                aria-labelledby="headingPages" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header"></h6>
                    <a class="collapse-item {{ $sub_modul == 'jenis_iuran' ? 'active' : '' }}"
                        href="{{ route('admin.jenis_iuran.index') }}">Jenis Iuran</a>
                    <a class="collapse-item {{ $sub_modul == 'iuran' ? 'active' : '' }}"
                        href="{{ route('admin.iuran.index') }}">Iuran</a>
                    <a class="collapse-item {{ $sub_modul == 'keringanan' ? 'active' : '' }}"
                        href="{{ route('admin.keringanan.index') }}">Keringanan</a>
                </div>
            </div>
        </li>

        <li
            class="nav-item {{ $sub_modul == 'role' || $sub_modul == 'siswa' || $sub_modul == 'pengguna' || $sub_modul == 'user' ? 'active' : '' }}">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#pengguna"
                aria-expanded="true" aria-controls="pengguna">
                <i class="fas fa-fw fa-folder"></i>
                <span>Pengguna</span>
            </a>
            <div id="pengguna"
                class="collapse {{ $sub_modul == 'role' || $sub_modul == 'siswa' || $sub_modul == 'wali_murid' || $sub_modul == 'pengurus' ? 'show' : '' }}"
                aria-labelledby="headingPages" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header"></h6>
                    <a class="collapse-item {{ $sub_modul == 'role' ? 'active' : '' }}"
                        href="{{ route('admin.role.index') }}">Role</a>
                    <a class="collapse-item {{ $sub_modul == 'siswa' ? 'active' : '' }}"
                        href="{{ route('admin.siswa.index') }}">Siswa</a>
                    <a class="collapse-item {{ $sub_modul == 'wali_murid' ? 'active' : '' }}"
                        href="{{ route('admin.wali_murid.index') }}">Wali Murid</a>
                    <a class="collapse-item {{ $sub_modul == 'pengurus' ? 'active' : '' }}"
                        href="{{ route('admin.pengurus.index') }}">Pengurus</a>
                </div>
            </div>
        </li>


        <!-- Heading -->
        <div class="sidebar-heading">
            Transaksi
        </div>
        <li class="nav-item {{ $sub_modul == 'pendaftaran' ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('admin.pendaftaran.index') }}">
                <i class="fas fa-fw fa-tachometer-alt"></i>
                <span>Pendaftaran</span></a>
        </li>
        <li class="nav-item {{ $sub_modul == 'tagihan' ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('admin.tagihan.index') }}">
                <i class="fas fa-fw fa-tachometer-alt"></i>
                <span>Tagihan</span></a>
        </li>
        <li class="nav-item {{ $sub_modul == 'penghuni' ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('admin.penghuni.index') }}">
                <i class="fas fa-fw fa-tachometer-alt"></i>
                <span>Penghuni</span></a>
        </li>
        <li class="nav-item {{ $sub_modul == 'absensi' ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('admin.absensi.index') }}">
                <i class="fas fa-fw fa-tachometer-alt"></i>
                <span>Absensi</span></a>
        </li>

        <!-- Heading -->
        <div class="sidebar-heading">
            Laporan
        </div>
        <li class="nav-item {{ $sub_modul == 'laporan/absensi' ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('admin.laporan.absensi.index') }}">
                <i class="fas fa-fw fa-tachometer-alt"></i>
                <span>Laporan Absensi</span></a>
        </li>
    @endif

    @if (auth()->user()->role_id == 2)
        <!-- Heading -->
        <div class="sidebar-heading">
            Transaksi
        </div>
        <li class="nav-item {{ $sub_modul == 'pendaftaran' ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('pengurus.pendaftaran.index') }}">
                <i class="fas fa-fw fa-tachometer-alt"></i>
                <span>Pendaftaran</span></a>
        </li>
        <li class="nav-item {{ $sub_modul == 'penghuni' ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('pengurus.penghuni.index') }}">
                <i class="fas fa-fw fa-tachometer-alt"></i>
                <span>Penghuni</span></a>
        </li>
        <li class="nav-item {{ $sub_modul == 'absensi' ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('pengurus.absensi.index') }}">
                <i class="fas fa-fw fa-tachometer-alt"></i>
                <span>Absensi</span></a>
        </li>

        <!-- Heading -->
        <div class="sidebar-heading">
            Laporan
        </div>
        <li class="nav-item {{ $sub_modul == 'laporan/absensi' ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('pengurus.laporan.absensi.index') }}">
                <i class="fas fa-fw fa-tachometer-alt"></i>
                <span>Laporan Absensi</span></a>
        </li>
    @endif

    @if (auth()->user()->role_id == 3)
        <!-- Divider -->
        <hr class="sidebar-divider">

        <!-- Heading -->
        <div class="sidebar-heading">
            Transaksi
        </div>

        <li class="nav-item {{ $sub_modul == 'pendaftaran' ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('walmur.pendaftaran.index') }}">
                <i class="fas fa-fw fa-tachometer-alt"></i>
                <span>Pendaftaran Siswa Baru</span></a>
        </li>
        <li class="nav-item {{ $sub_modul == 'siswa' ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('walmur.siswa.index') }}">
                <i class="fas fa-fw fa-tachometer-alt"></i>
                <span>Siswa</span></a>
        </li>
        <li class="nav-item {{ $sub_modul == 'tagihan' ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('walmur.tagihan.index') }}">
                <i class="fas fa-fw fa-tachometer-alt"></i>
                <span>Tagihan</span></a>
        </li>
        <li class="nav-item {{ $sub_modul == 'periode' ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('walmur.laporan.absensi.index') }}">
                <i class="fas fa-fw fa-tachometer-alt"></i>
                <span>Rekap Kegiatan</span></a>
        </li>
    @endif
</ul>
