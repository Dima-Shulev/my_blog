@extends('layouts.appAdmin')
@section('title.page'){{__('Редактировать статью')}}@endsection
@section('content-admin')

    <x-errors-any/>
    <x-title>
        {{__('Редактировать статью')}}
    </x-title>
    <hr/>
    <x-card>
        <a href="{{route('admin.articles')}}" class="btn btn-primary mb-2">{{__("Назад")}}</a>

        <x-form action="{{route('admin.articles.update',$articles->id)}}" method="post" enctype="multipart/form-data">

            <x-card-body>

                <x-label>
                    <b>{{__('Название:')}}</b>
                </x-label>
                <x-input type="text" name="title" class="mb-2" value="{{$articles->title}}"/>

            </x-card-body>

            <x-card-body>
                <x-label class="mb-2">
                    <b>{{__('Текст:')}}</b>
                </x-label>

                <x-text-area name="content" id="content" class="mb-2" id="myeditorinstance">{{ $articles->content }}</x-text-area>
            </x-card-body>

            <x-card-body>
                <x-label class="mb-2">
                    <b>{{__('Ключевые слова:')}}</b>
                </x-label>
                <x-input type="text" name="metaKey" class="mb-2" value="{{$articles->metaKey}}"/>
            </x-card-body>

            <x-card-body>
                <x-label class="mb-2">
                    <b>{{__('Мета описание:')}}</b>
                </x-label>
                <x-input type="text" name="metaDescription" class="mb-2" value="{{$articles->metaDescription}}"/>
            </x-card-body>

            <x-card-body>
                <x-label class="mb-2">
                    <b>{{__('Дата обновления:')}}</b>
                </x-label>
                <x-input type="date" name="created_at" class="mb-2"/>
            </x-card-body>
            @if(!$selectCategory->isEmpty())
                <x-card-body>
                    <x-label class="mb-2">
                        <b>{{__('Выберите категорию:')}}</b>
                    </x-label>
                    <select name="selectCategory">

                        @foreach($selectCategory as $item)
                            <option value="{{$item->id}}">{{$item->name}}</option>
                        @endforeach

                    </select>
                </x-card-body>
            @else
                <a href="{{route('admin.categories')}}" class="btn btn-sm btn-danger mb-1">{{__('Сначало создайте категорию')}}</a>
            @endif

            <x-card-body>
                <x-label class="mb-2">
                    <b>{{__('Модуль:')}}</b>
                </x-label>
                <select name="module">
                    <option value="default" selected>{{__('-/-')}}</option>
                    @if(!$modules->isEmpty())
                        @foreach($modules as $module)
                            <option value="{{$module->name}}">{{$module->position}}</option>
                        @endforeach
                    @endif
                </select>
            </x-card-body>

            <x-card-body>

                <div class="d-flex justify-content-start">
                    <div class="me-2">
                        <x-label class="mb-2">
                            <b>{{__('Опубликовать:')}}</b>
                        </x-label>
                    </div>
                    <div class="mb-2">
                        <x-login.checkbox-public type="checkbox" class="form-check-input" name="checkPublic" />
                    </div>
                </div>
            </x-card-body>

            <x-button type='submit' name="createCategory" class="mt-2">{{__("Сохранить")}}</x-button>

        </x-form>

    </x-card>
@endsection
