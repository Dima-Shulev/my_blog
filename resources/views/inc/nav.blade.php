<div class="history">
    <div>
        <b class="h3 me-2 mt-2">{{__("Выбор пары")}}:</b>
        <select id="cur">
            <option selected value="def">-/-</option>
        </select>
    </div>
    {{-- <h5>Фильтр:</h5>
     <select id="filter">
         <option selected value="default">-/-</option>
         <option value="timeType">Время</option>
         <option value="currencyType">Значения</option>
     </select>--}}
</div>
<hr>
<div class="chart">
            <h3 class="mt-2">{{__("Вид графика")}}:</h3>
            <hr>
                <button type="button" name="chart" class="btn btn-primary btn-sm mb-2">{{__("Графиковая")}}</button><br/>
                <button type="button" name="line" class="btn btn-primary btn-sm mb-2">{{__("Линейная")}}</button><br/>
                {{--<button type="button" name="hist" id="btn_c">{{__("Гистограмма")}}</button>--}}
                <button type="button" name="candle" class="btn btn-primary btn-sm mb-2">{{__("Свечная")}}</button>
</div>
<hr>
<div class="wrapper_btn_m">
    <div class="btn_m" style = "display: none">
    <h3>{{__("По минутам")}}:</h3>
        <hr>
            <button type="button" name="one" class="btn btn-primary mb-2" id="one">1</button>
            <button type="button" name="five" class="btn btn-primary mb-2" id="five">5</button>
            <button type="button" name="ten" class="btn btn-primary mb-2" id="ten">10</button>
            <button type="button" name="fifteen" class="btn btn-primary mb-2" id="fifteen">15</button>
            <button type="button" name="thirty" class="btn btn-primary mb-2" id="thirty">30</button>
    </div>
</div>
{{--<div id="orderValue" style = "display: none">
    <div id="selectValue">
    <h3>Сортировать по значению: </h3>
        <button type="button" name="min">min</button>
        <button type="button" name="max">max</button>
    </div>
   --}}{{-- <select id="selectValue">
        <option selected>-/-</option>
        <option value="min">От меньшего к большему</option>
        <option value="max">От большего к меньшему</option>
    </select>--}}{{--
</div>--}}
<script>
    let getCurrency = new ResponseAjax();
    getCurrency.checkDefaultOrEnter();
    getCurrency.getSelectedCurrency();
    getCurrency.selectTypeChart();
    getCurrency.selectValueToMinute();
  /*  let getObject = new CurrencyDate();
    getObject.showValueObj();*/
</script>
