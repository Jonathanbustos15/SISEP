(function($){
  
  $.fn.overlooker = function (opciones){
      //codigo de la funcion
      /*plugin que se instancia desde un formulario
      */
      this.stage_form_overlook = $(this)[0];

      var ajustes = $.extend({
      		//validaciones por defecto
      		validations : [
      			{      				
      				id : "nombre",
      				expresion : "no_vacio",
      				evento : "change"      				
      			}
      		],
      		//-----------------------------------------------------------------
	        //set de expresiones regulares
	        solo_letras : [ 
				{
					valor:/^[a-z A-Z]*$/,
					err_mens:"Este campo solo permite letras mayúsculas o minúsculas."
				}
			],			
	        solo_numeros : [ 
				{
					valor:/^[\d]*$/,
					err_mens:"Este campo solo permite números."
				}
			],
	        no_vacio : [
	        	{
	        		valor:/^[^]+$/,
	        		err_mens:"Este campo no puede ser vacío."
	        	}
	        ],
	        telefono : [ 
		        {
		            valor:/^\d{5,15}$/,
		            err_mens:"Este campo no es un número de teléfono válido.[Solo números 5 a 15 caractéres.]"
		        }
		    ],
		    doc_identidad : [ 
		        {
		            valor:/^\d{6,12}$/,
		            err_mens:"Este campo no es un número de identidad válido.[Solo números 6 a 12 caractéres.]"
		        }
		    ],
		    email : [ 
		        {
		            valor:/([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})/,
		            err_mens:"La dirección de correo no es válida."
		        }
		    ],
	        //-----------------------------------------------------------------

      }, opciones);      

      //Este es el formulario en el que se instancia el plugin
      console.log(this.stage_form_overlook);

      
      //-----------------------------------------------------------------
      //Ejecuta validacion para campo

      this.valida_change = function(selector,expresion){
      		
      		var self = this;
      		
  			selector.change(function(e) {

  				self.validator_exe(selector,expresion)
  			});			
      }

      this.valida_keyup = function(selector,expresion){
      		
      		var self = this;      		
  			
  			selector.keyup(function(e) {

  				self.validator_exe(selector,expresion)
  			});			
      }

      this.validator_exe = function(selector, expresion){

      		if( !ajustes[expresion][0].valor.test(selector.val()) ) {
				alert(ajustes[expresion][0].err_mens);					
				selector.val("")
				selector.focus()
			}
      }
      //-----------------------------------------------------------------          
      

      //-----------------------------------------------------------------
      //inicia mirando el array de validaciones
      this.lookAjustes = function(){
      		var self = this;

        	var itera_vals = $.each(ajustes.validations, function(index, val) {
        		console.log(val)
        		//-----------------------------------------------------------
        		//busca el campo
        		var campo_jquery = self.searchField(val.id)
        		//ejecuta la funcion del campo
        		//console.log(campo_jquery)        		

        		//se define en que evento se va a ejecutar la validación
        		switch (val.evento) {

        			case "change":
        					//-----------------------------
        					self.valida_change(campo_jquery, val.expresion)
        					//-----------------------------
        				break;
        			case "keyup":
        					//-----------------------------
        					self.valida_keyup(campo_jquery, val.expresion)
        					//-----------------------------
        				break;        			
        		}        		
        		//-----------------------------------------------------------
        	});

        	$.when(itera_vals).then(function(){
        		console.log("overlooker Set!")
        	});
        	
      }

      //retorna el campo de tipo jquery
      this.searchField = function(id_search){
      	  
      	  var field;

      	  console.log(this.stage_form_overlook["id"])

	      var itera = $.each(this.stage_form_overlook, function(index, val) {
	      		console.log(val["id"])

	      		if (val["id"] == id_search) {
	      			field = val["id"];
	      		}
	      });

	      return $("#"+this.stage_form_overlook["id"]+" #"+field);
      }

      
      //ejecuta la funcion de ver los ajustes
      this.lookAjustes()
      //-----------------------------------------------------------------
      
      
      
  };
})(jQuery);