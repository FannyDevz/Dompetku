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
            'date' => $row[5],
            'note' => $row[6],
        ]);
    }

    public function startRow(): int
    {
        return 2;
    }
}
