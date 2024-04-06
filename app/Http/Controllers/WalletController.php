<?php

namespace App\Http\Controllers;

use App\Helpers\ColorHelper;
use App\Helpers\Helper;
use App\Helpers\IconHelper;
use App\Models\Category;
use App\Models\Wallet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class WalletController extends Controller
{
    public function index(Request $request){
        $results = Wallet::withoutTrashed()->get();

        foreach ($results as $wallet) {
            $transactions = DB::table('transactions')->where('wallet_id', $wallet->id)
                ->leftJoin('categories', 'categories.id', '=', 'transactions.category_id')
                ->select('transactions.*', 'categories.name as category_name', 'categories.type as category_type')->get();

            $totalIncome = 0;
            $totalOutcome = 0;

            foreach ($transactions as $transaction) {
                if ($transaction->category_type === 'Income') {
                    $totalIncome += $transaction->amount;
                } elseif ($transaction->category_type === 'Outcome') {
                    $totalOutcome += $transaction->amount;
                }
            }

            $wallet->totalIncome = $totalIncome;
            $wallet->totalOutcome = $totalOutcome;
            $wallet->totalBalance = $totalIncome - $totalOutcome;
        }
        return view('user.wallet.index' , [
            'results' => $results
        ]);
    }

    public function create(){
        $colors = ColorHelper::getAvailableColors();
        $icons = IconHelper::getAvailableIcons();
        return view('user.wallet.create' , [
            'colors' => $colors,
            'icons' => $icons
        ]);
    }

    public function store(Request $request){
        $validate = [
            'name' => 'required',
        ];

        $request->validate($validate);

        try {
            $wallet = new Wallet();
            $wallet->name = $request->name;
            $wallet->description = $request->description;
            $wallet->color = $request->color ? $request->color : 'green';
            $wallet->icon = $request->icon ? $request->icon : 'Activity';
            $wallet->save();
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', $th->getMessage());
        }
        return redirect()->route('wallet.index')->with('success', 'Wallet Created Successfully');
    }

    public function edit($id){
        $wallet = Wallet::withoutTrashed()->find($id);
        $colors = ColorHelper::getAvailableColors();
        $icons = IconHelper::getAvailableIcons();
        return view('user.wallet.edit' , [
            'wallet' => $wallet,
            'colors' => $colors,
            'icons' => $icons
        ]);
    }

    public function update(Request $request , $id){

        $validate = [
            'name' => 'required',
        ];

        $request->validate($validate);

        try {
            $wallet = Wallet::find($id);
            $wallet->name = $request->name;
            $wallet->description = $request->description;
            $wallet->color = $request->color ? $request->color : 'green';
            $wallet->icon = $request->icon ? $request->icon : 'Activity';
            $wallet->save();
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', $th->getMessage());
        }
        return redirect()->route('wallet.transactions' , $id)->with('success', 'Wallet Updated Successfully');
    }

    public function destroy($id){
        try {
            $wallet = Wallet::withoutTrashed()->find($id);
            $wallet->delete();
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', $th->getMessage());
        }
        return redirect()->route('wallet.index')->with('success', 'Wallet Deleted Successfully');
    }

    public function transactions($walletId, Request $request){
        $wallet = Wallet::withoutTrashed()->find($walletId);

        $transactions = DB::table('transactions')->where('wallet_id', $walletId)
            ->leftJoin('categories', 'categories.id', '=', 'transactions.category_id')
            ->select('transactions.*', 'categories.id as category_id', 'categories.name as category_name', 'categories.type as category_type');

        $transactions = Helper::pagination( $transactions, $request );
        $totalIncome = 0;
        $totalOutcome = 0;

        foreach ($transactions as $transaction) {
            if ($transaction->category_type === 'Income') {
                $totalIncome += $transaction->amount;
            } elseif ($transaction->category_type === 'Outcome') {
                $totalOutcome += $transaction->amount;
            }
        }

        $wallet->totalIncome = $totalIncome;
        $wallet->totalOutcome = $totalOutcome;
        $wallet->totalBalance = $totalIncome - $totalOutcome;

        $categories_outcome = Category::withoutTrashed()->where('type' , 'Outcome')->get();
        $categories_income = Category::withoutTrashed()->where('type' , 'Income')->get();

        return view('user.wallet.transactions' , [
            'wallet' => $wallet,
            'transactions' => $transactions,
            'categories_income' => $categories_income,
            'categories_outcome' => $categories_outcome
        ]);

    }


    public function recycle_index(Request $request){
        $results = Wallet::onlyTrashed()->get();

        foreach ($results as $wallet) {
            $transactions = DB::table('transactions')->where('wallet_id', $wallet->id)
                ->leftJoin('categories', 'categories.id', '=', 'transactions.category_id')
                ->select('transactions.*', 'categories.name as category_name', 'categories.type as category_type')->get();

            $totalIncome = 0;
            $totalOutcome = 0;

            foreach ($transactions as $transaction) {
                if ($transaction->category_type === 'Income') {
                    $totalIncome += $transaction->amount;
                } elseif ($transaction->category_type === 'Outcome') {
                    $totalOutcome += $transaction->amount;
                }
            }

            $wallet->totalIncome = $totalIncome;
            $wallet->totalOutcome = $totalOutcome;
            $wallet->totalBalance = $totalIncome - $totalOutcome;
        }
        return view('user.wallet.index' , [
            'results' => $results
        ]);
    }
    public function recycle_transactions($walletId , Request $request){
        $wallet = Wallet::onlyTrashed()->find($walletId);

        $transactions = DB::table('transactions')->where('wallet_id', $walletId)
            ->leftJoin('categories', 'categories.id', '=', 'transactions.category_id')
            ->select('transactions.*', 'categories.name as category_name', 'categories.type as category_type');

        $transactions = Helper::pagination( $transactions, $request );

        $totalIncome = 0;
        $totalOutcome = 0;

        foreach ($transactions as $transaction) {
            if ($transaction->category_type === 'Income') {
                $totalIncome += $transaction->amount;
            } elseif ($transaction->category_type === 'Outcome') {
                $totalOutcome += $transaction->amount;
            }
        }

        $wallet->totalIncome = $totalIncome;
        $wallet->totalOutcome = $totalOutcome;
        $wallet->totalBalance = $totalIncome - $totalOutcome;

        $categories_outcome = Category::withoutTrashed()->where('type' , 'Outcome')->get();
        $categories_income = Category::withoutTrashed()->where('type' , 'Income')->get();
        return view('user.wallet.transactions' , [
            'wallet' => $wallet,
            'transactions' => $transactions,
            'categories_income' => $categories_income,
            'categories_outcome' => $categories_outcome
        ]);

    }

    public function recycle_restore($id){
        $wallet = Wallet::onlyTrashed()->find($id);
        $wallet->restore();
        return redirect()->route('wallet.index')->with('success', 'Wallet Restored Successfully');
    }

    public function recycle_delete($id){
        $wallet = Wallet::onlyTrashed()->find($id);
        $wallet->forceDelete();
        return redirect()->route('recycle-bin.wallet.index')->with('success', 'Wallet Permanently Deleted Successfully');
    }
}
