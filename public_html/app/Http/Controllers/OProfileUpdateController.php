<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Api\Auth\BaseController as BaseController;
use App\Organization;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class OProfileUpdateController extends BaseController
{
 
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
    }
    public function UpdateAdress(Request $request){
        $id = $request->id;
        $address = $request->adress;
        $org=Organization::find($id);
        $org->adress = ($address);
        $org->save();
    }
    public function UpdateTelephone(Request $request){
        $id = $request->id;
        $tel = $request->tel;
        $org=Organization::find($id);
        $org->tel = ($tel);
        $org->save();
        return $this->sendResponse('You have unsuccessfully update telephone.', 'GOD');
    }
    public function UpdateLocation(Request $request){
        $id = $request->id;
        $loc = $request->location;
        $org=Organization::find($id);
        $org->location = ($loc);
        $org->save();
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
            return $this->sendResponse('You have successfully upload image.', 'OK');
        else:
            {
                return $this->sendResponse('You have unsuccessfully update image.', 'BAD');
            }
        endif;
    }
}
