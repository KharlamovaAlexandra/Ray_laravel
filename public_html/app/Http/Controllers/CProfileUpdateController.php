<?php

namespace App\Http\Controllers;

use App\Citizen;
use App\Http\Controllers\Api\Auth\BaseController as BaseController;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class CProfileUpdateController extends BaseController
{
    public function UpdateUserpic(Request $request){
        $hash = $request->hash;
        $id = $request->id;
        $extension = $request->extension;
        $imageName = time() . '.' . $extension;
        $path = User::find($id)->picture;
        $user = User::find($id);


        if ($img = base64_decode($hash)):
            $user->picture = ($imageName);
            $user->save();
            Storage::disk('local')->put($imageName, $img, 'public');
            Storage::disk('local')->delete($path);
            return $this->sendResponse('You have successfully update image.', 'OK');
        else:
            {
                return $this->sendResponse('You have unsuccessfully upload image.', 'BAD');
            }
        endif;
    }
    public function UpdateDescription(Request $request){
        $validatedData = Validator::make($request->all(), [
            'id' => 'required|string',
            'description' => 'required|string|max:1255',
        ]);
        if($validatedData->fails()){
            return $this->sendError('Validation Error.', $validatedData->errors());
        }
        $id = $request->id;
        $description = $request->description;
        $cit = User::find($id);
        $cit->description = ($description);
        $cit->save();
        return $this->sendResponse('You have unsuccessfully update description.', 'GOD');
        
    }
    public function UpdateCity(Request $request){
        $id = $request->id;
        $city = $request->city;
        $cit=Citizen::find($id);
        $cit->city = ($city);
        $cit->save();
    }
    public function UpdateName(Request $request){
        $id = $request->id;
        $name = $request->name;
        $cit=Citizen::find($id);
        $cit->name = ($name);
        $cit->save();
    }
    public function UpdateFName(Request $request){
        $id = $request->id;
        $fname = $request->fname;
        $cit=Citizen::find($id);
        $cit->f_name = ($fname);
        $cit->save();
    }
    public function UpdateOName(Request $request){
        $id = $request->id;
        $oname = $request->oname;
        $cit=Citizen::find($id);
        $cit->o_name = ($oname);
        $cit->save();
    }
    public function UpdateEmail(Request $request){

        $validatedData = Validator::make($request->all(), [
            'id' => 'required|string',
            'email' => 'required|string|max:50|unique:users,email|email',
        ]);
        if($validatedData->fails()){
            return $this->sendError('Validation Error.', $validatedData->errors());
        }
        if ($validatedData) {
            $id = $request->id;
            $email = $request->email;
            $cit = User::find($id);
            $cit->email = ($email);
            $cit->save();
        }
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
