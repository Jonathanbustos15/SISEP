(function($){

  $.fn.valida = function (options){
      //codigo de la funcion

        $this = $(this)

        var set = $.extend({
          size_font: "5px",
          clase_ok: "flaticon-ok",
          color_ok: "rgb(31, 176, 27)",
          clase_error: "flaticon-error",
          color_error: "#F12121"
        }, options );

        //inputs
        $inputs = $this.filter( "input" );
        //objeto
        $objt = {};//objeto para validacion
        $estado = {};//estado del formulario
        $cont = 0;

        for(var i=0;i<$inputs.prevObject[0].length;i++){

          if(($inputs.prevObject[0][i]["value"]=="") && ($inputs.prevObject[0][i]["required"] == true)){

            //console.log($inputs.prevObject[0][i]["id"]+" está vacio.");
            $objt[i] = {
              id:$inputs.prevObject[0][i]["id"],
              valor:$inputs.prevObject[0][i]["value"],
              req:$inputs.prevObject[0][i]["required"]
            };
            //console.log($inputs.prevObject[0][i]["required"]);

            //pone el estilo rojo
            //$("#"+$inputs.prevObject[0][i]["id"]).css("border","solid 3px red");
            $("<span id='s"+i+"' class='"+set.clase_error+"' style='color:"+set.color_error+"; font-size:"+set.size_font+"'></span>").insertAfter($("#"+$inputs.prevObject[0][i]["id"]));
            $("#"+$inputs.prevObject[0][i]["id"]).focus();

          }else{
            /*
            //console.log($inputs.prevObject[0][i]["value"]);
            $objt[i] = {
              id:$inputs.prevObject[0][i]["id"],
              valor:$inputs.prevObject[0][i]["value"],
              req:$inputs.prevObject[0][i]["required"]
            };*/

            //pone el estilo verde
            //$("#"+$inputs.prevObject[0][i]["id"]).css("border","solid 3px green");
            //$("#"+$inputs.prevObject[0][i]["id"]).append("<span class='"+set.clase_ok+"'></span>");
            $("<span id='s"+i+"' class='"+set.clase_ok+"' style='color:"+set.color_ok+"; font-size:'"+set.size_font+"'></span>").insertAfter($("#"+$inputs.prevObject[0][i]["id"]));
            //console.log($inputs.prevObject[0][i]["required"]);
          }

        };//cierra for

        //$cont=$cont + 1;

        if(Object.keys($objt).length > 0){
          $estado.estado = false;
          $estado.objt = $objt;

        }else{
          $estado.estado = true;
          $estado.objt = $objt;
          $estado.srlz = $this.serialize()
        }

        /**/
        //---------------------------------------
        function quita_span(){
          $("span."+set.clase_error).remove();
          $("span."+set.clase_ok).remove();
        };

        var spans = $("span").length;

        console.log("spans "+spans+" inputs"+i);
        /*
        if(i !== spans){
          quita_span();
        }else{

        }*/
        //---------------------------------------


        /* forma general de un each

        var obj = {
          "flammable": "inflammable",
          "duh": "no duh"
        };

        $.each( obj, function( key, value ) {
          alert( key + ": " + value );
        });
        */
        /*
        for(var it=0;it<Object.keys($objt).length;it++){
          $.each($objt[it], function(key, value){
            //console.log( key + ": " + value );

            if($objt[it].req == true && $objt[it].valor == "" ){
              $("#"+$objt[it].id).focus();
              console.log($estado="hay requireds vacios");
              //return false;
            };

            else{
              $estado="los requireds estan todos llenos";
              return true;
            }

          });
        };*/


      //return $estado;
      //return $objt;

      return $estado;

  };

})(jQuery);

/* codigo para llegar a esto
//-----------------------------------------------------------
//$("#div2").animar();
$boton = $("#btn_valida");

//$("#in").valida($("#btn_valida"));

$boton.click(function(){

  $ver = $("#f_prueba").filter( "input" );
  console.log($ver.prevObject[0].length);//catidad de inputs
  //$ver = $("#f_prueba");


  for(var i=0;i<$ver.prevObject[0].length;i++){

    console.log($ver.prevObject[0][i]["value"]);

  }
  //console.log($ver.prevObject[0][0]["value"]);
});
//$("#in").valida();
//-----------------------------------------------------------
*/
