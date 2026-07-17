<?php

namespace App\Exports;

use App\Models\StockOut;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class StockOutExport implements FromCollection, WithHeadings
{
    protected $startDate;
    protected $endDate;

    public function __construct($startDate = null, $endDate = null)
    {
        $this->startDate = $startDate;
        $this->endDate = $endDate;
    }

    public function collection()
    {
        return StockOut::with('product')
            ->when($this->startDate, function ($q) {
                $q->whereDate('date', '>=', $this->startDate);
            })
            ->when($this->endDate, function ($q) {
                $q->whereDate('date', '<=', $this->endDate);
            })
            ->get()
            ->map(function ($stock) {
                return [
                    'Tanggal' => $stock->date,
                    'Produk' => $stock->product->name,
                    'Qty' => $stock->qty,
                    'Catatan' => $stock->note,
                ];
            });
    }

    public function headings(): array
    {
        return [
            'Tanggal',
            'Produk',
            'Qty',
            'Catatan',
        ];
    }
}