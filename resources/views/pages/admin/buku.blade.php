<x-admin-layout>
    <x-breadcrumb title="Buku">
        <li class="breadcrumb-item active">
            <p>Buku</p>
        </li>
    </x-breadcrumb>
    <x-content>
        <x-card>
            <x-card-header title="Data Buku"></x-card-header>
            <x-card-body>
                <x-input-search route="{{ route('admin.buku') }}">
                    <x-button-add target="tambahBuku"></x-button-add>
                </x-input-search>
                <x-table>
                    @slot('thead')
                        <tr>
                            <th width="1%">No</th>
                            <th>Buku</th>
                            <th>Detail</th>
                            <th>Rak & Baris</th>
                            <th>Aksi</th>
                        </tr>
                    @endslot
                    @if (count($buku) > 0)
                        @foreach ($buku as $index => $data)
                            <tr>
                                <td class="text-center align-middle">{{ $buku->firstItem() + $index }}</td>
                                <td class="align-middle">
                                    <ul class="products-list product-list-in-card pl-2 pr-2">
                                        <li class="item">
                                            <div class="product-img">
                                                <img src="{{ asset($data->getCover()) }}" alt="Foto" class="img-size-50">
                                            </div>
                                            <div class="product-info">
                                                <a href="javascript:void(0)" class="product-title">{{ ucwords($data->judul) }}</a>
                                                <span class="product-description">
                                                    ISBN: {{ $data->isbn }}
                                                </span>
                                            </div>
                                        </li>
                                        <li class="item">
                                            <div class="product-img">
                                                {!! DNS1D::getBarcodeHTML($data->isbn, 'EAN13') !!}
                                            </div>
                                        </li>
                                    </ul>
                                </td>
                                <td class="align-middle">
                                    <ul class="list-unstyled">
                                        <li class="item">Kategori: {{ $data->kategori }}</li>
                                        <li class="item">Pengarang: {{ $data->pengarang }}</li>
                                        <li class="item">Penerbit: {{ $data->penerbit }}</li>
                                        <li class="item">Tahun Terbit: {{ $data->tahun_terbit }}</li>
                                        <li class="item">Stok: {{ $data->jumlah_eksemplar }}</li>
                                    </ul>
                                </td>
                                <td class="align-middle">{{ $data->rak_baris->nama_rak }} - Baris {{ $data->rak_baris->nomor_baris }}</td>
                                <td class="align-middle">
                                    <div class="d-flex justify-content-center align-items-center">
                                        <x-button-edit target="editBuku" id="{{ $data->id }}"></x-button-edit>
                                        <x-button-delete id="{{ $data->id }}" resource="admin/buku"></x-button-delete>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="10" class="text-center">Tidak ada data buku</td>
                        </tr>
                    @endif
                </x-table>
                <x-pagination :paginator="$buku"></x-pagination>
            </x-card-body>
        </x-card>
    </x-content>

    @push('modal')
        <x-modal target="tambahBuku" title="Tambah Buku" size="modal-lg">
            <form method="POST" action="{{ route('admin.tambahBuku') }}" enctype="multipart/form-data" class="mb-2">
                @csrf
                <div class="row mb-2">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="tambah_isbn">ISBN</label>
                            <input type="text" name="tambah_isbn" id="tambah_isbn" class="form-control" value="{{ old('tambah_isbn') }}" placeholder="ISBN"maxlength="13" oninput="this.value = this.value.replace(/[^0-9]/g, '').slice(0, 13);">
                            @error('tambah_isbn') <span class="text-danger small">{{ $message }}</span> @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="tambah_judul">Judul<span class="text-danger">*</span></label>
                            <input type="text" name="tambah_judul" id="tambah_judul" class="form-control" value="{{ old('tambah_judul') }}" placeholder="Judul" required>
                            @error('tambah_judul') <span class="text-danger small">{{ $message }}</span> @enderror
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="tambah_pengarang">Pengarang<span class="text-danger">*</span></label>
                            <input type="text" name="tambah_pengarang" id="tambah_pengarang" class="form-control" value="{{ old('tambah_pengarang') }}" placeholder="Pengarang" required>
                            @error('tambah_pengarang') <span class="text-danger small">{{ $message }}</span> @enderror
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="tambah_penerbit">Penerbit</label>
                            <input type="text" name="tambah_penerbit" id="tambah_penerbit" class="form-control" value="{{ old('tambah_penerbit') }}" placeholder="Penerbit">
                            @error('tambah_penerbit') <span class="text-danger small">{{ $message }}</span> @enderror
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="tambah_tahun_terbit">Tahun Terbit</label>
                            <input type="text" name="tambah_tahun_terbit" id="tambah_tahun_terbit" class="form-control" value="{{ old('tambah_tahun_terbit') }}" placeholder="Tahun Terbit"maxlength="4" oninput="this.value = this.value.replace(/[^0-9]/g, '').slice(0, 4);">
                            @error('tambah_penerbit') <span class="text-danger small">{{ $message }}</span> @enderror
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="tambah_kategori">Kategori<span class="text-danger">*</span></label>
                            <select name="tambah_kategori" id="tambah_kategori" class="form-control" required>
                                @foreach ($kategori as $item)
                                    <option value="{{ $item->id }}">{{ $item->nama }}</option>
                                @endforeach
                            </select>
                            @error('tambah_kategori') <span class="text-danger small">{{ $message }}</span> @enderror
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="tambah_rak_baris_id">Rak & Baris<span class="text-danger">*</span></label>
                            <select name="tambah_rak_baris_id" id="tambah_rak_baris_id" class="form-control" required>
                                <option value="" disabled {{ old('tambah_rak_baris_id') == '' ? 'selected' : '' }}>Pilih salah satu</option>
                            </select>
                            @error('tambah_kategori') <span class="text-danger small">{{ $message }}</span> @enderror
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="tambah_jumlah_eksemplar">Stok<span class="text-danger">*</span></label>
                            <input type="text" name="tambah_jumlah_eksemplar" id="tambah_jumlah_eksemplar" class="form-control" value="{{ old('tambah_jumlah_eksemplar') }}" placeholder="Stok/Jumlah Eksemplar"maxlength="4" oninput="this.value = this.value.replace(/[^0-9]/g, '').slice(0, 4);" required>
                            @error('tambah_kategori') <span class="text-danger small">{{ $message }}</span> @enderror
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-group">
                            <label for="tambah_cover">Cover</label>
                            <div class="input-group">
                                <div class="custom-file">
                                    <input type="file" name="tambah_cover[]" id="tambah_cover" class="custom-file-input" accept="image/*" multiple>
                                    <label class="custom-file-label" for="tambah_cover">Pilih file</label>
                                </div>
                            </div>
                            @error('tambah_cover') <span class="text-danger small">{{ $message }}</span> @enderror
                            @error('tambah_cover.*') <span class="text-danger small">{{ $message }}</span> @enderror
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-group">
                            <label for="tambah_deskripsi">Deskripsi</label>
                            <textarea name="tambah_deskripsi" id="tambah_deskripsi" class="form-control" placeholder="Deskripsi" rows="3">{{ old('tambah_tanggal_lahir') }}</textarea>
                            @error('tambah_deskripsi') <span class="text-danger small">{{ $message }}</span> @enderror
                        </div>
                    </div>
                </div>
                <x-button-modal></x-button-modal>
            </form>
        </x-modal>

        <x-modal target="editBuku" title="Edit Buku" size="modal-lg">
            <form method="POST" enctype="multipart/form-data" class="mb-2">
                @csrf @method('PUT')
                <div class="row mb-2">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="edit_isbn">ISBN</label>
                            <input type="text" name="edit_isbn" id="edit_isbn" class="form-control" value="{{ old('edit_isbn') }}" placeholder="ISBN"maxlength="13" oninput="this.value = this.value.replace(/[^0-9]/g, '').slice(0, 13);">
                            @error('edit_isbn') <span class="text-danger small">{{ $message }}</span> @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="edit_judul">Judul<span class="text-danger">*</span></label>
                            <input type="text" name="edit_judul" id="edit_judul" class="form-control" value="{{ old('edit_judul') }}" placeholder="Judul" required>
                            @error('edit_judul') <span class="text-danger small">{{ $message }}</span> @enderror
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="edit_pengarang">Pengarang<span class="text-danger">*</span></label>
                            <input type="text" name="edit_pengarang" id="edit_pengarang" class="form-control" value="{{ old('edit_pengarang') }}" placeholder="Pengarang" required>
                            @error('edit_pengarang') <span class="text-danger small">{{ $message }}</span> @enderror
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="edit_penerbit">Penerbit</label>
                            <input type="text" name="edit_penerbit" id="edit_penerbit" class="form-control" value="{{ old('edit_penerbit') }}" placeholder="Penerbit">
                            @error('edit_penerbit') <span class="text-danger small">{{ $message }}</span> @enderror
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="edit_tahun_terbit">Tahun Terbit</label>
                            <input type="text" name="edit_tahun_terbit" id="edit_tahun_terbit" class="form-control" value="{{ old('edit_tahun_terbit') }}" placeholder="Tahun Terbit"maxlength="4" oninput="this.value = this.value.replace(/[^0-9]/g, '').slice(0, 4);">
                            @error('edit_penerbit') <span class="text-danger small">{{ $message }}</span> @enderror
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="edit_kategori">Kategori<span class="text-danger">*</span></label>
                            <select name="edit_kategori" id="edit_kategori" class="form-control" required>
                                @foreach ($kategori as $item)
                                    <option value="{{ $item->id }}">{{ $item->nama }}</option>
                                @endforeach
                            </select>
                            @error('edit_kategori') <span class="text-danger small">{{ $message }}</span> @enderror
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="edit_rak_baris_id">Rak & Baris<span class="text-danger">*</span></label>
                            <select name="edit_rak_baris_id" id="edit_rak_baris_id" class="form-control" required>
                                <option value="" disabled {{ old('edit_rak_baris_id') == '' ? 'selected' : '' }}>Pilih salah satu</option>
                            </select>
                            @error('edit_kategori') <span class="text-danger small">{{ $message }}</span> @enderror
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="edit_jumlah_eksemplar">Stok<span class="text-danger">*</span></label>
                            <input type="text" name="edit_jumlah_eksemplar" id="edit_jumlah_eksemplar" class="form-control" value="{{ old('edit_jumlah_eksemplar') }}" placeholder="Stok/Jumlah Eksemplar"maxlength="4" oninput="this.value = this.value.replace(/[^0-9]/g, '').slice(0, 4);" required>
                            @error('edit_kategori') <span class="text-danger small">{{ $message }}</span> @enderror
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-group">
                            <label for="edit_cover">Cover</label>
                            <div class="input-group">
                                <div class="custom-file">
                                    <input type="file" name="edit_cover[]" id="edit_cover" class="custom-file-input" accept="image/*" multiple>
                                    <label class="custom-file-label" for="edit_cover">Pilih file</label>
                                </div>
                            </div>
                            @error('edit_cover') <span class="text-danger small">{{ $message }}</span> @enderror
                            @error('edit_cover.*') <span class="text-danger small">{{ $message }}</span> @enderror
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-group">
                            <label for="edit_deskripsi">Deskripsi</label>
                            <textarea name="edit_deskripsi" id="edit_deskripsi" class="form-control" placeholder="Deskripsi" rows="3">{{ old('edit_tanggal_lahir') }}</textarea>
                            @error('edit_deskripsi') <span class="text-danger small">{{ $message }}</span> @enderror
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
            $('#editBuku').on('show.bs.modal', function(event) {
                var button = $(event.relatedTarget);
                var id = button.data('id');

                $.get('/admin/buku/' + id + '/edit', function(data) {
                    var modal = $(this);

                    modal.find('#edit_kategori').val(data.kategori_id);

                    $.ajax({
                        url: '/api/getRakBaris/' + data.kategori_id,
                        type: 'GET',
                        dataType: 'json',
                        success: function(rakBarisList) {
                            var rakSelect = modal.find('#edit_rak_baris_id');
                            rakSelect.empty().append('<option value="">Pilih salah satu</option>');

                            $.each(rakBarisList, function (key, value) {
                                rakSelect.append('<option value="' + value.id + '">' + value.nama_rak + ' - Baris ' + value.nomor_baris + '</option>');
                            });

                            rakSelect.val(data.rak_baris_id);
                        },
                        error: function () {
                            modal.find('#edit_rak_baris_id').html('<option value="">Gagal memuat data</option>');
                        }
                    });

                    modal.find('#edit_isbn').val(data.isbn);
                    modal.find('#edit_judul').val(data.judul);
                    modal.find('#edit_pengarang').val(data.pengarang);
                    modal.find('#edit_penerbit').val(data.penerbit);
                    modal.find('#edit_tahun_terbit').val(data.tahun_terbit);
                    modal.find('#edit_jumlah_eksemplar').val(data.jumlah_eksemplar);
                    modal.find('#edit_deskripsi').val(data.deskripsi);

                    if (Array.isArray(data.cover)) {
                        var previewContainer = $('#preview-cover');
                        previewContainer.empty();

                        data.cover.forEach(function(cover) {
                            var imgUrl = '/storage/' + cover;
                            previewContainer.append(`<img src="${imgUrl}" alt="Cover" width="300" class="img-fluid mb-2 me-2">`);
                        });
                    }

                    modal.find('form').attr('action', '/admin/buku/' + id + '/update');
                }.bind(this));
            });
        </script>

        <script>
            $(document).ready(function () {
                $('#tambah_kategori').on('change', function () {
                    var kategoriId = $(this).val();
                    $('#tambah_rak_baris_id').html('<option value="">Memuat...</option>');

                    if (kategoriId) {
                        $.ajax({
                            url: '/api/getRakBaris/' + kategoriId,
                            type: 'GET',
                            dataType: 'json',
                            success: function (data) {
                                $('#tambah_rak_baris_id').empty().append('<option value="">Pilih salah satu</option>');
                                $.each(data, function (key, value) {
                                    $('#tambah_rak_baris_id').append('<option value="' + value.id + '">' + value.nama_rak + ' - Baris ' + value.nomor_baris + '</option>');
                                });
                            },
                            error: function () {
                                $('#tambah_rak_baris_id').html('<option value="">Gagal memuat data</option>');
                            }
                        });
                    } else {
                        $('#tambah_rak_baris_id').html('<option value="">Pilih salah satu</option>');
                    }
                });

                $('#edit_kategori').on('change', function () {
                    var kategoriId = $(this).val();
                    $('#edit_rak_baris_id').html('<option value="">Memuat...</option>');

                    if (kategoriId) {
                        $.ajax({
                            url: '/api/getRakBaris/' + kategoriId,
                            type: 'GET',
                            dataType: 'json',
                            success: function (data) {
                                $('#edit_rak_baris_id').empty().append('<option value="">Pilih salah satu</option>');
                                $.each(data, function (key, value) {
                                    $('#edit_rak_baris_id').append('<option value="' + value.id + '">' + value.nama_rak + ' - Baris ' + value.nomor_baris + '</option>');
                                });
                            },
                            error: function () {
                                $('#edit_rak_baris_id').html('<option value="">Gagal memuat data</option>');
                            }
                        });
                    } else {
                        $('#edit_rak_baris_id').html('<option value="">Pilih salah satu</option>');
                    }
                });
            });
        </script>
    @endpush
</x-admin-layout>
