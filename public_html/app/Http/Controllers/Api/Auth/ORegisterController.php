<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Organization;
use App\User;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;
use Laravel\Passport\Client;


use App\Http\Controllers\Api\Auth\BaseController as BaseController;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;


class ORegisterController extends BaseController
{
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'inn'=>'required',
            'email' => 'required|email',
            'password' => 'required',
            'c_password' => 'required|same:password',
        ]);
        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());
        }
        $input = $request->all();


        $us['type'] = 'organization';
        $us['email'] = $input['email'];
        $us['password'] = Hash::make($input['password']);
        $user = User::create($us);

        $org['id'] =$user->id;
        $org['inn'] =$input['inn'];
        $org['name'] = $input['name'];
        $organization = Organization::create($org);

        $success['token'] =  $user->createToken('MyApp')->accessToken;
        $success['name'] =  $organization->name;
        $success['inn'] =  $organization->inn;
        $success['id'] =  $user->id;
        $success['type'] =  $user->type;
        $success['email'] =  $user->email;
        return $this->sendResponse($success, 'User register successfully.');
    }
}
