<?php
require_once 'conexion.php';
require_once 'Cliente.php';

if (isset($_GET['id'])) {
    $cliente = new Cliente($db);
    $cliente->id = $_GET['id'];

    if ($cliente->eliminar()) {
        header("Location: index.php?mensaje=eliminado");
    } else {
        echo "Error al eliminar el cliente.";
    }
} else {
    header("Location: index.php");
}
