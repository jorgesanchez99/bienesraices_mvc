<?php

namespace Controllers;

use Model\Admin;
use MVC\Router;

class LoginController{
    public static function login(Router $router){
        $errores = [];

        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $auth = new Admin($_POST);
            $errores = $auth->validar();
        

        if(empty($errores)){
            //*Verificar si el usuario existe
            $resultado = $auth->existeUsuario();
            if(!$resultado){
                //*Usuario no existe
                $errores = Admin::getErrores();
            }else{
                //*Usuario existe, verificar password
                $autenticado = $auth->comprobarPassword($resultado);
                if($autenticado){
                    //*Autenticar al usuario
                    $auth->autenticar();
                }else{
                    //*Password incorrecto
                    $errores = Admin::getErrores();
                }
            }
        }
        }

        $router->render('auth/login',[
            'errores' => $errores
        ]);
    }

    public static function logout(){
        session_start();
        $_SESSION = [];
        header('Location: /');          
    }
}