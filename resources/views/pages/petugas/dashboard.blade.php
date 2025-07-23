<x-petugas-layout>
    <x-breadcrumb title="Dashboard">
        <li class="breadcrumb-item active">
            <p>Dashboard</p>
        </li>
    </x-breadcrumb>

    <x-content>
        <x-widget title="Total Siswa" color="indigo" icon="fa-users" link="{{ route('petugas.siswa') }}">
            {{ $totalSiswa }}
        </x-widget>

        <x-widget title="Total Buku" color="lightblue" icon="fa-book" link="{{ route('petugas.buku') }}">
            {{ $totalBuku }}
        </x-widget>

        <x-widget title="Total Peminjaman Buku" color="maroon" icon="fa-chart-pie" link="{{ route('petugas.peminjaman') }}">
            {{ $totalPeminjaman }}
        </x-widget>

        <x-widget title="Total Pengembalian Buku" color="fuchsia" icon="fa-chart-bar" link="{{ route('petugas.pengembalian') }}">
            {{ $totalPengembalian }}
        </x-widget>
    </x-content>
</x-petugas-layout>
