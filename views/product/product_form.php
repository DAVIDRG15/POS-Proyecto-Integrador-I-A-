<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario de Producto</title>
    <!-- CSS -->
    <link rel="stylesheet" href="../../assets/css/style.css">
    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
    </script>
    <!-- JS -->
    <script src="../../assets/js/script.js"></script>
</head>

<?php
include('../../includes/header.php');
?>

<body>

    <div class="container mt-5 mb-5">
        <h1>Administrar Productos</h1>
        <br>
        <h2>Crear Producto</h2>
        <form action="../../php/create.php" method="post">
            <label for="nombre" class="form-label">Nombre:</label>
            <input type="text" class="form-control" name="nombre" required><br>

            <label for="categoria" class="form-label">Categoría:</label>
            <input type="text" class="form-control" name="categoria" required><br>

            <label for="fecha_vencimiento" class="form-label">Fecha de Vencimiento:</label>
            <input type="date" class="form-control" name="fecha_vencimiento" required><br>

            <label for="cantidad" class="form-label">Cantidad:</label>
            <input type="number" class="form-control" name="cantidad" required><br>

            <input type="submit" class="btn btn-success" value="Crear Producto">
        </form>

        <br>
        <hr>

        <h2>Actualizar Producto</h2>
        <form action="../../php/update.php" method="post">

            <label for="idProducto" class="form-label">Id:</label>
            <input type="text" class="form-control" name="idProducto" required><br>

            <label for="Nnombre" class="form-label">Nombre:</label>
            <input type="text" class="form-control" name="Nnombre" required><br>

            <label for="Ncategoria" class="form-label">Categoría:</label>
            <input type="text" class="form-control" name="Ncategoria" required><br>

            <label for="Nfecha_vencimiento" class="form-label">Fecha de Vencimiento:</label>
            <input type="date" class="form-control" name="Nfecha_vencimiento" required><br>

            <label for="Ncantidad" class="form-label">Cantidad:</label>
            <input type="number" class="form-control" name="Ncantidad" required><br>

            <input type="submit" class="btn btn-warning" value="Actualizar Producto">
        </form>

        <br>
        <hr>

        <h2>Eliminar Producto</h2>
        <form action="../../php/delete.php" method="post" onsubmit="return confirmarEliminar();">
            <label for="idProductoD" class="form-label">Id:</label>
            <input type="text" class="form-control" name="idProductoD" required><br>

            <input type="submit" class="btn btn-danger" value="Eliminar Producto">
        </form>

    </div>

</body>

<?php
include('../../includes/footer.php');
?>

</html>