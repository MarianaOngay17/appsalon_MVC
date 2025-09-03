<?php

namespace Controllers;

use MVC\Router;
use Model\Servicio;

class ServicioController{

    public static function index(Router $router){
        session_start();

        $servicios = Servicio::all();

        $router->render('servicios/index',[
            'nombre' => $_SESSION['nombre'],
            'servicios' => $servicios
        ]);
    }

    public static function crear(Router $router){
        session_start();

        $servicios = new Servicio;
        $alertas = [];

        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $servicios->sincronizar($_POST);
            $alertas = $servicios->validar();

            if(empty($alertas)){
                $servicios->guardar();
                header('Location: /servicios');
            }

        }

        
        $router->render('servicios/crear',[
            'nombre' => $_SESSION['nombre'],
            'servicios' => $servicios,
            'alertas' => $alertas
        ]);
    }

    public static function actualizar(Router $router){
        session_start();

        $servicios = new Servicio;

        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            
        }

       
        $router->render('servicios/actualizar',[
            'nombre' => $_SESSION['nombre'],
            'servicios' => $servicios
        ]);
    }

    public static function eliminar(Router $router){

        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            
        }
    }
}