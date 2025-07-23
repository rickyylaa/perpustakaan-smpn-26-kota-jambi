<x-admin-layout>
    <x-breadcrumb title="Rak & Baris">
        <li class="breadcrumb-item active">
            <p>Rak & Baris</p>
        </li>
    </x-breadcrumb>

    <x-content>
        <x-card>
            <x-card-header title="Data Rak & Baris"></x-card-header>
            <x-card-body>
                <x-input-search route="{{ route('admin.rakbaris') }}">
                    <x-button-add target="tambahRakbaris"></x-button-add>
                </x-input-search>
                <x-table>
                    @slot('thead')
                        <tr>
                            <th width="1%">No</th>
                            <th>Kode</th>
                            <th>Kategori</th>
                            <th>Rak</th>
                            <th>Baris</th>
                            <th>Aksi</th>
                        </tr>
                    @endslot
                    @if (count($rakbaris) > 0)
                        @foreach ($rakbaris as $index => $data)
                            <tr>
                                <td class="text-center align-middle">{{ $rakbaris->firstItem() + $index }}</td>
                                <td class="align-middle">{{ $data->kode }}</td>
                                <td class="align-middle">{{ $data->kategori->nama }}</td>
                                <td class="align-middle">{{ $data->nama_rak }}</td>
                                <td class="align-middle">{{ $data->nomor_baris }}</td>
                                <td class="align-middle">
                                    <div class="d-flex justify-content-center align-items-center">
                                        <x-button-edit target="editRakbaris" id="{{ $data->id }}"></x-button-edit>
                                        <x-button-delete id="{{ $data->id }}" resource="admin/rakbaris"></x-button-delete>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="10" class="text-center">Tidak ada data rakbaris</td>
                        </tr>
                    @endif
                </x-table>
                <x-pagination :paginator="$rakbaris"></x-pagination>
            </x-card-body>
        </x-card>
    </x-content>

    @push('modal')
        <x-modal target="tambahRakbaris" title="Tambah Rak & Baris" size="modal-lg">
            <form method="POST" action="{{ route('admin.tambahRakbaris') }}" enctype="multipart/form-data" class="mb-2">
                @csrf
                <div class="row mb-2">
                    <div class="col-12">
                        <div class="form-group">
                            <label for="tambah_kategori_id">Kategori<span class="text-danger">*</span></label>
                            <select name="tambah_kategori_id" id="tambah_kategori_id" class="form-control" required>
                                <option value="" disabled {{ old('tambah_kategori_id') == '' ? 'selected' : '' }}>Pilih salah satu</option>
                                @foreach ($kategori as $item)
                                    <option value="{{ $item->id }}">{{ $item->nama }}</option>
                                @endforeach
                            </select>
                            @error('tambah_kategori_id') <span class="text-danger small">{{ $message }}</span> @enderror
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-group">
                            <label for="tambah_nomor_baris">Rak<span class="text-danger">*</span></label>
                            <input type="text" name="tambah_nomor_baris" id="tambah_nama_rak" class="form-control" value="{{ old('tambah_nama_rak') }}" placeholder="Contoh: Rak A" required>
                        </div>
                        @error('tambah_nama_rak') <span class="text-danger small">{{ $message }}</span> @enderror
                    </div>
                    <div class="col-12">
                        <div class="form-group">
                            <label for="tambah_nomor_baris">Baris<span class="text-danger">*</span></label>
                            <input type="text" name="tambah_nomor_baris" id="tambah_nomor_baris" class="form-control" value="{{ old('tambah_nomor_baris') }}" placeholder="Contoh: 1" maxlength="3" oninput="this.value = this.value.replace(/[^0-9]/g, '').slice(0, 3);" required>
                        </div>
                        @error('tambah_nomor_baris') <span class="text-danger small">{{ $message }}</span> @enderror
                    </div>
                </div>
                <x-button-modal></x-button-modal>
            </form>
        </x-modal>

        <x-modal target="editRakbaris" title="Edit Rak & Baris" size="modal-lg">
            <form method="POST" enctype="multipart/form-data" class="mb-2">
                @csrf @method('PUT')
                <div class="row mb-2">
                    <div class="col-12">
                        <div class="form-group">
                            <label for="edit_kategori_id">Kategori<span class="text-danger">*</span></label>
                            <select name="edit_kategori_id" id="edit_kategori_id" class="form-control" required>
                                <option value="" disabled {{ old('edit_kategori_id') == '' ? 'selected' : '' }}>Pilih salah satu</option>
                                @foreach ($kategori as $item)
                                    <option value="{{ $item->id }}">{{ $item->nama }}</option>
                                @endforeach
                            </select>
                            @error('edit_kategori_id') <span class="text-danger small">{{ $message }}</span> @enderror
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-group">
                            <label for="edit_nomor_baris">Rak<span class="text-danger">*</span></label>
                            <input type="text" name="edit_nomor_baris" id="edit_nama_rak" class="form-control" value="{{ old('edit_nama_rak') }}" placeholder="Contoh: Rak A" required>
                        </div>
                        @error('edit_nama_rak') <span class="text-danger small">{{ $message }}</span> @enderror
                    </div>
                    <div class="col-12">
                        <div class="form-group">
                            <label for="edit_nomor_baris">Baris<span class="text-danger">*</span></label>
                            <input type="text" name="edit_nomor_baris" id="edit_nomor_baris" class="form-control" value="{{ old('edit_nomor_baris') }}" placeholder="Contoh: 1" maxlength="3" oninput="this.value = this.value.replace(/[^0-9]/g, '').slice(0, 3);" required>
                        </div>
                        @error('edit_nomor_baris') <span class="text-danger small">{{ $message }}</span> @enderror
                    </div>
                </div>
                <x-button-modal></x-button-modal>
            </form>
        </x-modal>
    @endpush

    @push('script')
        <x-confirm-delete></x-confirm-delete>

        <script>
            $('#editRakbaris').on('show.bs.modal', function(event) {
                var button = $(event.relatedTarget);
                var id = button.data('id');

                $.get('/admin/rakbaris/' + id + '/edit', function(data) {
                    var modal = $(this);
                    modal.find('#edit_kategori_id').val(data.kategori_id);
                    modal.find('#edit_nama_rak').val(data.nama_rak);
                    modal.find('#edit_nomor_baris').val(data.nomor_baris);

                    modal.find('form').attr('action', '/admin/rakbaris/' + id + '/update');
                }.bind(this));
            });
        </script>
    @endpush
</x-admin-layout>
