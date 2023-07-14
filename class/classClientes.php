<?php
    require_once './class/conexion/conexion.php';
    require_once './class/respuestas.php';

    class clientes extends conexion {

        private $table = 'usuario';

        public function listarClientes($pagina = 1){
            $inicio = 0 ;
            $cantidad = 100;
            if ($pagina >= 1){
                $inicio = $cantidad*($pagina - 1);
                $cantidad = $cantidad * $pagina;
            }

            $query = "SELECT * FROM " . $this->table . " WHERE rol_id = 3 LIMIT $cantidad OFFSET $inicio";
            $datos = parent::obtenerDatos($query);
            return($datos);
        }

        public function obtenerCliente($id){
            $_respuestas = new respuestas;
            $query = "SELECT * FROM " . $this->table . " WHERE usu_id = $id and rol_id = 3";
            $result = parent::obtenerDatos($query);
            if(isset($result)){
                return ($result);
            }else{
                return $_respuestas->error_200("no se encontro cliente con el id");
            }
            
        }

    }
?>