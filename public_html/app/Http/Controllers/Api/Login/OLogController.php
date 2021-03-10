<?php

namespace App\Http\Controllers\Api\Login;

use App\Http\Controllers\Controller;
use App\Organization;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class OLogController extends Controller
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
        $org = Organization::where('id',$inf['id'])->get();
        foreach ($org as $or) {
            $inf['name'] = $or->name;
            $inf['inn'] = $or->inn;
            $inf['adress'] = $or->adress;
            $inf['tel'] = $or->tel;
            $inf['type_active'] = $or->type_active;
            $inf['location'] = $or->location;

        }

        $otvet='пароль неверный';

        if (Hash::check($password, $password2))
        {
            return $this->sendResponse($inf,'Вы вошли.');
        }
        else{ return $this->sendResponse($otvet,'пароль неверный.');}
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
