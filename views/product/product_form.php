<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario de Producto</title>
</head>

<body>
    <h2>Crear Producto</h2>
    <form action="../../controllers/productController.php" method="post">
        <label for="nombre">Nombre:</label>
        <input type="text" name="nombre" required><br>

        <label for="categoria">Categoría:</label>
        <input type="text" name="categoria" required><br>

        <label for="fecha_vencimiento">Fecha de Vencimiento:</label>
        <input type="date" name="fecha_vencimiento" required><br>

        <label for="cantidad">Cantidad:</label>
        <input type="number" name="cantidad" required><br>

        <input type="submit" value="Crear Producto">
    </form>
</body>

</html>