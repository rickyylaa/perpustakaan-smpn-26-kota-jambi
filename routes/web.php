<?php

use Illuminate\Support\Facades\Route;

Route::prefix('admin')->middleware('auth', 'role:admin')->group(function () {
    Route::get('/dashboard', [App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('admin.dashboard');

    Route::get('/petugas', [App\Http\Controllers\Admin\PetugasController::class, 'index'])->name('admin.petugas');
    Route::post('/petugas/tambah', [App\Http\Controllers\Admin\PetugasController::class, 'store'])->name('admin.tambahPetugas');
    Route::get('/petugas/{petugas}/edit', [App\Http\Controllers\Admin\PetugasController::class, 'edit'])->name('admin.editPetugas');
    Route::put('/petugas/{petugas}/update', [App\Http\Controllers\Admin\PetugasController::class, 'update'])->name('admin.updatePetugas');
    Route::delete('/petugas/{id}/delete', [App\Http\Controllers\Admin\PetugasController::class, 'destroy'])->name('admin.hapusPetugas');

    Route::get('/kelas', [App\Http\Controllers\Admin\KelasController::class, 'index'])->name('admin.kelas');
    Route::post('/kelas/tambah', [App\Http\Controllers\Admin\KelasController::class, 'store'])->name('admin.tambahKelas');
    Route::get('/kelas/{kelas}/edit', [App\Http\Controllers\Admin\KelasController::class, 'edit'])->name('admin.editKelas');
    Route::put('/kelas/{kelas}/update', [App\Http\Controllers\Admin\KelasController::class, 'update'])->name('admin.updateKelas');
    Route::delete('/kelas/{id}/delete', [App\Http\Controllers\Admin\KelasController::class, 'destroy'])->name('admin.hapusKelas');

    Route::get('/siswa', [App\Http\Controllers\Admin\SiswaController::class, 'index'])->name('admin.siswa');
    Route::post('/siswa/tambah', [App\Http\Controllers\Admin\SiswaController::class, 'store'])->name('admin.tambahSiswa');
    Route::get('/siswa/{siswa}/edit', [App\Http\Controllers\Admin\SiswaController::class, 'edit'])->name('admin.editSiswa');
    Route::put('/siswa/{siswa}/update', [App\Http\Controllers\Admin\SiswaController::class, 'update'])->name('admin.updateSiswa');
    Route::delete('/siswa/{id}/delete', [App\Http\Controllers\Admin\SiswaController::class, 'destroy'])->name('admin.hapusSiswa');
    Route::get('/siswa/print/kartu-anggota/{kode_anggota}', [App\Http\Controllers\Admin\SiswaController::class, 'print'])->name('admin.printSiswa');

    Route::get('/kategori', [App\Http\Controllers\Admin\KategoriController::class, 'index'])->name('admin.kategori');
    Route::post('/kategori/tambah', [App\Http\Controllers\Admin\KategoriController::class, 'store'])->name('admin.tambahKategori');
    Route::get('/kategori/{kategori}/edit', [App\Http\Controllers\Admin\KategoriController::class, 'edit'])->name('admin.editKategori');
    Route::put('/kategori/{kategori}/update', [App\Http\Controllers\Admin\KategoriController::class, 'update'])->name('admin.updateKategori');
    Route::delete('/kategori/{id}/delete', [App\Http\Controllers\Admin\KategoriController::class, 'destroy'])->name('admin.hapusKategori');

    Route::get('/rakbaris', [App\Http\Controllers\Admin\RakBarisController::class, 'index'])->name('admin.rakbaris');
    Route::post('/rakbaris/tambah', [App\Http\Controllers\Admin\RakBarisController::class, 'store'])->name('admin.tambahRakbaris');
    Route::get('/rakbaris/{rakbaris}/edit', [App\Http\Controllers\Admin\RakBarisController::class, 'edit'])->name('admin.editRakbaris');
    Route::put('/rakbaris/{rakbaris}/update', [App\Http\Controllers\Admin\RakBarisController::class, 'update'])->name('admin.updateRakbaris');
    Route::delete('/rakbaris/{id}/delete', [App\Http\Controllers\Admin\RakBarisController::class, 'destroy'])->name('admin.hapusRakbaris');

    Route::get('/buku', [App\Http\Controllers\Admin\BukuController::class, 'index'])->name('admin.buku');
    Route::post('/buku/tambah', [App\Http\Controllers\Admin\BukuController::class, 'store'])->name('admin.tambahBuku');
    Route::get('/buku/{buku}/edit', [App\Http\Controllers\Admin\BukuController::class, 'edit'])->name('admin.editBuku');
    Route::put('/buku/{buku}/update', [App\Http\Controllers\Admin\BukuController::class, 'update'])->name('admin.updateBuku');
    Route::delete('/buku/{id}/delete', [App\Http\Controllers\Admin\BukuController::class, 'destroy'])->name('admin.hapusBuku');

    Route::get('/peminjaman', [App\Http\Controllers\Admin\PeminjamanController::class, 'index'])->name('admin.peminjaman');
    Route::post('/peminjaman/cekAnggota', [App\Http\Controllers\Admin\PeminjamanController::class, 'cek'])->name('admin.cekAnggotaPeminjaman');
    Route::get('/peminjaman/{kode_anggota}', [App\Http\Controllers\Admin\PeminjamanController::class, 'form'])->name('admin.formPeminjaman');
    Route::post('/peminjaman/{kode_anggota}/pinjam', [App\Http\Controllers\Admin\PeminjamanController::class, 'store'])->name('admin.tambahPeminjaman');

    Route::get('/pengembalian', [App\Http\Controllers\Admin\PengembalianController::class, 'index'])->name('admin.pengembalian');
    Route::post('/pengembalian/cekAnggota', [App\Http\Controllers\Admin\PengembalianController::class, 'cek'])->name('admin.cekAnggotaPengembalian');
    Route::get('/pengembalian/{kode_anggota}', [App\Http\Controllers\Admin\PengembalianController::class, 'form'])->name('admin.formPengembalian');
    Route::put('/pengembalian/{riwayat}/selesai', [App\Http\Controllers\Admin\PengembalianController::class, 'store'])->name('admin.selesaiPengembalian');

    Route::get('/laporan', [App\Http\Controllers\Admin\LaporanController::class, 'index'])->name('admin.laporan');
    Route::get('/laporan/periode/{daterange}', [App\Http\Controllers\Admin\LaporanController::class, 'periode'])->name('admin.laporanPeriode');

    Route::get('/denda', [App\Http\Controllers\Admin\DendaController::class, 'index'])->name('admin.denda');
    Route::post('/denda/tambah', [App\Http\Controllers\Admin\DendaController::class, 'store'])->name('admin.tambahDenda');
    Route::get('/denda/{denda}/edit', [App\Http\Controllers\Admin\DendaController::class, 'edit'])->name('admin.editDenda');
    Route::put('/denda/{denda}/update', [App\Http\Controllers\Admin\DendaController::class, 'update'])->name('admin.updateDenda');
    Route::delete('/denda/{id}/delete', [App\Http\Controllers\Admin\DendaController::class, 'destroy'])->name('admin.hapusDenda');
});

Route::prefix('petugas')->middleware('auth', 'role:petugas')->group(function () {
    Route::get('/dashboard', [App\Http\Controllers\Petugas\DashboardController::class, 'index'])->name('petugas.dashboard');

    Route::get('/siswa', [App\Http\Controllers\Petugas\SiswaController::class, 'index'])->name('petugas.siswa');
    Route::get('/siswa/print/kartu-anggota/{kode_anggota}', [App\Http\Controllers\Petugas\SiswaController::class, 'print'])->name('petugas.printSiswa');

    Route::get('/kategori', [App\Http\Controllers\Petugas\KategoriController::class, 'index'])->name('petugas.kategori');
    Route::post('/kategori/tambah', [App\Http\Controllers\Petugas\KategoriController::class, 'store'])->name('petugas.tambahKategori');
    Route::get('/kategori/{kategori}/edit', [App\Http\Controllers\Petugas\KategoriController::class, 'edit'])->name('petugas.editKategori');
    Route::put('/kategori/{kategori}/update', [App\Http\Controllers\Petugas\KategoriController::class, 'update'])->name('petugas.updateKategori');
    Route::delete('/kategori/{id}/delete', [App\Http\Controllers\Petugas\KategoriController::class, 'destroy'])->name('petugas.hapusKategori');

    Route::get('/rakbaris', [App\Http\Controllers\Petugas\RakBarisController::class, 'index'])->name('petugas.rakbaris');
    Route::post('/rakbaris/tambah', [App\Http\Controllers\Petugas\RakBarisController::class, 'store'])->name('petugas.tambahRakbaris');
    Route::get('/rakbaris/{rakbaris}/edit', [App\Http\Controllers\Petugas\RakBarisController::class, 'edit'])->name('petugas.editRakbaris');
    Route::put('/rakbaris/{rakbaris}/update', [App\Http\Controllers\Petugas\RakBarisController::class, 'update'])->name('petugas.updateRakbaris');
    Route::delete('/rakbaris/{id}/delete', [App\Http\Controllers\Petugas\RakBarisController::class, 'destroy'])->name('petugas.hapusRakbaris');

    Route::get('/buku', [App\Http\Controllers\Petugas\BukuController::class, 'index'])->name('petugas.buku');
    Route::post('/buku/tambah', [App\Http\Controllers\Petugas\BukuController::class, 'store'])->name('petugas.tambahBuku');
    Route::get('/buku/{buku}/edit', [App\Http\Controllers\Petugas\BukuController::class, 'edit'])->name('petugas.editBuku');
    Route::put('/buku/{buku}/update', [App\Http\Controllers\Petugas\BukuController::class, 'update'])->name('petugas.updateBuku');
    Route::delete('/buku/{id}/delete', [App\Http\Controllers\Petugas\BukuController::class, 'destroy'])->name('petugas.hapusBuku');

    Route::get('/peminjaman', [App\Http\Controllers\Petugas\PeminjamanController::class, 'index'])->name('petugas.peminjaman');
    Route::post('/peminjaman/cekAnggota', [App\Http\Controllers\Petugas\PeminjamanController::class, 'cek'])->name('petugas.cekAnggotaPeminjaman');
    Route::get('/peminjaman/{kode_anggota}', [App\Http\Controllers\Petugas\PeminjamanController::class, 'form'])->name('petugas.formPeminjaman');
    Route::post('/peminjaman/{kode_anggota}/pinjam', [App\Http\Controllers\Petugas\PeminjamanController::class, 'store'])->name('petugas.tambahPeminjaman');

    Route::get('/pengembalian', [App\Http\Controllers\Petugas\PengembalianController::class, 'index'])->name('petugas.pengembalian');
    Route::post('/pengembalian/cekAnggota', [App\Http\Controllers\Petugas\PengembalianController::class, 'cek'])->name('petugas.cekAnggotaPengembalian');
    Route::get('/pengembalian/{kode_anggota}', [App\Http\Controllers\Petugas\PengembalianController::class, 'form'])->name('petugas.formPengembalian');
    Route::put('/pengembalian/{riwayat}/selesai', [App\Http\Controllers\Petugas\PengembalianController::class, 'store'])->name('petugas.selesaiPengembalian');
});

Route::prefix('api')->group(function () {
    Route::get('/getRakBaris/{kategoriNama}', [App\Http\Controllers\ApiController::class, 'getRakBaris'])->name('getRakBaris');
    Route::get('/getPinjam/{kode_anggota}', [App\Http\Controllers\ApiController::class, 'getPinjam'])->name('getPinjam');
    Route::get('/getBuku/{isbn}', [App\Http\Controllers\ApiController::class, 'getBuku'])->name('getBuku');
    Route::get('/getAnggota/{kode_anggota}', [App\Http\Controllers\ApiController::class, 'getAnggota'])->name('getAnggota');
});

require __DIR__ . '/auth.php';
