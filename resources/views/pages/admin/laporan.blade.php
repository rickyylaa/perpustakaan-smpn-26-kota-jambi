<x-admin-layout>
    <x-breadcrumb title="Laporan">
        <li class="breadcrumb-item active">
            <p>Laporan</p>
        </li>
    </x-breadcrumb>
    <x-content>
            <x-card>
                <x-card-header title="Data Laporan"></x-card-header>
                <x-card-body>
                    <x-date-search route="admin.laporan"></x-date-search>
                    <x-table>
                        @slot('thead')
                            <tr>
                                <th width="1%">No</th>
                                <th>Siswa</th>
                                <th>Buku</th>
                                <th>Tanggal Pinjam</th>
                                <th>Tanggal Kembali</th>
                                <th>Denda</th>
                            </tr>
                        @endslot
                        @if (count($laporan) > 0)
                            @php
                                $rowNumber = 1;
                            @endphp
                            @foreach ($laporan as $index => $data)
                                <tr>
                                    <td class="text-center align-middle">{{ $rowNumber }}</td>
                                    <td class="align-middle">{{ $data->peminjaman->siswa->nama }}</td>
                                    <td class="align-middle">{{ $data->buku->judul }}</td>
                                    <td class="align-middle">{{ \Carbon\Carbon::parse($data->peminjaman->tanggal_pinjam)->translatedFormat('d F Y') }}</td>
                                    <td class="align-middle">{{ \Carbon\Carbon::parse($data->peminjaman->tanggal_deadline)->translatedFormat('d F Y') }}</td>
                                    <td class="align-middle">
                                        <ul class="list-unstyled mb-0 pl-3">
                                            <li>Denda Keterlambatan: Rp{{ number_format($data->denda_keterlambatan, 0, ',', '.') }},-</li>
                                            <li>Denda Buku Rusak: Rp{{ number_format($data->denda_buku_rusak, 0, ',', '.') }},-</li>
                                            <li>Denda Buku Hilang: Rp{{ number_format($data->denda_buku_hilang, 0, ',', '.') }},-</li>
                                        </ul>
                                    </td>
                                </tr>
                                @php
                                    $rowNumber++;
                                @endphp
                            @endforeach
                        @else
                            <tr>
                                <td colspan="10" class="text-center">Tidak ada data laporan</td>
                            </tr>
                        @endif
                    </x-table>
                </x-card-body>
            </x-card>
    </x-content>

    @push('script')
        <x-export-pdf url="admin"></x-export-pdf>
    @endpush
</x-admin-layout>
