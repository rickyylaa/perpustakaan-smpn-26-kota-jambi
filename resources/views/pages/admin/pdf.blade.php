<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Laporan Pesanan</title>

    <link rel="shortcut icon" href="/assets/img/icons/icon.png" type="image/x-icon">

    <link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Poppins:100,200,300,400,500,600,700,800,900' type='text/css'>

    <link rel="stylesheet" href="/pdf/vendor/bootstrap/css/bootstrap.min.css" type="text/css">
    <link rel="stylesheet" href="/assets/plugins/font-awesome/css/fontawesome.min.css" type="text/css">
    <link rel="stylesheet" href="/pdf/css/stylesheet.css" type="text/css">
</head>
<body>
    <div class="container-fluid invoice-container">
        <main>
            <div class="table-responsive">
                <table class="table table-bordered border border-secondary mb-0">
                    <tbody>
                        <tr>
                            <td colspan="2" class="bg-light text-center">
                                <h3 class="mb-0">Laporan Periode ({{ $date[0] }} - {{ $date[1] }})</h3>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2" class="p-0">
                                <table class="table table-sm mb-0">
                                    <thead>
                                        <tr class="bg-light">
                                            <td class="col-2"><strong>Siswa</strong></td>
                                            <td class="col-2"><strong>Buku</strong></td>
                                            <td class="col-2"><strong>Denda Keterlambatan</strong></td>
                                            <td class="col-2"><strong>Denda Buku Rusak</strong></td>
                                            <td class="col-2"><strong>Denda Buku Hilang</strong></td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($laporan as $data)
                                            <tr>
                                                <td class="col-1">
                                                    <span class="m-0">{{ ucwords($data->peminjaman->siswa->nama) }}</span>
                                                </td>
                                                <td class="col-1">
                                                    <span class="m-0">{{ ucwords($data->buku->judul) }}</span>
                                                </td>
                                                <td class="col-1">
                                                    <span class="m-0">Rp{{ number_format($data->denda_keterlambatan, 0, ',', '.') }},-</span>
                                                </td>
                                                <td class="col-1">
                                                    <span class="m-0">Rp{{ number_format($data->denda_buku_rusak, 0, ',', '.') }},-</span>
                                                </td>
                                                <td class="col-1">
                                                    <span class="m-0">Rp{{ number_format($data->denda_buku_hilang, 0, ',', '.') }},-</span>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="10" class="text-center">Anda tidak memiliki data dalam tabel ini</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <td colspan="4"></td>
                                            <td class="text-start">Total: Rp{{ number_format($total, 0, ',', '.') }},-</td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </main>
        <footer class="text-center mt-4">
            <div class="btn-group btn-group-sm d-print-none">
                <a href="javascript:window.print()" class="btn btn-light border text-black-50 shadow-none">
                    <i class="fa-sharp fa-solid fa-print"></i> Print & Download
                </a>
            </div>
        </footer>
    </div>
</body>
</html>
