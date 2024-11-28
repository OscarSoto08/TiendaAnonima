<?php

class ClienteDAO{
    private $idPersona;
    private $nombre;
    private $apellido;
    private $correo;
    private $clave;
    private $estado;
    public function __construct($idPersona=null, $nombre=null, $apellido=null, $correo=null, $clave=null, $estado=null){
        $this -> idPersona = $idPersona;
        $this -> nombre = $nombre;
        $this -> apellido = $apellido;
        $this -> correo = $correo;
        $this -> clave = $clave;
        $this ->estado = $estado;
    }
    
    public function autenticar(){
        return "select idCliente
                from Cliente 
                where correo = '" . $this -> correo . "' and clave = '" . $this -> clave . "'";
    }
    
    public function consultar(){
        return "select nombre, apellido, correo, estado
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

    public function filtrar($filtro){
        return "SELECT idCliente, nombre, apellido, correo, estado
                FROM Cliente
                WHERE idCliente LIKE '%{$filtro}%' OR 
                        nombre LIKE '%{$filtro}%' OR 
                        apellido LIKE '%{$filtro}%' OR
                        correo LIKE '%{$filtro}%'";
    }

    public function cambiarEstado(){
        return "UPDATE cliente SET estado = {$this -> estado} WHERE idCliente = {$this -> idPersona}";
    }

    public function consultarTodos(){
        return 
        "SELECT idCliente, nombre, apellido, correo, estado
        FROM Cliente
        WHERE 1";
    }
}

?>