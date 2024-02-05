@extends('layouts.appAdmin')
@section('title.page'){{__('Создать страницу')}}@endsection
@section('content-admin')

    <x-errors-any/>
    <x-title>
        {{__('Создать страницу')}}
    </x-title>
    <hr/>
    <x-card>
        <a href="{{route('admin.pages')}}" class="btn btn-primary mb-2">{{__("Назад")}}</a>

        <x-form action="{{route('admin.pages.store')}}" method="post">

            <x-card-body>

                <x-label>
                    <b>{{__('Название:')}}</b>
                </x-label>
                <x-input type="text" name="name" class="mb-2"/>

            </x-card-body>

            <x-card-body>
                <x-label class="mb-2">
                    <b>{{__('Описание:')}}</b>
                </x-label>

                <x-text-area name="content" />
            </x-card-body>

            <x-card-body>
                <x-label class="mb-2">
                    <b>{{__('Ключевые слова:')}}</b>
                </x-label>
                <x-input type="text" name="metaKey" class="mb-2"/>
            </x-card-body>

            <x-card-body>
                <x-label class="mb-2">
                    <b>{{__('Мета описание:')}}</b>
                </x-label>
                <x-input type="text" name="metaDescription" class="mb-2"/>
            </x-card-body>

            <x-card-body>
                <x-label class="mb-2">
                    <b>{{__('Дата создания:')}}</b>
                </x-label>
                <x-input type="date" name="created_at" class="mb-2"/>
            </x-card-body>

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
            <x-button type='submit' name="createPage" class="mt-2">{{__("Создать")}}</x-button>
        </x-form>

    </x-card>
@endsection

