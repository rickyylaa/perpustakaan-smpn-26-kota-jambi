<x-petugas-layout>
    <x-breadcrumb title="Siswa">
        <li class="breadcrumb-item active">
            <p>Siswa</p>
        </li>
    </x-breadcrumb>

    <x-content>
        <x-card>
            <x-card-header title="Data Siswa"></x-card-header>
            <x-card-body>
                <x-input-search route="{{ route('petugas.siswa') }}"></x-input-search>
                <x-table>
                    @slot('thead')
                        <tr>
                            <th width="1%">No</th>
                            <th>Siswa</th>
                            <th>Kelas</th>
                            <th>Tmpt/Tgl Lahir</th>
                            <th>Jenis Kelamin</th>
                            <th>Aksi</th>
                        </tr>
                    @endslot
                    @if (count($siswa) > 0)
                        @foreach ($siswa as $index => $data)
                            <tr>
                                <td class="text-center align-middle">{{ $siswa->firstItem() + $index }}</td>
                                <td class="align-middle">
                                    <ul class="products-list product-list-in-card pl-2 pr-2">
                                        <li class="item">
                                            <div class="product-img">
                                                <img src="{{ asset($data->getFoto()) }}" alt="Foto" class="img-size-50">
                                            </div>
                                            <div class="product-info">
                                                <a href="javascript:void(0)" class="product-title">{{ ucwords($data->nama) }}</a>
                                                <span class="product-description">
                                                    {{ $data->nisn }}
                                                </span>
                                            </div>
                                        </li>
                                    </ul>
                                </td>
                                <td class="align-middle">{{ ucwords($data->kelas->nama_kelas) }}</td>
                                <td class="align-middle">{{ $data->tempat_lahir }}, {{ \Carbon\Carbon::parse($data->tanggal_lahir)->translatedFormat('d F Y') }}</td>
                                <td class="align-middle">{{ str_replace(' ', '-', ucwords(str_replace('-', ' ', $data->jenis_kelamin))) }}</td>
                                <td class="align-middle">
                                    <div class="d-flex justify-content-center align-items-center">
                                        <x-button-print route="{{ route('petugas.printSiswa', $data->kode_anggota) }}"></x-button-print>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="10" class="text-center">Tidak ada data siswa</td>
                        </tr>
                    @endif
                </x-table>
                <x-pagination :paginator="$siswa"></x-pagination>
            </x-card-body>
        </x-card>
    </x-content>
</x-petugas-layout>
