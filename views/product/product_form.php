<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario de Producto</title>
</head>

<body>

    <hr>
    
    <h2>Crear Producto</h2>
    <form action="../../php/create.php" method="post">
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

    <br>
    <hr>

    <h2>Actualizar Producto</h2>
    <form action="../../php/update.php" method="post">

        <label for="idProducto">Id:</label>
        <input type="text" name="idProducto" required><br>

        <label for="Nnombre">Nombre:</label>
        <input type="text" name="Nnombre" required><br>

        <label for="Ncategoria">Categoría:</label>
        <input type="text" name="Ncategoria" required><br>

        <label for="Nfecha_vencimiento">Fecha de Vencimiento:</label>
        <input type="date" name="Nfecha_vencimiento" required><br>

        <label for="Ncantidad">Cantidad:</label>
        <input type="number" name="Ncantidad" required><br>

        <input type="submit" value="Actualizar Producto">
    </form>

    <br>
    <hr>

    <h2>Eliminar Producto</h2>
    <form action="../../php/delete.php" method="post">

        <label for="idProductoD">Id:</label>
        <input type="text" name="idProductoD" required><br>

        <input type="submit" value="Eliminar Producto">
    </form>

    <br>
    <hr>

</body>

</html>