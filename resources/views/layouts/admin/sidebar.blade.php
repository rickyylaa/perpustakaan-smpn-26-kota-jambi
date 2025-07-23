<aside class="main-sidebar sidebar-light-primary elevation-2">
    <a href="{{ route('admin.dashboard') }}" class="brand-link">
        <img src="{{ asset('assets/img/icons/icon.png') }}" alt="Perpustakaan" class="brand-image" style="opacity: .8">
        <span class="brand-text font-weight-bold">Perpustakaan</span>
    </a>
    <div class="sidebar os-theme-dark">
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{ asset(AuthAdmin()->getFoto()) }}" alt="User Image" class="img-circle elevation-2">
            </div>
            <div class="info">
                <a href="javascript:;" class="d-block">{{ AuthAdmin()->nama }}</a>
            </div>
        </div>
        <div class="form-inline">
            <div class="input-group" data-widget="sidebar-search">
                <input type="search" class="form-control form-control-sidebar" placeholder="Cari..." aria-label="Search">
                <div class="input-group-append">
                    <button class="btn btn-sidebar">
                        <i class="fa fa-sharp fa-solid fa-magnifying-glass"></i>
                    </button>
                </div>
            </div>
        </div>
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-item">
                    <a href="{{ route('admin.dashboard') }}" class="nav-link @active('admin/dashboard')">
                        <i class="nav-icon fa fa-solid fa-sharp fa-gauge-high" style="font-size: 1rem;"></i>
                        <p>Dashboard</p>
                    </a>
                </li>
                <li class="nav-header text-secondary text-bold">Data</li>
                <li class="nav-item">
                    <a href="{{ route('admin.petugas') }}" class="nav-link @active('admin/petugas')">
                        <i class="nav-icon fa fa-user-tie" style="font-size: 1rem;"></i>
                        <p>Petugas</p>
                    </a>
                </li>
                <li class="nav-item @open('admin/kelas') || @open('admin/siswa')">
                    <a href="#" class="nav-link @active('admin/kelas') || @active('admin/siswa')">
                        <i class="nav-icon fa fa-users" style="font-size: 1rem;"></i>
                        <p>
                            Data Siswa
                            <i class="fa fa-angle-left right" style="font-size: 1rem;"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('admin.kelas') }}" class="nav-link @active('admin/kelas')">
                                <i class="fa fa-circle nav-icon" style="font-size: 0.50rem;"></i>
                                <p>Kelas</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.siswa') }}" class="nav-link @active('admin/siswa')">
                                <i class="fa fa-circle nav-icon" style="font-size: 0.50rem;"></i>
                                <p>Siswa</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item @open('admin/kategori') || @open('admin/rakbaris') || @open('admin/buku')">
                    <a href="#" class="nav-link @active('admin/kategori') || @active('admin/rakbaris') || @active('admin/buku')">
                        <i class="nav-icon fa fa-book" style="font-size: 1rem;"></i>
                        <p>
                            Perpustakaan
                            <i class="fa fa-angle-left right" style="font-size: 1rem;"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('admin.kategori') }}" class="nav-link @active('admin/kategori')">
                                <i class="fa fa-circle nav-icon" style="font-size: 0.50rem;"></i>
                                <p>Kategori</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.rakbaris') }}" class="nav-link @active('admin/rakbaris')">
                                <i class="fa fa-circle nav-icon" style="font-size: 0.50rem;"></i>
                                <p>Rak & Baris</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.buku') }}" class="nav-link @active('admin/buku')">
                                <i class="fa fa-circle nav-icon" style="font-size: 0.50rem;"></i>
                                <p>Buku</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-header text-secondary text-bold">Manajemen</li>
                <li class="nav-item @open('admin/peminjaman*') || @open('admin/pengembalian*')">
                    <a href="#" class="nav-link @active('admin/peminjaman*') || @active('admin/pengembalian*')">
                        <i class="nav-icon fas fa-exchange-alt" style="font-size: 1rem;"></i>
                        <p>
                            Transaksi
                            <i class="fas fa-angle-left right" style="font-size: 1rem;"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('admin.peminjaman') }}" class="nav-link @active('admin/peminjaman*')">
                                <i class="fas fa-circle nav-icon" style="font-size: 0.5rem;"></i>
                                <p>Peminjaman</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.pengembalian') }}" class="nav-link @active('admin/pengembalian*')">
                                <i class="fas fa-circle nav-icon" style="font-size: 0.5rem;"></i>
                                <p>Pengembalian</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.laporan') }}" class="nav-link @active('admin/laporan')">
                        <i class="nav-icon fas fa-chart-line" style="font-size: 1rem;"></i>
                        <p>Laporan</p>
                    </a>
                </li>
                <li class="nav-header text-secondary text-bold">Lainnya</li>
                <li class="nav-item">
                    <a href="{{ route('admin.denda') }}" class="nav-link @active('admin/denda')">
                        <i class="nav-icon fas fa-dollar" style="font-size: 1rem;"></i>
                        <p>Denda</p>
                    </a>
                </li>
                <li class="nav-item">
                    <form method="POST" action="{{ route('logout') }}" id="logout-form" style="display: none;">
                        @csrf
                    </form>
                    <a href="javascript:;" class="nav-link" onclick="document.getElementById('logout-form').submit();">
                        <i class="nav-icon fa fa-solid fa-sharp fa-sign-out-alt" style="font-size: 1rem;"></i>
                        <p>Logout</p>
                    </a>
                </li>
            </ul>
        </nav>
    </div>
</aside>
