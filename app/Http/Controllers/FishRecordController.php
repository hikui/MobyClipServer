<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\FishRecord as FishRecord;
use App\User as User;
use App\FishType as FishType;

class FishRecordController extends Controller {
    
    public function store(Request $request) {
        $this->validate($request, [
            'photo' => 'required|image',
            'user_hash' => 'required|string',
            'length' => 'required|numeric',
            'weight' => 'required|numeric',
            'lat' => 'nullable|numeric',
            'long' => 'nullable|numeric',
            'place' => 'nullable|string',
        ]);
        
        // The store path should exist because it's checked in the AppServiceProvider
        $storePath = env('IMAGE_STORE_PATH');
        $file = $request->file('photo');

        // 1. save file
        $extension = $file->getClientOriginalExtension();
        $randFileName = uniqid().'.'.$extension;
        $file->move($storePath, $randFileName);
        // 2. find user
        $user = User::where('hash',$request->input('user_hash'))->first(); 
        // 3. Create a new record
        $lat = $request->input("lat");
        $long = $request->input("long");
        $place = $request->input("place");
        $record = new FishRecord();
        $record->user()->associate($user);
        $record->weight = $request->input("weight");
        $record->length = $request->input("length");
        $record->latitude = $lat;
        $record->longitude = $long;
        $record->place = $place;
        // 4. Fish recognition
        $fishType = FishType::firstOrCreate(['name' => 'Snapper']);
        $record->fishType()->associate($fishType);
        $record->save();
        return $record; 
    }
}