<?php

class ClienteDAO{
    private $idPersona;
    private $nombre;
    private $apellido;
    private $correo;
    private $clave;

    public function __construct($idPersona=null, $nombre=null, $apellido=null, $correo=null, $clave=null){
        $this -> idPersona = $idPersona;
        $this -> nombre = $nombre;
        $this -> apellido = $apellido;
        $this -> correo = $correo;
        $this -> clave = $clave;
    }
    
    public function autenticar(){
        return "select idCliente
                from Cliente 
                where correo = '" . $this -> correo . "' and clave = '" . $this -> clave . "'";
    }
    
    public function consultar(){
        return "select nombre, apellido, correo
                from Cliente
                where idCliente = '" . $this -> idPersona . "'";
    }

    public function registrar(){
        return "insert into Cliente (nombre, apellido, correo, clave)
                values ('" . $this -> nombre . "', '" .
                             $this -> apellido . "', '" .
                             $this -> correo . "', '" .
                             $this -> clave . "')";
    }
}

?>