<?php

namespace App\Http\Controllers;

use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ReviewsController extends Controller
{
    public function index(){
        $allReviews = Review::select('id','title','content','user_id','created_at','status')->orderBy('id','ASC')->get();
        return view('reviews.index',compact('allReviews'));
    }

    public function show($post){
        $show = Review::select('id','title','content','user_id','created_at','like')->where('id',(int)$post)->first();
        $url_like = Storage::url('likes.png');
        return show_one_review($show,$url_like);
    }

    public function like($post, Request $request){
        return like_review($request,$post);
    }
}
