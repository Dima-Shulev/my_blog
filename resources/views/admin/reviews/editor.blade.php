@extends('layouts.appAdmin')
@section('title'){{__('Редактировать отзыв')}}@endsection
@section('content-admin')

    <x-errors-any></x-errors-any>

    <x-title>{{__('Редактировать отзыв')}}</x-title>
    <hr/>
    <x-container>
        <x-card>
            <x-card-body>


                <x-form action="{{route('admin.reviews.update',$id)}}" method="post" >

                    <x-form-item>

                        <x-label>{{__('Заголовок')}}</x-label>
                        <x-input type="text" name="title" value="{{ $reviews->title }}" />

                    </x-form-item>

                    <x-form-item>

                        <x-label>{{__('Текст')}}</x-label>
                        <x-text-area name="content" id="content" class="mb-2" id="myeditorinstance">{{$reviews->content}}</x-text-area>

                    </x-form-item>

                    <x-form-item>

                        <x-label>{{__('Опубликовать')}}</x-label>
                        <x-input class="form-check-input" type="checkbox" name="subscription"/>

                    </x-form-item>

                    <x-button type="submit" name="updateReview" >{{__('Редактировать отзыв')}}</x-button>
                </x-form>

            </x-card-body>
        </x-card>
    </x-container>

@endsection
