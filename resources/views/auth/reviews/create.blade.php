@extends('layouts.main')
@section('title'){{__('Создать отзыв')}}@endsection
@section('content')
    <x-errors-any></x-errors-any>

    <x-title>{{__('Создать отзыв')}}</x-title>
<hr/>
    <x-container>
        <x-card>
            <x-card-body>

                <x-form action="{{route('auth.reviews.store')}}" method="post" >

                    <x-form-item>

                        <x-label>{{__('Заголовок')}}</x-label>
                        <x-input type="text" name="title" value="{{request('old')}}" />


                    </x-form-item>

                    <x-form-item>

                        <x-label>{{__('Текст')}}</x-label>
                        <x-text-area rows="3" cols="10" name="content">{{request('old')}}</x-text-area>

                    </x-form-item>

                        <x-button type="submit" name="createReview" >{{__('Создать отзыв')}}</x-button>
                </x-form>

            </x-card-body>
        </x-card>
    </x-container>

@endsection
