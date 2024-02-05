@extends('layouts.main')
@section('title.page'){{__('Все отзывы')}}@endsection
@section('content.page')
    <x-title-post>
        {{__('Все отзывы')}}
    </x-title-post>
    <div>
        <p class="alert alert-warning">Внимание!!! Добавлять отзывы могут только авторизированные пользователи, прошедшие регистрацию!</p>
    </div>
    <x-reviews-all :allReviews="$allReviews"/>
@endsection
