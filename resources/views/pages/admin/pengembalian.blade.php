<x-admin-layout>
    <x-breadcrumb title="Pengembalian">
        <li class="breadcrumb-item active">
            <p>Pengembalian</p>
        </li>
    </x-breadcrumb>
    <x-content>
        <x-card>
            <x-card-body>
                <form method="POST" action="{{ route('admin.cekAnggotaPengembalian') }}" id="anggotaForm">
                    @csrf
                    <div class="row">
                        <div class="col-12">
                            <label for="scannedKode">Scan Anggota Perpus</label>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <i class="fas fa-user-tag"></i>
                                    </span>
                                </div>
                                <input type="text" name="kode_anggota" id="scannedKode" class="form-control form-control-lg" placeholder="Scan atau masukkan kode anggota" required>
                            </div>
                            @error('kode_anggota')
                                <span class="text-danger small">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </form>
                <div class="mb-3">
                    <div class="d-flex justify-content-end">
                        <x-button-scan target="scanAnggota" title="Scan Anggota Perpus"></x-button-scan>
                    </div>
                </div>
            </x-card-body>
        </x-card>
    </x-content>

    @push('modal')
        <x-modal target="scanAnggota" title="Scan Kartu Anggota" size="modal-lg">
            <div class="row">
                <div class="col-12 mb-3">
                    <div id="anggotaScanner" style="width: 100%;"></div>
                </div>
            </div>
        </x-modal>
    @endpush

    @push('style')
        <style>
            #anggotaScanner {
                width: 100%;
                height: 300px;
                border: 2px dashed #ccc;
                position: relative;
            }

            #anggotaScanner video {
                width: 100% !important;
                height: 100% !important;
                object-fit: cover;
            }
        </style>
    @endpush

    @push('js')
        <script src="https://unpkg.com/html5-qrcode@2.3.8"></script>
    @endpush

    @push('script')
        <script>
            let anggotaScanner = null;

            $('#scanAnggota').on('shown.bs.modal', function () {
                initAnggotaScanner();
            });

            $('#scanAnggota').on('hidden.bs.modal', function () {
                if (anggotaScanner) {
                    anggotaScanner.stop().then(() => {
                        anggotaScanner = null;
                    }).catch(err => {
                        console.error("Gagal menghentikan scanner:", err);
                    });
                }
            });

            function initAnggotaScanner() {
                if (!anggotaScanner) {
                    anggotaScanner = new Html5Qrcode("anggotaScanner");

                    const config = {
                        fps: 10,
                        qrbox: { width: 650, height: 200 },
                        rememberLastUsedCamera: true,
                        supportedScanTypes: [Html5QrcodeScanType.SCAN_TYPE_CAMERA]
                    };

                    Html5Qrcode.getCameras().then(devices => {
                        if (devices && devices.length) {
                            const rearCamera = devices.find(device =>
                                device.label.toLowerCase().includes('back') ||
                                device.label.toLowerCase().includes('rear')
                            );

                            const cameraId = rearCamera ? rearCamera.id : devices[0].id;

                            anggotaScanner.start(
                                cameraId,
                                config,
                                (decodedText) => {
                                    handleAnggotaScanSuccess(decodedText);
                                },
                                (errorMessage) => {
                                    console.log(errorMessage);
                                }
                            ).catch(err => {
                                console.error("Gagal memulai scanner:", err);
                            });
                        }
                    }).catch(err => {
                        console.error("Tidak bisa mengakses kamera:", err);
                    });
                }
            }

            function handleAnggotaScanSuccess(decodedText) {
                if (!decodedText) return;

                if (anggotaScanner) {
                    anggotaScanner.stop().then(() => {
                        anggotaScanner = null;
                    });
                }

                const kodeAnggotaRegex = /^[A-Z0-9]{8,15}$/;
                if (!kodeAnggotaRegex.test(decodedText)) {
                    alert('Format kode anggota tidak valid: ' + decodedText);
                    setTimeout(() => {
                        initAnggotaScanner();
                    }, 1000);
                    return;
                }

                $('#kode-anggota-result').val(decodedText);
                $('#scannedKode').val(decodedText);
                $('#scanAnggota').modal('hide');

                $.get(`/api/getAnggota/${decodedText}`, function(data) {
                    if (data.success) {
                        $('#anggotaForm').submit();
                    } else {
                        alert('Anggota tidak ditemukan: ' + data.message);
                        setTimeout(() => {
                            $('#scanAnggota').modal('show');
                            initAnggotaScanner();
                        }, 500);
                    }
                }).fail(() => {
                    alert('Gagal memeriksa anggota');
                    setTimeout(() => {
                        $('#scanAnggota').modal('show');
                        initAnggotaScanner();
                    }, 500);
                });
            }
        </script>
    @endpush
</x-admin-layout>
