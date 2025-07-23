<x-admin-layout>
    <x-breadcrumb title="Siswa">
        <li class="breadcrumb-item active">
            <p>Siswa</p>
        </li>
    </x-breadcrumb>

    <x-content>
        <x-card>
            <x-card-header title="Data Siswa"></x-card-header>
            <x-card-body>
                <x-input-search route="{{ route('admin.siswa') }}">
                    <x-button-add target="tambahSiswa"></x-button-add>
                </x-input-search>
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
                                        <x-button-print route="{{ route('admin.printSiswa', $data->kode_anggota) }}"></x-button-print>
                                        <x-button-edit target="editSiswa" id="{{ $data->id }}"></x-button-edit>
                                        <x-button-delete id="{{ $data->id }}" resource="admin/siswa"></x-button-delete>
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

    @push('modal')
        <x-modal target="tambahSiswa" title="Tambah Siswa" size="modal-lg">
            <form method="POST" action="{{ route('admin.tambahSiswa') }}" enctype="multipart/form-data" class="mb-2">
                @csrf
                <div class="row mb-2">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="tambah_nisn">NISN (Nomor Induk Siswa Nasional)<span class="text-danger">*</span></label>
                            <input type="text" name="tambah_nisn" id="tambah_nisn" class="form-control" value="{{ old('tambah_nisn') }}" placeholder="Nomor Induk Pegawai" maxlength="10" oninput="this.value = this.value.replace(/[^0-9]/g, '').slice(0, 10);" required>
                            @error('tambah_nisn') <span class="text-danger small">{{ $message }}</span> @enderror
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
                            <label for="tambah_tempat_lahir">Tempat Lahir<span class="text-danger">*</span></label>
                            <input type="text" name="tambah_tempat_lahir" id="tambah_tempat_lahir" class="form-control" value="{{ old('tambah_tempat_lahir') }}" placeholder="Tempat Lahir" required>
                            @error('tambah_tempat_lahir') <span class="text-danger small">{{ $message }}</span> @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="tambah_tanggal_lahir">Tanggal Lahir<span class="text-danger">*</span></label>
                            <input type="date" name="tambah_tanggal_lahir" id="tambah_tanggal_lahir" class="form-control" value="{{ old('tambah_tanggal_lahir') }}" required>
                            @error('tambah_tanggal_lahir') <span class="text-danger small">{{ $message }}</span> @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="tambah_kelas_id">Kelas<span class="text-danger">*</span></label>
                            <select name="tambah_kelas_id" id="tambah_kelas_id" class="form-control" required>
                                <option value="" disabled {{ old('tambah_kelas_id') == '' ? 'selected' : '' }}>Pilih salah satu</option>
                                @foreach ($kelas as $item)
                                    <option value="{{ $item->id }}">{{ $item->nama_kelas }}</option>
                                @endforeach
                            </select>
                            @error('tambah_kelas_id') <span class="text-danger small">{{ $message }}</span> @enderror
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
                    <div class="col-12 mb-3">
                        <div class="form-group">
                            <label for="tambah_alamat">Alamat</label>
                            <textarea name="tambah_alamat" id="tambah_alamat" class="form-control" placeholder="Alamat" rows="3">{{ old('tambah_tanggal_lahir') }}</textarea>
                            @error('tambah_alamat') <span class="text-danger small">{{ $message }}</span> @enderror
                        </div>
                    </div>
                </div>
                <x-button-modal></x-button-modal>
            </form>
        </x-modal>

        <x-modal target="editSiswa" title="Edit Siswa" size="modal-lg">
            <form method="POST" enctype="multipart/form-data" class="mb-2">
                @csrf @method('PUT') <input type="hidden" name="id" value="{{ old('id') }}">
                <div class="row mb-2">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="edit_nisn">NISN (Nomor Induk Siswa Nasional)<span class="text-danger">*</span></label>
                            <input type="text" name="edit_nisn" id="edit_nisn" class="form-control" value="{{ old('edit_nisn') }}" placeholder="Nomor Induk Pegawai" maxlength="10" oninput="this.value = this.value.replace(/[^0-9]/g, '').slice(0, 10);" required>
                            @error('edit_nisn') <span class="text-danger small">{{ $message }}</span> @enderror
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
                            <label for="edit_tempat_lahir">Tempat Lahir<span class="text-danger">*</span></label>
                            <input type="text" name="edit_tempat_lahir" id="edit_tempat_lahir" class="form-control" value="{{ old('edit_tempat_lahir') }}" placeholder="Tempat Lahir" required>
                            @error('edit_tempat_lahir') <span class="text-danger small">{{ $message }}</span> @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="edit_tanggal_lahir">Tanggal Lahir<span class="text-danger">*</span></label>
                            <input type="date" name="edit_tanggal_lahir" id="edit_tanggal_lahir" class="form-control" value="{{ old('edit_tanggal_lahir') }}" required>
                            @error('edit_tanggal_lahir') <span class="text-danger small">{{ $message }}</span> @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="edit_kelas_id">Kelas<span class="text-danger">*</span></label>
                            <select name="edit_kelas_id" id="edit_kelas_id" class="form-control" required>
                                <option value="" disabled {{ old('edit_kelas_id') == '' ? 'selected' : '' }}>Pilih salah satu</option>
                                @foreach ($kelas as $item)
                                    <option value="{{ $item->id }}">{{ $item->nama_kelas }}</option>
                                @endforeach
                            </select>
                            @error('edit_kelas_id') <span class="text-danger small">{{ $message }}</span> @enderror
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
                    <div class="col-12 mb-3">
                        <div class="form-group">
                            <label for="edit_alamat">Alamat</label>
                            <textarea name="edit_alamat" id="edit_alamat" class="form-control" placeholder="Alamat" rows="3">{{ old('edit_tanggal_lahir') }}</textarea>
                            @error('edit_alamat') <span class="text-danger small">{{ $message }}</span> @enderror
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
            $('#editSiswa').on('show.bs.modal', function(event) {
                var button = $(event.relatedTarget);
                var id = button.data('id');

                $.get('/admin/siswa/' + id + '/edit', function(data) {
                    var modal = $(this);
                    modal.find('#edit_id').val(data.id);
                    modal.find('#edit_kelas_id').val(data.kelas_id);
                    modal.find('#edit_nisn').val(data.nisn);
                    modal.find('#edit_nama').val(data.nama);
                    modal.find('#edit_tempat_lahir').val(data.tempat_lahir);
                    modal.find('#edit_tanggal_lahir').val(data.tanggal_lahir);
                    modal.find('#edit_jenis_kelamin').val(data.jenis_kelamin);
                    modal.find('#edit_alamat').val(data.alamat);

                    var previewContainer = modal.find('#preview-foto');
                    previewContainer.empty();
                    if (data.foto) {
                        var imgUrl = '/storage/' + data.foto;
                        previewContainer.append(`
                            <img src="${imgUrl}" alt="avatar" width="300" class="img-fluid">
                        `);
                    }

                    modal.find('form').attr('action', '/admin/siswa/' + id + '/update');
                }.bind(this));
            });
        </script>
    @endpush
</x-admin-layout>
