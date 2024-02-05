class CurrencyDate {
    currency;
    newCurrency;
    datetime;
    options;
    getCur;
    option;
    data;
    chart;
    newArray;
    lengthArr;
    checkCur;
    draws;
    objectCur;

    constructor() {
        this.currency = {};
        this.newCurrency = {};
        this.newArray = {};
    }

    chartsGoogle() {
        google.charts.load("current", {packages: ["corechart"]});
        google.charts.setOnLoadCallback(this.connectChart);
    }

    connectChart = () => {
        let socket = new WebSocket("wss://stream.binance.com:9443/ws/!miniTicker@arr");
        socket.onopen = function () {
        };
        socket.onclose = function (event) {
            if (event.wasClean) {
            } else {
            }
        };
        socket.onmessage = (event) => {
            this.parseDate(JSON.parse(event.data));
            socket.onerror = function (error) {
                alert("Ошибка " + error.message);
            };
        }
    }

    parseDate = (bodyEvent) => {
        for(let allObject in bodyEvent) {
            if (!this.currency[bodyEvent[allObject].s]) {
                this.currency[bodyEvent[allObject].s] = {};
            }
            this.dateTime = new Date();
            this.dateTime = this.dateTime.getHours() + ":" + this.dateTime.getMinutes() + ":" + this.dateTime.getSeconds();
            if (!this.currency[bodyEvent[allObject].s].time) {
                this.currency[bodyEvent[allObject].s].time = [];
            }
            this.currency[bodyEvent[allObject].s].time.push(this.dateTime);
            if (!this.currency[bodyEvent[allObject].s].value) {
                this.currency[bodyEvent[allObject].s].value = [];
            }
            this.currency[bodyEvent[allObject].s].value.push(bodyEvent[allObject]["c"]);
        }
    }

   /* showValueObj(object){
        const result = setInterval(()=>{
            if(object !== undefined){
             /!*  console.log(object);*!/
               /!*clearInterval(result)*!/
            }
        },2000);
    }

    writeDraw(){
        for(const property in this.checkCur) {
            if (property === this.select.value) {

                this.getCur.value = "def";

                this.draws = new Draw();
                this.draws.drawChart(this.select.value,this.checkCur[property]);
                this.lengthArr = this.checkCur[property].value.length;
                if (!this.newArray[property]) this.newArray[property] = [];
                this.newArray[property].push(this.checkCur[property].value);
                if (this.checkCur[property].value.length !== this.newArray[property].length) {
                    this.draws.drawChart(this.select.value,this.checkCur[property]);
                }
            }
        }
    }*/
}
