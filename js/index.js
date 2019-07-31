Highcharts.chart('container', {
    chart: {
        type: 'bar'
    },
    title: {
        text: 'Niños, niñas y jóvenes participantes del Programa Ondas'
    },
    xAxis: {
        categories: ['Año 1', 'Año 2', 'Año 3', 'Año 4', 'Total'],
        title: {
            text: null
        }
    },
    yAxis: {
        min: 0,
        title: {
            text: 'Niños y niñas',
            align: 'high'
        },
        labels: {
            overflow: 'justify'
        }
    },
    tooltip: {
        valueSuffix: ' niños y niñas'
    },
    plotOptions: {
        bar: {
            dataLabels: {
                enabled: true
            }
        }
    },
    legend: {
        layout: 'vertical',
        align: 'right',
        verticalAlign: 'top',
        x: -40,
        y: 80,
        floating: true,
        borderWidth: 1,
        backgroundColor: ((Highcharts.theme && Highcharts.theme.legendBackgroundColor) || '#FFFFFF'),
        shadow: true
    },
    credits: {
        enabled: false
    },
    lang: {
        downloadCSV: ['Descargar CSV'],
        printChart: ['Imprimir'],
        viewFullscreen: ['Pantalla Completa'],
        downloadPNG: ['Descargar PNG'],
        downloadJPEG: ['Descargar JPEG'],
        downloadPDF: ['Descargar PDF'],
        downloadSVG: ['Descargar SVG'],
        downloadXLS: ['Descargar XLS'],
        viewData: ['Ver Datos'],
        openInCloud: ['Ver en Cloud']
    },
    series: [{
        name: 'Meta',
        data: [750, 1350, 2000, 1900, 6000]
    }, {
        name: 'Cumplimiento',
        data: [794, 1646, 3151, 0, 5591]
    }, {
        name: 'Restante',
        data: [0, 0, 0, 0, 490]
    }]
});