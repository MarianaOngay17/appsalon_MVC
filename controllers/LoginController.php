<?php

namespace Controllers;

use MVC\Router;
use Model\Usuario;
use Classes\Email;

class LoginController{

    public static function login(Router $router){
        $alertas = [];
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $auth = new Usuario($_POST);
            $alertas = $auth->validarLogin();

            if(empty($alertas)){
                //comprobar que exista
                $usuario = Usuario::where('email', $auth->email);
                
                if($usuario){
                    //verificar password y confirmado
                    if($usuario->comprobarPasswordAndVerificado($auth->password)){
                        session_start();
                        $_SESSION['id'] = $usuario->id;
                        $_SESSION['nombre'] = $usuario->nombre . " " . $usuario->apellido;
                        $_SESSION['email'] = $usuario->email;
                        $_SESSION['login'] = true;

                        //redireccionamiento
                        if($usuario->admin === "1"){
                            $_SESSION['admin'] = $usuario->admin ?? null;
                            header('Location: /admin');
                        }else{
                            header('Location: /cita');
                        }
                       
                    }

                }else{
                    Usuario::setAlerta('error','Usuario no encontrado');
                }
            }
        }

        $alertas = Usuario::getAlertas();
       
        $router->render('auth/login', [
            'alertas' => $alertas
        ]);
    }

    public static function logout(){
        echo "desde logout";
    }

    public static function olvide(Router $router){
        $router->render('auth/olvide-password', []);
    }

    public static function recuperar(){
        echo "desde recuperar";
    }

    public static function crear(Router $router){

        $usuario = new Usuario;
        $alertas = [];

        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            
            $usuario->sincronizar($_POST);
            $alertas = $usuario->validarNuevaCuenta();

            //revisar alertas vacio
            if(empty($alertas)){
                //verificar que el usuario no este registrado
                $resultado = $usuario->existeUsuario();

                if($resultado->num_rows){
                    $alertas = Usuario::getAlertas();
                }else{
                    //hash password
                    $usuario->hashPassword();
                    //GENERAR TOKEN
                    $usuario->crearToken();
                    //enviar el email
                    $email = new Email($usuario->email, $usuario->nombre, $usuario->token);
                    $email->enviarConfirmacion();
                    //crear usuario
                    $resultado = $usuario->guardar();
                    if($resultado){
                        header('Location: /mensaje');
                    }
                
                    
                }
            }

        }

        $router->render('auth/crear-cuenta', [
            'usuario' => $usuario,
            'alertas' => $alertas
        ]);


    }

    public static function mensaje(Router $router){
         $router->render('auth/mensaje', []);
    }

    public static function confirmar(Router $router){
        $alertas = [];
        $token = s($_GET['token']);
        $usuario = Usuario::where('token', $token);

        if(empty($usuario)){
            //error
            Usuario::setAlerta('error','Token No Válido');
        }else{  
            //confirmar usuario
            $usuario->confirmado = "1";
            $usuario->token = "";
            $resultado = $usuario->guardar();
            Usuario::setAlerta('exito','Cuenta Comprobada Correctamente');
        }

        $alertas = Usuario::getAlertas();
        $router->render('auth/confirmar-cuenta', [
            'alertas' => $alertas
        ]);
    }

}