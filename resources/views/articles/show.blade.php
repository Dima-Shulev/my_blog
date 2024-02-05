@extends('layouts.main')
@section('title.page'){{ $title }}@endsection
@section('content.page')
    <h1 class="h3">{{$title}}</h1>
    <hr>
        <div>
            @foreach($showArticles as $article)
                <p>{!! $article->content !!}</p>
            @endforeach
        </div>
@endsection
