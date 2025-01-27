<?php

namespace Controllers;

use Model\Propiedad;
use MVC\Router;
use PHPMailer\PHPMailer\PHPMailer;

class PaginasController{

    public static function index(Router $router){
        $propieades = Propiedad::get(3);
        $inicio = true;
        $router->render('paginas/index', [
            'inicio' => $inicio,
            'propiedades' => $propieades
        ]);
    }

    public static function nosotros(Router $router){
        $router->render('paginas/nosotros', []);
    }

    public static function propiedades(Router $router){
        $propieades = Propiedad::all();
        $router->render('paginas/propiedades', [
            'propiedades' => $propieades
        ]);
    }


    public static function propiedad(Router $router){
        $id = validarORedireccionar('propiedades');
        if($id){
            $propiedad = Propiedad::find($id);
            if(!$propiedad){
                header('Location: /propiedades');
            }
        }
        $router->render('paginas/propiedad', [
            'propiedad' => $propiedad
        ]);

    }

    public static function blog(Router $router){
        $router->render('paginas/blog', []);
    }

    public static function entrada(Router $router){
        $router->render('paginas/entrada', []);
    }
    public static function contacto(Router $router){
        $mensaje = null;
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $respuestas = $_POST['contacto'];


            //*Crear una instancia de PHPMailer
            $mail = new PHPMailer();
            //*Configurar SMTP
            $mail->isSMTP();
            $mail->Host = 'sandbox.smtp.mailtrap.io';
            $mail->SMTPAuth = true;
            $mail->Username = '338aee6210d2aa';
            $mail->Password = '2124c8dd8229d8'; 
            $mail->SMTPSecure = 'tls';
            $mail->Port = 2525;



            //*Configurar el contenido del email
            $mail->setFrom('admin@bienesraices.com');
            $mail->addAddress('admin@bienesraices.com', 'BienesRaices.com');
            $mail->Subject = 'Tienes un mensaje nuevo';

            //*Habilitar HTML
            $mail->isHTML(true);
            $mail->CharSet = 'UTF-8';

            //*Contenido del email
            $contenido = '<html>';
            $contenido .= '<p>Tienes un nuevo mensaje</p>';
            $contenido .= '<p>Nombre: '.$respuestas['nombre'].'</p>';

            //*Enviar de forma condicional algunos campos de email o telefono
            if($respuestas['contacto'] === 'telefono'){
                $contenido .= '<p>Eligio ser contactado por telefono</p>';
                $contenido .= '<p>Telefono: '.$respuestas['telefono'].'</p>';
                $contenido .= '<p>Fecha: '.$respuestas['fecha'].'</p>';
                $contenido .= '<p>Hora: '.$respuestas['hora'].'</p>';
            }else{
                $contenido .= '<p>Eligio ser contactado por email</p>';
                $contenido .= '<p>Email: '.$respuestas['email'].'</p>';
            }

            $contenido .= '<p>Mensaje: '.$respuestas['mensaje'].'</p>';
            $contenido .= '<p>Vende o Compra: '.$respuestas['tipo'].'</p>';
            $contenido .= '<p>Precio o Presupuesto: S/'.$respuestas['precio'].'</p>';
            $contenido .= '<p>Prefiere ser contactado por: '.$respuestas['contacto'].'</p>';
            $contenido .= '</html>';

            //*Contenido del email
            $mail -> Body = $contenido;
            $mail -> AltBody = 'Texto alternativo sin HTML';

            //*Enviar el email
            if($mail->send()){
                $mensaje = 'Mensaje enviado correctamente';
            }else{
                $mensaje = 'El mensaje no se pudo enviar';
            }
            
        }
        $router->render('paginas/contacto', [
            'mensaje' => $mensaje
        ]);
    }






}