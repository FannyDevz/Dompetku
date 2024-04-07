<?php

namespace App\Http\Controllers;

use App\Helpers\ColorHelper;
use App\Helpers\IconHelper;
use App\Models\Wallet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index(Request $request){
        if (Auth::user()){
            return redirect()->route('wallet.index');
        };

        return redirect()->route('login');
    }
}
