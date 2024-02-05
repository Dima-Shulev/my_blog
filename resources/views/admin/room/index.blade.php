@extends('layouts.appAdmin')
@section('title.page'){{__('Административная панель')}}@endsection
@section('content-admin')
    <x-title>
        {{__('Административная панель')}}
    </x-title>
       <div class="row">
            <div class="col-12 col-md-6 mb-2">
                <x-card class="form-control">
                    <x-card-body>
                        <h2 class="h5">{{__('Пользователи')}}</h2>
                        <hr>
                        <table class="table">
                        @if(!$countAndShow['showLastUser']->isEmpty())
                            @foreach($countAndShow['showLastUser'] as $us)
                                    <tr>
                                        <td><b>{{__('Логин: ')}}</b></td>
                                        <td><b>{{__('Опубликован: ')}}</b></td>
                                    </tr>
                                    <tr>
                                        <td>{{$us->name}}</td>
                                        <td>{{$us->active?'Да':'Нет'}}</td>
                                    </tr>
                            @endforeach
                        @else
                            <p>{{__('Нет ни одного пользователя!')}}</p>

                        @endif
                        </table>
                            <p><b>{{__("Общее количество: ")}}</b>{{$countAndShow['countUser']}}</p>
                    </x-card-body>
                </x-card>
            </div>
            <div class="col-12 col-md-6 mb-2">
                <x-card class="form-control">
                    <x-card-body>
                        <h2 class="h5">{{__('Валютные пары:')}}</h2>
                        <hr>
                        <table class="table">
                        @if(!$countAndShow['showLastCurrency']->isEmpty())
                            @foreach($countAndShow['showLastCurrency'] as $cur)
                                <tr>
                                    <td><b>{{__('Id: ')}}</b></td>
                                    <td><b>{{__('Валюта: ')}}</b></td>
                                </tr>
                                <tr>
                                    <td>{{$cur->id}}</td>
                                    <td>{{$cur->name}}</td>
                                </tr>
                            @endforeach
                        @else
                            <p>{{__('Нет ни одной валюты!')}}</p>
                        @endif
                        </table>
                        <p><b>{{__("Общее количество: ")}}</b>{{$countAndShow['countCurrency']}}</p>
                    </x-card-body>
                </x-card>
            </div>
            <div class="col-12 col-md-6 mb-2">
                <x-card class="form-control">
                    <x-card-body>
                        <h2 class="h5">{{__('Категории')}}</h2>
                        <hr>
                        <table class="table">
                        @if(!$countAndShow['showLastCategory']->isEmpty())
                            @foreach($countAndShow['showLastCategory'] as $cat)
                                <tr>
                                    <td><b>{{__('Название: ')}}</b></td>
                                    <td><b>{{__('Опубликована: ')}}</b></td>
                                </tr>
                                <tr>
                                    <td>{{$cat->name}}</td>
                                    <td>{{$cat->active?'Да':'Нет'}}</td>
                                </tr>
                            @endforeach
                        @else
                            <p>{{__('Нет ни одной категории!')}}</p>
                        @endif
                        </table>
                        <p><b>{{__("Общее количество: ")}}</b>{{$countAndShow['countCategory']}}</p>
                    </x-card-body>
                </x-card>
            </div>
            <div class="col-12 col-md-6 mb-2">
                <x-card class="form-control">
                    <x-card-body>
                        <h2 class="h5">{{__('Статьи')}}</h2>
                        <hr>
                        <table class="table">
                        @if(!$countAndShow['showLastArticle']->isEmpty())
                                @foreach($countAndShow['showLastArticle'] as $art)
                                <tr>
                                    <td><b>{{__('Заголовок: ')}}</b></td>
                                    <td><b>{{__('Опубликована: ')}}</b></td>
                                </tr>
                                <tr>
                                    <td>{{$art->title}}</td>
                                    <td>{{$art->active?'Да':'Нет'}}</td>
                                </tr>
                            @endforeach
                        @else
                            <p>{{__('Нет ни одной статьи!')}}</p>
                        @endif
                        </table>
                        <p><b>{{__("Общее количество: ")}}</b>{{$countAndShow['countArticle']}}</p>
                    </x-card-body>
                </x-card>
            </div>
            <div class="col-12 col-md-6 mb-2">
                <x-card class="form-control">
                    <x-card-body>
                        <h2 class="h5">{{__('Отзывы')}}</h2>
                        <hr>
                        <table class="table">
                        @if(!$countAndShow['showLastReviews']->isEmpty())
                            @foreach($countAndShow['showLastReviews'] as $rev)
                                <tr>
                                    <td><b>{{__('Заголовок: ')}}</b></td>
                                    <td><b>{{__('Опубликована: ')}}</b></td>
                                </tr>
                                <tr>
                                    <td>{{$rev->title}}</td>
                                    <td>{{$rev->status}}</td>
                                </tr>
                            @endforeach
                        @else
                            <p>{{__('Нет ни одного отзыва!')}}</p>
                        @endif
                        </table>
                        <p><b>{{__("Общее количество: ")}}</b>{{$countAndShow['countReviews']}}</p>
                    </x-card-body>
                </x-card>
            </div>
       </div>
@endsection


