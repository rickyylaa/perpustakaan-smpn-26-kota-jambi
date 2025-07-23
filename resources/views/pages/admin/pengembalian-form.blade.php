<x-admin-layout>
    <x-breadcrumb title="Pengembalian">
        <li class="breadcrumb-item active">
            <p>Pengembalian</p>
        </li>
    </x-breadcrumb>
    <x-content>
        <x-card-6>
            <x-card-body>
                <div class="row align-items-start">
                    <div class="col-md-4 mb-3">
                        <img src="{{ asset('storage/' . $siswa->foto) }}" alt="Foto Siswa" class="img-fluid rounded" style="max-height: 300px; height: 150px; width: 150px;">
                    </div>
                    <div class="col-md-8 mt-2" style="left: -20px;">
                        <dl class="row">
                            <dt class="col-sm-4">Nama</dt>
                            <dd class="col-sm-8">{{ $siswa->nama }}</dd>
                            <dt class="col-sm-4">NISN</dt>
                            <dd class="col-sm-8">{{ $siswa->nisn }}</dd>
                            <dt class="col-sm-4">Kelas</dt>
                            <dd class="col-sm-8">{{ $siswa->kelas->nama_kelas }}</dd>
                            <dt class="col-sm-4">Tmpt.Tgl Lahir</dt>
                            <dd class="col-sm-8">{{ $siswa->tempat_lahir }}, {{ \Carbon\Carbon::parse($siswa->tanggal_lahir)->translatedFormat('d F Y') }}</dd>
                            <dt class="col-sm-4">Jenis Kelamin</dt>
                            <dd class="col-sm-8">{{ ucfirst($siswa->jenis_kelamin) }}</dd>
                        </dl>
                    </div>
                </div>
            </x-card-body>
        </x-card-6>
        <x-card>
            <x-card-header title="Pengembalian Buku"></x-card-header>
            <x-card-body>
                <x-table>
                    @slot('thead')
                        <tr>
                            <th width="1%">No</th>
                            <th>Judul Buku</th>
                            <th width="1%">Tanggal Pinjam</th>
                            <th width="1%">Tanggal Deadline</th>
                            <th>Denda</th>
                            <th>Aksi</th>
                        </tr>
                    @endslot
                    @if (count($riwayat) > 0)
                        @php
                            $rowNumber = 1;
                        @endphp
                        @foreach ($riwayat as $data)
                            <tr>
                                <td class="text-center align-middle">{{ $rowNumber }}</td>
                                <td class="align-middle">{{ $data->buku->judul }}</td>
                                <td class="align-middle">{{ \Carbon\Carbon::parse($data->peminjaman->tanggal_pinjam)->translatedFormat('d F Y') }}</td>
                                <td class="align-middle">{{ \Carbon\Carbon::parse($data->peminjaman->tanggal_deadline)->translatedFormat('d F Y') }}</td>
                                <td class="align-middle">
                                    <ul class="list-unstyled p-0">
                                        <li>Keterlambatan: Rp{{ number_format($data->denda_keterlambatan, 0, ',', '.') }},-</li>
                                        <li>Buku Hilang: Rp{{ number_format($data->denda_buku_hilang ?? 0, 0, ',', '.') }},-</li>
                                        <li>Buku Rusak: Rp{{ number_format($data->denda_buku_rusak ?? 0, 0, ',', '.') }},-</li>
                                    </ul>
                                </td>
                                <td class="align-middle">
                                    <div class="d-flex justify-content-center align-items-center">
                                        <x-button-complete target="completePengembalian" id="{{ $data->id }}"></x-button-complete>
                                    </div>
                                </td>
                            </tr>
                            @php
                                $rowNumber++;
                            @endphp
                        @endforeach
                    @else
                        <tr>
                            <td colspan="10" class="text-center">Tidak ada data peminjaman</td>
                        </tr>
                    @endif
                </x-table>
            </x-card-body>
        </x-card>
    </x-content>

    @push('style')
        <style>
            dt {
                font-weight: normal;
                margin-bottom: 0;
            }

            dd {
                margin-bottom: 0.25rem;
            }

            dt::after {
                content: ':';
                margin-right: 0.5rem;
            }
        </style>
    @endpush

    @push('modal')
        <x-modal target="completePengembalian" title="Pengembalian Denda" size="modal-lg">
            <p>Centang salah satu jika terjadi Buku Rusak atau Buku Hilang</p>
            <form method="POST" enctype="multipart/form-data">
                @csrf @method('PUT') <input type="hidden" name="denda_keterlambatan" id="denda_keterlambatan" value="{{ $riwayat[0]->denda_keterlambatan ?? 0 }}">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <div class="custom-control custom-switch">
                                <input type="checkbox" name="denda_buku_rusak" id="denda_buku_rusak" class="custom-control-input" value="{{ $denda->denda_buku_rusak }}">
                                <label class="custom-control-label" for="denda_buku_rusak">
                                    Denda Buku Rusak (Rp{{ number_format($denda->denda_buku_rusak) }})
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <div class="custom-control custom-switch">
                                <input type="checkbox" name="denda_buku_hilang" id="denda_buku_hilang" class="custom-control-input" value="{{ $denda->denda_buku_hilang }}">
                                <label class="custom-control-label" for="denda_buku_hilang">
                                    Denda Buku Hilang (Rp{{ number_format($denda->denda_buku_hilang) }})
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 mb-3">
                        <label for="catatan">Catatan</label>
                        <textarea name="catatan" id="catatan" class="form-control" placeholder="Catatan" rows="3">{{ old('catatan') }}</textarea>
                    </div>
                </div>
                <x-button-modal></x-button-modal>
            </form>
        </x-modal>
    @endpush

    @push('script')
        <script>
            $('#completePengembalian').on('show.bs.modal', function(event) {
                var button = $(event.relatedTarget);
                var id = button.data('id');
                var modal = $(this);

                var actionUrl = '/admin/pengembalian/' + id + '/selesai';
                modal.find('form').attr('action', actionUrl);
            });
        </script>
    @endpush
</x-admin-layout>
