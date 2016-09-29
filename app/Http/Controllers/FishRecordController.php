<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
            // 2. create a FishRecord object
            // 3. Recognize fish
            // 4. return result
            return ['msg'=>"success"];
        } else {
            throw new Exception("Failed to upload file.");
        }
        
        return "You won't see this";
    }
}