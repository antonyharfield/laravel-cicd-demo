<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Hospital;

class HospitalController extends Controller
{
    public function index() {
        $hospitals = DB::select('select * from hospitals');
        return response()->json($hospitals);
    }

    public function show($id) {
        $hospitals = DB::select('select * from hospitals where id = ?', [$id]);
        if (sizeof($hospitals) == 0) {
            return response('Not found', 404);
        }
        return response()->json($hospitals[0]);

        // $hospital = Hospital::find($id);
        // if ($hospital == null) {
        //     return response('Not found', 404);
        // }
        // return response()->json($hospital);
    }

    public function store(Request $request) {
        $name = $request->input('name');
        $address = $request->input('address');
        $numberOfBeds = $request->input('numberOfBeds');
        $numberOfDoctors = $request->input('numberOfDoctors');
        $id = DB::table('hospitals')->insertGetId([
            'name' => $name, 
            'address' => $address, 
            'numberOfBeds' => $numberOfBeds, 
            'numberOfDoctors' => $numberOfDoctors
        ]);
        // $hospital = new Hospital;
        // $hospital->name = $request->input('name');
        // $hospital->address = $request->input('address');
        // $hospital->numberOfBeds = $request->input('numberOfBeds');
        // $hospital->numberOfDoctors = $request->input('numberOfDoctors');
        // $hospital->save();
        // $id = $hospital->id;
        return response()->json(null, 201, ['Location' => "/hospitals/$id"]);
    }

}
