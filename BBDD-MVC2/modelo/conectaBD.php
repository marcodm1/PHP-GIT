<?php

    class ConectaBD {
        private $conexion;
        private static $instancia;

        private function __construct() {
            $this->conexion = new PDO('mysql:host=localhost;dbname=dwes', 'root', '');
        }

        public static function singleton(){     // comprueba si hay una instancia, y si no hay, se crea el objeto en la variable $instancia
            if (!isset(self::$instancia)) {     // se usa :: porque es static
                $miclase = __CLASS__;           // __CLASS__ retorna el nombre de la clase
                self::$instancia = new $miclase;// self es para los static
            }
            return self::$instancia; // devuelve el objeto tipo instancia
        } 

        function comprobarUsuario($id, $password) {
            $consulta = $this->conexion->prepare("SELECT * from personas where id=:id");// quito contraseña
            $consulta->bindParam(":id", $id); 
            $consulta->execute();
            $resultado = $consulta->fetchObject(); // fetch object convierte el resultado a un obj
            if (!isset($resultado) ) {
                return false;
            }
            $passwordHash = $resultado->contrasenia;
            if (!password_verify($password, $passwordHash)) {
                return false;
            }
            return true;
        }
       
        function createUsuario($nombre, $apellido, $pais, $contraseña) {
            $pass     = password_hash($contraseña, PASSWORD_DEFAULT);
            $consulta = $this->conexion->prepare("INSERT into personas (nombre, apellido, pais, contrasenia)  values (:nombre, :apellido, :pais, :contrasenia)");
            $consulta->bindParam(":nombre"     , $nombre);
            $consulta->bindParam(":apellido"   , $apellido);
            $consulta->bindParam(":pais"       , $pais);
            $consulta->bindParam(":contrasenia", $pass);
            $consulta->execute();
            if ($consulta) {
                return true;
            }else {
                return false;
            }
        }

        function readUsuario($name, $pagina) {
            $consulta1 = $this->conexion->prepare("SELECT count(*) FROM personas WHERE nombre = :nombre1");
            $consulta1->bindParam(":nombre1", $name); 
            $consulta1->execute(); // como es count devuelve una tabla con una columna y una fila, con el numero de resultados encontrados
            $count         = $consulta1->fetchColumn(); // devuelve el 1º resultado de la columna 1ª y si se vuelve a llamar, devuelve el 2º resultado de la misma columna
            $limitePagina  = 2;
            $numeroPaginas = ceil($count/$limitePagina); //ceil simplemente redondea hacia arriba el numero de paginas que se van a crear
            $empiezaEn     = ($pagina - 1) * $limitePagina;

            $consulta2 = $this->conexion->prepare("SELECT * FROM personas WHERE nombre = :nombre ORDER BY apellido asc limit $empiezaEn, $limitePagina");
            $consulta2->bindParam(":nombre", $name); 
            $consulta2->execute();
            $resultado2 = $consulta2->fetchAll(PDO::FETCH_ASSOC);
            if ($resultado2) {
                return $resultado2;
            }else {
                return false;
            }
        }

        function updateUsuario($name, $nameNuevo) {
            $consulta = $this->conexion->prepare("UPDATE personas set nombre=:nameNuevo where nombre=:nombre ");
            $consulta->bindParam(":nameNuevo", $nameNuevo);
            $consulta->bindParam(":nombre", $name);
            $resultado2 = $consulta->execute();
            if ($resultado2) {
                return $resultado2;
            }else {
                return false;
            }
        }

        function deleteUsuario($id) {
            $consulta = $this->conexion->prepare("DELETE from personas where  id=:id");
            $consulta->bindParam(":id", $id);
            $resultado2 = $consulta->execute();
            if ($resultado2) {
                return $resultado2;
            }else {
                return false;
            }
        }


        function mostrarTodo() {
            $consulta2 = $this->conexion->prepare("SELECT id, nombre FROM personas");
            $consulta2->execute();
            $resultado2 = $consulta2->fetchAll(PDO::FETCH_ASSOC);
            if ($resultado2) {
                return $resultado2;
            }else {
                return false;
            }
        }
        
    
    }
?>  

