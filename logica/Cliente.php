<?php

class Cliente extends Persona{
    
    public function __construct($idPersona=0, $nombre="", $apellido="", $correo="", $clave=""){
        parent::__construct($idPersona, $nombre, $apellido, $correo, $clave);
    }
    
    public function registrar(){
        $conexion = new Conexion();
        $conexion -> abrirConexion();
        $clienteDAO = new ClienteDAO($this -> idPersona, $this -> nombre, $this -> apellido, $this -> correo, $this -> clave);
        $conexion -> ejecutarConsulta($clienteDAO -> registrar());
        $this -> idPersona = $conexion -> obtenerLlaveAutonumerica();
        $conexion -> cerrarConexion();
        echo $this -> idPersona;
    }
 
    public function autenticar(){
        $conexion = new Conexion();
        $conexion -> abrirConexion();
        $clienteDAO = new ClienteDAO(null, null, null, $this -> correo, $this -> clave);
        $conexion -> ejecutarConsulta($clienteDAO -> autenticar());
        if($conexion -> numeroFilas() == 0){
            $conexion -> cerrarConexion();
            return false;
        }else{
            $registro = $conexion -> siguienteRegistro();
            $this -> idPersona = $registro[0];
            $conexion -> cerrarConexion();
            return true;
        }
    }
    
    public function consultar(){
        $conexion = new Conexion();
        $conexion -> abrirConexion();
        $clienteDAO = new ClienteDAO($this -> idPersona);
        $conexion -> ejecutarConsulta($clienteDAO -> consultar());
        $registro = $conexion -> siguienteRegistro();
        $this -> nombre = $registro[0];
        $this -> apellido = $registro[1];
        $this -> correo = $registro[2];
        $conexion -> cerrarConexion();
    }
}

?>




