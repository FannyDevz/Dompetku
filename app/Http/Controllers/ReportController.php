<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\Wallet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    public function index(Request $request)
    {
        $wallets = Wallet::select('id', 'name')->where('user_id', Auth::user()->id)->get();
        $months = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
        $years = Transaction::select(DB::raw('YEAR(date) as year'))->distinct()->pluck('year');

        $wallet_id = $request->get('wallet_id');
        if ($wallet_id) {
            $transactions = DB::table('transactions')
                ->select('categories.name as category_name', 'categories.type as category_type', DB::raw('count(*) as transaction_count'), DB::raw('sum(amount) as total_amount'))
                ->leftJoin('categories', 'categories.id', '=', 'transactions.category_id')
                ->whereNull('transactions.deleted_at')
                ->where('transactions.wallet_id', $wallet_id);

            if ($request->get('month') || $request->get('year')) {
                if ($request->get('year')) {
                    if ($request->get('year') != 'all') {
                        $transactions = $transactions->whereYear('date', $request->get('year'));
                    }
                }
                if ($request->get('month')) {
                    if ($request->get('month') != 'all') {
                        $transactions = $transactions->whereMonth('date', $request->get('month'));
                    }
                }
            }

            $transactions = $transactions->groupBy('categories.type', 'transactions.category_id', 'categories.name')
                ->get();


            $transactionData = [
                'income' => [],
                'outcome' => [],
                'total_income' => 0,
                'total_outcome' => 0,
                'total' => 0
            ];
            foreach ($transactions as $transaction) {
                $category = [
                    'category_name' => $transaction->category_name,
                    'transaction_count' => $transaction->transaction_count,
                    'total_amount' => $transaction->total_amount
                ];

                if ($transaction->category_type === 'Income') {
                    $transactionData['income'][] = $category;
                    $transactionData['total_income'] += $transaction->total_amount;
                } else {
                    $transactionData['outcome'][] = $category;
                    $transactionData['total_outcome'] += $transaction->total_amount;
                }
            }
            $transactionData['total'] = $transactionData['total_income'] - $transactionData['total_outcome'];
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
