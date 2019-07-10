<?php

class sube_imagen
{

    //propiedades de la clase
    //--------------------
    public $archivo;
    //--------------------
    public $nombre;
    public $tipo;
    public $ruta_temporal;
    public $tamano;
    public $dimensiones;
    public $alto;
    public $ancho;
    //--------------------
    public $origen;
    public $destino;
    //--------------------

    //funciones de la clase

    //-------------------------------------------
    //asigna las variables

    public function __construct($archivo, $destino)
    {
        $this->archivo = $archivo;
        $this->destino = $destino;
    }

    //función de subida
    public function subir()
    {
        //$this->nombre = $this->archivo["name"];

        $this->asigna_val();

        $ejecucion = $this->mover_server();

        if ($ejecucion == "ok") {

            $mensaje = array('nombre' => $this->nombre,
                'estado'                  => "Archivo Tipo = " . $this->tipo . " tamaño = " . $this->tamano . " subido con éxito.",
                'src'                     => 'subidas/' . $this->nombre,
                'clase'                   => 'alert alert-success',
            );
        } else {
            $mensaje = array('nombre' => $this->nombre,
                'estado'                  => "Archivo " . $this->nombre . " no pudo ser movido al servidor, el archivo supera el límite de peso o no es de un formato permitido.",
                'tipo'                    => $this->tipo,
                'clase'                   => 'alert alert-danger',
            );
        }

        return $mensaje;
    }
    //--------------------------------------------------------------------------------------------------

    //funciones principales

    //-------------------------------------------
    //validar el archivo y asignar variables

    private function asigna_val()
    {
        //asigna variables del archivo
        $this->nombre        = $this->archivo["name"];
        $this->tipo          = $this->archivo["type"];
        $this->ruta_temporal = $this->archivo["tmp_name"];
        $this->tamano        = $this->archivo["size"];
        $this->dimensiones   = getimagesize($this->ruta_temporal);
        $this->alto          = $this->dimensiones[1];
        $this->ancho         = $this->dimensiones[0];

        $this->origen     = $this->ruta_temporal;
        $this->directorio = $this->destino;
        $this->destino    = $this->destino . $this->nombre;
    }
    //-------------------------------------------

    //-------------------------------------------
    //validar que el archivo sea una imagen menor de 1MB
    private function valida_image()
    {

        if ($this->tipo != "image/jpg" && $this->tipo != "image/png" && $this->tipo != "image/jpeg" && $this->tipo != "image/gif" && $this->tipo != "application/pdf" && $this->tipo != "application/msword" && $this->tipo != "application/vnd.oasis.opendocument.text" && $this->tipo != "application/vnd.openxmlformats-officedocument.wordprocessingml.document" && $this->tipo != "application/vnd.openxmlformats-officedocument.spreadsheetml.sheet" && $this->tipo != "application/vnd.ms-excel" && $this->tipo != "application/x-rar" && $this->tipo != "" && $this->tipo != "application/octet-stream") {
            //retorna mensaje de error
            //echo"ERROR!!!!...El tipo de archivo no es una imagen."; application/msword
            return false;

        } else if ($this->tamano > (1024 * 1024) * 500) #si es mayor que 500 mega 500MB
        {
            return false;
        } else {
            return true;
        }
    }
    //-------------------------------------------

    //-------------------------------------------
    //funcion para mover el archivo
    private function mover_server()
    {

        $valida = $this->valida_image();

        if ($valida == true) {

            move_uploaded_file($this->origen, $this->destino);

            return "ok";

        } else {

            return $valida;
        }

    }
    //-------------------------------------------

}
