<?php

namespace App\Imports;

use App\Models\Transaction;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;

class TransactionImport implements ToModel, WithStartRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Transaction([
            'name' => $row[0],
            'wallet_name' => $row[1],
            'category_name' => $row[2],
            'category_type' => $row[3],
            'amount' => $row[4],
            'year' => $row[5],
            'month' => $row[6],
            'date' => $row[7],
            'note' => $row[8],
        ]);
    }

    public function startRow(): int
    {
        return 2;
    }
}
