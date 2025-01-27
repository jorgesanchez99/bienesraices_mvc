<?php
namespace Model;

class ActiveRecord{
        //* DB
        protected static $db;
        protected static $tabla = '';
        protected static $columnas = [];
        
    
        //* Errores-Validacion
        protected static $errores = [];
    
        //* Definir la conexión a la base de datos
        public static function setDB($database){
            self::$db = $database;
        }
    
        public function guardar(){
            if(isset($this->id)){
                $this->actualizar();
            }else{
                $this->crear();
            }
        }
    
        //* Almacenar la propiedad en la base de datos
        public function crear(){
            //* Sanitizar los datos
            $atributos = $this->sanitizarAtributos();
            
    
            //* Insertar en la base de datos
            $query = "INSERT INTO " . static::$tabla . " ( ";
            $query .= join(', ', array_keys($atributos));
            $query .= " ) VALUES (' ";
            $query .= join("', '", array_values($atributos));
            $query .= " ') ";
    
            // echo $query;
            $resultado = self::$db->query($query);
            if($resultado){
                //* Redireccionar al usuario
                header('Location: /admin?resultado=1');
            }else{
                echo "Error";
            }
        }
    
        //* Actualizar la propiedad en la base de datos
        public function actualizar(){
            //* Sanitizar los datos
            $atributos = $this->sanitizarAtributos();
    
            $valores = [];
            foreach($atributos as $key => $value){
                $valores[] = "{$key} = '{$value}'";
            }
    
            //* Insertar en la base de datos
            $query = "UPDATE " . static::$tabla . " SET ";
            $query .= join(', ', $valores);
            $query .= " WHERE id = '" . self::$db->escape_string($this->id) . "' ";
            $query .= " LIMIT 1 ";
            
            $resultado = self::$db->query($query);
            if($resultado){
                //* Redireccionar al usuario
                header('Location: /admin?resultado=2');
            }else{
                echo "Error";
            }
        }
    
        //* Eliminar la propiedad
        public function eliminar(){
            $query = "DELETE FROM " . static::$tabla . " WHERE id = " . self::$db->escape_string($this->id) . " LIMIT 1";
            $resultado = self::$db->query($query);
            if($resultado){
                $this->borrarImagen();
                header('Location: /admin?resultado=3');
            }
        }
    
        public function atributos(){
            $atributos = [];
            foreach(static::$columnas as $columna){
                if($columna === 'id') continue;
                $atributos[$columna] = $this->$columna;
            }
            return $atributos;
    
        }
    
        //* Sanitizar los datos
        public function sanitizarAtributos(){
            $atributos = $this->atributos();
            $sanitizado = [];
            foreach($atributos as $key => $value){
                $sanitizado[$key] = mysqli_real_escape_string(self::$db, $value);
            }
            return $sanitizado;
    
        }
    
        //* Validar
        public static function getErrores(){
            return static::$errores;
        }
    
        public function validar(){
            static::$errores = [];
            return static::$errores;
        }
    
        //* Subida de archivos
        public function setImagen($imagen){
            //*Eliminar la imagen previa
            if(isset($this->id)){
                $this->borrarImagen();  
            }
            if($imagen){
                $this->imagen = $imagen;
            }
        }
        //* Eliminar imagen
        public function borrarImagen(){
            //* Comprobar si la imagen existe
            $existeArchivo = file_exists(CARPETA_IMAGENES . $this->imagen);
            if($existeArchivo){
                unlink(CARPETA_IMAGENES . $this->imagen);
            }
        }
    
        //* Lista todas las propiedades
        public static function all(){
            $query = "SELECT * FROM " . static::$tabla;
    
            $resultado = self::consultarSQL($query);
    
            return $resultado;
        }

        //* Lista propiedades por limite
        public static function get($limite){
            $query = "SELECT * FROM " . static::$tabla . " LIMIT " . $limite;
    
            $resultado = self::consultarSQL($query);
    
            return $resultado;
        }
    
        //* Busca una propiedad por su id
        public static function find($id){
            $query = "SELECT * FROM " . static::$tabla . " WHERE id = {$id}";
    
            $resultado = self::consultarSQL($query);
    
            return array_shift($resultado); //* array_shift: Devuelve el primer valor de un array
        }
    
        public static function consultarSQL($query){
            //* Consultar la base de datos
            $resultado = self::$db->query($query);
    
            //* Iterar los resultados
            $array = [];
            while($registro = $resultado->fetch_assoc()){
                $array[] = static::crearObjeto($registro);
            }
    
            //* Liberar la memoria
            $resultado->free();
    
            return $array;
        }
    
        protected static function crearObjeto($registro){
            $objeto = new static; 
    
            foreach($registro as $key => $value){
                if(property_exists($objeto, $key)){
                    $objeto->$key = $value;
                }
            }
    
            return $objeto;
        }
    
        //* Sincrionizar el objeto en memoria con los datos de la base de datos
        public function sincronizar($args = []){
            foreach($args as $key => $value){
                if(property_exists($this, $key) && !is_null($value)){
                    $this->$key = $value;
                }
            }
        }
}