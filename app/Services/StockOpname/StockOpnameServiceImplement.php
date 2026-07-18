<?php

namespace App\Services\StockOpname;

use App\Models\Product;
use App\Repositories\StockOpname\StockOpnameRepository;
use Illuminate\Support\Facades\DB;
use LaravelEasyRepository\Service;

class StockOpnameServiceImplement extends Service implements StockOpnameService
{
    protected $mainRepository;

    public function __construct(StockOpnameRepository $mainRepository)
    {
        $this->mainRepository = $mainRepository;
    }

    /**
     * Buat stock opname baru.
     * Hitung difference otomatis, update stok produk menjadi physical_stock.
     */
    public function create($data)
    {
        return DB::transaction(function () use ($data) {
            $data['difference'] = $data['physical_stock'] - $data['system_stock'];

            $opname = $this->mainRepository->create($data);

            Product::findOrFail($data['product_id'])->update([
                'stock' => $data['physical_stock'],
            ]);

            return $opname;
        });
    }

    /**
     * Update stock opname.
     * Jika physical_stock berubah, stok produk ikut diperbarui.
     */
    public function update($id, array $data)
    {
        return DB::transaction(function () use ($id, $data) {
            $data['difference'] = $data['physical_stock'] - $data['system_stock'];

            $opname = $this->mainRepository->update($id, $data);

            Product::findOrFail($data['product_id'])->update([
                'stock' => $data['physical_stock'],
            ]);

            return $opname;
        });
    }

    /**
     * Hapus stock opname.
     * Stok tidak di-rollback karena sudah di-adjust saat opname.
     */
    public function delete($id)
    {
        return $this->mainRepository->delete($id);
    }

    /**
     * Ambil semua record dengan relasi (untuk halaman index).
     */
    public function allWithRelations()
    {
        return $this->mainRepository->allWithRelations();
    }

    /**
     * Ambil data dengan filter tanggal (untuk laporan).
     */
    public function reportFilter(?string $startDate, ?string $endDate)
    {
        return $this->mainRepository->filterByDate($startDate, $endDate);
    }
}
