<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
// use Tymon\JWTAuth\Facades\JWTAuth;
use App\Models\User;
use App\Models\Customer;
// use Tymon\JWTAuth\Exceptions\JWTException;

class UserController extends Controller
{
    public function __construct(){
        $this->middleware('auth:api', [
            'except' => ['create_customer']
        ]);
    }

    public function create_customer(Request $request){
        $customer = [
                'name' => $request->input('name'),
                'username' => $request->input('username'),
                'password' => bcrypt($request->input('password')),
                'role' => $request->input('role'),
                'image' => $request->input('image'),
                'id_card' => $request->input('id_card'),
                // 'birth_date' => $request->input('birth_date'),
                'tel' => $request->input('tel'),
                'address' => $request->input('address'),
        ];
        $user_create = User::create($customer);
        return "success";
    }

    public function create_user(Request $request){
        $user = [
            'name' => $request->input('name'),
            'username' => $request->input('username'),
            'password' => bcrypt($request->input('password')),
            'role' => $request->input('role'),
            'image' => $request->input('image')
        ];
        $user_create = User::create($user);
        return "success";
    }

    public function all_users(Request $request){
        $users = DB::table('users')
                ->where('role', '!=', 'Admin')
                ->get();
        return response()->json($users);
    }

    public function get_user_by_id($id){
        $users = DB::table('users')
                ->where('id', '=', $id)
                ->get();
        return response()->json($users);
    }
}