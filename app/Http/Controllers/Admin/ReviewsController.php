<?php

namespace App\Http\Controllers\Admin;

use App\Models\Review;
use App\Http\Requests\CheckReviewsRequest;
use App\Http\Controllers\Controller;


class ReviewsController extends Controller
{
    public function index(){
        $allReviews = page_paginate(5,Review::class);
        return view('admin.reviews.index',compact('allReviews'));
    }

   public function edit($id){
        $reviews = Review::find((int)$id);
        return view('admin.reviews.editor',compact('id','reviews'));
   }

   public function update($id,CheckReviewsRequest $request){
      $result = $request->validated();
      return update_review_admin($id,$request,$result);
   }

    public function publicReviews($id,$active){
        public_item($id,$active,Review::class);
        return redirect()->route('admin.reviews');
    }

   public function deleteReviews($id){
        return Review::find((int)$id)->delete();
   }
}
