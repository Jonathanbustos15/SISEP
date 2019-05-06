(function(){
	//
	//console.log("Hola desde helper docentes.")

	//sistema de tabs
	//var id_li_activo = sessionStorage.getItem("id_tab_proceso_gen");

	self.tabs = {
		nombre_storage : "",
		id_li_activo :  null,
		arr_no_permit : [],
		nom_tab_default : "",
		value_tab : true,
		valida_tab : function(){

			this.id_li_activo = sessionStorage.getItem(this.nombre_storage);

			console.log(this.id_li_activo)

			$.each(this.arr_no_permit, function(index, val) {
				
				console.log("index: "+index+" valor: "+val);

				
				if (val == tabs.id_li_activo) {

					/*break;*/
					//le da clase activa a default
					$("#"+tabs.nom_tab_default).addClass('active');
					
					//console.log(tabs.nom_tab_default.substr(3))

					var nom_gen = tabs.nom_tab_default.substr(3);
					
					$("#"+nom_gen).addClass('active');

					tabs.value_tab = false;

					return false;								

				}else{

					tabs.value_tab = true;
				} 

				
			});

			if (this.value_tab) {
				//console.log(tabs.id_li_activo)

				$("#"+tabs.id_li_activo).addClass('active');

				$('ul a[href="#'+tabs.id_li_activo.slice(3,20)+'"]').tab('show');

				$("#"+tabs.id_li_activo.slice(3,20)).addClass('active');

			}

		},
		setClickRole : function(){

			$("[role=presentation]").click(function(event) {
				/* Act on the event */
				tabs.id_li_activo = $(this)[0].id;

				console.log($(this)[0].id);

				// Store
				sessionStorage.setItem(tabs.nombre_storage, $(this)[0].id);
			});

		},
		setTabs : function(){

			this.valida_tab()

			this.setClickRole();
		}		

	}

	//----------------------------------------------------------------

})()
