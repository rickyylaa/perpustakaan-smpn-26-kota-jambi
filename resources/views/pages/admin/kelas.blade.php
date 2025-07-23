<x-admin-layout>
    <x-breadcrumb title="Kelas">
        <li class="breadcrumb-item active">
            <p>Kelas</p>
        </li>
    </x-breadcrumb>

    <x-content>
        <x-card>
            <x-card-header title="Data Kelas"></x-card-header>
            <x-card-body>
                <x-input-search route="{{ route('admin.kelas') }}">
                    <x-button-add target="tambahKelas"></x-button-add>
                </x-input-search>
                <x-table>
                    @slot('thead')
                        <tr>
                            <th width="1%">No</th>
                            <th>Nama Kelas</th>
                            <th>Tingkat</th>
                            <th>Wali Kelas</th>
                            <th>Isi Kelas</th>
                            <th>Aksi</th>
                        </tr>
                    @endslot
                    @if (count($kelas) > 0)
                        @foreach ($kelas as $index => $data)
                            <tr>
                                <td class="text-center align-middle">{{ $kelas->firstItem() + $index }}</td>
                                <td class="align-middle">{{ $data->nama_kelas }}</td>
                                <td class="align-middle">{{ $data->tingkat }}</td>
                                <td class="align-middle">{{ $data->wali_kelas }}</td>
                                <td class="align-middle">{{ $data->isi_kelas }} Siswa</td>
                                <td class="align-middle">
                                    <div class="d-flex justify-content-center align-items-center">
                                        <x-button-edit target="editKelas" id="{{ $data->id }}"></x-button-edit>
                                        <x-button-delete id="{{ $data->id }}" resource="admin/kelas"></x-button-delete>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="10" class="text-center">Tidak ada data kelas</td>
                        </tr>
                    @endif
                </x-table>
                <x-pagination :paginator="$kelas"></x-pagination>
            </x-card-body>
        </x-card>
    </x-content>

    @push('modal')
        <x-modal target="tambahKelas" title="Tambah Kelas" size="modal-lg">
            <form method="POST" action="{{ route('admin.tambahKelas') }}" enctype="multipart/form-data" class="mb-2">
                @csrf
                <div class="row mb-2">
                    <div class="col-12">
                        <div class="form-group">
                            <label for="tambah_nama_kelas">Nama Kelas<span class="text-danger">*</span></label>
                            <input type="text" name="tambah_nama_kelas" id="tambah_nama_kelas" class="form-control" value="{{ old('tambah_nama_kelas') }}" placeholder="Contoh: Kelas 1-A" required>
                            @error('tambah_nama_kelas') <span class="text-danger small">{{ $message }}</span> @enderror
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-group">
                            <label for="tambah_tingkat">Tingkat<span class="text-danger">*</span></label>
                            <input type="text" name="tambah_tingkat" id="tambah_tingkat" class="form-control" value="{{ old('tambah_tingkat') }}" placeholder="Contoh: 1" maxlength="1" oninput="this.value = this.value.replace(/[^0-9]/g, '').slice(0, 1);" required>
                            @error('tambah_tingkat') <span class="text-danger small">{{ $message }}</span> @enderror
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-group">
                            <label for="tambah_wali_kelas">Wali Kelas<span class="text-danger">*</span></label>
                            <input type="text" name="tambah_wali_kelas" id="tambah_wali_kelas" class="form-control" value="{{ old('tambah_wali_kelas') }}" placeholder="Wali Kelas" required>
                            @error('tambah_wali_kelas') <span class="text-danger small">{{ $message }}</span> @enderror
                        </div>
                    </div>
                </div>
                <x-button-modal></x-button-modal>
            </form>
        </x-modal>

        <x-modal target="editKelas" title="Edit Kelas" size="modal-lg">
            <form method="POST" enctype="multipart/form-data" class="mb-2">
                @csrf @method('PUT')
                <div class="row mb-2">
                    <div class="col-12">
                        <div class="form-group">
                            <label for="edit_nama_kelas">Nama Kelas<span class="text-danger">*</span></label>
                            <input type="text" name="edit_nama_kelas" id="edit_nama_kelas" class="form-control" value="{{ old('edit_nama_kelas') }}" placeholder="Contoh: Kelas 1-A" required>
                            @error('edit_nama_kelas') <span class="text-danger small">{{ $message }}</span> @enderror
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-group">
                            <label for="edit_tingkat">Tingkat<span class="text-danger">*</span></label>
                            <input type="text" name="edit_tingkat" id="edit_tingkat" class="form-control" value="{{ old('edit_tingkat') }}" placeholder="Contoh: 1" maxlength="1" oninput="this.value = this.value.replace(/[^0-9]/g, '').slice(0, 1);" required>
                            @error('edit_tingkat') <span class="text-danger small">{{ $message }}</span> @enderror
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-group">
                            <label for="edit_wali_kelas">Wali Kelas<span class="text-danger">*</span></label>
                            <input type="text" name="edit_wali_kelas" id="edit_wali_kelas" class="form-control" value="{{ old('edit_wali_kelas') }}" placeholder="Wali Kelas" required>
                            @error('edit_wali_kelas') <span class="text-danger small">{{ $message }}</span> @enderror
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
            $('#editKelas').on('show.bs.modal', function(event) {
                var button = $(event.relatedTarget);
                var id = button.data('id');

                $.get('/admin/kelas/' + id + '/edit', function(data) {
                    var modal = $(this);
                    modal.find('#edit_nama_kelas').val(data.nama_kelas);
                    modal.find('#edit_tingkat').val(data.tingkat);
                    modal.find('#edit_wali_kelas').val(data.wali_kelas);

                    modal.find('form').attr('action', '/admin/kelas/' + id + '/update');
                }.bind(this));
            });
        </script>
    @endpush
</x-admin-layout>
