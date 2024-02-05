@extends('layouts.main')
@section('title.page'){{__('Все категории')}}@endsection
@section('content.page')
    <x-title-post>
        {{__('Все категории')}}
    </x-title-post>
    <x-categories-all :allCategories="$allCategories"/>
@endsection
