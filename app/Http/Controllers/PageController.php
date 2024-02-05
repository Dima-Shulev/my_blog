<?php

namespace App\Http\Controllers;

use App\Models\Page;

class PageController extends Controller
{
    public function index(){
        $home = Page::select(['id','name','content','metaKey','metaDescription','url'])->orderBy('id','ASC')->first();
        return view('pages.index',compact('home'));
    }

    public function show($url){
        $show = Page::select(['id','name','content','metaKey','metaDescription','url'])->where('url',$url)->orderBy('id','ASC')->first();
        return view('pages.show',compact('show'));
    }
}
