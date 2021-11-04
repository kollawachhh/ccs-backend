<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Models\Requests;
use Tymon\JWTAuth\Facades\JWTAuth;

class RequestController extends Controller
{
    public function __construct(){
        $this->middleware('auth:api');
    }

    public function create_request(Request $request){
        $user = JWTAuth::user();
        $request = [
                'user_id' => $user->id,
                'type' => $request->input('type'),
                'project_name' => $request->input('project_name'),
                'appointment' => $request->input('appointment'),
                'status' => $request->input('status'),
                'cover_sheet' => $request->input('cover_sheet'),
                'fee_receipt' => $request->input('fee_receipt'),
                'contract' => $request->input('contract'),
                'construction_permit' => $request->input('construction_permit'),
                'title_deed' => $request->input('title_deed'),
                'map' => $request->input('map'),
                'plan' => $request->input('plan'),
        ];
        $request_create = Requests::create($request);
        return "success";
    }

    public function all_requests_by_id($id){
        $requests = DB::table('requests')
                ->where('user_id', '=', $id)
                ->get();

        return response()->json($requests);
    }

    public function request_detail_by_id($id){
        $request = Requests::with('user')
                   ->where('id', '=', $id)
                   ->get();
        return $request;
    }

    public function all_waiting_request(){
        $user = JWTAuth::user();
        $raw = "select *, requests.id, users.id as user_id, users.name, requests.type, requests.status from requests inner join users on requests.user_id = users.id where status in ('Waiting approve', 'Explore required', 'Exploring')";
        $requests = DB::select(DB::raw($raw));
        return response()->json($requests);
    }

    public function update_status(Request $request, $id){
        $requests = Requests::findOrFail($id);
        $requests->status = $request->input('status');
        $requests->value = $request->input('value');
        $requests->save();
        
        return "update success";
    }

    public function appointment(Request $request, $id){
        $requests = Requests::findOrFail($id);
        $requests->appointment = $request->input('appointment');
        $requests->status = $request->input('status');
        $requests->save();
        
        return "update success";
    }

    public function all_appointed(Request $request){
        // $user = JWTAuth::user();
        // $raw = "select requests.appointment from requests";
        // $requests = DB::select(DB::raw($raw));
        DB::table('requests')
            ->get();
        return response()->json($requests);
    }
}