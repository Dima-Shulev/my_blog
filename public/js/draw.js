class Draw{

    nameCurrency;
    date;
    options;
    chart;
    selectChart;
    customerArea;

    constructor(nameCurrency,types){
        this.nameCurrency = nameCurrency;
        this.selectChart = types;
        //получение зоны клиента
        this.customerArea = Intl.DateTimeFormat().resolvedOptions().timeZone;
    }

    showDrawType(type){
        if(type === "AreaChart"){
            this.options = {
                title: 'График котировок',
                hAxis: {title: 'Время', titleTextStyle: {color: '#333'}, minValue: 0.00000000001}
            };
            this.chart = new google.visualization.AreaChart(document.getElementById('chart_div'));
        }else if(type === "LineChart"){
            this.options = {
                title: 'График котировок',
                curveType: 'function',
                legend: { position: 'bottom' }
            };
            this.chart = new google.visualization.LineChart(document.getElementById('chart_div'));
        }else if(type === "CandlestickChart"){
            this.options = {
                title: 'График котировок',
                legend: 'none'
            };
            this.chart = new google.visualization.CandlestickChart(document.getElementById('chart_div'));
        }
       /* else if(type === "Histogram") {
            this.options = {
                title: 'График котировок',
                hAxis: {title: 'Время', titleTextStyle: {color: '#333'}},
                vAxis: {minValue: 0}
            };
            this.chart = new google.visualization.Histogram(document.getElementById('chart_div'));
        }*/
    }

    convertDateZone(dates, zone){
        return (((typeof dates === "string") ? new Date(dates) : dates).toLocaleString("ru-RU",{timeZone: zone}));
    }

    drawChartDb(obj) {
        let drawNow = [];
        drawNow[0] = [];
        drawNow[0][0] = "Время";
        drawNow[0][1] = this.nameCurrency;
        let dates;
        let  j = 1;
        for(let property in obj) {
                if(!drawNow[j]){drawNow[j] = [];}
                dates = this.convertDateZone(obj[property].created_at,this.customerArea);
                drawNow[j].push(dates.substring(11));
                drawNow[j].push(parseFloat(obj[property].close));
                j += 1;
        }
        this.data = google.visualization.arrayToDataTable(drawNow);
        this.showDrawType(this.selectChart);
        this.chart.draw(this.data, this.options);
    }

    drawChartDbCandle(obj) {
            let drawNow = [];
            let dates;
            let i = 0;
            for (let property in obj) {
                if (!drawNow[i]) {
                    drawNow[i] = [];
                }
                dates = this.convertDateZone(obj[property].created_at, this.customerArea);
                drawNow[i].push(dates.substring(11));
                drawNow[i].push(Number(obj[property].open));
                drawNow[i].push(Number(obj[property].min));
                drawNow[i].push(Number(obj[property].max));
                drawNow[i].push(Number(obj[property].close));
                i += 1;
            }
            this.data = google.visualization.arrayToDataTable(drawNow,true);
            this.showDrawType(this.selectChart);
            this.chart.draw(this.data, this.options);
    }


   drawChart(cur,obj) {
        let drawNow = [];
        drawNow[0] = [];
        drawNow[0][0] = "Время";
        drawNow[0][1] = cur;

        for (let s = 0, h = 0, j = 1; s < obj.time.length, h < obj.value.length; s++, h++, j++) {
            drawNow[j] = [];
            drawNow[j][0] = obj.time[s];
            drawNow[j][1] = Number(obj.value[h]);
        }
        this.data = google.visualization.arrayToDataTable(drawNow);
        this.options = {
            title: 'График котировок',
            hAxis: {title: 'Время', titleTextStyle: {color: '#333'}},
            vAxis: {
                minValue: 0,
                title: "value",
                format: "currency"
            }
        };
        this.chart = new google.visualization.AreaChart(document.getElementById('chart_div'));
        this.chart.draw(this.data, this.options);
    }
}
