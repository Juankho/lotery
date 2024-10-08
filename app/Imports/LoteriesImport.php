<?php

namespace App\Imports;

use App\Models\Lotery;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class LoteriesImport implements ToModel, WithHeadingRow
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        return new Lotery([
            'name' => $row['name'],
            'description' => $row['description'],
            'rules' => $row['rules'],
            'status' => $row['status']
        ]);
    }

    public function headingRow(): int
    {
        return 1;
    }
}
