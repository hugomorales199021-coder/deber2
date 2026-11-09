<?php
require_once 'conexion.php';
require_once 'Cliente.php';

$cliente = new Cliente($db);
$stmt = $cliente->leerTodos();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Lista de Clientes</title>
</head>
<body>
    <h2>Panel de Administración de Clientes</h2>
    <a href="crear.html"><strong>+ Agregar Nuevo Cliente</strong></a><br><br>

    <?php if(isset($_GET['mensaje']) && $_GET['mensaje'] == 'creado'): ?>
        <p style="color: green;">¡Cliente creado con éxito!</p>
    <?php endif; ?>
    <?php if(isset($_GET['mensaje']) && $_GET['mensaje'] == 'actualizado'): ?>
        <p style="color: green;">¡Cliente actualizado con éxito!</p>
    <?php endif; ?>
    <?php if(isset($_GET['mensaje']) && $_GET['mensaje'] == 'eliminado'): ?>
        <p style="color: red;">Cliente eliminado.</p>
    <?php endif; ?>

    <table border="1" cellpadding="10" cellspacing="0">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Email</th>
                <th>Teléfono</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = $stmt->fetch(PDO::FETCH_ASSOC)): ?>
            <tr>
                <td><?php echo $row['id']; ?></td>
                <td><?php echo $row['nombre']; ?></td>
                <td><?php echo $row['email']; ?></td>
                <td><?php echo $row['telefono']; ?></td>
                <td>
                    <!-- Pasar ID por la URL (GET) -->
                    <a href="editar.php?id=<?php echo $row['id']; ?>">Editar</a> | 
                    <a href="procesar_eliminar.php?id=<?php echo $row['id']; ?>" onclick="return confirm('¿Seguro que quieres eliminar este cliente?')">Eliminar</a>
                </td>
            </tr>
            <?php endwith; ?>
        </tbody>
    </table>
</body>
</html>
Usa el código con precaución.

3. Formulario para Editar (editar.php)

Este archivo recibe el ID por la URL, usa el método leerUno() para llenar automáticamente los campos del formulario con los datos actuales del cliente, y permite modificarlos.
php
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
Usa el código con precaución.

Archivo procesador (procesar_editar.php)

php
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
Usa el código con precaución.

4. Archivo para Eliminar (procesar_eliminar.php)

No necesita un formulario HTML porque la acción se ejecuta directamente al hacer clic en el enlace "Eliminar" del listado principal.
php
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
