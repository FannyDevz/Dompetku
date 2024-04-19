<?php

namespace App\Http\Controllers;

use App\Helpers\ColorHelper;
use App\Helpers\Helper;
use App\Helpers\IconHelper;
use App\Models\Category;
use App\Models\Wallet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class WalletController extends Controller
{
    public function index(Request $request){
        $results = Wallet::withoutTrashed()->where('user_id', Auth::user()->id)->get();

        foreach ($results as $wallet) {
            $transactions = DB::table('transactions')->where('wallet_id', $wallet->id)
                ->leftJoin('categories', 'categories.id', '=', 'transactions.category_id')
                ->whereNull('transactions.deleted_at')
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

        $check = Wallet::onlyTrashed()->where('user_id', Auth()->user()->id);
        if($check){
            return redirect()->back()->with('error', 'Wallet '. $request->name . ' Already Exists in Trash Please Delete or Restore First');
        }
        try {
            $wallet = new Wallet();
            $wallet->name = $request->name;
            $wallet->user_id = Auth()->user()->id;
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
            $wallet = Wallet::withoutTrashed()->where('user_id', Auth::user()->id)->find($id);
            $wallet->delete();
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', $th->getMessage());
        }
        return redirect()->route('wallet.index')->with('success', 'Wallet Deleted Successfully');
    }

    public function transactions($walletId, Request $request){
        $wallet = Wallet::withoutTrashed()->where('user_id', Auth::user()->id)->find($walletId);

        $transactions = DB::table('transactions')->where('wallet_id', $walletId)
            ->leftJoin('categories', 'categories.id', '=', 'transactions.category_id')
            ->whereNull('transactions.deleted_at')
            ->select('transactions.*', 'categories.id as category_id', 'categories.name as category_name', 'categories.type as category_type');
        $transactions = $this->filtering( $transactions, $request );

//        $transactions = $transactions->get();
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

        $categories_outcome = Category::withoutTrashed()->where('type' , 'Outcome')->where('user_id' , Auth::user()->id)->get();
        $categories_income = Category::withoutTrashed()->where('type' , 'Income')->where('user_id' , Auth::user()->id)->get();

        return view('user.wallet.transactions' , [
            'wallet' => $wallet,
            'transactions' => $transactions,
            'categories_income' => $categories_income,
            'categories_outcome' => $categories_outcome
        ]);

    }


    public function recycle_index(Request $request){
        $results = Wallet::onlyTrashed()->where('user_id', Auth::user()->id)->get();

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
        $wallet = Wallet::onlyTrashed()->where('user_id', Auth::user()->id)->find($walletId);

        $transactions = DB::table('transactions')->where('wallet_id', $walletId)
            ->leftJoin('categories', 'categories.id', '=', 'transactions.category_id')
            ->select('transactions.*', 'categories.name as category_name', 'categories.type as category_type');
        $transactions = $this->filtering( $transactions, $request );

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
        $wallet = Wallet::onlyTrashed()->where('user_id', Auth::user()->id)->find($id);
        $wallet->restore();
        return redirect()->route('wallet.index')->with('success', 'Wallet Restored Successfully');
    }

    public function recycle_delete($id){
        $wallet = Wallet::onlyTrashed()->where('user_id', Auth::user()->id)->find($id);
        $wallet->forceDelete();
        return redirect()->route('recycle-bin.wallet.index')->with('success', 'Wallet Permanently Deleted Successfully');
    }

    private function filtering($transactions, $request){

        if ($request->get('name')) {
            $transactions = $transactions->where('transactions.name','like','%'.$request->get('name').'%');
        }
        if ($request->get('note')){
            $transactions = $transactions->where('transactions.note','like','%'.$request->get('note').'%');
        }
        if ($request->get('date_start') || $request->get('date_end')) {
            if ($request->get('date_start')) {
                $transactions = $transactions->whereDate('transactions.date', '>=', $request->get('date_start'));
            }
            if ($request->get('date_end')) {
                $transactions = $transactions->whereDate('transactions.date', '<=', $request->get('date_end'));
            }
        }
        if ($request->get('total_start') || $request->get('total_end')) {
            if ($request->get('total_start')) {
                $transactions = $transactions->where('transactions.amount', '>=', $request->get('total_start'));
            }
            if ($request->get('total_end')) {
                $transactions = $transactions->where('transactions.amount', '<=', $request->get('total_end'));
            }
        }
        if ($request->get('type')) {
            if ($request->get('type') === 'income') {
                $transactions = $transactions->where('categories.type', 'Income');
                if ($request->get('income') != '') {
                    $transactions = $transactions->where('category_id', $request->get('income'));
                }
            } elseif ($request->get('type') === 'outcome') {
                $transactions = $transactions->where('categories.type', 'Outcome');
                if ($request->get('outcome') != '') {
                    $transactions = $transactions->where('category_id', $request->get('outcome'));
                }
            }
        }

        if ($request->has('sort')) {
            $sort = $request->input('sort');
            $filter = $request->input('by');
            $transactions->orderBy("transactions.{$filter}", $sort);
        } else {
            $transactions->orderBy("created_at", 'desc');
        }

        return $transactions;
    }
}
