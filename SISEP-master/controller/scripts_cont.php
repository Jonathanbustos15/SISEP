<?php
class scripts_pag
{

    public $arr_scripts = [];
    public $arr_css     = [];

    public function creaArrayScripts()
    {

        $this->arr_scripts = [

            "jQuery"                  => "bower_components/jquery/dist/jquery.js",

            "jQueryUI"                => "bower_components/jquery-ui/jquery-ui.js",
            "jQueryUI i18n"           => "bower_components/jquery-ui/ui/i18n/datepicker-es.js",
            "lightbox2-master"        => "bower_components/lightbox2-master/lightbox.js",
            //"jQueryfc"=>"https://code.jquery.com/jquery-3.3.1.js",

            "Bootstrap"               => "bower_components/bootstrap/dist/js/bootstrap.min.js",
            //"Metis Menu"=>"bower_components/metisMenu/dist/metisMenu.min.js",
            "DataTables"              => "bower_components/datatables/media/js/jquery.dataTables.min.js",
            "dataTables.bootstrap js" => "bower_components/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.js",

            //Plugin mask
            "mask.js"                 => "bower_components/jquery-mask-plugin/dist/jquery.mask.js",
            "formatCurrency.js"       => "bower_components/jquery-formatcurrency/jquery.formatCurrency-1.4.0.js",
            "accounting.js"           => "bower_components/accounting.js/accounting.min.js",

            //"DataTables-Bootstrap"=>"bower_components/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.min.js",
            //"DataTables-Data"=>"js/data_tabla.js",
            "validav1"                => "bower_components/valida_p.js/js/valida_p_v1.js",
            //"jquery ui widget"=>"js/jquery.ui.widget.js",
            //"jquery iframe-transport"=>"js/jquery.iframe-transport.js",
            "fileupload c"            => "bower_components/blueimp-file-upload/js/jquery.iframe-transport.js",
            "fileupload plugin"       => "bower_components/blueimp-file-upload/js/jquery.fileupload.js",
            //"moment"=>"js/plugins/calendario/moment.min.js",
            //"jquery-ui-timepicker"=>"js/plugins/calendario/jquery-ui-timepicker-addon.js",
            //"Setup Calendario"=>"js/plugins/calendario/calendarCotizacion.js",

            //"timer.js"=>"js/plugins/sesion_plugin/timer.jquery.js",
            //"bootstrap-treeview"=>"bower_components/bootstrap-treeview/public/js/bootstrap-treeview.js",
            //"valida_p_v1.js"=>"bower_components/valida_p.js/js/valida_p_v1.js",
            "jquery_controllerV2"     => "bower_components/jquery_controllerV2.js/jquery_controllerV2.js",
            //"validaArchivoPlugin.js"=>"bower_components/validaArchivoPlugin.js/validaArchivoPlugin.js",
            //"raphael-min.js"=>"bower_components/raphael/raphael-min.js",
            //"morris.js"=>"bower_components/morrisjs/morris.min.js",
            "sb-admin-2.js"           => "bower_components/sb-admin-2/js/sb-admin-2.js",
            "helper-global"           => "js/helper_global.js",
            "footer"                  => "js/footer.js",
            "hoshi"                   => "js/classie.js",
            "jquery17"                => "http://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js",
            "adipoimin"               => "bower_components/lightbox2-master/jquery.adipoli.min.js",
            //"index"=>"js/scripts_cont/cont_index.js",

        ];

    }

    public function creaArrayCss()
    {

        $this->arr_css = [

            "bootstrap"          => "bower_components/bootstrap/dist/css/bootstrap.min.css",
            "bootstrap theme"    => "bower_components/bootstrap/dist/css/bootstrap-theme.min.css",
            "sisep estilos"      => "bower_components/bootstrap/dist/css/sisep-estilos.css",
            "portlet"            => "bower_components/bootstrap/dist/css/porlet.css",
            "adipolicss"         => "bower_components/lightbox2-master/adipoli.css",

            "jQueryUI"           => "bower_components/jquery-ui/themes/ui-darkness/jquery-ui.css",
            "jQueryUI-bootstrap" => "bower_components/jquery-ui-bootstrap/jquery.ui.theme.css",
            "lightbox2-master"   => "bower_components/lightbox2-master/lightbox.css",
            //"metisMenu"=>"bower_components/metisMenu/dist/metisMenu.min.css",
            //"timeline"=>"dist/css/timeline.css",
            "sb-admin-2"         => "bower_components/sb-admin-2/css/sb-admin-2.css",
            //"morris"=>"bower_components/morrisjs/morris.css",
            "font-awesome"       => "bower_components/sb-admin-2/font-awesome-4.1.0/css/font-awesome.min.css",
            //"dataTables jquery"=>"bower_components/datatables/media/css/jquery.dataTables.css",
            //"dataTables f"=>"bower_components/datatables/media/css/dataTables.foundation.css",
            "dataTables"         => "bower_components/datatables/media/css/dataTables.bootstrap.css",
            //"dataTables.bootstrap"=>"bower_components/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.css",
            //"font-awesome"=>"bower_components/font-awesome/css/font-awesome.min.css",
            "fuentes"            => "bower_components/bootstrap/dist/css/stylesheet.css",
            //"jquery-ui-timepicker-addon"=>"js/plugins/calendario/jquery-ui-timepicker-addon.css",
            "inputs"             => "bower_components/bootstrap/dist/css/hoshi.css",
        ];

    }

    public function standar()
    {

        $this->creaArrayScripts();

        $paths = "";

        foreach ($this->arr_scripts as $key => $value) {

            $paths .= "<script src='../" . $value . "'></script>\n";
            $paths .= "<!-- " . $key . " -->\n";

        }

        echo $paths;
    }

    public function standarCss()
    {

        $this->creaArrayCss();

        $paths = "";

        foreach ($this->arr_css as $key => $value) {

            $paths .= "<link href='../" . $value . "' rel='stylesheet'>\n";
            $paths .= "<!-- " . $key . " -->\n";

        }

        echo $paths;
    }

    public function special($arr_script)
    {

        $this->standar();

        for ($i = 0; $i < sizeof($arr_script); $i++) {
            # code...
            echo '<script src="../js/scripts_cont/' . $arr_script[$i] . '"></script>';
        }
    }

    //------------------------------------------------------------------------------------------------------
}
