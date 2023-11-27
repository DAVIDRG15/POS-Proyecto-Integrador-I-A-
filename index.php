<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>POS - Equipo 8 - 004</title>
    <!-- CSS -->
    <link rel="stylesheet" href="assets/css/style.css">
    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</head>

<?php
include('includes/header.php');
?>

<body>
    <div class="container index text-center mt-5 mb-5">
        <h1>Sistema Punto de Venta</h1>
        <br>
        <img src="assets/img/logo.png" class="img-fluid" alt="Punto de venta">
        <br><br>
        <a href="views/sales/sales_form.php"><button type="button" class="btn btn-success btn1">Vender</button></a>
        <a href="views/sales/sales_list.php"><button type="button" class="btn btn-success btn1">Ventas</button></a>
        <a href="views/product/product_list.php"><button type="button" class="btn btn-secondary btn2">Lista de Productos</button></a>
        <a href="views/product/product_form.php"><button type="button" class="btn btn-secondary btn2">Administrar Productos</button></a>
    </div>
</body>

<?php
include('includes/footer.php');
?>

</html>