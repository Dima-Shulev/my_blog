<?php

use App\Models\Review;
use App\Models\User;
use Illuminate\Http\File;
use Illuminate\Support\Facades\Storage;

if(! function_exists('create_review')){
    function create_review($checkUser,$result){
        if($checkUser){
            Review::query()->create([
                'title' => $result['title'],
                'content' => $result['content'],
                'user_id' => $checkUser->id,
                'created_at' => date('Y-m-d H:i:s'),
                'status' => true,
            ]);
        }
    }
}

if(! function_exists('update_user_room')){
    function update_user_room($request,$id){
        if($request){
            $query = User::find((int)$id);
            $query->name = $request->name;
            $query->email = $request->email;
            if(!empty($request->avatar)){
                $image = Storage::disk('avatar')->putFile('',new File($request->avatar));
                $linkImage = asset("storage/avatar/{$image}");
            }else{
                $image ='unknown.webp';
                $linkImage = asset("storage/avatar/{$image}");
            }
            session_user($query, 'session_user',$linkImage);
            $query->updated_at = date('Y-m-d H:i:s',time());
            $query->avatar = $image;
            $query->save();
            return redirect()->route('auth.room')->with('success','update_user');
        }else{
            return redirect()->route('auth.room.edit')->with('error','error_user');
        }
    }
}
