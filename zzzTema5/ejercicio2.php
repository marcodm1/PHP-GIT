<?php
    if (!empty($_POST['nombre']) && !empty($_POST['edad']) && !empty($_POST['plato']) && !empty($_POST['horario'])) {
        echo "<ol>";
        foreach ($_POST as $algo) {
            if (is_array($algo)) {
                foreach ($algo as $clave => $valor) {
                    echo "<li>" . $valor . "</li>";
                }
            }else {
                echo "<li>" . $algo . "</li><br>";
            }
        }
        echo "</ol>";
    }else {
        $error = array();

        formulario();
    }

    function formulario() {
        ?>
        <form action="ejercicio2.php" method="post">
            
            <label for="txtnombre">Nombre del nuevo restaurante?:</label>
                <input type="text" name="nombre" id="txtnombre" minlength="5" value="<?php if(isset($_POST['nombre'])){echo $_POST['nombre'];} ?>"><br><br> <!-- no me funciona minlength -->

            <label for="numEdad">Es mayor de 18 años?:</label>
                <input type="checkbox" name="edadmas" id="numEdad" value="acepta1" <?php if(isset($_POST['edadmas'])){echo 'checked="checked"';} ?> ><br><br>

            <label for="numEdad">Es menor de 18 años?:</label>
                <input type="checkbox" name="edadmenos" id="numEdad" value="acepta2" <?php if(isset($_POST['edadmenos'])){echo 'checked="checked"';} ?> ><br><br>

            <!-- probar a hacer un array de checkeds -->

            <label for="plato">Seleccione su plato principal:</label><br>
                    <input type="radio" name="plato" value="macarrones" <?php if(isset($_POST['plato']) && $_POST['plato'] == "macarrones"){echo 'checked="checked"';} ?> >
                <label for="macarrones">Macarrones con chorizo</label><br>
                    <input type="radio" name="plato" value="carbonara" <?php if(isset($_POST['plato']) && $_POST['plato'] == "carbonara"){echo 'checked="checked"';} ?> >
                <label for="carbonara"> Pasta carbonara </label><br>
                    <input type="radio" name="plato" value="pizza" <?php if(isset($_POST['plato']) && $_POST['plato'] == "pizza"){echo 'checked="checked"';} ?> >
                <label for="pizza">     Pizza           </label><br>
                    <input type="radio" name="plato" value="burguer" <?php if(isset($_POST['plato']) && $_POST['plato'] == "burguer"){echo 'checked="checked"';} ?> >
                <label for="burguer">   Burguer         </label><br><br>

            <label for="horario">Seleccione su horario:</label>
                <select name="horario[]">
                    <option value="comidas">Comidas</option>
                    <option value="cenas" >Cenas</option>
                </select><br>
            <input type="submit" value="enviar">
        </form>
        <?php
    }

?>