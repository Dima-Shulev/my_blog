@extends('layouts.appAdmin')
@section('title.page'){{__('Статьи')}}@endsection
@section('content-admin')

    <h1 class="h4">{{__('Все статьи:')}}</h1>
    <a href="{{route('admin.articles.create')}}" class="btn btn-sm btn-primary m-2">{{__('Создать статью')}}</a>
    <div class="form-control">
      @if(count($articles) > 0)
        <table class="table">
            <tr>
                <td><b>{{__('Id:')}}</b></td>
                <td><b>{{__('Заголовок:')}}</b></td>
                <td><b>{{__('Дата создания:')}}</b></td>
                <td><b>{{__('Статус:')}}</b></td>
                <td><b>{{__('Действие:')}}</b></td>
            </tr>

            @foreach($articles as $article)
                <tr>
                    <td>{{$article->id}}</td>
                    <td>{{$article->title}}</td>
                    <td>{{$article->created_at}}</td>
                    <td>{{$article->active}}</td>
                    <td>
                        <a href="{{route('admin.articles.publicArticle',[$article->id,$article->active])}}" class="btn btn-sm btn-{{$article->active == 1 ? 'danger': 'success'}} mb-1 me-1">{{$article->active == 1?'Деактивировать':'Активировать'}}</a>
                        <a href="{{route('admin.articles.edit',['url' => $article->url])}}" class="btn btn-sm btn-primary mb-1">{{__('Редактировать')}}</a>
                        <a href="{{route('admin.articles.delete',$article->id)}}" class="btn btn-sm btn-danger mb-1">{{__('Удалить')}}</a>
                    </td>
                </tr>
            @endforeach

        </table>
        {{$articles->links()}}
      @else
        <p>{{__('Пока нет ни одной созданной статьи!')}}</p>

      @endif
    </div>
@endsection
