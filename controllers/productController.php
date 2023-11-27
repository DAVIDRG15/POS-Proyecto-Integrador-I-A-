<?php

include_once(__DIR__ . '/../config/config.php');
include_once(__DIR__ . '/../models/product.php');

class ProductController {
    public function createProduct($nombre, $categoria, $fecha_vencimiento, $cantidad) {
        global $conn;

        $sql = "INSERT INTO productos (nombre, categoria, fecha_vencimiento, cantidad) 
                VALUES ('$nombre', '$categoria', '$fecha_vencimiento', '$cantidad')";

        if ($conn->query($sql) === TRUE) {
            echo '<script>';
            echo 'alert("Producto creado con éxito");';
            echo 'window.location.href="../../views/product/product_form.php";';
            echo '</script>';            
        } else {
            echo '<script>';
            echo 'alert("Error al crear el producto: ' . $conn->error . '");';
            echo 'window.location.href="../../views/product/product_form.php";';
            echo '</script>';
        }
    }

    public function readProducts() {
        global $conn;
    
        $sql = "SELECT * FROM productos";
        $result = $conn->query($sql);
    
        $products = [];
    
        if ($result->num_rows > 0) {
            echo '<table class="table table-bordered">';
            echo '<thead>';
            echo '<tr>';
            echo '<th>ID</th>';
            echo '<th>Nombre</th>';
            echo '<th>Categoría</th>';
            echo '<th>Fecha de Vencimiento</th>';
            echo '<th>Cantidad</th>';
            echo '</tr>';
            echo '</thead>';
            echo '<tbody>';
    
            while ($row = $result->fetch_assoc()) {
                $product = new Product();
                $product->id_producto = $row['id_producto'];
                $product->nombre = $row['nombre'];
                $product->categoria = $row['categoria'];
                $product->fecha_vencimiento = $row['fecha_vencimiento'];
                $product->cantidad = $row['cantidad'];
    
                $products[] = $product;
    
                echo '<tr>';
                echo '<td>' . $product->id_producto . '</td>';
                echo '<td>' . $product->nombre . '</td>';
                echo '<td>' . $product->categoria . '</td>';
                echo '<td>' . $product->fecha_vencimiento . '</td>';
                echo '<td>' . $product->cantidad . '</td>';
                echo '</tr>';
            }
    
            echo '</tbody>';
            echo '</table>';
        } else {
            echo "No hay productos disponibles";
        }
    }    

    public function updateProduct($id, $nombre, $categoria, $fecha_vencimiento, $cantidad) {
        global $conn;

        $sql = "UPDATE productos SET 
                nombre = '$nombre', 
                categoria = '$categoria', 
                fecha_vencimiento = '$fecha_vencimiento', 
                cantidad = '$cantidad' 
                WHERE id_producto = '$id'";

        if ($conn->query($sql) === TRUE) {
            echo '<script>';
            echo 'alert("Producto actualizado con éxito");';
            echo 'window.location.href="../../views/product/product_form.php";';
            echo '</script>';
        } else {
            echo '<script>';
            echo 'alert("Error al crear el producto: ' . $conn->error . '");';
            echo 'window.location.href="../../views/product/product_form.php";';
            echo '</script>';
        }
    }

    public function deleteProduct($id) {
        global $conn;

        $sql = "DELETE FROM productos WHERE id_producto = '$id'";

        if ($conn->query($sql) === TRUE) {
            echo '<script>';
            echo 'alert("Producto eliminado con éxito");';
            echo 'window.location.href="../../views/product/product_form.php";';
            echo '</script>';
        } else {
            echo '<script>';
            echo 'alert("Error al crear el producto: ' . $conn->error . '");';
            echo 'window.location.href="../../views/product/product_form.php";';
            echo '</script>';
        }
    }
}

?>