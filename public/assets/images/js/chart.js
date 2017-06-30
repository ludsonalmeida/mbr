$(function () {

    window.chart = new Highcharts.Chart({

        chart: {
            renderTo: 'container',
            polar: true
        },

        title: {
            text: 'Teste de Autoconhecimento',
            x: -80
        },

        pane: {
            size: '80%'
        },

        xAxis: {
            categories: ['Autoconhecimento', 'Sexualidade', 'Relacionamento'],
            lineWidth: 0
        },

        yAxis: {
            gridLineInterpolation: 'circle',
            lineWidth: 0,
            min: 0
        },

        tooltip: {
            shared: true
        },

        series: [{
                type: "column",
                name: 'Pontos',
                data: [80000, 20000, 20000],
                pointPlacement: 'on'
        }

        ]
    });
});