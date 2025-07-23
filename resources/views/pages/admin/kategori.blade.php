<x-admin-layout>
    <x-breadcrumb title="Kategori">
        <li class="breadcrumb-item active">
            <p>Kategori</p>
        </li>
    </x-breadcrumb>

    <x-content>
        <x-card>
            <x-card-header title="Data Kategori"></x-card-header>
            <x-card-body>
                <x-input-search route="{{ route('admin.kategori') }}">
                    <x-button-add target="tambahKategori"></x-button-add>
                </x-input-search>
                <x-table>
                    @slot('thead')
                        <tr>
                            <th width="1%">No</th>
                            <th>Kategori</th>
                            <th>Slug</th>
                            <th width="20%">Aksi</th>
                        </tr>
                    @endslot
                    @if (count($kategori) > 0)
                        @foreach ($kategori as $index => $data)
                            <tr>
                                <td class="text-center align-middle">{{ $kategori->firstItem() + $index }}</td>
                                <td class="align-middle">{{ $data->nama }}</td>
                                <td class="align-middle">{{ $data->slug }}</td>
                                <td class="align-middle">
                                    <div class="d-flex justify-content-center align-items-center">
                                        <x-button-edit target="editKategori" id="{{ $data->id }}"></x-button-edit>
                                        <x-button-delete id="{{ $data->id }}" resource="admin/kategori"></x-button-delete>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="10" class="text-center">Tidak ada data kategori</td>
                        </tr>
                    @endif
                </x-table>
                <x-pagination :paginator="$kategori"></x-pagination>
            </x-card-body>
        </x-card>
    </x-content>

    @push('modal')
        <x-modal target="tambahKategori" title="Tambah Kategori" size="modal-lg">
            <form method="POST" action="{{ route('admin.tambahKategori') }}" enctype="multipart/form-data" class="mb-2">
                @csrf
                <div class="row mb-2">
                    <div class="col-12">
                        <div class="form-group">
                            <label for="tambah_nama">Nama Kategori<span class="text-danger">*</span></label>
                            <input type="text" name="tambah_nama" id="tambah_nama" class="form-control" value="{{ old('tambah_nama') }}" placeholder="Contoh: Komik" required>
                            @error('tambah_nama') <span class="text-danger small">{{ $message }}</span> @enderror
                        </div>
                    </div>
                </div>
                <x-button-modal></x-button-modal>
            </form>
        </x-modal>

        <x-modal target="editKategori" title="Edit Kategori" size="modal-lg">
            <form method="POST" enctype="multipart/form-data" class="mb-2">
                @csrf @method('PUT')
                <div class="row mb-2">
                    <div class="col-12">
                        <div class="form-group">
                            <label for="edit_nama">Nama Kategori<span class="text-danger">*</span></label>
                            <input type="text" name="edit_nama" id="edit_nama" class="form-control" value="{{ old('edit_nama') }}" placeholder="Contoh: Komik" required>
                            @error('edit_nama') <span class="text-danger small">{{ $message }}</span> @enderror
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
            $('#editKategori').on('show.bs.modal', function(event) {
                var button = $(event.relatedTarget);
                var id = button.data('id');

                $.get('/admin/kategori/' + id + '/edit', function(data) {
                    var modal = $(this);
                    modal.find('#edit_nama').val(data.nama);

                    modal.find('form').attr('action', '/admin/kategori/' + id + '/update');
                }.bind(this));
            });
        </script>
    @endpush
</x-admin-layout>
