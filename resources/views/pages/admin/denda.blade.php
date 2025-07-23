<x-admin-layout>
    <x-breadcrumb title="Denda">
        <li class="breadcrumb-item active">
            <p>Denda</p>
        </li>
    </x-breadcrumb>

    <x-content>
        <x-card>
            <x-card-header title="Data Denda"></x-card-header>
            <x-card-body>
                <x-input-search route="{{ route('admin.denda') }}">
                    <x-button-add target="tambahDenda"></x-button-add>
                </x-input-search>
                <x-table>
                    @slot('thead')
                        <tr>
                            <th width="1%">No</th>
                            <th>Denda Keterlambatan</th>
                            <th>Denda Buku Rusak</th>
                            <th>Denda Buku Hilang</th>
                            <th>Aksi</th>
                        </tr>
                    @endslot
                    @if (count($denda) > 0)
                        @foreach ($denda as $index => $data)
                            <tr>
                                <td class="text-center align-middle">{{ $denda->firstItem() + $index }}</td>
                                <td class="align-middle">Rp{{ number_format($data->denda_keterlambatan, 0, ',', '.') }},-</td>
                                <td class="align-middle">Rp{{ number_format($data->denda_buku_rusak, 0, ',', '.') }},-</td>
                                <td class="align-middle">Rp{{ number_format($data->denda_buku_hilang, 0, ',', '.') }},-</td>
                                <td class="align-middle">
                                    <div class="d-flex justify-content-center align-items-center">
                                        <x-button-edit target="editDenda" id="{{ $data->id }}"></x-button-edit>
                                        <x-button-delete id="{{ $data->id }}" resource="admin/denda"></x-button-delete>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="10" class="text-center">Tidak ada data denda</td>
                        </tr>
                    @endif
                </x-table>
                <x-pagination :paginator="$denda"></x-pagination>
            </x-card-body>
        </x-card>
    </x-content>

    @push('modal')
        <x-modal target="tambahDenda" title="Tambah Denda" size="modal-lg">
            <form method="POST" action="{{ route('admin.tambahDenda') }}" enctype="multipart/form-data" class="mb-2">
                @csrf
                <div class="row mb-2">
                    <div class="col-12">
                        <div class="form-group">
                            <label for="tambah_denda_keterlambatan">Denda Keterlambatan<span class="text-danger">*</span></label>
                            <input type="text" name="tambah_denda_keterlambatan" id="tambah_denda_keterlambatan" class="form-control" value="{{ old('tambah_denda_keterlambatan') }}" placeholder="Denda Keterlambatan" maxlength="8" oninput="formatDenda(this);" onblur="removeDotAndSave(this);" required>
                            @error('tambah_denda_keterlambatan') <span class="text-danger small">{{ $message }}</span> @enderror
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-group">
                            <label for="tambah_denda_buku_rusak">Denda Buku Rusak<span class="text-danger">*</span></label>
                            <input type="text" name="tambah_denda_buku_rusak" id="tambah_denda_buku_rusak" class="form-control" value="{{ old('tambah_denda_buku_rusak') }}" placeholder="Denda Buku Rusak" maxlength="8" oninput="formatDenda(this);" onblur="removeDotAndSave(this);" required>
                            @error('tambah_denda_buku_rusak') <span class="text-danger small">{{ $message }}</span> @enderror
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-group">
                            <label for="tambah_denda_buku_hilang">Denda Buku Hilang<span class="text-danger">*</span></label>
                            <input type="text" name="tambah_denda_buku_hilang" id="tambah_denda_buku_hilang" class="form-control" value="{{ old('tambah_denda_buku_hilang') }}" placeholder="Denda Buku Hilang" maxlength="8" oninput="formatDenda(this);" onblur="removeDotAndSave(this);" required>
                            @error('tambah_denda_buku_hilang') <span class="text-danger small">{{ $message }}</span> @enderror
                        </div>
                    </div>
                </div>
                <x-button-modal></x-button-modal>
            </form>
        </x-modal>

        <x-modal target="editDenda" title="Edit Denda" size="modal-lg">
            <form method="POST" enctype="multipart/form-data" class="mb-2">
                @csrf @method('PUT')
                <div class="row mb-2">
                    <div class="col-12">
                        <div class="form-group">
                            <label for="edit_denda_keterlambatan">Denda Keterlambatan<span class="text-danger">*</span></label>
                            <input type="text" name="edit_denda_keterlambatan" id="edit_denda_keterlambatan" class="form-control" value="{{ old('edit_denda_keterlambatan') }}" placeholder="Denda Keterlambatan" maxlength="8" oninput="formatDenda(this);" onblur="removeDotAndSave(this);" required>
                            @error('edit_denda_keterlambatan') <span class="text-danger small">{{ $message }}</span> @enderror
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-group">
                            <label for="edit_denda_buku_rusak">Denda Buku Rusak<span class="text-danger">*</span></label>
                            <input type="text" name="edit_denda_buku_rusak" id="edit_denda_buku_rusak" class="form-control" value="{{ old('edit_denda_buku_rusak') }}" placeholder="Denda Buku Rusak" maxlength="8" oninput="formatDenda(this);" onblur="removeDotAndSave(this);" required>
                            @error('edit_denda_buku_rusak') <span class="text-danger small">{{ $message }}</span> @enderror
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-group">
                            <label for="edit_denda_buku_hilang">Denda Buku Hilang<span class="text-danger">*</span></label>
                            <input type="text" name="edit_denda_buku_hilang" id="edit_denda_buku_hilang" class="form-control" value="{{ old('edit_denda_buku_hilang') }}" placeholder="Denda Buku Hilang" maxlength="8" oninput="formatDenda(this);" onblur="removeDotAndSave(this);" required>
                            @error('edit_denda_buku_hilang') <span class="text-danger small">{{ $message }}</span> @enderror
                        </div>
                    </div>
                </div>
                <x-button-modal></x-button-modal>
            </form>
        </x-modal>
    @endpush

    @push('script')
        <x-confirm-delete></x-confirm-delete>

        <script>
            $('#editDenda').on('show.bs.modal', function(event) {
                var button = $(event.relatedTarget);
                var id = button.data('id');

                $.get('/admin/denda/' + id + '/edit', function(data) {
                    var modal = $(this);
                    modal.find('#edit_denda_keterlambatan').val(data.denda_keterlambatan);
                    modal.find('#edit_denda_buku_rusak').val(data.denda_buku_rusak);
                    modal.find('#edit_denda_buku_hilang').val(data.denda_buku_hilang);

                    modal.find('form').attr('action', '/admin/denda/' + id + '/update');
                }.bind(this));
            });
        </script>
    @endpush
</x-admin-layout>
