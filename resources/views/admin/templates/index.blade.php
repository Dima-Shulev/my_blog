@extends('layouts.appAdmin')
@section('title.page'){{__('Шаблоны')}}@endsection
@section('content-admin')

    <h1 class="h4">{{__('Все шаблоны:')}}</h1>
    <div class="form-control">
        @if($templates->isEmpty())
            <p>{{__('Нет ни одного шаблона!')}}</p>
        @else
            <table class="table">
                <tr>
                    <td><b>{{__('Id:')}}</b></td>
                    <td><b>{{__('Название:')}}</b></td>
                    <td><b>{{__('Статус:')}}</b></td>
                    <td><b>{{__('Действие:')}}</b></td>
                </tr>

                @foreach($templates as $template)
                    <tr>
                        <td>{{$template->id}}</td>
                        <td>{{$template->name}}</td>
                        <td>{{$template->active}}</td>
                        <td>
                            <a href="{{route('admin.templates.publicTemplate',[$template->id,$template->active])}}" class="btn btn-sm btn-{{$template->active == 1 ? 'danger': 'success'}} mb-1 me-1">{{$template->active == 1?'Деактивировать':'Активировать'}}</a>
                        </td>
                    </tr>
                @endforeach
            </table>
        @endif
    </div>
@endsection

