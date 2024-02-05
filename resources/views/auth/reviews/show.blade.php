@extends('layouts.main')
@section('title.page'){{ $arr['title'] }}@endsection
@section('content.page')
    <x-title-post>
        {{$arr['title']}}
        <x-slot name="right">
            <x-button-link href="{{ route('auth.reviews') }}">
                {{ __('Назад') }}
            </x-button-link>
        </x-slot>
    </x-title-post>
    <div class="form-control">
        <div class="d-flex justify-content-between align-items-end">
        <div class="w-auto me-3">
            <div class="mb-3">
                <b>{{__("Пользователь: ")}}</b><i>{{ $arr['name'] }}</i>
            </div>
            <div class="mb-3">
                <b>{{__("Отзыв: ")}}</b>{{ $arr['content'] }}
            </div>
            <div class="mb-3">
                <p class="small text-muted"><b>{{__("Дата публикации: ")}}</b><i>{{ $arr['created_at'] }}</i></p>
            </div>
            </div>
        <div class="ml-0">
            <x-form action="{{route('auth.reviews.like', $arr['id'])}}" method="post">
                <x-input type="hidden" name="like" value="1"/>
               <x-button type="submit" name="new_like" class="btn-sm btn-danger">{{__('Like')}}<x-like>+{{ $arr['like'] }}</x-like></x-button>
            </x-form>
        </div>
        </div>
    </div>
@endsection
