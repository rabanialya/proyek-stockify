<!DOCTYPE html>
<html>

<head>

<meta charset="utf-8">

<style>

body{
    font-family: DejaVu Sans;
    font-size:12px;
}

table{
    width:100%;
    border-collapse:collapse;
    margin-top:20px;
}

table,th,td{
    border:1px solid black;
}

th,td{
    padding:8px;
}

h2{
    text-align:center;
}

</style>

</head>

<body>

<h2>
    STOCKIFY
</h2>

<h3 style="text-align:center">
    Laporan Persediaan Barang
</h3>

<table>

<thead>

<tr>

<th>No</th>
<th>Produk</th>
<th>SKU</th>
<th>Kategori</th>
<th>Supplier</th>
<th>Stok</th>
<th>Minimum</th>
<th>Status</th>

</tr>

</thead>

<tbody>

@foreach($products as $product)

<tr>

<td>{{ $loop->iteration }}</td>

<td>{{ $product->name }}</td>

<td>{{ $product->sku }}</td>

<td>{{ $product->category->name }}</td>

<td>{{ $product->supplier->name }}</td>

<td>{{ $product->stock }}</td>

<td>{{ $product->minimum_stock }}</td>

<td>

@if($product->stock <= $product->minimum_stock)

Stok Menipis

@else

Aman

@endif

</td>

</tr>

@endforeach

</tbody>

</table>

<p style="margin-top:20px">

<strong>Total Produk :</strong>

{{ $products->count() }}

</p>

<p>

Dicetak :

{{ now()->format('d-m-Y H:i') }}

</p>

</body>

</html>