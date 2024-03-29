<!-- ========== Left Sidebar Start ========== -->
<div class="vertical-menu">
    <div data-simplebar class="h-100">
        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <!-- Left Menu Start -->
            <ul class="metismenu list-unstyled" id="side-menu">
                <li class="menu-title">Menu - {{ Auth::user()->roles }}</li>
                <li>
                    <a href="{{ route('dashboard') }}" class="waves-effect">
                        <div class="d-inline-block icons-sm mr-1"><i class="uim uim-airplay"></i></div>
                        <span>Dashboard</span>
                    </a>
                </li>
                @if (Auth::user()->roles === 'Admin')
                    <li>
                        <a href="{{ route('admin.api') }}" class=" waves-effect">
                            <div class="d-inline-block icons-sm mr-1"><i class="uim uim-lock-access"></i></div>
                            <span>API</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.sekolah') }}" class=" waves-effect">
                            <div class="d-inline-block icons-sm mr-1"><i class="uim uim-horizontal-align-left"></i>
                            </div>
                            <span>Sekolah</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.kelas') }}" class=" waves-effect">
                            <div class="d-inline-block icons-sm mr-1"><i class="uim uim-layers-alt"></i></div>
                            <span>Kelas</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.matpel') }}" class=" waves-effect">
                            <div class="d-inline-block icons-sm mr-1"><i class="uim uim-grids"></i></div>
                            <span>Mata Pelajaran</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.user') }}" class=" waves-effect">
                            <div class="d-inline-block icons-sm mr-1"><i class="uim uim-key-skeleton-alt"></i></div>
                            <span>Akun</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.siswa') }}" class=" waves-effect">
                            <div class="d-inline-block icons-sm mr-1"><i class="uim uim-list-ul"></i></div>
                            <span>Siswa</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.guru') }}" class="waves-effect">
                            <div class="d-inline-block icons-sm mr-1"><i class="uim uim-layer-group"></i></div>
                            <span>Guru</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.jadwal') }}" class=" waves-effect">
                            <div class="d-inline-block icons-sm mr-1"><i class="uim uim-clock-eight"></i></div>
                            <span>Jadwal</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.absensi') }}" class=" waves-effect">
                            <div class="d-inline-block icons-sm mr-1"><i class="uim uim-schedule"></i></div>
                            <span>Absensi</span>
                        </a>
                    </li>
                    <li>
                        <a href="#" class="has-arrow waves-effect">
                            <div class="d-inline-block icons-sm mr-1"><i class="uim uim-bookmark"></i></div>
                            <span>Laporan</span>
                        </a>
                        <ul class="sub-menu" aria-expanded="false">
                            <li><a href="{{ route('admin.laporan_jadwal') }}">Jadwal</a></li>
                            <li><a href="{{ route('admin.laporan_absensi') }}">Absensi</a></li>
                        </ul>
                    </li>
                @elseif (Auth::user()->roles === 'Guru')
                    <li>
                        <a href="{{ route('admin.siswa') }}" class=" waves-effect">
                            <div class="d-inline-block icons-sm mr-1"><i class="uim uim-list-ul"></i></div>
                            <span>Siswa</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.guru') }}" class="waves-effect">
                            <div class="d-inline-block icons-sm mr-1"><i class="uim uim-layer-group"></i></div>
                            <span>Guru</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.jadwal') }}" class=" waves-effect">
                            <div class="d-inline-block icons-sm mr-1"><i class="uim uim-clock-eight"></i></div>
                            <span>Jadwal</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.absensi') }}" class=" waves-effect">
                            <div class="d-inline-block icons-sm mr-1"><i class="uim uim-schedule"></i></div>
                            <span>Absensi</span>
                        </a>
                    </li>
                @elseif (Auth::user()->roles === 'Siswa')
                    <li>
                        <a href="{{ route('admin.siswa') }}" class=" waves-effect">
                            <div class="d-inline-block icons-sm mr-1"><i class="uim uim-list-ul"></i></div>
                            <span>Siswa</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.jadwal') }}" class=" waves-effect">
                            <div class="d-inline-block icons-sm mr-1"><i class="uim uim-clock-eight"></i></div>
                            <span>Jadwal</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.absensi') }}" class=" waves-effect">
                            <div class="d-inline-block icons-sm mr-1"><i class="uim uim-schedule"></i></div>
                            <span>Absensi</span>
                        </a>
                    </li>
                @endif
            </ul>
        </div>
        <!-- Sidebar -->
    </div>
</div>
<!-- Left Sidebar End -->
