<?php

include_once(__DIR__ . '/../config/config.php');
include_once(__DIR__ . '/../models/product.php');

class ProductController {
    public function createProduct($nombre, $categoria, $fecha_vencimiento, $cantidad) {
        global $conn;

        $sql = "INSERT INTO productos (nombre, categoria, fecha_vencimiento, cantidad) 
                VALUES ('$nombre', '$categoria', '$fecha_vencimiento', '$cantidad')";

        if ($conn->query($sql) === TRUE) {
            echo "Producto creado con éxito";
        } else {
            echo "Error al crear el producto: " . $conn->error;
        }
    }

    public function readProducts() {
        global $conn;

        $sql = "SELECT * FROM productos";
        $result = $conn->query($sql);

        $products = [];

        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $product = new Product();
                $product->id_producto = $row['id_producto'];
                $product->nombre = $row['nombre'];
                $product->categoria = $row['categoria'];
                $product->fecha_vencimiento = $row['fecha_vencimiento'];
                $product->cantidad = $row['cantidad'];

                $products[] = $product;
            }

            foreach ($products as $product) {
                echo "ID: " . $product->id_producto . "<br>";
                echo "Nombre: " . $product->nombre . "<br>";
                echo "Categoría: " . $product->categoria . "<br>";
                echo "Fecha de Vencimiento: " . $product->fecha_vencimiento . "<br>";
                echo "Cantidad: " . $product->cantidad . "<br><br>";
            }
        } else {
            echo "No hay productos disponibles";
        }
    }
}

// Crear productos
$productController = new ProductController();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST["nombre"];
    $categoria = $_POST["categoria"];
    $fecha_vencimiento = $_POST["fecha_vencimiento"];
    $cantidad = $_POST["cantidad"];

    $productController->createProduct($nombre, $categoria, $fecha_vencimiento, $cantidad);
}
//

?>