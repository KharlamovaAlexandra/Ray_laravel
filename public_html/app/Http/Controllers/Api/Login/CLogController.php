<?php

namespace App\Http\Controllers\Api\Login;

use App\Citizen;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class CLogController extends Controller
{
    public function auth(Request $request)
    {
        $input = $request->all();
        $email['email'] = $input['email'];
        $password = $input['password'];
        
        
        $usr= User::where('email',$email)->get();
        foreach ($usr as $us) {
            $inf['id'] = $us->id;
            $password2 = $us->password;
            $inf['email'] = $us->email;
            $inf['type'] = $us->type;
            $inf['description'] = $us->description;
            $inf['data_create_user'] = $us->created_at;
        }
        $cit = Citizen::where('id',$inf['id'])->get();
        foreach ($cit as $ci) {
            $inf['namу'] = $ci->name;
            $inf['f_name'] = $ci->inn;
            $inf['o_name'] = $ci->adress;
            $inf['city'] = $ci->tel;
        }




        $otvet='пароль неверный';
        
       // if (Auth::attempt(array('email' =>  $email, 'password' => $password)))
       // {
      //          	 return $this->sendResponse($inf,'Вы вошли.');
       // }

        if (Hash::check($password, $password2))
        {
        	 return $this->sendResponse($inf,'Вы вошли.');
        }
        else{ return $this->sendResponse($password,'пароль неверный.');}
    }

    public function sendResponse($result, $message)
    {
        $response = [
            'success' => true,
            'data'    => $result,
            'message' => $message,
        ];
        return response()->json($response, 200);
    }
}
