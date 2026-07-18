<?php

namespace App\Exports;

use App\Models\StockOpname;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class StockOpnameExport implements FromCollection, WithHeadings
{
    public function __construct(
        protected ?string $startDate = null,
        protected ?string $endDate = null
    ) {}

    public function collection()
    {
        return StockOpname::with(['product', 'user'])
            ->when($this->startDate, fn($q) => $q->whereDate('date', '>=', $this->startDate))
            ->when($this->endDate, fn($q) => $q->whereDate('date', '<=', $this->endDate))
            ->orderByDesc('date')
            ->get()
            ->map(fn($s) => [
                'Tanggal'      => $s->date?->format('d-m-Y'),
                'Produk'       => $s->product->name ?? '-',
                'Stok Sistem'  => $s->system_stock,
                'Stok Fisik'   => $s->physical_stock,
                'Selisih'      => $s->difference,
                'Petugas'      => $s->user->name ?? '-',
                'Keterangan'   => $s->note ?? '-',
            ]);
    }

    public function headings(): array
    {
        return ['Tanggal', 'Produk', 'Stok Sistem', 'Stok Fisik', 'Selisih', 'Petugas', 'Keterangan'];
    }
}
