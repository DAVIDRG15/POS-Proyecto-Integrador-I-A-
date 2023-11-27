<?php
include_once(__DIR__ . '/../controllers/productController.php');
$productController = new ProductController();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST["idProductoD"];

    $productController->deleteProduct($id);
}
?>