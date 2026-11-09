<?php
// Incluir conexión y clase Cliente
require_once 'conexion.php'; // Tu archivo de conexión PDO
require_once 'Cliente.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $cliente = new Cliente($db);

    // Asignar los valores del formulario al objeto
    $cliente->nombre = $_POST['nombre'];
    $cliente->email = $_POST['email'];
    $cliente->telefono = $_POST['telefono'];

    if ($cliente->crear()) {
        header("Location: index.php?mensaje=creado");
    } else {
        echo "Error al registrar el cliente.";
    }
  }
