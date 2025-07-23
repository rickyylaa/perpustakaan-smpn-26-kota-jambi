<?php

// @formatter:off
// phpcs:ignoreFile
/**
 * A helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */


namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property int $user_id
 * @property int $nip
 * @property string $nama
 * @property string $no_hp
 * @property string $jenis_kelamin
 * @property string $foto
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\TFactory|null $use_factory
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection<int, \Illuminate\Notifications\DatabaseNotification> $notifications
 * @property-read int|null $notifications_count
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Admin newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Admin newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Admin onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Admin query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Admin whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Admin whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Admin whereFoto($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Admin whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Admin whereJenisKelamin($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Admin whereNama($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Admin whereNip($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Admin whereNoHp($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Admin whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Admin whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Admin withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Admin withoutTrashed()
 */
	class Admin extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property int $rak_baris_id
 * @property string $kode_buku
 * @property string|null $isbn
 * @property string $judul
 * @property string $slug
 * @property \App\Models\Kategori|null $kategori
 * @property string $pengarang
 * @property string|null $penerbit
 * @property string|null $tahun_terbit
 * @property int $jumlah_eksemplar
 * @property string|null $deskripsi
 * @property string|null $cover
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\TFactory|null $use_factory
 * @property-read \App\Models\RakBaris $rak_baris
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Buku newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Buku newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Buku onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Buku query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Buku whereCover($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Buku whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Buku whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Buku whereDeskripsi($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Buku whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Buku whereIsbn($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Buku whereJudul($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Buku whereJumlahEksemplar($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Buku whereKategori($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Buku whereKodeBuku($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Buku wherePenerbit($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Buku wherePengarang($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Buku whereRakBarisId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Buku whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Buku whereTahunTerbit($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Buku whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Buku withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Buku withoutTrashed()
 */
	class Buku extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property int|null $denda_keterlambatan
 * @property int|null $denda_buku_rusak
 * @property int|null $denda_buku_hilang
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\TFactory|null $use_factory
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Denda newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Denda newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Denda onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Denda query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Denda whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Denda whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Denda whereDendaBukuHilang($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Denda whereDendaBukuRusak($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Denda whereDendaKeterlambatan($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Denda whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Denda whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Denda withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Denda withoutTrashed()
 */
	class Denda extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property string $nama
 * @property string $slug
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\TFactory|null $use_factory
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\RakBaris> $rakbaris
 * @property-read int|null $rakbaris_count
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Kategori newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Kategori newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Kategori onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Kategori query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Kategori whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Kategori whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Kategori whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Kategori whereNama($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Kategori whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Kategori whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Kategori withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Kategori withoutTrashed()
 */
	class Kategori extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property string $nama_kelas
 * @property string $tingkat
 * @property string $wali_kelas
 * @property int $isi_kelas
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\TFactory|null $use_factory
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Siswa> $siswa
 * @property-read int|null $siswa_count
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Kelas newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Kelas newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Kelas onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Kelas query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Kelas whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Kelas whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Kelas whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Kelas whereIsiKelas($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Kelas whereNamaKelas($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Kelas whereTingkat($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Kelas whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Kelas whereWaliKelas($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Kelas withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Kelas withoutTrashed()
 */
	class Kelas extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property-read \App\Models\TFactory|null $use_factory
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\RiwayatPeminjaman> $riwayat
 * @property-read int|null $riwayat_count
 * @property-read \App\Models\Siswa|null $siswa
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Peminjaman newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Peminjaman newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Peminjaman onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Peminjaman query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Peminjaman withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Peminjaman withoutTrashed()
 */
	class Peminjaman extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property int $user_id
 * @property int $nip
 * @property string $nama
 * @property string $no_hp
 * @property string $jenis_kelamin
 * @property string $foto
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\TFactory|null $use_factory
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection<int, \Illuminate\Notifications\DatabaseNotification> $notifications
 * @property-read int|null $notifications_count
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Petugas newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Petugas newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Petugas onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Petugas query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Petugas whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Petugas whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Petugas whereFoto($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Petugas whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Petugas whereJenisKelamin($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Petugas whereNama($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Petugas whereNip($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Petugas whereNoHp($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Petugas whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Petugas whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Petugas withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Petugas withoutTrashed()
 */
	class Petugas extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property int $kategori_id
 * @property string $kode
 * @property string $nama_rak
 * @property int $nomor_baris
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Buku> $buku
 * @property-read int|null $buku_count
 * @property-read \App\Models\TFactory|null $use_factory
 * @property-read \App\Models\Kategori $kategori
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RakBaris newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RakBaris newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RakBaris onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RakBaris query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RakBaris whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RakBaris whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RakBaris whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RakBaris whereKategoriId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RakBaris whereKode($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RakBaris whereNamaRak($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RakBaris whereNomorBaris($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RakBaris whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RakBaris withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RakBaris withoutTrashed()
 */
	class RakBaris extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property-read \App\Models\Buku|null $buku
 * @property-read \App\Models\TFactory|null $use_factory
 * @property-read \App\Models\Peminjaman|null $peminjaman
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RiwayatPeminjaman newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RiwayatPeminjaman newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RiwayatPeminjaman onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RiwayatPeminjaman query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RiwayatPeminjaman withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RiwayatPeminjaman withoutTrashed()
 */
	class RiwayatPeminjaman extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property int|null $kelas_id
 * @property string $kode_anggota
 * @property int $nisn
 * @property string $nama
 * @property string $tempat_lahir
 * @property string $tanggal_lahir
 * @property string $jenis_kelamin
 * @property string|null $alamat
 * @property string $foto
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\TFactory|null $use_factory
 * @property-read \App\Models\Kelas|null $kelas
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Siswa newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Siswa newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Siswa onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Siswa query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Siswa whereAlamat($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Siswa whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Siswa whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Siswa whereFoto($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Siswa whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Siswa whereJenisKelamin($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Siswa whereKelasId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Siswa whereKodeAnggota($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Siswa whereNama($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Siswa whereNisn($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Siswa whereTanggalLahir($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Siswa whereTempatLahir($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Siswa whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Siswa withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Siswa withoutTrashed()
 */
	class Siswa extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property string $username
 * @property string $password
 * @property string $role
 * @property string|null $remember_token
 * @property string|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Admin|null $admin
 * @property-read \App\Models\TFactory|null $use_factory
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection<int, \Illuminate\Notifications\DatabaseNotification> $notifications
 * @property-read int|null $notifications_count
 * @property-read \App\Models\Petugas|null $petugas
 * @method static \Database\Factories\UserFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereRole($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereUsername($value)
 */
	class User extends \Eloquent {}
}

