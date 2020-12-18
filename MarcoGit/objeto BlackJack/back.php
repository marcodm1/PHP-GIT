
<?php
    if (!isset($_POST['nombre']) && !isset($_POST['dinero'])){
        echo "Error: no ha introducido alguno de los campos.";
    }
    if (!isset($_POST['continuar'])){
        echo "Error: no ha seleccionado nada.";
    }
 

    // _______________________________JUGADOR_______________________________
    class Jugador {
        private $dineroCartera;
        private $manoJugador = array();
        
        public function __construct($dineroCartera) {
            $this->dineroCartera = $dineroCartera;
        }
        public function getSumaManoJugador() {
            $suma = 0;
            for ($i=0; $i<count($this->manoJugador); $i++){
                $suma += $this->manoJugador[$i]->getNumeroCarta();
            }
            return $suma;
        }
        
        

    }
    // _______________________________CASINO_______________________________
    class Casino {
        // private $caja;
        private $manoCasino = array();

        public function __construct($num){
            $this->caja = $num;
        }
        
        public function getSumaManoCasino() {
            $suma = 0;
            for ($i=0; $i<count($this->manoCasino); $i++){
                $suma += $this->manoCasino[$i]->getNumeroCarta();
            }
            return $suma;
        }
        public function empezarPartida(){ 
            // repartir cartas a todos los jugadores
            for ($i=0; $i<2; $i++) { // numero de jugadores
                for ($i=0; $i<2; $i++) { // 2 cartas por cada jugador
                    if ($i == 0) {
                        // $num          = mt_rand(1, 13);
                        // $nuevaCarta   = new Carta($num);
                        // $this->manoCasino[] = $nuevaCarta;
                        // $this->baraja->quitarCarta($nuevaCarta);
                    }else {
                        $num          = mt_rand(1, 13);
                        $nuevaCarta   = new Carta($num);
                        $this->manoJugador[] = $nuevaCarta;
                        // $this->baraja->quitarCarta($nuevaCarta);
                    }
                }
            }
        }
        public function repartirUna() {

        }

    }
    // _______________________________CARTA_______________________________
    class Carta {
        private $numeroCarta;
         
        public function __construct($num){
            switch ($num){
                case 1: 
                    if ($num >0 && $num <10){
                        return $this->numeroCarta = $num;
                    }
                case 2:
                    if ($num >= 10 && $num <14){
                        return $this->numeroCarta = 10;
                    }
            }
        }
        public function getNumeroCarta() {
            return $this->numeroCarta;
        }
    }  
  
    // _______________________________PROGRAMA_______________________________

    $miJugador = new Jugador(100);
   
    $miCasino = new Casino(1000);
   
    

    // -------- 1ª partida ---------

    $miCasino->empezarPartida();
    guardarPartida();
    $miJugador->getSumaManoJugador(); // 5-10
    seguirJugando();
    if ($_POST['continuar'] == 'no') {
    }else {
        
    }
    
    
    // _______________________________FUNCIONES_______________________________

    function seguirJugando(){
        ?>
            <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST">
          
            <label for="continuar"><strong>Desea otra carta?</strong></label>
                    <label for="si">si</label>
                        <input type="radio" name="continuar" value="si">
                    <label for="no">no</label>
                            <input type="radio" name="continuar" value="no">

            <input type="submit" value="enviar">
        <?php
    }
    function guardarPartida(){
        session_start();
        // crear session con un objeto
        $object = new Jugador(100);
        $_SESSION['jugador'] = serialize($object);
    
        $object2 = new Casino(100);
        $_SESSION['casino'] = serialize($object2);
    
        $object3 = new Baraja(100);
        $_SESSION['baraja'] = serialize($object3);
    }
?>