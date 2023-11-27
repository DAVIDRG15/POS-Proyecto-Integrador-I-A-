<?php
include_once(__DIR__ . '/../controllers/productController.php');
$productController = new ProductController();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST["idProducto"];
    $nombre = $_POST["Nnombre"];
    $categoria = $_POST["Ncategoria"];
    $fecha_vencimiento = $_POST["Nfecha_vencimiento"];
    $precio = $_POST["Nprecio"];
    $cantidad = $_POST["Ncantidad"];

    $productController->updateProduct($id, $nombre, $categoria, $fecha_vencimiento, $precio, $cantidad);
}
?>