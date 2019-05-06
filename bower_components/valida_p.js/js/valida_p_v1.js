(function($){

  $.fn.valida = function (){
      //codigo de la funcion
        //el formulario
        $this = $(this)
        //inputs
        $inputs = $this.filter( "input" );
        //objeto
        $objt = {};//objeto para validacion
        $estado = {};//estado del formulario        

        for(var i=0;i<$inputs.prevObject[0].length;i++){

          if(($inputs.prevObject[0][i]["value"]=="") && ($inputs.prevObject[0][i]["required"] == true)){

            $objt[i] = {
              id:$inputs.prevObject[0][i]["id"],
              valor:$inputs.prevObject[0][i]["value"],
              req:$inputs.prevObject[0][i]["required"]
            };

            //pone el estilo rojo
            $("#"+$inputs.prevObject[0][i]["id"]).css("border","solid 3px red");
            $("#"+$inputs.prevObject[0][i]["id"]).focus();

          }else{
            //pone el estilo verde
            $("#"+$inputs.prevObject[0][i]["id"]).css("border","solid 3px green");
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

        //devuelve el objeto
        return $estado;

  };

})(jQuery);
