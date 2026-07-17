<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">

    <style>

        body{
            font-family: DejaVu Sans;
            font-size:12px;
        }

        h2,h3{
            margin:0;
        }

        table{
            width:100%;
            border-collapse:collapse;
            margin-top:20px;
        }

        table,
        th,
        td{
            border:1px solid #000;
        }

        th,
        td{
            padding:8px;
            text-align:left;
        }

        .header{
            text-align:center;
            margin-bottom:25px;
        }

        .summary{
            margin-top:25px;
        }

    </style>

</head>

<body>

<div class="header">

    <h2>STOCKIFY</h2>

    <h3>Laporan Stok Masuk</h3>

    <br>

    <strong>Periode :</strong>

    {{ $startDate ?: '-' }}

    s/d

    {{ $endDate ?: '-' }}

</div>

<table>

    <thead>

        <tr>

            <th>No</th>

            <th>Tanggal</th>

            <th>Produk</th>

            <th>Qty</th>

            <th>Catatan</th>

        </tr>

    </thead>

    <tbody>

    @foreach($stockIns as $stock)

        <tr>

            <td>{{ $loop->iteration }}</td>

            <td>{{ $stock->date }}</td>

            <td>{{ $stock->product->name }}</td>

            <td>{{ $stock->qty }}</td>

            <td>{{ $stock->note }}</td>

        </tr>

    @endforeach

    </tbody>

</table>

<div class="summary">

    <p>
        <strong>Total Transaksi :</strong>

        {{ $stockIns->count() }}
    </p>

    <p>

        <strong>Total Barang Masuk :</strong>

        {{ $stockIns->sum('qty') }}

    </p>

    <p>

        Dicetak :

        {{ now()->format('d-m-Y H:i') }}

    </p>

</div>

</body>

</html>