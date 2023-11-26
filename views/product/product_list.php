<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Productos</title>
</head>

<body>
    <h2>Lista de Productos</h2>

    <?php
    include_once('../../controllers/productController.php');
    $productController = new ProductController();
    $productController->readProducts();
    ?>
</body>

</html>