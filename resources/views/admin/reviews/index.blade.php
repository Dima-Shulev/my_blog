@extends('layouts.appAdmin')
@section('title.page'){{__('Все отзывы')}}@endsection
@section('content-admin')

<h1 class="h4">{{__('Все отзывы')}}</h1>
    <div class="form-control">

        @if($allReviews->isEmpty())
        <p>{{__('Нет ни одного отзыва')}}</p>
    @else
       <table class="table">
           <tr>
               <td class="p-2">{{__('id')}}</td>
               <td class="p-2">{{__('Заголовок отзыва')}}</td>
               <td class="p-2">{{__('Дата публикации')}}</td>
               <td class="p-2">{{__('Статус')}}</td>
               <td class="p-2">{{__('Действие')}}</td>
           </tr>

       @foreach($allReviews as $review)
               <tr>
               <td class="p-2">{{ $review->id }}</td>
               <td class="p-2">{{ $review->title }}</td>
               <td class="p-2">{{ $review->created_at }}</td>
               <td class="p-2">{{ $review->status }}</td>
               <td>
                       <a href="{{route('admin.reviews.publicReview',[$review->id,$review->status])}}" class="btn btn-sm btn-{{$review->status == 1 ? 'danger': 'success'}} mb-1 me-1">{{$review->status == 1?'Деактивировать':'Активировать'}}</a>
                       <a href="{{route('admin.reviews.editor',['id' => $review->id])}}" class="btn btn-sm btn-primary mb-1">{{__('Редактировать')}}</a>
                       <a href="{{route('admin.reviews.deleteReviews',['id' => $review->id])}}" class="btn btn-sm btn-danger mb-1">{{__('Удалить')}}</a>
               </td>
           </tr>
       @endforeach
       </table>
        {{$allReviews->links()}}
    @endif
    </div>
@endsection
