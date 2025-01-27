<?php

namespace Controllers;
use MVC\Router;
use Model\Propiedad;
use Model\Vendedor;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\ImageManager as Image;


class PropiedadController{
    public static function index(Router $router){
        $propiedades = Propiedad::all();
        $resultado = $_GET['resultado'] ?? null;
        $vendedores = Vendedor::all();

        $router->render('propiedades/admin', [
            'propiedades' => $propiedades,
            'resultado' => $resultado,
            'vendedores' => $vendedores
        ]);
    }

    public static function crear(Router $router){
        $propiedad = new Propiedad;
        $vendedores = Vendedor::all();
        $errores = Propiedad::getErrores();

        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            //Crear una nueva instancia
            $propiedad = new Propiedad($_POST['propiedad']);

            //Validar
            
            
            //* Generar un nombre unico
            $nombreImagen = md5( uniqid( rand(), true ) ). ".jpg";
            if($_FILES['propiedad']['tmp_name']['imagen']){
                $manager= new Image(Driver::class);
                $image = $manager->read($_FILES['propiedad']['tmp_name']['imagen'])->cover(800,600);
                $propiedad->setImagen($nombreImagen);
            }
            
            $errores = $propiedad->validar();

            if(empty($errores)){
                 //* Subida de archivos
                //* Crear carpeta
                
                if(!is_dir(CARPETA_IMAGENES)){ //* is_dir: Indica si el fichero es un directorio
                    mkdir(CARPETA_IMAGENES);
                }

                //* Guardar la imagen en el servidor
                $image->save(CARPETA_IMAGENES . $nombreImagen);

                $propiedad->guardar();
            }
        }

        $router->render('propiedades/crear', [
            'propiedad' => $propiedad,
            'vendedores' => $vendedores,
            'errores' => $errores ?? []
        ]);
        
    }

    public static function actualizar(Router $router){
        $id = validarORedireccionar('admin');
        $propiedad = Propiedad::find($id);
        $vendedores = Vendedor::all();
        $errores = Propiedad::getErrores();

        //* Metodo POST para actualizar
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            //* Asignar los atributos
             $args = $_POST['propiedad'];
             $propiedad -> sincronizar($args);
     
             //* Validacion
             $errores = $propiedad->validar();
     
             //* Subida de archivos 
             //* Generar un nombre unico
             $nombreImagen = md5( uniqid( rand(), true ) ). ".jpg";
     
             if($_FILES['propiedad']['tmp_name']['imagen']){
                 $manager= new Image(Driver::class);
                 $image = $manager->read($_FILES['propiedad']['tmp_name']['imagen'])->cover(800,600);
                 $propiedad->setImagen($nombreImagen);
             }
     
             //* Revisar que el arreglo de errores este vacio
             if(empty($errores)){
                 //* Almacenar la imagen
                 if($_FILES['propiedad']['tmp_name']['imagen']){
                     $image->save(CARPETA_IMAGENES . $nombreImagen);
                 }
     
                 $propiedad->guardar();
                 
             }
     
         }

        $router->render('propiedades/actualizar', [
            'propiedad' => $propiedad,
            'vendedores' => $vendedores,
            'errores' => $errores
        ]);
    }

    public static function eliminar(){
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            //*Validar ID
            $id = $_POST['id'];
            $id = filter_var($id, FILTER_VALIDATE_INT);

            if($id){
                $tipo = $_POST['tipo'];
                if (validarTipoContenido($tipo)) {
                    $propiedad = Propiedad::find($id);
                    $propiedad->eliminar();
                }
            }
        }
    }
}