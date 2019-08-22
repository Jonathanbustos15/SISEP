carga_aibd();

function carga_aibd() {
    var id_funciona = $("#id_indicador").val();
    console.log("Carga el aibd " + id_funciona);
    $.ajax({
        url: '../controller/ajaxController12.php',
        data: "pkID=" + id_funciona + "&tipo=consultar&nom_tabla=indicador",
    }).done(function(data) {
        Texto = data.mensaje[0]["indicador"];
        var arrCategorias = ['Año 1', 'Año 2', 'Año 3', 'Año 4', 'Total'];
        meta1 = parseInt(data.mensaje[0]["meta1"]);
        meta2 = parseInt(data.mensaje[0]["meta2"]);
        meta3 = parseInt(data.mensaje[0]["meta3"]);
        meta4 = parseInt(data.mensaje[0]["meta4"]);
        total_meta = meta1 + meta2 + meta3 + meta4;
        var arrMeta = [meta1, meta2, meta3, meta4, total_meta];
        fkID_proyecto_marco = data.mensaje[0]["fkID_proyecto_marco"];
        cumplimiento1 = parseInt($("#cumplimiento1").val());
        cumplimiento2 = parseInt($("#cumplimiento2").val());
        cumplimiento3 = parseInt($("#cumplimiento3").val())
        cumplimiento4 = parseInt($("#cumplimiento4").val());
        cumplimiento_total = cumplimiento1 + cumplimiento2 + cumplimiento3 + cumplimiento4;
        pendiente1 = cumplimiento1 - meta1;
        pendiente2 = cumplimiento1 + cumplimiento2 - meta1 - meta2;
        pendiente3 = cumplimiento1 + cumplimiento2 + cumplimiento3 - meta1 - meta2 - meta3;
        pendiente4 = cumplimiento1 + cumplimiento2 + cumplimiento3 + cumplimiento4 - meta1 - meta2 - meta3 - meta4;
        pendiente_total = cumplimiento_total - total_meta;
        var arrCumplimiento = [cumplimiento1, cumplimiento2, cumplimiento3, cumplimiento4, cumplimiento_total];
        var arrPendiente = [pendiente1, pendiente2, pendiente3, pendiente4, pendiente_total];
        dibuja(Texto, arrMeta, arrCategorias, arrCumplimiento, arrPendiente)
    }).fail(function() {
        console.log("error");
    }).always(function() {
        console.log("complete");
    });
};

function dibuja(Texto, arrMeta, arrCategorias, arrCumplimiento, arrPendiente) {
    Highcharts.chart('container', {
        chart: {
            type: 'bar'
        },
        title: {
            text: Texto
        },
        xAxis: {
            categories: arrCategorias,
            title: {
                text: null
            }
        },
        yAxis: {
            min: 0,
            title: {
                text: Texto,
                align: 'high'
            },
            labels: {
                overflow: 'justify'
            }
        },
        tooltip: {
            valueSuffix: Texto
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
            data: arrMeta
        }, {
            name: 'Cumplimiento',
            data: arrCumplimiento
        }, {
            name: 'Restante',
            data: arrPendiente
        }]
    });
}