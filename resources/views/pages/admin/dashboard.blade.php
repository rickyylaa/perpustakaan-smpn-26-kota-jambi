<x-admin-layout>
    <x-breadcrumb title="Dashboard">
        <li class="breadcrumb-item active">
            <p>Dashboard</p>
        </li>
    </x-breadcrumb>

    <x-content>
        <x-widget title="Total Siswa" color="indigo" icon="fa-users" link="{{ route('admin.siswa') }}">
            {{ $totalSiswa }}
        </x-widget>

        <x-widget title="Total Buku" color="lightblue" icon="fa-book" link="{{ route('admin.buku') }}">
            {{ $totalBuku }}
        </x-widget>

        <x-widget title="Total Peminjaman Buku" color="maroon" icon="fa-chart-pie" link="{{ route('admin.peminjaman') }}">
            {{ $totalPeminjaman }}
        </x-widget>

        <x-widget title="Total Pengembalian Buku" color="fuchsia" icon="fa-chart-bar" link="{{ route('admin.pengembalian') }}">
            {{ $totalPengembalian }}
        </x-widget>
    </x-content>
</x-admin-layout>
