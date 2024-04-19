<?php

namespace App\Http\Controllers;

use App\Helpers\Helper;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CategoryController extends Controller
{
    public function incomeIndex(Request $request)
    {
        $results = Category::where('type', 'Income')->where('user_id', Auth::user()->id);
        $results = Helper::pagination( $results, $request , 10);
        return view('user.category.income' , ['results' => $results]);
    }
    public function outcomeIndex(Request $request)
    {
        $results = Category::where('type', 'Outcome')->where('user_id', Auth::user()->id);
        $results = Helper::pagination( $results, $request , 10);
        return view('user.category.outcome' , ['results' => $results]);
    }

    public function incomeStore(Request $request){
        $request->validate([
            'name' => 'required',
        ]);

        try{
            $category = new Category();
            $category->name = $request->name;
            $category->user_id = Auth::user()->id;
            $category->description = $request->description;
            $category->type = "Income";
            $category->save();
        } catch (\Exception $exception){
            return redirect()->back()->with('error', $exception->getMessage());
        }

        return redirect()->back()->with('success', 'Category created successfully');
    }
    public function outcomeStore(Request $request){
        $request->validate([
            'name' => 'required',
        ]);

        try {
            $category = new Category();
            $category->name = $request->name;
            $category->user_id = Auth::user()->id;
            $category->description = $request->description;
            $category->type = "Outcome";
            $category->save();
        } catch (\Exception $exception){
            return redirect()->back()->with('error', $exception->getMessage());
        }
        return redirect()->back()->with('success', 'Category created successfully');
    }

    public function incomeUpdate(Request $request, $id){

        $request->validate([
            'name' => 'required',
        ]);

        try{
            $category = Category::find($id);
            $category->name = $request->name;
            $category->description = $request->description;
            $category->type = "Income";
            $category->save();
        } catch (\Exception $exception){
            return redirect()->back()->with('error', $exception->getMessage());
        }
        return redirect()->back()->with('success', 'Category updated successfully');
    }

    public function outcomeUpdate(Request $request, $id){
        $request->validate([
            'name' => 'required',
        ]);

        try{
            $category = Category::find($id);
            $category->name = $request->name;
            $category->description = $request->description;
            $category->type = "Outcome";
            $category->save();
        } catch (\Exception $exception){
            return redirect()->back()->with('error', $exception->getMessage());
        }
        return redirect()->back()->with('success', 'Category updated successfully');
    }

    public function incomeDelete($id){
        $category = Category::find($id);
        $category->delete();
        return redirect()->back()->with('success', 'Category deleted successfully');
    }

    public function outcomeDelete($id){
        $category = Category::find($id);
        $category->delete();
        return redirect()->back()->with('success', 'Category deleted successfully');
    }
}
