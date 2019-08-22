(function($){
  $.fn.colorInput = function (opciones){
      //codigo de la funcion
      $this=$(this)

      var set = $.extend({
        color: "#556b2f"
      }, opciones );

      $this.css("background-color", set.color);
  };
})(jQuery);

/*

$.fn.greenify = function( options ) {

        // This is the easiest way to have default options.
        var settings = $.extend({
            // These are the defaults.
            color: "#556b2f",
            backgroundColor: "white"
        }, options );

        // Greenify the collection based on the settings variable.
        return this.css({
            color: settings.color,
            backgroundColor: settings.backgroundColor
        });

*/
