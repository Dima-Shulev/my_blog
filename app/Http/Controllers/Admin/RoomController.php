<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\ValidEntranceRoomRequest;
use App\Models\Article;
use App\Models\Category;
use App\Models\Currency;
use App\Models\Review;
use App\Models\User;
use App\Http\Controllers\Controller;

class RoomController extends Controller
{
    public function admin(){
        return view('admin.admin');
    }
    public function entrance(ValidEntranceRoomRequest $request){
        $checkVal = $request->validated();
        $checkName = User::select(['name','password'])->where('name',$checkVal['name'])->first();
        return check_entrance_room($checkName,$checkVal);
    }

    public function index(){
            $showLastUser = select_last(User::class,'name','active');
            $countUser = User::count();

            $showLastReviews = select_last(Review::class,'title','status');
            $countReviews = Review::count();

            $showLastCategory = select_last(Category::class,'name','active');
            $countCategory = Category::count();

            $showLastArticle = select_last(Article::class,'title','active');
            $countArticle = Article::count();

            $showLastCurrency = select_last(Currency::class,'id','name');
            $countCurrency = Currency::count();

            $countAndShow = [
            'countUser' => $countUser,
            'showLastUser' => $showLastUser,
            'countReviews' => $countReviews,
            'showLastReviews' => $showLastReviews,
            'countCategory' => $countCategory,
            'showLastCategory' => $showLastCategory,
            'countArticle' => $countArticle,
            'showLastArticle' => $showLastArticle,
            'countCurrency' => $countCurrency,
            'showLastCurrency' => $showLastCurrency
        ];

        return view('admin.room.index',compact('countAndShow'));
    }

    public function closeSession(){
        session()->flush();
        return redirect('/admin');
    }
}
