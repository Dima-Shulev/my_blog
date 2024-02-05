<?php

use App\Models\Article;
use App\Models\Category;
use App\Models\Page;
use App\Models\Review;
use App\Models\User;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Hash;

if(! function_exists('create_category')) {
    function create_category($result){
        if($result['content'] == null){
            $result['content'] = "null";
        }
        if($result){
            Category::query()->create([
                'name' => $result['name'],
                'content' => $result['content'],
                'metaKey' => $result['metaKey'],
                'metaDescription' => $result['metaDescription'],
                'created_at' => new Carbon($result['created_at']),
                'user_id' => 1,
                'active' => $result['checkPublic'],
                'module_name' => $result['module'],
                'url' => url_translit($result['name'])
            ]);

            return redirect()->route('admin.categories')->with('success','create_category');
        }else{
            return redirect()->route('admin.categories.edit')->with('error','error_create_category');
        }
    }
}

if(! function_exists('update_category')) {
    function update_category($result,$id){
        if($result){
            $update = Category::find((int)$id);
            $update->name = $result['name'];
            $update->content = $result['content'];
            $update->metaKey = $result['metaKey'];
            $update->metaDescription = $result['metaDescription'];
            $update->created_at = new Carbon($result['created_at']);
            $update->user_id = 1;
            $update->active = $result['checkPublic'];
            $update->module_name = $result['module'];
            $update->url = url_translit($result['name']);
            $update->save();
            session()->forget('session_admin');
            $session = session();
            $session->put('session_admin','session_auth');
            $session->put('name',$result['name']);
            return redirect()->route('admin.categories')->with('success','update_category');
        }else{
            return redirect()->route('admin.categories.edit')->with('error','error_update_category');
        }
    }
}

if(! function_exists('create_article')){
    function create_article($result){
        if($result){
            Article::query()->create([
                'title' => $result['title'],
                'content' => $result['content'],
                'metaKey' => $result['metaKey'],
                'metaDescription' => $result['metaDescription'],
                'created_at' => new Carbon($result['created_at']),
                'category_id' => $result['selectCategory'],
                'user_id' => 1,
                'active' => $result['checkPublic'],
                'module_name' => $result['module'],
                'url' => url_translit($result['title'])
            ]);

            return redirect()->route('admin.articles')->with('success','create_article');
        }else{
            return redirect()->route('admin.articles.edit')->with('error','error_create_article');
        }
    }
}

if(! function_exists('update_article')){
    function update_article($result,$id){
        if($result){
            $update = Article::find((int)$id);
            $update->title = $result['title'];
            $update->content = $result['content'];
            $update->metaKey = $result['metaKey'];
            $update->metaDescription = $result['metaDescription'];
            $update->created_at = new Carbon($result['created_at']);
            $update->user_id = 1;
            $update->category_id = $result['selectCategory'];
            $update->module_name = $result['module'];
            $update->active = $result['checkPublic'];
            $update->url = url_translit($result['title']);
            $update->save();

            session()->forget('session_admin');
            $session = session();
            $session->put('session_admin','session_auth');
            $session->put('title',$result['title']);

            return redirect()->route('admin.articles')->with('success','update_article');
        }else{
            return redirect()->route('admin.articles.edit')->with('error','error_update_article');
        }
    }
}

if(! function_exists('create_page')) {
    function create_page($result){
        if($result){
            Page::query()->create([
                'name' => $result['name'],
                'content' => $result['content'],
                'metaKey' => $result['metaKey'],
                'metaDescription' => $result['metaDescription'],
                'created_at' => new Carbon($result['created_at']),
                'user_id' => 1,
                'active' => $result['checkPublic'],
                'module_name' => $result['module'],
                'url' => url_translit($result['name'])
            ]);

            return redirect()->route('admin.pages')->with('success','create_page');
        }else{
            return redirect()->route('admin.pages.edit')->with('error','error_create_pages');
        }
    }
}


if(! function_exists('update_page')) {
    function update_page($result,$id){

        if($result){
            $update = Page::find((int)$id);
            $update->name = $result['name'];
            $update->content = $result['content'];
            $update->metaKey = $result['metaKey'];
            $update->metaDescription = $result['metaDescription'];
            $update->created_at = new Carbon($result['created_at']);
            $update->user_id = 1;
            $update->module_name = $result['module'];
            $update->active = $result['checkPublic'];
            $update->url = url_translit($result['name']);
            $update->save();

            session()->forget('session_admin');
            $session = session();
            $session->put('session_admin','session_auth');
            $session->put('name',$result['name']);

            return redirect()->route('admin.pages')->with('success','update_page');
        }else{
            return redirect()->route('admin.pages.edit')->with('error','error_update_page');
        }
    }
}

if(! function_exists('update_review_admin')) {
    function update_review_admin($id,$request,$result){
        $idReview = Review::find((int)$id);
        if($idReview){
            if(!$request['subscription']){
                $result['subscription'] = 0;
            }else{
                $result['subscription'] = 1;
            }
            $idReview->title = $result['title'];
            $idReview->content = $result['content'];
            $idReview->status = $result['subscription'];
            $idReview->save();
        }
        return redirect()->route('admin.reviews');
    }
}


if(! function_exists('check_entrance_room')) {
    function check_entrance_room($checkName,$checkVal){
        if($checkName){
            if(Hash::check($checkVal['password'],$checkName->password)){
                session_user($checkName,'session_admin','avatar');

                return redirect()->route('admin.room')->with('success','entrance');
            }else{
                return redirect()->route('admin')->with('error','error_pass');
            }
        }else{
            return redirect()->route('admin')->with('errors','error_user_name');
        }
    }
}

if(! function_exists('check_public_user')) {
    function check_public_user($request,$result){
        if(!isset($request->checkPublic)){
            $result['checkPublic'] = false;
        }else if($request->checkPublic == "on"){
            $result['checkPublic'] = true;
        }
        return $result['checkPublic'];
    }
}

if(! function_exists('update_user')) {
    function update_user($id,$result){
        if($result){
            $query = User::find((int)$id);
            $query->name = $result['name'];
            $query->email = $result['email'];
            $query->password = Hash::make($result['password']);
            $query->created_at = $result['created_at'];
            $query->balance = $result['balance'];
            $query->status = $result['status'];
            $query->active = $result['checkPublic'];
            $query->save();

            session()->forget('session_admin');
            $session = session();
            $session->put('session_admin','session_auth');
            $session->put('id',$id);
            $session->put('name',$result['name']);
            $session->put('email',$result['email']);
            $session->put('balance',$result['balance']);

            return redirect()->route('admin.users')->with('success','update_user');
        }else{
            return redirect()->route('admin.users.edit')->with('error','error_user');
        }
    }
}
