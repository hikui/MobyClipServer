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
            'user_hash' => 'required',
        ]);
        
        // The store path should exist because it's checked in the AppServiceProvider
        $storePath = env('IMAGE_STORE_PATH');
        $file = $request->file('photo');
        if($file->isValid()) {
            // 1. save file
            $extension = $file->getClientOriginalExtension();
            $randFileName = uniqid().'.'.$extension;
            $file->move($storePath, $randFileName);
            // 2. find user
            $user = User::where('hash',$request->input('user_hash'))->first(); 
            // 3. Create a new record
            $record = new FishRecord();
            $record->user()->associate($user);
            $record->weight = 0;
            $record->length = 0;

            // 4. Fish recognition
            $fishType = FishType::firstOrCreate(['name' => 'Snapper']);
            $record->fishType()->associate($fishType);
            $record->save();
            return $record; 
        } else {
            throw new Exception("Failed to upload file.");
        }
        
        return "You won't see this";
    }
}