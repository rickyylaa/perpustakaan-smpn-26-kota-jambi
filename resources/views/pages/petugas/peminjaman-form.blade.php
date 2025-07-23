<x-petugas-layout>
    <x-breadcrumb title="Peminjaman">
        <li class="breadcrumb-item active">
            <p>Peminjaman</p>
        </li>
    </x-breadcrumb>
    <x-content>
        <x-alert :denda-keterlambatan="$denda->denda_keterlambatan"
            :denda-hilang="$denda->denda_buku_hilang"
            :denda-rusak="$denda->denda_buku_rusak">
        </x-alert>
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
        <x-card-6>
            <x-card-header title="Peminjaman Buku"></x-card-header>
            <x-card-body>
                <p class="text-muted fs-14">
                    Buku hanya boleh dipinjam <span class="text-danger">*Maksimal 3 Buku</span>
                </p>
                <div class="mb-3">
                    <x-button-scan target="scanBuku" title="Scan Buku"></x-button-scan>
                </div>
                <form method="POST" action="{{ route('petugas.tambahPeminjaman', $siswa->kode_anggota) }}" class="mb-3">
                    @csrf
                    <div class="row">
                        <div class="col-12 mb-3">
                            <label for="buku1">Buku 1</label>
                            <select name="buku1" id="buku1" class="form-control select2">
                                <option value="" {{ old('buku1') == '' ? 'selected' : '' }}>Pilih salah satu</option>
                                @foreach ($buku as $item)
                                    <option value="{{ $item->id }}"
                                        {{ $item->jumlah_eksemplar < 1 ? 'disabled' : '' }}>
                                        {{ $item->judul }} (Stok: {{ $item->jumlah_eksemplar }})
                                    </option>
                                @endforeach
                            </select>
                            @error('buku1') <span class="text-danger small">{{ $message }}</span> @enderror
                        </div>
                        <div class="col-12 mb-3">
                            <label for="buku2">Buku 2</label>
                            <select name="buku2" id="buku2" class="form-control select2">
                                <option value="" {{ old('buku1') == '' ? 'selected' : '' }}>Pilih salah satu</option>
                                @foreach ($buku as $item)
                                    <option value="{{ $item->id }}"
                                        {{ $item->jumlah_eksemplar < 1 ? 'disabled' : '' }}>
                                        {{ $item->judul }} (Stok: {{ $item->jumlah_eksemplar }})
                                    </option>
                                @endforeach
                            </select>
                            @error('buku2') <span class="text-danger small">{{ $message }}</span> @enderror
                        </div>
                        <div class="col-12 mb-3">
                            <label for="buku3">Buku 3</label>
                            <select name="buku3" id="buku3" class="form-control select2">
                                <option value="" {{ old('buku1') == '' ? 'selected' : '' }}>Pilih salah satu</option>
                                @foreach ($buku as $item)
                                    <option value="{{ $item->id }}"
                                        {{ $item->jumlah_eksemplar < 1 ? 'disabled' : '' }}>
                                        {{ $item->judul }} (Stok: {{ $item->jumlah_eksemplar }})
                                    </option>
                                @endforeach
                            </select>
                            @error('buku3') <span class="text-danger small">{{ $message }}</span> @enderror
                        </div>
                    </div>
                    <div class="d-flex justify-content-end">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </x-card-body>
        </x-card-6>
    </x-content>

    @push('modal')
        <x-modal target="scanBuku" title="Scan Buku" size="modal-lg">
            <div class="row">
                <div class="col-12 mb-3">
                    <div id="reader" style="width: 100%;"></div>
                    <input type="text" id="isbn-result" class="form-control mt-2" placeholder="ISBN akan tampil di sini" readonly>
                </div>
            </div>
        </x-modal>
    @endpush

    @push('css')
        <link rel="stylesheet" href="{{ asset('assets/plugins/select2/css/select2.min.css') }}" type="text/css">
        <link rel="stylesheet" href="{{ asset('assets/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}" type="text/css">
    @endpush

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

        <style>
            #reader {
                width: 100%;
                height: 300px;
                border: 2px dashed #ccc;
                position: relative;
            }

            #reader video {
                width: 100% !important;
                height: 100% !important;
                object-fit: cover;
            }

            #reader img {
                display: none;
            }
        </style>
    @endpush

    @push('js')
        <script src="{{ asset('assets/plugins/select2/js/select2.full.min.js') }}"></script>
        <script src="https://unpkg.com/html5-qrcode@2.3.8"></script>
    @endpush

    @push('script')
        <script>
            $(function () {
                $('.select2').select2()

                $('.select2bs4').select2({
                theme: 'bootstrap4'
                })
            })
        </script>

        <script>
            $(document).ready(function () {
                const bukuSelects = ['#buku1', '#buku2', '#buku3'];

                function updateOptions() {
                    const selectedValues = bukuSelects.map(sel => $(sel).val()).filter(v => v);

                    bukuSelects.forEach(sel => {
                        const currentVal = $(sel).val();
                        $(sel + ' option').each(function () {
                            const val = $(this).val();
                            if (!val) return;
                            if (selectedValues.includes(val) && val !== currentVal) {
                                $(this).prop('disabled', true);
                            } else {
                                $(this).prop('disabled', false);
                            }
                        });
                    });
                }

                bukuSelects.forEach(sel => {
                    $(sel).on('change', function () {
                        updateOptions();
                    });
                });

                updateOptions();
            });
        </script>

        <script>
            $(document).ready(function () {
                const bukuSelects = ['#buku1', '#buku2', '#buku3'];

                function updateOptions(bukuTerpinjam = []) {
                    const selectedValues = bukuSelects.map(sel => $(sel).val()).filter(v => v);

                    bukuSelects.forEach(sel => {
                        const currentVal = $(sel).val();
                        $(sel + ' option').each(function () {
                            const val = $(this).val();
                            if (!val) return;
                            if ((selectedValues.includes(val) && val !== currentVal) || bukuTerpinjam.includes(val)) {
                                $(this).prop('disabled', true);
                            } else {
                                $(this).prop('disabled', false);
                            }
                        });

                        $(sel).select2();
                    });
                }

                const kodeAnggota = "{{ $siswa->kode_anggota }}";
                $.get(`/api/getPinjam/${kodeAnggota}`, function (data) {
                    const bukuTerpinjam = data.map(String);
                    updateOptions(bukuTerpinjam);

                    bukuSelects.forEach(sel => {
                        $(sel).on('change', function () {
                            updateOptions(bukuTerpinjam);
                        });
                    });
                });
            });
        </script>

        <script>
            let html5QrCode;

            $('#scanBuku').on('shown.bs.modal', function () {
                if (!html5QrCode) {
                    html5QrCode = new Html5Qrcode("reader");

                    const config = {
                        fps: 10,
                        qrbox: { width: 650, height: 200 },
                        rememberLastUsedCamera: true,
                        supportedScanTypes: [Html5QrcodeScanType.SCAN_TYPE_CAMERA]
                    };

                    html5QrCode.start(
                        { facingMode: "environment" },
                        config,
                        (decodedText, decodedResult) => {
                            handleScanSuccess(decodedText);
                        },
                        (errorMessage) => {
                            //
                        }
                    ).catch(err => {
                        console.error("Gagal memulai scanner:", err);
                    });
                }
            });

            $('#scanBuku').on('hidden.bs.modal', function () {
                if (html5QrCode) {
                    html5QrCode.stop().then(() => {
                        html5QrCode.clear();
                        html5QrCode = null;
                    }).catch(err => {
                        console.error("Gagal menghentikan scanner:", err);
                    });
                }
            });

            function handleScanSuccess(decodedText) {
                if (!decodedText) return;

                if (html5QrCode) {
                    html5QrCode.stop().then(() => {
                        html5QrCode = null;
                    });
                }

                $('#isbn-result').val(decodedText);
                $('#scanBuku').modal('hide');

                const isbnRegex = /^(?:\d{10}|\d{13})$/;
                if (!isbnRegex.test(decodedText)) {
                    console.error('Format ISBN tidak valid');
                    return;
                }

                $.get(`/api/getBuku/${decodedText}`, function (data) {
                    if (data.success) {
                        const idBuku = data.book.id;
                        const judul = data.book.judul;

                        const selects = ['#buku1', '#buku2', '#buku3'];
                        let bukuDitambahkan = false;

                        for (const sel of selects) {
                            const selectElement = $(sel);
                            if (!selectElement.val()) {
                                const optionExists = selectElement.find(`option[value="${idBuku}"]`).length > 0;

                                if (optionExists) {
                                    selectElement.val(idBuku).trigger('change');
                                    bukuDitambahkan = true;
                                    break;
                                }
                            }
                        }

                        if (!bukuDitambahkan) {
                            console.log('Semua slot buku sudah terisi atau buku tidak tersedia');
                        }
                    } else {
                        console.log('Buku tidak ditemukan di database');
                    }
                }).fail(() => {
                    console.error('Gagal memeriksa buku');
                }).always(() => {
                    setTimeout(() => {
                        $('#scanBuku').modal('show');
                        if (!html5QrCode) {
                            initScanner();
                        }
                    }, 500);
                });
            }

            function initScanner() {
                html5QrCode = new Html5Qrcode("reader");
                const config = {
                    fps: 10,
                    qrbox: { width: 650, height: 200 },
                    rememberLastUsedCamera: true,
                    supportedScanTypes: [Html5QrcodeScanType.SCAN_TYPE_CAMERA]
                };

                html5QrCode.start(
                    { facingMode: "environment" },
                    config,
                    (decodedText, decodedResult) => {
                        handleScanSuccess(decodedText);
                    },
                    (errorMessage) => {
                        //
                    }
                ).catch(err => {
                    console.error("Gagal memulai scanner:", err);
                });
            }
        </script>
    @endpush
</x-petugas-layout>
