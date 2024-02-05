<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta id="_token" name="csrf-token" content="{{ csrf_token() }}">
     <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <title>{{__('Вход в админку')}}</title>
</head>
<body class="bg-body-tertiary">
<div class="d-flex justify-content-between align-items-center min-vh-100 w-25 m-auto">

    <main class="flex-grow-1 py-3">
        <div class="wrapper">
            <div class="container">
                @include('modules.message')
                <x-errors-any/>
                <x-card class="card mb-3">
                    <x-card-header>
                        <x-card-title>
                            {{ __('Вход') }}
                        </x-card-title>

                    </x-card-header>

                    <x-card-body>

                        <x-form action="{{ route('admin.entrance')}}" method="post">

                            <x-form-item>
                                <x-label required>
                                    {{ __('Ваш логин') }}
                                </x-label>
                                <x-input type="text" name="name" autofocus />
                            </x-form-item>

                            <x-form-item>
                                <x-label required>
                                    {{ __('Ваш пароль') }}
                                </x-label>
                                <x-input type="password" name="password" />
                            </x-form-item>
                            <div class="d-flex justify-content-between">
                                <x-button type="submit">{{ __('Войти') }}</x-button>
                            </div>
                        </x-form>

                    </x-card-body>

                </x-card>
            </div>
        </div>
    </main>
</div>
<script src="{{asset('js/bootstrap.min.js')}}" ></script>
</body>
</html>
