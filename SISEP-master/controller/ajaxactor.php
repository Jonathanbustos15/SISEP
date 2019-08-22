<?php

include '../DAO/genericoDAO.php';

class Generico_DAO
{

    use GenericoDAO;

}

$r    = array();
$tipo = isset($_POST['tipo']) ? $_POST['tipo'] : "";

switch ($tipo) {

    case 'consultarmunicipio':
        $generico = new Generico_DAO();

        $q_carga = "select * FROM `municipio` WHERE fkID_departamento = 30 ORDER BY nombre";

        $resultado = $generico->EjecutarConsulta2($q_carga);
        /**/
        if ($resultado) {
            while ($row = mysqli_fetch_row($resultado)) {
                $codigo    = $row[0];
                $codigodep = $row[1];
                $nombre    = $row[2];
                $r[]       = array('codigo' => $codigo, 'nombre' => $nombre, 'codigodepartamento' => $codigodep);
            }
        } else {
            $r["estado"] = "Error";
        }

        break;

    case 'consultardepartamento':
        $generico = new Generico_DAO();

        $q_carga = "select * FROM `departamento` ORDER BY nombre_departamento";

        $resultado = $generico->EjecutarConsulta2($q_carga);
        /**/
        if ($resultado) {
            while ($row = mysqli_fetch_row($resultado)) {
                $codigo = $row[0];
                $nombre = $row[1];
                $r[]    = array('codigo' => $codigo, 'nombre' => $nombre);
            }
        } else {
            $r["estado"] = "Error";
        }

        break;

    case 'consultarpais':
        $generico = new Generico_DAO();

        $q_carga = "select * FROM `pais` ORDER BY nombre_pais";

        $resultado = $generico->EjecutarConsulta2($q_carga);
        /**/
        if ($resultado) {
            while ($row = mysqli_fetch_row($resultado)) {
                $codigo = $row[0];
                $nombre = $row[1];
                $r[]    = array('codigo' => $codigo, 'nombre' => $nombre);
            }
        } else {
            $r["estado"] = "Error";
        }

        break;

    case 'consultarciudad':
        $id       = $_POST['id'];
        $generico = new Generico_DAO();

        $q_carga = "select * FROM `municipio` where fkID_departamento=" . $id . " ORDER BY nombre";

        $resultado = $generico->EjecutarConsulta2($q_carga);
        /**/
        if ($resultado) {
            while ($row = mysqli_fetch_row($resultado)) {
                $codigo    = $row[0];
                $codigodep = $row[1];
                $nombre    = $row[2];
                $r[]       = array('codigo' => $codigo, 'nombre' => $nombre);
            }
        } else {
            $r["estado"] = "Error";
        }

        break;

    case 'consultarciudad2':
        $id       = $_POST['id'];
        $generico = new Generico_DAO();

        $q_carga = "select fkID_pais,actor.fkID_departamento,fkID_municipio,municipio.nombre FROM actor
                        left join municipio on municipio.pkID = actor.fkID_municipio
                        where actor.pkID=" . $id;

        $resultado = $generico->EjecutarConsulta2($q_carga);
        /**/
        if ($resultado) {
            while ($row = mysqli_fetch_row($resultado)) {
                $fkID_pais         = $row[0];
                $fkID_departamento = $row[1];
                $fkID_municipio    = $row[2];
                $nombre            = $row[3];
                $r[]               = array('fkID_pais' => $fkID_pais, 'fkID_departamento' => $fkID_departamento, 'fkID_municipio' => $fkID_municipio, 'nombre' => $nombre);
            }
        } else {
            $r["estado"] = "Error";
        }

        break;

    case 'eliminarlogico':
        $id         = $_POST['id'];
        $generico   = new Generico_DAO();
        $q_inserta  = "update `actor` SET estadoV=2 where pkID='$id'";
        $r["query"] = $q_inserta;
        $resultado  = $generico->EjecutaActualizar($q_inserta);
        /**/
        if ($resultado) {
            $r[] = $resultado;

        } else {
            $r["estado"]  = "Error";
            $r["mensaje"] = "No se inserto.";
        }
        break;

    default:
        # code...
        break;
}

echo json_encode($r);
