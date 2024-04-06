<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
   public function storeIncome(Request $request, $id)
   {
       $validate = [
           'name' => 'required',
           'amount' => 'required',
           'category' => 'required',
           'date' => 'required',
       ];

       $request->validate($validate);

       try {
           $transaction = new Transaction();
           $transaction->name = $request->name;
           $transaction->amount = $request->amount;
           $transaction->category_id = $request->category;
           $transaction->date = $request->date;
           $transaction->note = $request->note;
           $transaction->wallet_id = $id;
           $transaction->save();
       } catch (\Exception $e) {
           return redirect()->back()->with('error', $e->getMessage());
       }

       return redirect()->back()->with('success', 'Transaction created successfully');
   }

   public function storeOutcome(Request $request, $id)
   {
       $validate = [
           'name' => 'required',
           'amount' => 'required',
           'category' => 'required',
           'date' => 'required',
       ];
       $request->validate($validate);

       try {
           $transaction = new Transaction();
           $transaction->name = $request->name;
           $transaction->amount = $request->amount;
           $transaction->category_id = $request->category;
           $transaction->date = $request->date;
           $transaction->note = $request->note;
           $transaction->wallet_id = $id;
           $transaction->save();
       } catch (\Exception $e) {
           return redirect()->back()->with('error', $e->getMessage());
       }

       return redirect()->back()->with('success', 'Transaction created successfully');
   }

   public function update(Request $request, $id)
   {
       $validate = [
           'name' => 'required',
           'amount' => 'required',
           'category' => 'required',
           'date' => 'required',
       ];

       $request->validate($validate);

       try {
           $transaction = Transaction::find($id);
           $transaction->name = $request->name;
           $transaction->amount = $request->amount;
           $transaction->category_id = $request->category;
           $transaction->date = $request->date;
           $transaction->note = $request->note;
           $transaction->save();
       } catch (\Exception $e) {
           return redirect()->back()->with('error', $e->getMessage());
       }

       return redirect()->back()->with('success', 'Transaction Updated Successfully');

   }

   public function destroy($id)
   {
       try {
           $transaction = Transaction::find($id);
           $transaction->delete();
       } catch (\Exception $e) {
           return redirect()->back()->with('error', $e->getMessage());
       }

       return redirect()->back()->with('success', 'Transaction Deleted Successfully');
   }
}
