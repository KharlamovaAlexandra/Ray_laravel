<?php

namespace App\Http\Controllers\Api\Profile;

use App\Citizen;
use App\Http\Controllers\Controller;
use App\Organization;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class GetProfileController extends Controller
{
    public function citizen(Request $request){

        $input = $request->all();
        $id=$input['id'];
        $user=User::where('id',$id)->get();
        $U['id']=$id;
        foreach ($user as $us) {
            $U['type']=$us->type;
            $U['description']=$us->description;
            $U['email']=$us->email;
            if (Storage::disk('local')->has($us->picture)) {
                $ex=Storage::disk('local')->get($us->picture);
                $binary=base64_encode($ex);
                $U['picture'] = $binary;}
            else $U['picture'] ='null';
        }
        if ($U['type']=='citizen') {
            $citizen=Citizen::where('id',$id)->get();
            foreach ($citizen as $cit) {
                $U['city']=$cit->city;
                $U['name']=$cit->name;
                $U['f_name']=$cit->f_name;
                $U['o_name']=$cit->o_name;
            }
            return $this->sendResponse($U,'OK');
        }
        else{
            return $this->sendResponse('этот аккаунт не принадлежит гражданину', 'BAD');
        }


    }
    public function organization(Request $request){
        $input = $request->all();
        $id=$input['id'];
        $user=User::where('id',$id)->get();
        $U['id']=$id;
        foreach ($user as $us) {
            $U['type']=$us->type;
            $U['description']=$us->description;
            $U['email']=$us->email;
            if (Storage::disk('local')->has($us->picture)) {
                $ex=Storage::disk('local')->get($us->picture);
                $binary=base64_encode($ex);
                $U['picture'] = $binary;}
            else $U['picture'] ='null';
        }
        if ($U['type']=='organization') {
            $org = Organization::where('id', $id)->get();
            foreach ($org as $or) {
                $U['inn'] = $or->inn;
                $U['name'] = $or->name;
                $U['adress'] = $or->adress;
                $U['tel'] = $or->tel;
                $U['type_active'] = $or->type_active;
                $U['location'] = $or->location;
            }

            return $this->sendResponse($U, 'OK');
        }
        else{
            return $this->sendResponse('этот аккаунт не принадлежит организации', 'BAD');
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
