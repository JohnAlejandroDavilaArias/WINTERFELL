<?php
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");

require_once ("../conexion.php");
require_once ("../modelos/citas.php");

$control = $_GET['control'];

$citas = new Citas($conexion);

switch ($control) {
    case 'consulta':
        $vec = $citas->consulta();
        break;

    case 'insertar':
        //$json = '{"fecha":"1998-06-11","hora":"06:00:00"}';
        $json = file_get_contents('php://input');
        $params = json_decode($json);
        $vec = $citas->insertar($params);
        break;

    case 'eliminar':
        $id = $_GET['id'];
        $vec = $citas->eliminar($id);
        break;

    case 'editar':
        //$json = '{"fecha":"1998-06-11","hora":"06:00:00","nota":"Fecha de nacimiento"}';
        $json = file_get_contents('php://input');
        $params = json_decode($json);
        $id = $_GET['id'];
        $vec = $citas->editar($id, $params);
        break;

    case 'filtro':
        $dato = $_GET['dato'];
        $vec = $citas->filtro($dato);
        break;
}

$datosj = json_encode($vec);
header('Content-Type: application/json');
echo $datosj;
