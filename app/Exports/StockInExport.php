<?php

namespace App\Exports;

use App\Models\StockIn;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class StockInExport implements FromCollection, WithHeadings
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
        return StockIn::with('product')
            ->when($this->startDate, function ($query) {
                $query->whereDate('date', '>=', $this->startDate);
            })
            ->when($this->endDate, function ($query) {
                $query->whereDate('date', '<=', $this->endDate);
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
            'Catatan'
        ];
    }
}