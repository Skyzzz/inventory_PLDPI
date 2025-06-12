<!DOCTYPE html>
<html>

<head>
    <title>Laporan Barang Masuk</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <style>
        * {
            font-family: Arial, sans-serif !important;
        }

        body {
            font-size: 11pt;
        }

        .kop {
            text-align: center;
            line-height: 1.2;
        }

        .kop img {
            float: left;
            height: 100px;
        }

        .kop div {
            margin: 0;
        }

        .garis {
            border: 2px solid black;
            border-style: double none none;
            margin-top: 10px;
            margin-bottom: 20px;
        }

        table tr td {
            font-size: 10pt;
        }

        table thead tr th {
            font-size: 10pt;
            text-align: center;
        }

        .table-bordered td,
        .table-bordered th {
            border: 1px solid #000 !important;
        }

        .total th {
            font-size: 11pt;
            color: red;
            text-align: right;
        }
    </style>
</head>

<body>

    <div class="kop">
        <img src="{{ public_path('images/kantor.png') }}" alt="logo">
        <div style="font-size: 14pt;">PEMERINTAH PROVINSI KALIMANTAN SELATAN</div>
        <div style="font-size: 14pt;">DINAS PENDIDIKAN DAN KEBUDAYAAN</div>
        <div style="font-size: 16pt; font-weight: bold;">PUSAT LAYANAN DISABILITAS DAN PENDIDIKAN INKLUSI</div>
        <div style="font-size: 10pt;">
            Jalan Perdagangan Komp. Bumi Indah Lestari II, Kuin Utara, Kayu Tangi, Banjarmasin - Kalimantan Selatan<br>
            Telp. 0811 5132 424 - Email: <u>pldpi.provkalsel@gmail.com</u>
        </div>
    </div>

    <hr class="garis">

    <div class="text-center mb-4">
        <div style="font-size: 16pt; font-weight: bold;">LAPORAN BARANG MASUK</div>
        <div style="font-size: 11pt; font-weight: bold;">Tanggal: {{ date('d M Y', strtotime($dari)) }} - {{ date('d M Y', strtotime($sampai)) }}</div>
    </div>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>No</th>
                <th>ID Barang Masuk</th>
                <th>Supplier</th>
                <th>Tanggal Masuk</th>
                <th>Nama Barang</th>
                <th>Harga</th>
                <th>Jumlah</th>
                <th>Total Pengeluaran</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data_masuk as $item)
            <tr>
                <td class="text-center">{{ $loop->iteration }}</td>
                <td>{{ $item->kode_bm }}</td>
                <td>{{ $item->pemasok->nama }}</td>
                <td>{{ date('d F Y', strtotime($item->tanggal)) }}</td>
                <td>{{ $item->nama }}</td>
                <td>Rp. {{ number_format($item->harga) }}</td>
                <td>{{ number_format($item->jumlah) }} {{ $item->satuan }}</td>
                <td>Rp. {{ number_format($item->tot_pengeluaran) }}</td>
            </tr>
            @endforeach
            <tr class="total">
                <th colspan="7"><b>Total Pembelian</b></th>
                <th><b>Rp. {{ number_format($data_masuk->sum('tot_pengeluaran')) }}</b></th>
            </tr>
        </tbody>
    </table>

</body>

</html>
