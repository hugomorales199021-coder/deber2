<?php
require_once 'conexion.php';
require_once 'Cliente.php';

// Validar que exista el ID en la URL
if (!isset($_GET['id'])) {
    header("Location: index.php");
    exit;
}

$cliente = new Cliente($db);
$cliente->id = $_GET['id'];

// Buscar los datos del cliente para rellenar el formulario
if (!$cliente->leerUno()) {
    echo "Cliente no encontrado.";
    exit;
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Editar Cliente</title>
</head>
<body>
    <h2>Modificar Datos del Cliente</h2>
    
    <form action="procesar_editar.php" method="POST">
        <!-- Campo oculto para enviar el ID indispensable para el UPDATE -->
        <input type="hidden" name="id" value="<?php echo $cliente->id; ?>">

        <label for="nombre">Nombre:</label><br>
        <input type="text" id="nombre" name="nombre" value="<?php echo $cliente->nombre; ?>" required><br><br>

        <label for="email">Correo Electrónico:</label><br>
        <input type="email" id="email" name="email" value="<?php echo $cliente->email; ?>" required><br><br>

        <label for="telefono">Teléfono:</label><br>
        <input type="text" id="telefono" name="telefono" value="<?php echo $cliente->telefono; ?>"><br><br>

        <button type="submit">Actualizar Cambios</button>
        <a href="index.php">Cancelar</a>
    </form>
</body>
</html>
