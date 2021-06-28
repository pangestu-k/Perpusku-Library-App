<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Laporan</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/paper-css/0.4.1/paper.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/paper-css/0.4.1/paper.css">
    <style>
        @page { size: A4 }

        h1 {
            font-weight: bold;
            font-size: 20pt;
            text-align: center;
        }

        table {
            border-collapse: collapse;
            width: 100%;
        }

        .table th {
            padding: 8px 8px;
            border:1px solid #000000;
            text-align: center;
        }

        .table td {
            padding: 3px 3px;
            border:1px solid #000000;
        }

        .text-center {
            text-align: center;
        }
    </style>
</head>
<body class="A4" onclick="window.print()">
    <section class="sheet padding-10mm">
        <h1>LAPORAN PEMINJAMAN BUKU PERPUSKU</h1>

        <table class="table">
            <thead>
                <th class="p-4">#</th>
                <th class="p-4" colspan="2">Buku</th>
                <th class="p-4">Nama Peminjam</th>
                <th class="p-4">Tanggal Pinjam</th>
                <th class="p-4">Tanggal Kembali</th>
                <th class="p-4">Keterangan</th>
            </thead>

            <tbody>

                @php
                    $no = 0;
                @endphp

                @forelse ($borrows as $borrow)
                    <tr class="justify-item-center" style="position: relative">
                        <td class="p-4">{{ ++$no }}</td>
                        <td class="p-4"><img src="{{ Storage::url($borrow->book->photo) }}" class="img rounded" height="100px" width="100px"></td>
                        <td class="p-4">{{ $borrow->book->title }}</td>
                        <td class="p-4"><b>{{ $borrow->user->name }}</b></td>
                        <td class="p-4">{{ $borrow->tanggal_pinjam }}</td>
                        <td class="p-4">{{ $borrow->tanggal_kembali }}</td>
                        <td class="p-4"><i>{{ $borrow->keterangan == null ? 'none' : $borrow->keterangan }}</i></td>
                    </tr>

                    @empty
                        <tr>
                            <td class="bg-danger text-light p-4" colspan="8">Anda Belum meminjam Buku, <b>Ayo Pinjam</b></td>
                        </tr>
                @endforelse
            </tbody>
        </table>

    </section>
</body>
</html>
