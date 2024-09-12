<?php 
class CategoriaDAO{

    public function consultarTodos(){
        return "select idCategoria, nombre
                from Categoria";
    }
}
?>