<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Crear Nuevo Cliente</title>
</head>
<body>
    <h2>Registrar Nuevo Cliente</h2>
    
    <!-- El formulario envía los datos a un archivo procesador -->
    <form action="procesar_crear.php" method="POST">
        <label for="nombre">Nombre:</label><br>
        <input type="text" id="nombre" name="nombre" required><br><br>

        <label for="email">Correo Electrónico:</label><br>
        <input type="email" id="email" name="email" required><br><br>

        <label for="telefono">Teléfono:</label><br>
        <input type="text" id="telefono" name="telefono"><br><br>

        <button type="submit">Guardar Cliente</button>
        <a href="index.php">Volver a la lista</a>
    </form>
</body>
</html>
