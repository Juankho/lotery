<?php

namespace App\Services;

use App\Models\Lotery;

class LoteryService
{

    public function getAllLoteries(array $filters)
    {
        return Lotery::query()
            ->applyFilters($filters)
            ->get();
    }

    public function createLotery(array $data)
    {
        return Lotery::create($data);
    }

    public function updateLotery(array $data)
    {
    }

    public function deleteLotery()
    {
    }
}
