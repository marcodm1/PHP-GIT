<?php
    if (!isset($_COOKIE['name']) && isset($_COOKIE['password'])){
            echo "Error: No se ha logeado correctamente.";
            header("connLOGIN.php");
    }

    if ( !isset($_POST['name']) ) {
        echo "no ha introducido el campo correctamente";
        formularioUsuario(); 
    }else {
        $name = $_POST['name'];
        require_once("ConectaBD.php");
        $consulta  = ConectaBD::singleton();
        $resultado = $consulta->createUsuario($name);
        var_dump($resultado->fetch_all());
        ?>
            <li><a href="menu.php">Volver al menu</a></li>
        <?php
    }
        
    function formularioUsuario(){
        ?>
            <form action="<?php echo $_SERVER['PHP_SELF']?>" method="post">
                <label for="txtNombre">Nombre:</label>
                    <input type="text" name="name" id="txtNombre"><br><br>
                
                <input type="submit" value="enviar">
            </form>
        <?php
    }
    


?>