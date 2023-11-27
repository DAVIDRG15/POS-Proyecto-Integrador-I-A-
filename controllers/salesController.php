<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "punto_de_venta";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

function obtenerProductoPorId($id_producto) {
    global $conn;

    $sql = "SELECT id_producto, nombre, precio FROM productos WHERE id_producto = $id_producto";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        return $row;
    } else {
        return null;
    }
}

function agregarAlCarrito($producto) {
    session_start();

    if (!isset($_SESSION['carrito'])) {
        $_SESSION['carrito'] = array();
    }

    $_SESSION['carrito'][] = $producto;

    echo "Producto agregado al carrito: {$producto['nombre']} - {$producto['precio']}<br>";
}

function finalizarVenta($pago) {
    global $conn;

    session_start();

    if (!empty($_SESSION['carrito'])) {
        $producto = $_SESSION['carrito'][0];

        $inventario_actual = obtenerInventario($producto['id_producto']);
        if ($inventario_actual > 0) {
            $nuevo_inventario = $inventario_actual - 1;
            actualizarInventario($producto['id_producto'], $nuevo_inventario);

            $total = calcularTotal($_SESSION['carrito']);
            $productos = json_encode($_SESSION['carrito']);
            $fecha_venta = date("Y-m-d H:i:s");
            
            $sql = "INSERT INTO registro_de_venta (fecha, pago, productos, total) VALUES ('$fecha_venta', '$pago', '$productos', $total)";
            if ($conn->query($sql) === TRUE) {
                echo '<script>';
                echo 'alert("Venta registrada con éxito.");';
                echo 'window.location.href="../../views/sales/sales_form.php";';
                echo '</script>';
                $_SESSION['carrito'] = array();
            } else {              
                echo '<script>';
                echo 'alert("Error al registrar la venta: ' . $conn->error . '");';
                echo 'window.location.href="../../views/product/product_form.php";';
                echo '</script>';
            }
        } else {
            echo '<script>';
            echo 'alert("No hay inventario suficiente para completar la venta.");';
            echo 'window.location.href="../../views/sales/sales_form.php";';
            echo '</script>';
        }
    } else {
        echo "El carrito está vacío. Agrega productos antes de finalizar la venta.";
    }
}

function obtenerInventario($id_producto) {
    global $conn;

    $sql = "SELECT cantidad FROM productos WHERE id_producto = $id_producto";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        return $row['cantidad'];
    } else {
        return 0;
    }
}

function actualizarInventario($id_producto, $nuevo_inventario) {
    global $conn;

    $sql = "UPDATE productos SET cantidad = $nuevo_inventario WHERE id_producto = $id_producto";
    $conn->query($sql);
}

function calcularTotal($carrito) {
    $total = 0;

    foreach ($carrito as $producto) {
        $total += $producto['precio'];
    }

    return $total;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['agregar_carrito'])) {
        $id_producto = $_POST['id_producto'];
        $producto = obtenerProductoPorId($id_producto);

        if ($producto !== null) {
            agregarAlCarrito($producto);
        } else {
            echo '<script>';
            echo 'alert("Producto no encontrado.");';
            echo 'window.location.href="../../views/sales/sales_form.php";';
            echo '</script>';
        }
    } elseif (isset($_POST['finalizar_venta'])) {
        $pago = $_POST['pago'];
        finalizarVenta($pago);
    }
}
?>