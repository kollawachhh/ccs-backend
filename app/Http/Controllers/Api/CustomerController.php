<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class CustomerController extends Controller
{
    public function __construct(){
        $this->middleware('auth:api');
    }

    public function all_customers(Request $request){
        $customers = DB::table('users')
                ->where('role', '=', 'Customer')
                ->get();
        return response()->json($customers);
    }
}