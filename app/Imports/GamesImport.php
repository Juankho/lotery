<?php

namespace App\Imports;

use App\Models\Game;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class GamesImport implements ToModel, WithColumnFormatting, WithHeadingRow
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        return new Game([
            "lotery_id" => $row["lotery_id"],
            "game_date" => $row["game_date"],
            "total_prize" => $row["total_prize"],
        ]);
    }


    public function headingRow(): int
    {
        return 1;
    }

    public function columnFormats(): array
    {
        return [
            'game_date' => 'yyyy-mm-dd',
        ];
    }
}
