<?php
include_once(__DIR__ . '/../controllers/productController.php');
$productController = new ProductController();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST["nombre"];
    $categoria = $_POST["categoria"];
    $fecha_vencimiento = $_POST["fecha_vencimiento"];
    $cantidad = $_POST["cantidad"];

    $productController->createProduct($nombre, $categoria, $fecha_vencimiento, $cantidad);
}
?>