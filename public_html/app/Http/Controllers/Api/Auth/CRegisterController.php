<?php

namespace App\Http\Controllers\Api\Auth;

use App\Citizen;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;
use Laravel\Passport\Client;


use App\Http\Controllers\Api\Auth\BaseController as BaseController;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class CRegisterController extends BaseController
{
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'f_name'=> 'required',
            'o_name'=> 'required',
            'email' => 'required|email',
            'password' => 'required',
            'c_password' => 'required|same:password',
        ]);
        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());
        }
        $input = $request->all();

        $us['type'] = 'citizen';
        $us['email'] = $input['email'];
        $us['password'] = Hash::make($input['password']);
        $user = User::create($us);

        $cit['id'] =$user->id;
        $cit['name'] =$input['name'];
        $cit['f_name'] =$input['f_name'];
        $cit['o_name'] = $input['o_name'];
        $citizen = Citizen::create($cit);


        $success['token'] =  $user->createToken('MyApp')->accessToken;
        $success['name'] =  $citizen->name;
        $success['f_name'] =  $citizen->f_name;
        $success['o_name'] =  $citizen->o_name;
        $success['id'] =  $user->id;
        $success['type'] =  $user->type;
        $success['email'] =  $user->email;
        return $this->sendResponse($success, 'User register successfully.');
    }
}
