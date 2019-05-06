/*
Mi primer plugin
--------------------------------
la estructura basica para hacer un plugin es

(function($){
  $.fn.nombrefuncion = function (){
      //codigo de la funcion
  };
})(jQuery);
*/

(function($){
/*  $.fn.animar = function (){
      //codigo de la funcion

      $this = $(this)//se iguala al elemento que sea seleccionado

      $this.hover(function(){ //cuando se ponga el puntero sobre el elemento
          $this.animate({//se anima cambiandolo por estos valores
            height:'250px',
            width:'230px'
          })
      });
  };
*/
  $.fn.valida = function (boton){
      //codigo de la funcion

      $this = $(this)

      //$boton = $("#btn_valida");

      $boton = boton;

      $boton.click(function(){
        $valor = $this.val();

        if($valor == ""){
          console.log("Esta vacio."+$valor.length);

        }else{
          console.log("El valor del campo es: "+$valor.length);

        }
      });

  };

})(jQuery);
