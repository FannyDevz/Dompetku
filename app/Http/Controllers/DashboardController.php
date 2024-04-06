<?php

namespace App\Http\Controllers;

use App\Helpers\ColorHelper;
use App\Helpers\IconHelper;
use App\Models\Wallet;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request){
        return redirect()->route('wallet.index');
    }
}
