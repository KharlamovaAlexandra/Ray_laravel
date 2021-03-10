<?php

namespace App\Http\Controllers;

use App\Organization;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use function MongoDB\BSON\toJSON;


class ImageUploadController extends Controller
{
    public function sendResponse($result, $message)
    {
        $response = [
            'success' => true,
            'data'    => $result,
            'message' => $message,
        ];
        return response()->json($response, 200);
    }

    public function imageUploadPost(Request $request)
    {
        /*        $request->validate([
                    'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                ]);*/

        $hash = $request->hash;
        $id = $request->id;
        $extension = $request->extension;
        $imageName = time() . '.' . $extension;

        $user = User::find($id);
        $user->picture = ($imageName);
        $user->save();
        if ($img = base64_decode($hash)):
            //$request->image->move(public_path('images'), $imageName);
            Storage::disk('local')->put($imageName, $img, 'public');
            return $this->sendResponse('You have successfully upload image.', 'OK');
            else:
                {
                    return $this->sendResponse('You have unsuccessfully upload image.', 'BAD');
                }
            endif;
    }
}
