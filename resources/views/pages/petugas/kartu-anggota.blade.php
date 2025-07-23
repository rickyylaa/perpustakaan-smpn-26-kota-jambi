<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <title>Kartu Anggota Perpustakaan Sekolah</title>

    <link rel="icon" href="{{ asset('assets/img/icons/icon.png') }}" sizes="509x339" type="image/png">

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap');

        * {
            box-sizing: border-box;
        }

        body {
            margin: 2rem;
            background: #f0f4f8;
            font-family: 'Poppins', sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            gap: 20px;
            flex-direction: column;
        }

        .card-container {
            display: flex;
            flex-direction: column;
            gap: 30px;
        }

        .container {
            display: flex;
            align-items: flex-start;
            gap: 20px;
        }

        .download-btn {
            background-color: #004aad;
            color: white;
            border: none;
            width: 40px;
            height: 40px;
            border-radius: 50%;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: background-color 0.3s;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            margin-top: 20px;
        }

        .download-btn:hover {
            background-color: #003b8a;
        }

        .download-btn svg {
            width: 20px;
            height: 20px;
            fill: white;
        }

        .card {
            width: 770px;
            background: white;
            border-radius: 12px;
            box-shadow: 0 12px 20px rgba(0, 0, 0, 0.15);
            overflow: hidden;
            display: flex;
            flex-direction: column;
            color: #333;
        }

        .card-header {
            background: #004aad;
            color: white;
            padding: 1rem 1.5rem;
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .card-header .logo {
            width: 90px;
            height: 90px;
            flex-shrink: 0;
            border-radius: 8px;
            background: transparent;
            display: flex;
            justify-content: center;
            align-items: center;
            overflow: hidden;
        }

        .card-header .logo img {
            max-width: 90px;
            max-height: 90px;
        }

        .card-header .header-text {
            flex-grow: 1;
            text-align: center;
            line-height: 1.1;
            user-select: none;
        }

        .card-header .header-text h2 {
            margin: 0;
            font-weight: 600;
            font-size: 1.5rem;
        }

        .card-header .header-text .school-name {
            font-weight: 600;
            font-size: 1.5rem;
            margin-top: 0.3rem;
        }

        .card-header .header-text .school-address {
            font-weight: 500;
            font-size: 0.9rem;
            margin-top: 0.3rem;
            opacity: 0.9;
            letter-spacing: 0.06em;
        }

        .card-body {
            display: flex;
            padding: 1.5rem;
            gap: 4rem;
            align-items: flex-start;
        }

        .card-body .photo {
            width: 160px;
            height: 160px;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            flex-shrink: 0;
        }

        .card-body .photo img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .card-body .info {
            margin-top: 0.5rem;
            flex-grow: 1;
            font-size: 1rem;
            color: #222;
        }

        .info-row {
            display: flex;
            margin-bottom: 0.5rem;
            align-items: baseline;
        }

        .label {
            font-weight: 400;
            color: #555;
            min-width: 150px;
            display: inline-block;
        }

        .separator {
            padding: 0 5px;
            font-weight: 300;
        }

        .value {
            font-weight: 400;
            color: #555;
        }

        .photo-section {
            display: flex;
            flex-direction: column;
            gap: 1rem;
            width: 150px;
        }

        .barcode-section {
            width: 100%;
            display: flex;
            flex-direction: column;
            align-items: flex-start;
            margin-top: 0.1rem;
        }

        .barcode-container {
            width: 100%;
            transform: scale(0.8);
            transform-origin: left center;
            margin-left: 0;
            margin-top: -7px;
            margin-bottom: -13px;
        }

        .barcode-number {
            font-size: 0.9rem;
            margin-top: 0.3rem;
            color: #333;
            text-align: left;
            width: 100%;
            margin-left: 0;
        }

        .signature-section {
            margin-left: auto;
            text-align: start;
            padding-top: 0;
            min-width: 180px;
        }

        .signature-date {
            font-size: 0.9rem;
            color: #333;
        }

        .signature-division {
            font-size: 0.9rem;
            color: #333;
            margin-bottom: 2rem;
        }

        .signature-name {
            font-size: 0.9rem;
            color: #333;
            font-weight: 500;
            padding-right: 10px;
        }

        .signature-number {
            font-size: 0.9rem;
            color: #333;
            font-weight: 400;
            padding-right: 10px;
        }

        .signature-overlay-container {
            position: relative;
            margin-top: 1rem;
            min-height: 100px;
        }

        .signature-text {
            position: relative;
            z-index: 1;
            text-align: center;
        }

        .signature-images {
            position: absolute;
            top: -4rem;
            left: -4rem;
            width: 100%;
            height: 100%;
            display: flex;
            justify-content: space-between;
            align-items: center;
            z-index: 2;
            opacity: 0.8;
        }

        .school-stamp {
            width: 100px;
            height: 100px;
            object-fit: contain;
            margin-left: -10px;
        }

        .signature-image {
            width: 140px;
            height: 70px;
            object-fit: contain;
            margin-right: -15px;
        }

        .bottom-section {
            display: flex;
            width: 100%;
            margin-top: 1rem;
            justify-content: space-between;
            align-items: flex-end;
            margin-bottom: -65px;
        }

        .card-footer {
            background: #e0e6f1;
            text-align: center;
            padding: 0.8rem 1rem;
            font-size: 0.9rem;
            color: #666;
            font-style: italic;
            user-select: none;
        }

        .card-back-header {
            background: #004aad;
            color: white;
            padding: 1rem 1.5rem;
            text-align: center;
        }

        .card-back-header h2 {
            margin: 0;
            font-weight: 600;
            font-size: 1.5rem;
        }

        .card-back-body {
            padding: 1.5rem;
        }

        .rules-list {
            list-style-type: none;
            padding: 0;
            margin: 0;
        }

        .rules-list li {
            position: relative;
            padding-left: 1.5rem;
            margin-bottom: 0.8rem;
            line-height: 1.4;
        }

        .rules-list li:before {
            content: "•";
            position: absolute;
            left: 0;
            color: #004aad;
            font-weight: bold;
        }

        .footer-note {
            font-style: italic;
            text-align: center;
            margin-top: 2rem;
            color: #666;
            font-size: 0.9rem;
        }
    </style>
</head>
<body>
    <div class="card-container">
        <div class="container">
            <div class="card" id="libraryCard">
                <header class="card-header">
                    <div class="logo" aria-label="Logo sekolah">
                        <img src="{{ asset('assets/img/logos/logo.png') }}" alt="logo">
                    </div>
                    <div class="header-text">
                        <h2>KARTU ANGGOTA PERPUSTAKAAN</h2>
                        <div class="school-name">SMP NEGERI 26 KOTA JAMBI</div>
                        <div class="school-address">Jl. Liposos II No.RT.08 Kel, Bakung Jaya, Kec. Paal Merah,<br>Kota Jambi, Jambi 36135</div>
                    </div>
                </header>
                <section class="card-body">
                    <div class="photo-section">
                        <div class="photo">
                            <img src="{{ asset($siswa->getFoto()) }}" alt="Foto siswa" />
                        </div>
                        <div class="barcode-section">
                            <div class="barcode-container">
                                {!! DNS1D::getBarcodeHTML($siswa->kode_anggota, 'C128', 2.6, 80) !!}
                            </div>
                            <div class="barcode-number">{{ $siswa->kode_anggota }}</div>
                        </div>
                    </div>
                    <div class="info">
                        <div class="info-row">
                            <span class="label">Nama</span>
                            <span class="separator">:</span>
                            <span class="value">{{ $siswa->nama }}</span>
                        </div>
                        <div class="info-row">
                            <span class="label">NISN</span>
                            <span class="separator">:</span>
                            <span class="value">{{ $siswa->nisn }}</span>
                        </div>
                        <div class="info-row">
                            <span class="label">Kelas</span>
                            <span class="separator">:</span>
                            <span class="value">{{ $siswa->kelas->nama_kelas }}</span>
                        </div>
                        <div class="info-row">
                            <span class="label">Tmpt.Tgl Lahir</span>
                            <span class="separator">:</span>
                            <span class="value">{{ $siswa->tempat_lahir }}, {{ \Carbon\Carbon::parse($siswa->tanggal_lahir)->translatedFormat('d F Y') }}</span>
                        </div>
                        <div class="info-row">
                            <span class="label">Jenis Kelamin</span>
                            <span class="separator">:</span>
                            <span class="value">{{ str_replace(' ', '-', ucwords(str_replace('-', ' ', $siswa->jenis_kelamin))) }}</span>
                        </div>
                        <div class="bottom-section">
                            <div></div>
                            <div class="signature-section">
                                <div class="signature-date">Jambi, {{ \Carbon\Carbon::now()->translatedFormat('d F Y') }}</div>
                                <div class="signature-division">Kepala Perpustakaan</div>
                                <div class="signature-overlay-container">
                                    <div class="signature-text">
                                        <div class="signature-name">Imam Darto Desta S.Pd</div>
                                        <div class="signature-number">NIP: 123456789012345678</div>
                                    </div>
                                    <div class="signature-images">
                                        <img src="{{ asset('assets/img/elemetns/cap.png') }}" class="school-stamp" alt="Cap Sekolah">
                                        <img src="{{ asset('assets/img/elemetns/ttd.png') }}" class="signature-image" alt="Tanda Tangan">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <footer class="card-footer">
                    &copy; {{ now()->year }} Perpustakaan SMP Negeri 26 Kota Jambi
                </footer>
            </div>
            <button class="download-btn" id="downloadBtn" title="Download Kartu Depan">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                    <path d="M19 9h-4V3H9v6H5l7 7 7-7zM5 18v2h14v-2H5z"/>
                </svg>
            </button>
        </div>
        <div class="container">
            <div class="card" id="libraryCardBack">
                <header class="card-back-header">
                    <h2>PERATURAN PERPUSTAKAAN</h2>
                </header>
                <section class="card-back-body">
                    <ul class="rules-list">
                        <li>Kartu anggota ini harus dibawa setiap kunjungan, peminjaman dan pengembalian ke perpustakaan.</li>
                        <li>Tanpa kartu anggota, kunjungan, peminjaman dan pengembalian tidak dapat dilayani.</li>
                        <li>Pengembalian lewat dari batas waktu akan dikenakan denda sesuai peraturan yang berlaku.</li>
                        <li>Jika kartu hilang atau rusak, harap segera melaporkan ke petugas perpustakaan.</li>
                        <li>Dilarang meminjamkan kartu anggota kepada orang lain.</li>
                        <li>Kerusakan atau kehilangan buku menjadi tanggung jawab peminjam.</li>
                        <li>Kartu anggota ini tidak dapat dipergunakan oleh orang lain.</li>
                        <li>Kartu anggota ini berlaku selama menjadi siswa di SMPN 26 Kota Jambi.</li>
                    </ul>
                    <div class="footer-note">
                        &copy; {{ now()->year }} Perpustakaan SMP Negeri 26 Kota Jambi
                    </div>
                </section>
            </div>
            <button class="download-btn" id="downloadBackBtn" title="Download Kartu Belakang">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                    <path d="M19 9h-4V3H9v6H5l7 7 7-7zM5 18v2h14v-2H5z"/>
                </svg>
            </button>
        </div>
    </div>

    <script src="https://html2canvas.hertzen.com/dist/html2canvas.min.js"></script>
    <script>
        document.getElementById('downloadBtn').addEventListener('click', function() {
            const card = document.getElementById('libraryCard');
            html2canvas(card, {
                scale: 2,
                logging: false,
                useCORS: true,
                allowTaint: true
            }).then(canvas => {
                const link = document.createElement('a');
                link.download = 'Kartu-Perpustakaan-Depan-SMPN26-Jambi.png';
                link.href = canvas.toDataURL('image/png');
                link.click();
            });
        });

        document.getElementById('downloadBackBtn').addEventListener('click', function() {
            const card = document.getElementById('libraryCardBack');
            html2canvas(card, {
                scale: 2,
                logging: false,
                useCORS: true,
                allowTaint: true
            }).then(canvas => {
                const link = document.createElement('a');
                link.download = 'Kartu-Perpustakaan-Belakang-SMPN26-Jambi.png';
                link.href = canvas.toDataURL('image/png');
                link.click();
            });
        });
    </script>
</body>
</html>
