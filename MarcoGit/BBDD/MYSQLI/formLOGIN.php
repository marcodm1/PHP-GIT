
<!DOCTYPE html>
<html lang="es">
<head>
    <title>Marco Domínguez</title>
    <meta charset="UTF-8">
    <meta name="author" content="Marco Dominguez">
    <meta name="description" content="ejercicio2 unodos">
</head>
<body>
    <?php 
        if (isset($_POST['name']) && isset($_POST['id'])){
            echo "Error: algun dato introducido no es correcto.";
        }

        mostrarFormulario();
        function mostrarFormulario( ){
            ?>
            <h1> Logearse como usuario de la tabla</h1>
                <form action="connLOGIN.php" method="post">
                    <label for="txtNombre">Nombre:</label>
                        <input type="text" name="name" id="txtNombre"><br><br>
                    <label for="pwd"> ID:</label>
                        <input type="id" name="id" id="pwd"><br><br>
                 
                    <input type="submit" value="enviar">
                </form>
            <?php
        }
    ?>
    

</body>
</html>