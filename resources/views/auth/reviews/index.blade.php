@extends('layouts.main')
@section('title.page'){{__('Все отзывы')}}@endsection
@section('content.page')
    <x-title-post>
        {{__('Все отзывы')}}
       <x-slot name="right">
            <x-button-link href="{{ route('auth.reviews.create') }}">
                {{ __('Создать отзыв') }}
            </x-button-link>

       </x-slot>
    </x-title-post>
    <x-reviews-all  :allReviews="$allReviews"/>
@endsection
