<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <style>
        body {
            font-family: DejaVu Sans;
            font-size: 12px;
        }
        h2, h3 {
            margin: 0;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        table, th, td {
            border: 1px solid #000;
        }
        th, td {
            padding: 8px;
            text-align: left;
        }
        .header {
            text-align: center;
            margin-bottom: 25px;
        }
        .summary {
            margin-top: 25px;
        }
        .plus  { color: #16a34a; }
        .minus { color: #dc2626; }
    </style>
</head>
<body>

<div class="header">
    <h2>STOCKIFY</h2>
    <h3>Laporan Stock Opname</h3>
    <br>
    <strong>Periode :</strong>
    {{ $startDate ?: '-' }} s/d {{ $endDate ?: '-' }}
</div>

<table>
    <thead>
        <tr>
            <th>No</th>
            <th>Tanggal</th>
            <th>Produk</th>
            <th>Stok Sistem</th>
            <th>Stok Fisik</th>
            <th>Selisih</th>
            <th>Petugas</th>
            <th>Keterangan</th>
        </tr>
    </thead>
    <tbody>
    @foreach($stockOpnames as $opname)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $opname->date?->format('d-m-Y') }}</td>
            <td>{{ $opname->product->name ?? '-' }}</td>
            <td>{{ $opname->system_stock }}</td>
            <td>{{ $opname->physical_stock }}</td>
            <td class="{{ $opname->difference > 0 ? 'plus' : ($opname->difference < 0 ? 'minus' : '') }}">
                {{ $opname->difference > 0 ? '+' : '' }}{{ $opname->difference }}
            </td>
            <td>{{ $opname->user->name ?? '-' }}</td>
            <td>{{ $opname->note ?? '-' }}</td>
        </tr>
    @endforeach
    </tbody>
</table>

<div class="summary">
    <p><strong>Total Transaksi :</strong> {{ $stockOpnames->count() }}</p>
    <p>Dicetak : {{ now()->format('d-m-Y H:i') }}</p>
</div>

</body>
</html>
