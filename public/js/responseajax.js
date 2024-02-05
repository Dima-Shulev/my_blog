class ResponseAjax extends CurrencyDate
{
    howValue;
    currencyDb;
    draw;
    typesChart;
    token;
    chart;
    idCurrency;
    currencyAndValue;
    obj;
    checkCur;
    static cur;


    constructor(){
        super();
        this.typesChart = document.querySelector(".chart");
        this.getCurrency = document.querySelector("#cur");
        this.whatPush = document.querySelector(".btn_m");
        this.token = document.getElementById("_token");
        this.getCurrencyAndDefault();
    }

    //запрос и получение данных валютных пар с db
    async ajax(url, ContentType) {
        const myFetch = await fetch(url, {
            method: "GET",
            headers: {
                "Content-Type": ContentType
            }
        });
        const result = await myFetch.json();
        this.defaultCur = await Object.assign({},result[1]);
        this.allCurrency(result[0]);
    }

    async ajaxValue(bodyDate, url, ContentType, token){
        const response = await fetch(url,{
            method: "POST",
            headers: {
                "X-CSRF-TOKEN": token,
                "Content-Type": ContentType
            },
            body: JSON.stringify(bodyDate)
        });
        const res = await response.json();
        this.currencyAndValue = await Object.assign({},res);
        this.checkValue = await Object.assign({},res);
    }

    //вывод валют из db + default
   getCurrencyAndDefault(){
        this.ajax( "/ajax", "application/json");
    }

    //отправка выбора диаграммы пользователя
    getTypeDraw(typesChart){
        if(typesChart === "chart"){typesChart = "AreaChart";}
        else if(typesChart === "line"){typesChart = "LineChart";}
        else if(typesChart === "candle"){typesChart = "CandlestickChart";}
        else if(typesChart === "hist"){typesChart = "Histogram";}
        else{typesChart = "AreaChart";}
        return typesChart;
    }

    //все валюты из db
    allCurrency(cur) {
        for (let oneCurrency in cur) {
            this.currencyDb = document.createElement("option");
            this.currencyDb.innerText = cur[oneCurrency].name;
            this.currencyDb.value = cur[oneCurrency].name;
            this.getCurrency.append(this.currencyDb);
            this.idCurrency = cur[oneCurrency].id;
        }
    }

    getDefaultCurrency(chart) {
        if (this.getCurrency.value === "def") {
            const awaites = setInterval(() => {
                if (this.defaultCur !== undefined) {
                    if (chart !== "candle" && this.getCurrency.value === "def") {
                        this.draw = new Draw("ETHUSDT", this.getTypeDraw(chart));
                        this.draw.drawChartDb(this.defaultCur);
                        clearInterval(awaites);
                        } else if (chart === "candle" && this.getCurrency.value === "def") {
                                this.draw = new Draw("ETHUSDT", "CandlestickChart");
                                this.draw.drawChartDbCandle(this.defaultCur);
                                clearInterval(awaites);
                        }
                    }
            }, 1000);
        }
    }


    checkDefaultOrEnter = () => {
        if (this.getCurrency.value === "def") {
            if (this.typesChart.value === undefined) {
                this.getDefaultCurrency(null);
            }
            this.typesChart.addEventListener("click", (event) => {
                this.typesChart.value = event.target.name;
                this.getDefaultCurrency(this.typesChart.value);
            });
        }
    }

        setValueToMinute = (currency, howMinute, chart) => {
                this.ajaxValue({
                    name: currency,
                    item: howMinute,
                    chart: "candle"
                }, "/ajaxValueCandle", "application/json", this.token.content);

            if (chart !== "candle") {
                    setTimeout(() => {
                        let obj = Object.assign({}, this.currencyAndValue);
                        const checkChange = setInterval(() => {
                            if (JSON.stringify(obj) !== JSON.stringify(this.checkValue)) {
                                if(this.typesChart.value !== "candle") {
                                    this.draw = new Draw(this.getCurrency.value, this.getTypeDraw(this.typesChart.value));
                                    this.draw.drawChartDb(this.checkValue);
                                    clearInterval(checkChange);
                                }
                            }
                        }, 1000);

                        const checkCurrency = setInterval((currency)=>{
                            if(currency !== this.getCurrency.value){
                                this.draw = new Draw(this.getCurrency.value, this.getTypeDraw(this.typesChart.value));
                                this.draw.drawChartDb(this.currencyAndValue);
                                clearInterval(checkCurrency);
                            }
                        },500);
                    }, 10);
            }

            if (chart === "candle") {
                setTimeout(() => {
                    let objectCandle = Object.assign({}, this.currencyAndValue);
                    const changeCandle = setInterval(() => {
                        if (JSON.stringify(objectCandle) !== JSON.stringify(this.checkValue)) {
                            if(this.typesChart.value === "candle") {
                                this.draw = new Draw(this.getCurrency.value, this.getTypeDraw(this.typesChart.value));
                                this.draw.drawChartDbCandle(this.checkValue);
                                clearInterval(changeCandle);
                            }else{
                                clearInterval(changeCandle);
                            }
                        }
                    },2500);
                }, 100);
            }
    }

    selectValueToMinute = () => {
        this.whatPush.addEventListener("click",(event)=> {
            this.whatPush.name = event.target.name;

            if(this.whatPush.name === "one"){
                this.setValueToMinute(this.getCurrency.value,"one",this.chart);

                // обновление по таймфреймам и проверка что по прежнему диапазон не изменился пользователем
                this.updateMinute("one",60000);
            }else if(this.whatPush.name === "five"){
                this.setValueToMinute(this.getCurrency.value, "five", this.chart);
                this.updateMinute("five",150000);
            }else if(this.whatPush.name === "ten"){
                this.setValueToMinute(this.getCurrency.value,"ten", this.chart);
                this.updateMinute("ten",300000);
            }else if(this.whatPush.name === "fifteen"){
                this.setValueToMinute(this.getCurrency.value,"fifteen", this.chart);
                this.updateMinute("fifteen",450000);
            }else if(this.whatPush.name === "thirty"){
                this.setValueToMinute(this.getCurrency.value,"thirty", this.chart);
                this.updateMinute("thirty",900000);
            }
        });
    }

    selectTypeChart = () => {
        this.typesChart.addEventListener("click", (event) => {
            this.chart = event.target.name;
            if(this.getCurrency.value !== "def") {
                this.whatPush.style.display = "block";
            }
              this.draw = new Draw(this.getCurrency.value, this.getTypeDraw(this.chart));
              this.intervalType(this.currencyAndValue, this.chart, this.whatPush.name);
        });
    };

    intervalType(object, type, howTime){
        let ob = setInterval(()=>{
            if(object !== undefined) {
                if (type !== "candle") {
                    this.draw.drawChartDb(object);
                    clearInterval(ob)
                } else if (type === "candle") {
                    setTimeout(() => {
                        this.draw.drawChartDbCandle(object, howTime);
                        clearInterval(ob);
                    }, 2000);
                }
            }
        },2100);
    }

    updateMinute(timeString,timeOut){
        let how = setInterval(()=>{
            if(this.whatPush.name === timeString) {
                this.setValueToMinute(this.getCurrency.value, timeString, this.chart);
            }else{
                clearInterval(how);
            }
        },timeOut);
    }

    getSelectedCurrency = () => {

        this.getCurrency.addEventListener("click", (event) => {
            this.getCurrency.value = event.target.value;

            if (this.getCurrency.value !== "def"){
                setTimeout(()=>{
                    this.cur = this.getCurrency.value;
                },1000);
                if(this.getCurrency.value !== this.cur) {
                    this.ajaxValue({
                            name: this.getCurrency.value,
                            item: "one"
                        }, "/ajaxValueCandle", "application/json", this.token.content, "one");

                    }
                    const checks = setTimeout(() => {
                        if (this.currencyAndValue !== undefined) {
                            if (this.typesChart.name === undefined) {
                                let chart = null;
                                this.draw = new Draw(this.getCurrency.value, this.getTypeDraw(chart));
                                this.draw.drawChartDb(this.currencyAndValue);
                                clearInterval(checks);
                            } else {
                                this.selectTypeChart();
                                clearInterval(checks);
                            }
                        }
                    }, 5000);
            }
        });
    }
}
