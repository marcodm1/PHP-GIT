<!DOCTYPE html>
<html lang="es">
	<head>
		<title>Marco Domínguez</title>
		<meta charset="UTF-8">
        <meta name="author"      content="Marco Dominguez">
        <meta name="description" content="Ejercicio session">
        
	</head>
	<body>
        <?php
            session_start();

            $_SESSION['nombre']    = "Marco";
            $_SESSION['apellido1'] = "Dominguez";
            $_SESSION['apellido2'] = "Mateos";

            echo "Creo una session con 3 parametros: <br>"; 
            echo "[nombre] [apellido1] [apellido2]<br>";
        ?>
        <a href="menu.php"> Volver al menu</a><br> 

    </body>
</html>