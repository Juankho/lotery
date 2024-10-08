<?php

namespace App\Imports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class UsersImport implements ToModel, WithHeadingRow, WithColumnFormatting
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        return new User([
            'name' => $row['name'],
            'email' => $row['email'],
            'password' => bcrypt($row['password']),
            'birth_date' => $row['birth_date'],
            'phone' => $row['phone'],
        ]);
    }

    public function headingRow(): int
    {
        return 1;
    }

    public function columnFormats(): array
    {
        return [
            'birth_date' => 'yyyy-mm-dd',
        ];
    }
}
