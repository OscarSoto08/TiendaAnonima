<?php

class Cliente extends Persona{
    
    
    public function __construct($idPersona=0, $nombre="", $apellido="", $correo="", $clave=""){
        parent::__construct($idPersona, $nombre, $apellido, $correo, $clave);
    }
}

?>




