<?php

namespace App\Http\Controllers;

use mysql_xdevapi\Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use app\Location;

class locationController extends Controller
{


    public function ajaxLocationRequestGet(){

        $gLocations =  DB::table('locations')
            ->select('*')
            ->get();
        return response()->json($gLocations);

    }
    
    public function ajaxLocationRequestPost(Request $request){
        $response = array(
            'status' => 'success',
            'msg' => $request->message,
        );
        
        DB::table('locations')->insert(
            ['title' => $request->title, 'description' => $request->description, 'lng' => $request->lng, 'lat' => $request->lat, 'created_at' =>date('Y-m-d H:i:s'), 'updated_at' =>date('Y-m-d H:i:s') ]
        );
        return response()->json($response);
    }

    public function ajaxUpdateLocationRequestPost(Request $request){
        $response = array(
            'status' => 'success',
            'msg' => $request->message,
        );
        DB::table('locations')
            ->where('id', $request->id)
            ->update(['title' => $request->title, 'description' => $request->description, 'updated_at' =>date('Y-m-d H:i:s')]);
        return response()->json($response);
    }

    public function ajaxsearchLocationRequestPost(Request $request){
        $gLocations =  DB::table('locations')
            ->select('*')
            ->where('title', $request->title)
            ->get();
        return response()->json($gLocations);
    }
}
