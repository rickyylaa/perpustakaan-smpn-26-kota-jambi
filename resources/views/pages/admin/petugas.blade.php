<x-admin-layout>
    <x-breadcrumb title="Petugas">
        <li class="breadcrumb-item active">
            <p>Petugas</p>
        </li>
    </x-breadcrumb>

    <x-content>
        <x-card>
            <x-card-header title="Data Petugas"></x-card-header>
            <x-card-body>
                <x-input-search route="{{ route('admin.petugas') }}">
                    <x-button-add target="tambahPetugas"></x-button-add>
                </x-input-search>
                <x-table>
                    @slot('thead')
                        <tr>
                            <th width="1%">No</th>
                            <th>Petugas</th>
                            <th>Telpon</th>
                            <th>Jenis Kelamin</th>
                            <th>Aksi</th>
                        </tr>
                    @endslot
                    @if (count($petugas) > 0)
                        @foreach ($petugas as $index => $data)
                            <tr>
                                <td class="text-center align-middle">{{ $petugas->firstItem() + $index }}</td>
                                <td class="align-middle">
                                    <ul class="products-list product-list-in-card pl-2 pr-2">
                                        <li class="item">
                                            <div class="product-img">
                                                <img src="{{ asset($data->getFoto()) }}" alt="Foto" class="img-size-50">
                                            </div>
                                            <div class="product-info">
                                                <a href="javascript:void(0)" class="product-title">{{ ucwords($data->nama) }}</a>
                                                <span class="product-description">
                                                    {{ $data->nip }}
                                                </span>
                                            </div>
                                        </li>
                                    </ul>
                                </td>
                                <td class="align-middle">
                                    <a href="https://wa.me/{{ $data->getNoHP() }}" class="text-info" target="_blank">
                                        {{ $data->getNoHP() }}
                                    </a>
                                </td>
                                <td class="align-middle">{{ str_replace(' ', '-', ucwords(str_replace('-', ' ', $data->jenis_kelamin))) }}</td>
                                <td class="align-middle">
                                    <div class="d-flex justify-content-center align-items-center">
                                        <x-button-edit target="editPetugas" id="{{ $data->id }}"></x-button-edit>
                                        <x-button-delete id="{{ $data->id }}" resource="admin/petugas"></x-button-delete>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="10" class="text-center">Tidak ada data petugas</td>
                        </tr>
                    @endif
                </x-table>
                <x-pagination :paginator="$petugas"></x-pagination>
            </x-card-body>
        </x-card>
    </x-content>

    @push('modal')
        <x-modal target="tambahPetugas" title="Tambah Petugas" size="modal-lg">
            <form method="POST" action="{{ route('admin.tambahPetugas') }}" enctype="multipart/form-data" class="mb-2">
                @csrf
                <div class="row mb-2">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="tambah_nip">NIP (Nomor Induk Kepegawaian)<span class="text-danger">*</span></label>
                            <input type="text" name="tambah_nip" id="tambah_nip" class="form-control" value="{{ old('tambah_nip') }}" placeholder="Nomor Induk Kepegawaian" maxlength="18" oninput="this.value = this.value.replace(/[^0-9]/g, '').slice(0, 18);" required>
                            @error('tambah_nip') <span class="text-danger small">{{ $message }}</span> @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="tambah_nama">Nama<span class="text-danger">*</span></label>
                            <input type="text" name="tambah_nama" id="tambah_nama" class="form-control" value="{{ old('tambah_nama') }}" placeholder="Nama" required>
                            @error('tambah_nama') <span class="text-danger small">{{ $message }}</span> @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="tambah_no_hp">No Hp<span class="text-danger">*</span></label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">+62</span>
                                </div>
                                <input type="text" name="tambah_no_hp" id="tambah_no_hp" class="form-control" value="{{ old('tambah_no_hp') }}" placeholder="Contoh: 81234****" maxlength="15" oninput="this.value = this.value.replace(/[^0-9]/g, '').slice(0, 15);" required>
                            </div>
                            @error('tambah_no_hp') <span class="text-danger small">{{ $message }}</span> @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="tambah_jenis_kelamin">Jenis Kelamin<span class="text-danger">*</span></label>
                            <select name="tambah_jenis_kelamin" id="tambah_jenis_kelamin" class="form-control" required>
                                <option value="laki-laki" {{ old('tambah_jenis_kelamin') == 'laki-laki' ? 'selected' : '' }}>Laki-Laki</option>
                                <option value="perempuan" {{ old('tambah_jenis_kelamin') == 'perempuan' ? 'selected' : '' }}>Perempuan</option>
                            </select>
                            @error('tambah_jenis_kelamin') <span class="text-danger small">{{ $message }}</span> @enderror
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-group">
                            <label for="tambah_foto">Foto</label>
                            <div class="input-group">
                                <div class="custom-file">
                                    <input type="file" name="tambah_foto" id="tambah_foto" class="custom-file-input" accept="image/*">
                                    <label class="custom-file-label" for="tambah_foto">Pilih file</label>
                                </div>
                            </div>
                            @error('tambah_foto') <span class="text-danger small">{{ $message }}</span> @enderror
                        </div>
                    </div>
                </div>
                <x-button-modal></x-button-modal>
            </form>
        </x-modal>

        <x-modal target="editPetugas" title="Edit Petugas" size="modal-lg">
            <form method="POST" enctype="multipart/form-data" class="mb-2">
                @csrf @method('PUT')
                <div class="row mb-2">
                    <div class="col-12">
                        <div class="form-group">
                            <label for="edit_username">Username<span class="text-danger">*</span></label>
                            <input type="text" name="edit_username" id="edit_username" class="form-control" value="{{ old('edit_username') }}" placeholder="Username" required>
                            @error('edit_username') <span class="text-danger small">{{ $message }}</span> @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="edit_password">Password<span class="text-danger">*</span></label>
                            <input type="password" name="edit_password" id="edit_password" class="form-control" placeholder="Kosongkan jika tidak ingin mengganti password">
                            @error('edit_password') <span class="text-danger small">{{ $message }}</span> @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="edit_password_confirmation">Konfirmasi Password<span class="text-danger">*</span></label>
                            <input type="password" name="edit_password_confirmation" id="edit_password_confirmation" class="form-control" placeholder="Kosongkan jika tidak ingin mengganti password">
                        </div>
                    </div>
                    <div class="col-12">
                        <caption> <hr> </caption>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="edit_nip">NIP (Nomor Induk Kepegawaian)<span class="text-danger">*</span></label>
                            <input type="text" name="edit_nip" id="edit_nip" class="form-control" value="{{ old('edit_nip') }}" placeholder="Nomor Induk Kepegawaian" maxlength="18" oninput="this.value = this.value.replace(/[^0-9]/g, '').slice(0, 18);" required>
                            @error('edit_nip') <span class="text-danger small">{{ $message }}</span> @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="edit_nama">Nama<span class="text-danger">*</span></label>
                            <input type="text" name="edit_nama" id="edit_nama" class="form-control" value="{{ old('edit_nama') }}" placeholder="Nama" required>
                            @error('edit_nama') <span class="text-danger small">{{ $message }}</span> @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="edit_no_hp">No Hp<span class="text-danger">*</span></label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">+62</span>
                                </div>
                                <input type="text" name="edit_no_hp" id="edit_no_hp" class="form-control" value="{{ old('edit_no_hp') }}" placeholder="Contoh: 81234****" maxlength="15" oninput="this.value = this.value.replace(/[^0-9]/g, '').slice(0, 15);" required>
                            </div>
                            @error('edit_no_hp') <span class="text-danger small">{{ $message }}</span> @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="edit_jenis_kelamin">Jenis Kelamin<span class="text-danger">*</span></label>
                            <select name="edit_jenis_kelamin" id="edit_jenis_kelamin" class="form-control" required>
                                <option value="laki-laki" {{ old('edit_jenis_kelamin') == 'laki-laki' ? 'selected' : '' }}>Laki-Laki</option>
                                <option value="perempuan" {{ old('edit_jenis_kelamin') == 'perempuan' ? 'selected' : '' }}>Perempuan</option>
                            </select>
                            @error('edit_jenis_kelamin') <span class="text-danger small">{{ $message }}</span> @enderror
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-group">
                            <label for="edit_foto">Foto</label>
                            <div class="input-group">
                                <div class="custom-file">
                                    <input type="file" name="edit_foto" id="edit_foto" class="custom-file-input" accept="image/*">
                                    <label class="custom-file-label" for="edit_foto">Pilih file</label>
                                </div>
                            </div>
                            @error('edit_foto') <span class="text-danger small">{{ $message }}</span> @enderror
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-group">
                            <label>Foto Sebelumnya</label>
                            <div id="preview-foto"></div>
                        </div>
                    </div>
                </div>
                <x-button-modal></x-button-modal>
            </form>
        </x-modal>
    @endpush

    @push('script')
        <x-confirm-delete></x-confirm-delete>
        <x-file-browser></x-file-browser>

        <script>
            $('#editPetugas').on('show.bs.modal', function(event) {
                var button = $(event.relatedTarget);
                var id = button.data('id');

                $.get('/admin/petugas/' + id + '/edit', function(data) {
                    var modal = $(this);
                    modal.find('#user_id').val(data.user_id);
                    modal.find('#edit_username').val(data.user.username);
                    modal.find('#edit_nip').val(data.nip);
                    modal.find('#edit_nama').val(data.nama);
                    modal.find('#edit_no_hp').val(data.no_hp.replace('0', ''));
                    modal.find('#edit_jenis_kelamin').val(data.jenis_kelamin);

                    var previewContainer = modal.find('#preview-foto');
                    previewContainer.empty();
                    if (data.foto) {
                        var imgUrl = '/storage/' + data.foto;
                        previewContainer.append(`
                            <img src="${imgUrl}" alt="avatar" width="300" class="img-fluid">
                        `);
                    }

                    modal.find('form').attr('action', '/admin/petugas/' + id + '/update');
                }.bind(this));
            });
        </script>
    @endpush
</x-admin-layout>
