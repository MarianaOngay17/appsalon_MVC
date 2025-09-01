<?php

namespace Controllers;

use Model\Cita;
use Model\Servicio;
use Model\CitaServicio;

class APIController {

    public static function index(){
        $servicios = Servicio::all();
        echo json_encode($servicios);
    }

    public static function guardar(){
        //guardar cita y devuelve id
        $cita = new Cita($_POST);
        $resultado = $cita->guardar();

        $id = $resultado['id'];

        //almaceta la cita y el servicio
        $idServicios = explode(",", $_POST['servicios']);
        foreach($idServicios as $idServicio) {
            $args = [
                'citaId' => $id,
                'servicioId' => $idServicio
            ];
            $citaServicio = new CitaServicio($args);
            $citaServicio->guardar();
        }
        
        echo json_encode(['resultado' => $resultado]);

       
    }

}