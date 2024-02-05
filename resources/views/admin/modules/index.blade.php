@extends('layouts.appAdmin')
@section('title.page'){{__('Модули')}}@endsection
@section('content-admin')

    <h1 class="h4">{{__('Все модули:')}}</h1>
    {{--<a href="{{route('admin.articles.create')}}" class="btn btn-sm btn-primary m-2">{{__('Создать статью')}}</a>--}}
    <div class="form-control">
        @if(count($modules) > 0)
            <table class="table">
                <tr>
                    <td><b>{{__('Id:')}}</b></td>
                    <td><b>{{__('Название:')}}</b></td>
                    <td><b>{{__('Позиция:')}}</b></td>
                    <td><b>{{__('Статус:')}}</b></td>
                    <td><b>{{__('Шаблон (ID):')}}</b></td>
                    <td><b>{{__('Действие:')}}</b></td>
                </tr>

                @foreach($modules as $module)
                    <tr>
                        <td>{{$module->id}}</td>
                        <td>{{$module->name}}</td>
                        <td>{{$module->position}}</td>
                        <td>{{$module->active}}</td>
                        <td>{{$module->template_id}}</td>
                        <td>
                            <a href="{{route('admin.modules.publicModules',[$module->id,$module->active])}}" class="btn btn-sm btn-{{$module->active == 1 ? 'danger': 'success'}} mb-1 me-1">{{$module->active == 1?'Деактивировать':'Активировать'}}</a>
                         {{--   <a href="{{route('admin.articles.edit',['url' => $article->url])}}" class="btn btn-sm btn-primary mb-1">{{__('Редактировать')}}</a>
                            <a href="{{route('admin.articles.delete',$article->id)}}" class="btn btn-sm btn-danger mb-1">{{__('Удалить')}}</a>--}}
                        </td>
                    </tr>
                @endforeach

            </table>
        @else
            <p>{{__('Пока нет ни одной созданного модуля!')}}</p>

        @endif
    </div>
@endsection

