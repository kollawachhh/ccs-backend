<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
 
 
class AdminController extends Controller
{
    public function __construct() {
        $this->middleware('auth:api');
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
 
    public function remove_user(Request $request){
        $user = User::find($request->input('id'));
        $user->delete();
 
        return "remove success";
    }
 
    public function get_user($id)
    {
        $user = User::findOrFail($id);
        return $user;
    }
 
    public function all_users(Request $request){
        $users = DB::table('users')
                ->where('role', '!=', 'Admin')
                ->get();
        return response()->json($users);
    }
}