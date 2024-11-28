<?php

class Cliente extends Persona{
    private $estado;
    public function __construct($idPersona=0, $nombre="", $apellido="", $correo="", $clave="", $estado= "") {
        parent::__construct($idPersona, $nombre, $apellido, $correo, $clave);
        $this->estado = $estado;
    }
    public function getEstado(){ return $this -> estado; }
    public function setEstado($estado) { $this -> estado = $estado; }
    
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
    public function consultarTodos(){
        $clientes = [];
        $conexion = new Conexion();
        $conexion -> abrirConexion();
        $clienteDAO = new ClienteDAO();
        $conexion -> ejecutarConsulta($clienteDAO -> consultarTodos());
        while($registro = $conexion -> siguienteRegistro()){
            $cliente = new Cliente(idPersona: $registro[0], nombre: $registro[1], apellido: $registro[2], correo: $registro[3], estado: $registro[4]);
            array_push($clientes, $cliente);
        }
        $conexion -> cerrarConexion();
        return $clientes;        
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
        $this -> estado = $registro[3];
        $conexion -> cerrarConexion();
    }

    public function filtrar($filtro){
        $clientes = [];
        $conexion = new Conexion();
        $conexion -> abrirConexion();
        $clienteDAO = new ClienteDAO();
        $conexion -> ejecutarConsulta($clienteDAO -> filtrar($filtro));
        switch ($conexion->numeroFilas()) {
            case 0:
                $conexion->cerrarConexion();
                return null;
            default:
                $conexion->cerrarConexion();
                while($fila = $conexion -> siguienteRegistro()) {
                    array_push($clientes, new Cliente(
                        idPersona: $fila[0], nombre: $fila[1], apellido: $fila[2], correo: $fila[3], estado: $fila[4]
                    ));
                }
            return $clientes;
        }
    }

    public function cambiarEstado(){
        $conexion = new Conexion();
        $clienteDAO = new ClienteDAO(idPersona: $this -> idPersona, estado: $this -> getEstado());
        $conexion -> abrirConexion();
        $conexion -> ejecutarConsulta(sentenciaSQL: $clienteDAO -> cambiarEstado());
        $conexion -> cerrarConexion();
    }
}

?>




