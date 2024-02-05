@extends('layouts.main')
@section('keywords'){{__('Диаграммы котировок валют')}}@endsection
@section('description'){{__('Онлайн статистика котировок валютых пар')}}@endsection
@csrf
<script type="text/javascript">
    window.onload = function(){
        let data = new CurrencyDate;
        data.chartsGoogle();
    }
</script>
@section('title.page'){{__('Диаграммы')}}@endsection
@section('content.page')
    <x-title>
        {{__('Диаграммы')}}
    </x-title>
    <hr>
    <div class="d-flex">
        <div class="row w-100">
            <div class="col-12 col-md-4">
                @include('inc.nav')
            </div>
            <div class="col-12 col-md-8">
                @include('inc.draw')
            </div>
        </div>
    </div>
@endsection
