<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ValidateCategory;
use App\Models\Category;
use App\Models\Module;
use Illuminate\Http\Request;


class CategoryController extends Controller
{
    public function index(Request $request){
        $categories = page_paginate(5,Category::class);
        return view('admin.categories.index',compact('categories'));
    }

    public function create(){
        $modules = Module::select(['id','name','active'])->orderBy('id','ASC')->get();
        return view('admin.categories.create',compact('modules'));
    }

    public function store(ValidateCategory $request){
        $result = $request->validated();
        $result['checkPublic'] = checkPublic($request,$result);
        return create_category($result);
    }

    public function edit($url){
        $modules = Module::select(['id','name','active'])->orderBy('id','ASC')->get();
        $categories = Category::select(['id','name','content','created_at','metaKey','metaDescription','active','user_id','url'])->where('url',$url)->first();
        return view('admin.categories.edit', compact('categories','url','modules'));
    }

    public function update($id, ValidateCategory $request){
        $result = $request->validated();
        $result['checkPublic'] = checkPublic($request,$result);
        return update_category($result,$id);
    }

    public function publicCategory($id,$active){
        public_item($id,$active,Category::class);
        return redirect()->route('admin.categories');
    }

    public function deleteCategory($id){
        Category::find((int)$id)->delete();
        return redirect()->route('admin.categories');
    }
}
