$(function() {
    console.log('Hola fecha proyectos marco.');
    var options_format = {
        symbol: "$",
        decimal: ",",
        thousand: ".",
        precision: 0,
        format: "%s%v"
    };
    //---------------------------------------------------------------
    //---------------------------------------------------------------
    //inicializacion del plugin de fecha datetimepicker
    //calendario para la fecha de inicio
    $("#fecha_ini").datepicker({
        dateFormat: "yy-mm-dd",
        onClose: function(selectedDate) {
            $("#fecha_fin").datepicker("option", "minDate", selectedDate);
        }
    });
    //calendario para la fecha de inicio
    $("#fecha_fin").datepicker({
        dateFormat: "yy-mm-dd"
    });
    //---------------------------------------------------------------
    //$('#valor').mask('000.000.000.000.000', {reverse: true});
    $('#valor_mask').mask('000.000.000.000.000', {
        reverse: true
    });

    function remplazar(texto, buscar, nuevo) {
        var temp = '';
        var long = texto.length;
        for (j = 0; j < long; j++) {
            if (texto[j] == buscar) {
                temp += nuevo;
            } else temp += texto[j];
        }
        return temp;
    }
    $('#valor_mask').change(function(event) {
        /* Act on the event */
        //console.log($(this).val());
        var val_cuantia = $(this).val();
        //var val_replace = val_cuantia.replace(".", "");
        $('#valor').val(remplazar(val_cuantia, ".", ""))
        //console.log(remplazar (val_cuantia, ".", ""))
    });
    /*function remplazar (texto, buscar, nuevo){
	    var temp = '';
	    var long = texto.length;
	    for (j=0; j<long; j++) {
	        if (texto[j] == buscar) 
	        {
	            temp += nuevo;
	        } else
	            temp += texto[j];
	    }
	    return temp;
	};

	
	$('#valor_mask').mask('000.000.000.000.000', {reverse: true});	

	$('#valor_mask').change(function(event) {		
		var val_cuantia = $(this).val();		
		$('#valor').val(remplazar(val_cuantia, ".", ""))		
	});

*/
    //-----------------------------------------
    //click al detalle en cada fila-----------------------------------------------------------------
    //$('.table').on( 'click', '.detail', function () {
    //window.location.href = $(this).attr('href');
    //} );
    //----------------------------------------------------------------------------------------------
});