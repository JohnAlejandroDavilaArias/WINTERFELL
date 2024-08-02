<?php
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");

require_once ("../conexion.php");
require_once ("../modelos/notas.php");

$control = $_GET['control'];

$notas = new Notas($conexion);

switch ($control) {
    case 'consulta':
        $vec = $notas->consulta();
        break;

    case 'insertar':
        //
        $json = '{"fecha":"1998-06-11","hora":"06:00:00"}';
        //$json = file_get_contents('php://input');
        $params = json_decode($json);
        $vec = $notas->insertar($params);
        break;

    case 'eliminar':
        $id = $_GET['id'];
        $vec = $notas->eliminar($id);
        break;

    case 'editar':
        //$json = '{"fecha":"1998-06-11","hora":"06:00:00","nota":"Fecha de nacimiento"}';
        $json = file_get_contents('php://input');
        $params = json_decode($json);
        $id = $_GET['id'];
        $vec = $notas->editar($id, $params);
        break;

    case 'filtro':
        $dato = $_GET['dato'];
        $vec = $notas->filtro($dato);
        break;
}

$datosj = json_encode($vec);
header('Content-Type: application/json');
echo $datosj;
