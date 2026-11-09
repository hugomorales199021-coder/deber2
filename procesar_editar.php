<?php
require_once 'conexion.php';
require_once 'Cliente.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $cliente = new Cliente($db);

    $cliente->id = $_POST['id'];
    $cliente->nombre = $_POST['nombre'];
    $cliente->email = $_POST['email'];
    $cliente->telefono = $_POST['telefono'];

    if ($cliente->actualizar()) {
        header("Location: index.php?mensaje=actualizado");
    } else {
        echo "Error al actualizar el cliente.";
    }
}
