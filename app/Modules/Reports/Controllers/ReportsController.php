<?php

namespace App\Modules\Reports\Controllers;

use App\Modules\Reports\Contracts\IReports;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Facades\JWTAuth;

class ReportsController extends Controller{
    
    protected $IReports ;

    public function __construct(IReports $IReports){
        $this->IReports = $IReports;
    }

    public function getReports(){
        $results = $this->IReports->getReports();
        return response()->json([
            "success"=>true,
            "data" => $results
        ]);
    }
    public function register(Request $request)
    {

        Log::info($request);
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);

        if($validator->fails()){
                return response()->json($validator->errors()->toJson(),400);
        }

        // $user = User::create([
        //     'name' => $request->get('name'),
        //     'email' => $request->get('email'),
        //     'password' => Hash::make($request->get('password')),
        // ]);
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->get('password'));
        $user->save();

        // [
        //     'name' => $request->get('name'),
        //     'email' => $request->get('email'),
        //     'password' => Hash::make($request->get('password')),
        // ]

        $token = JWTAuth::fromUser($user);

        return response()->json(compact('user','token'),201);
    }

}


?>