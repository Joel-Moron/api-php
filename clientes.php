<?php
    require_once './class/respuestas.php';
    require_once './class/classClientes.php';

    $_respuestas = new respuestas;

    $_clientes = new clientes;

    if ($_SERVER['REQUEST_METHOD'] == 'GET') {
        if(isset($_GET['page'])){
            $pagina = $_GET['page'];
            $listaClientes = $_clientes->listarClientes($pagina);
        }else if(isset($_GET['id'])){
            $clienteid = $_GET['id'];
            $listaClientes = $_clientes->obtenerCliente($clienteid);
        }else{
            $listaClientes = $_clientes->listarClientes();
        }
        echo json_encode($listaClientes);
    }else if ($_SERVER['REQUEST_METHOD'] == 'POST'){
        echo 'hola post';
    }else if ($_SERVER['REQUEST_METHOD'] == 'PUT'){
        echo 'hola put';
    }else if ($_SERVER['REQUEST_METHOD'] == 'DELETE'){
        echo 'hola delete';
    }else{
        header('Content-type: application/json');
        $datosArray = $_respuestas->error_405();
        echo json_encode($datosArray);
    }
?>