(function(){

	/* html para los checks
	<div class="form-group">
      <div class="checkbox">
            <label class="col-sm-2 control-label">
                <div class="col-sm-10">
                    <input type="checkbox" id="chk_admin" name="admin" value="0">
                    <input type='hidden' id="chk_admin_hidden" value='0' name='admin'>
                    Administrador                                
                </div>
            </label>
      </div>    
    </div>
	*/

	self.chk_t = {

		selector : '',
		chk_rec : function(tipo){

			if (tipo == true) {	          
	          $("#"+this.selector).val('1');
	        } else{	          
	          $("#"+this.selector).val('0');	          
	        };

		},
		chk_rec_t : function(){

			$("#"+this.selector).click(function(event) {

			  chk_t.chk_rec($(this)[0]["checked"])
    
		      if(document.getElementById(chk_t.selector).checked) {
		          document.getElementById(chk_t.selector+'_hidden').disabled = true;
		      }else{
		        document.getElementById(chk_t.selector+'_hidden').disabled = false;
		      }

		    });
		}
	}
	
})()