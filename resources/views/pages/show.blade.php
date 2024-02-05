@extends('layouts.main')
@section('keywords.page'){{ $show->metaKey }}@endsection
@section('description.page'){{ $show->metaDescription }}@endsection
@section('title.page'){{ $show->name }}@endsection
@section('content.page')
    <hr>
    <div>
        <p>{!! $show->content !!}</p>
    </div>
@endsection
