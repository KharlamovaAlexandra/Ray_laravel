<?php

namespace App\Http\Controllers\Api\LentaOrg;

use App\Organization;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\DB;

class LentaController extends BaseController
{
    public function lenta(Request $request){
        $input = $request->all();
        $count = Organization::orderBy('id', 'desc')->take(1)->get();
        $count = $count[0]->id;
        $org=Organization::orderBy('id', 'desc')->get();
        $organizations = array();
        $col = (int)$input['offset'];
        $offset = $col+5;
        $rasch = $count - $col;
        $i = 0;

        foreach ($org as $or) {
            $organization =[];
            if (($or->id <= $rasch) and ($i<5))
            {
                $organization['id'] = $or->id;
                $organization['name'] = $or->name;
                $organization['type_active'] = $or->type_active;
                $i = $i+1;
            }
            array_push($organizations, $organization );
         
        }

        array_push($organizations, $offset);
        return response()->json($organizations, 200);
    }
}
