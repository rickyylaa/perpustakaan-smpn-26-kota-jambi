<aside class="main-sidebar sidebar-light-primary elevation-2">
    <a href="{{ route('petugas.dashboard') }}" class="brand-link">
        <img src="{{ asset('assets/img/icons/icon.png') }}" alt="Perpustakaan" class="brand-image" style="opacity: .8">
        <span class="brand-text font-weight-bold">Perpustakaan</span>
    </a>
    <div class="sidebar os-theme-dark">
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{ asset(AuthPetugas()->getFoto()) }}" alt="User Image" class="img-circle elevation-2">
            </div>
            <div class="info">
                <a href="javascript:;" class="d-block">{{ AuthPetugas()->nama }}</a>
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
                    <a href="{{ route('petugas.dashboard') }}" class="nav-link @active('petugas/dashboard')">
                        <i class="nav-icon fa fa-solid fa-sharp fa-gauge-high" style="font-size: 1rem;"></i>
                        <p>Dashboard</p>
                    </a>
                </li>
                <li class="nav-header text-secondary text-bold">Data</li>
                <li class="nav-item">
                    <a href="{{ route('petugas.siswa') }}" class="nav-link @active('petugas/siswa')">
                        <i class="nav-icon fa fa-users" style="font-size: 1rem;"></i>
                        <p>Siswa</p>
                    </a>
                </li>
                <li class="nav-item @open('petugas/kategori') || @open('petugas/rakbaris') || @open('petugas/buku')">
                    <a href="#" class="nav-link @active('petugas/kategori') || @active('petugas/rakbaris') || @active('petugas/buku')">
                        <i class="nav-icon fa fa-book" style="font-size: 1rem;"></i>
                        <p>
                            Perpustakaan
                            <i class="fa fa-angle-left right" style="font-size: 1rem;"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('petugas.kategori') }}" class="nav-link @active('petugas/kategori')">
                                <i class="fa fa-circle nav-icon" style="font-size: 0.50rem;"></i>
                                <p>Kategori</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('petugas.rakbaris') }}" class="nav-link @active('petugas/rakbaris')">
                                <i class="fa fa-circle nav-icon" style="font-size: 0.50rem;"></i>
                                <p>Rak & Baris</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('petugas.buku') }}" class="nav-link @active('petugas/buku')">
                                <i class="fa fa-circle nav-icon" style="font-size: 0.50rem;"></i>
                                <p>Buku</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-header text-secondary text-bold">Manajemen</li>
                <li class="nav-item @open('petugas/peminjaman*') || @open('petugas/pengembalian*')">
                    <a href="#" class="nav-link @active('petugas/peminjaman*') || @active('petugas/pengembalian*')">
                        <i class="nav-icon fas fa-exchange-alt" style="font-size: 1rem;"></i>
                        <p>
                            Transaksi
                            <i class="fas fa-angle-left right" style="font-size: 1rem;"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('petugas.peminjaman') }}" class="nav-link @active('petugas/peminjaman*')">
                                <i class="fas fa-circle nav-icon" style="font-size: 0.5rem;"></i>
                                <p>Peminjaman</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('petugas.pengembalian') }}" class="nav-link @active('petugas/pengembalian*')">
                                <i class="fas fa-circle nav-icon" style="font-size: 0.5rem;"></i>
                                <p>Pengembalian</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-header text-secondary text-bold">Lainnya</li>
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
