@props(['dendaKeterlambatan', 'dendaHilang', 'dendaRusak'])

<div class="col-12 mb-3">
    <div class="alert alert-info mb-0" role="alert">
        <h3 class="alert-heading">Catatan Perihal Peminjaman Buku</h3>
        <p class="fs-15">Beberapa hal yang dapat disampaikan kepada siswa mengenai peraturan
            dalam peminjaman buku di Perpustakaan SMPN 26 Kota Jambi</p>
        <hr>
        <ul class="px-3">
            <li class="fs-16 mb-1">
                <span class="fs-15">
                    Siswa diwajibkan mendaftarkan diri sebagai anggota perpustakaan.
                </span>
            </li>
            <li class="fs-16 mb-1">
                <span class="fs-15">
                    Waktu peminjaman buku hanya 7 hari. Jika lewat akan dikenakan denda.
                </span>
            </li>
            <li class="fs-16 mb-1">
                <span class="fs-15">
                    Tarif denda keterlambatan: Rp{{ number_format($dendaKeterlambatan, 0, ',', '.') }},- / hari
                </span>
            </li>
            <li class="fs-16 mb-1">
                <span class="fs-15">
                    Denda buku hilang: Rp{{ number_format($dendaHilang, 0, ',', '.') }},- / buku
                </span>
            </li>
            <li class="fs-16 mb-1">
                <span class="fs-15">
                    Denda buku rusak: Rp{{ number_format($dendaRusak, 0, ',', '.') }},- / buku
                </span>
            </li>
        </ul>
    </div>
</div>
