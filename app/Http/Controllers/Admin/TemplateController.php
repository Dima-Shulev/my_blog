<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Template;


class TemplateController extends Controller
{
    public function index(){
        $templates = Template::select(['id','name','active'])->orderBy('id','ASC')->get();
        return view('admin.templates.index',compact('templates'));
    }

    public function publicTemplate($id,$active){
        public_item($id,$active,Template::class);
        return redirect()->route('admin.templates');
    }
}
