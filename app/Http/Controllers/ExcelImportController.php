<?php

namespace App\Http\Controllers;

use App\Exports\TemplateTransaction;
use App\Imports\TransactionImport;
use App\Models\Category;
use App\Models\Transaction;
use App\Models\Wallet;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;

class ExcelImportController extends Controller
{
    public function showImportForm()
    {
        return view('user.excel.import-form');
    }

    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls'
        ]);

        $file = $request->file('file');

        $data = Excel::toArray(new TransactionImport, $file);

        session(['import_data' => $data[0]]);

        return view('user.excel.preview-import')->with('data', $data[0]);
    }

    public function processImport(Request $request)
    {
        $data = session('import_data');

        foreach ($data as $key => $row) {
            $row_num = $key + 2;
            $date = $row[5];

            // Validasi Name
            if ($row[0] == null) {
                return redirect()->route('import-excel')->with('error', 'Name at row = '. $row_num . ' error. Data must not empty');
            }

            // Validasi Wallet Name
            if ($row[1] == null) {
                return redirect()->route('import-excel')->with('error', 'Wallet Name at row = '. $row_num . ' error. Data must not empty');
            }

            // Validasi Category Name
            if ($row[2] == null) {
                return redirect()->route('import-excel')->with('error', 'Category Name at row = '. $row_num . ' error. Data must not empty');
            }

            //Validasi Category Type
            if ($row[3] == null) {
                return redirect()->route('import-excel')->with('error', 'Category Type at row = '. $row_num . ' error. Data must not empty');
            } elseif (!in_array(strtolower($row[3]), ['in', 'out'])) {
                return redirect()->route('import-excel')->with('error', 'Category Type '. $row[3] .' at row = '. $row_num . ' error. Data must be Income or Outcome');
            } else {
                $categoryType = strtolower($row[3]);
                if ($categoryType == 'in') {
                    $categoryType = 'Income';
                } else {
                    $categoryType = 'Outcome';
                }
            }

            //Validasi Amount
            if (!is_numeric($row[4])){
                return redirect()->route('import-excel')->with('error', 'Amount '. $row[4] .' at row = '. $row_num . ' error. Data must numberic');
            }


            //Validasi Date
            function validateDate($date, $format = 'd/m/Y'){
                $d = \DateTime::createFromFormat($format, $date);
                if ($d && $d->format($format) === $date) {
                    return true;
                } else {
                    return false;
                }
            }
            if ($date == null ) {
                return redirect()->route('import-excel')->with('error', 'Date at row = '. $row_num . ' error. Data must have year, month and date');
            } elseif (!validateDate($date)) {
                return redirect()->route('import-excel')->with('error', 'Date at row = '. $row_num . ' error. Format must be d/m/Y');
            }
            $dateValue = Carbon::createFromFormat('d/m/Y', $date);
            //Check Wallet and Get Wallet ID
            $wallet = Wallet::withoutTrashed()->where('name', $row[1])->where('user_id', Auth::user()->id)->first();
            if (!$wallet) {
                try {
                    $wallet = Wallet::create([
                        'name' => $row[1],
                        'user_id' => Auth::user()->id,
                        'icon' => "Wallet",
                        'color' => "purple",
                    ]);
                } catch (\Throwable $th) {
                    return redirect()->route('import-excel')->with('error', 'Wallet at row '. $row_num . ' not created');
                }
            }

            $wallet_id = $wallet->id;
            //Check Category and Get Category ID
            $category = Category::withoutTrashed()->where('name', $row[2])->where('type', $categoryType)->where('user_id', Auth::user()->id)->first();
            if (!$category) {
                try {
                    $category = Category::create([
                        'name' => $row[2],
                        'user_id' => Auth::user()->id,
                        'type' => $categoryType,
                    ]);
                }
                catch (\Throwable $th) {
                    return redirect()->route('import-excel')->with('error', 'Category at row'. $row_num . ' not created');
                }
            }

            $category_id = $category->id;

            if ($wallet_id && $category_id) {
                try {
                    Transaction::create([
                        'name' => $row[0],
                        'wallet_id' => $wallet_id,
                        'category_id' => $category_id,
                        'amount' => $row[4],
                        'date' => $dateValue,
                        'note' => $row[6],
                    ]);
                } catch (\Throwable $th) {
                    return redirect()->route('import-excel')->with('error', 'Transaction at row'. $row_num . 'not created');
                }
            }
        }

        session()->forget('import_data');
        return redirect()->route('import-excel')->with('success', 'Data imported successfully');
    }

    public function export()
    {
        $transactionData = [
            'headers' => [
                'Name',
                'Wallet Name',
                'Category Name',
                'Category Type',
                'Amount',
                'Date',
                'Note',
            ],
            'data' => [
                [
                    'Contoh Nama',
                    'Personal',
                    'Category Name',
                    'in/out',
                    1000000,
                    '01/01/2022',
                    'note jika ada'
                ],
            ],
        ];

        return Excel::download(new TemplateTransaction($transactionData), 'template_transaction.xlsx');
    }
}
