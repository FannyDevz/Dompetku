<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\Wallet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    public function index(Request $request)
    {
        $wallets = Wallet::select('id', 'name')->get();
        $months = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
        $years = Transaction::select(DB::raw('YEAR(date) as year'))->distinct()->pluck('year');

        $wallet_id = $request->get('wallet_id');
        if ($wallet_id) {
            $transactions = DB::table('transactions')
                ->select('categories.name as category_name', 'categories.type as category_type', DB::raw('count(*) as transaction_count'), DB::raw('sum(amount) as total_amount'))
                ->leftJoin('categories', 'categories.id', '=', 'transactions.category_id')
                ->where('transactions.wallet_id', $wallet_id)
                ->groupBy('categories.type', 'transactions.category_id')
                ->get();

            $transactionData = [
                'income' => [],
                'outcome' => []
            ];
            foreach ($transactions as $transaction) {
                $category = [
                    'category_name' => $transaction->category_name,
                    'transaction_count' => $transaction->transaction_count,
                    'total_amount' => $transaction->total_amount
                ];

                if ($transaction->category_type === 'Income') {
                    $transactionData['income'][] = $category;
                } else {
                    $transactionData['outcome'][] = $category;
                }
            }

            dd($transactionData);
        } else {
            $transactionData = null;
        }
        return view('user.report.index',
            [
                'wallets' => $wallets,
                'months' => $months,
                'years' => $years,
                'transactions' => $transactionData
            ]
        );
    }
}
