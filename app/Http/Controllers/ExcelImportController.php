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
            $year = $row[5];
            $month = $row[6];
            $date = $row[7];

            if (!in_array( $row[3], ['Income', 'Outcome'])) {
                return redirect()->route('import-excel')->with('error', 'Category Type '. $row[3] .' at row = '. $row_num . ' not created. Data must be Income or Outcome');
            }
            if (!is_numeric($row[4])){
                return redirect()->route('import-excel')->with('error', 'Amount '. $row[4] .' at row = '. $row_num . ' not created. Data must numberic');
            }
            if ($year == null || $month == null || $date == null) {
                return redirect()->route('import-excel')->with('error', 'Date at row = '. $row_num . ' not created. Data must have year, month and date');
            } else if (!is_numeric($year) || !is_numeric($month) || !is_numeric($date)) {
                return redirect()->route('import-excel')->with('error', 'Date at row = '. $row_num . ' not created. Data must numberic');
            } else {
                if ($month < 1 || $month > 12) {
                    return redirect()->route('import-excel')->with('error', 'Date at Month '. $month . ', row = '. $row_num . ' not created. Data month must between 1 and 12');
                }
                if ($date < 1 || $date > 31) {
                    return redirect()->route('import-excel')->with('error', 'Date at Date '. $date . ', row = '. $row_num . ' not created. Data date must between 1 and 31');
                }
            }

            $dateValue = Carbon::create($year, $month, $date)->toDateString();
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
                    return redirect()->route('import-excel')->with('error', 'Wallet at row'. $row_num . ' not created');
                }
            }

            $wallet_id = $wallet->id;

            //Check Category and Get Category ID
            $category = Category::withoutTrashed()->where('name', $row[2])->where('type', $row[3])->first();
            if (!$category) {
                try {
                    $category = Category::create([
                        'name' => $row[2],
                        'type' => $row[3],
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
                        'note' => $row[8],
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
                'Year',
                'Month',
                'Date',
                'Note',
            ],
            'data' => [
                [
                    'Contoh Nama',
                    'Personal',
                    'Category Name',
                    'Income/Outcome',
                    1000000,
                    2021,
                    8,
                    1,
                    'note jika ada'
                ],
            ],
        ];

        return Excel::download(new TemplateTransaction($transactionData), 'template_transaction.xlsx');
    }
}
