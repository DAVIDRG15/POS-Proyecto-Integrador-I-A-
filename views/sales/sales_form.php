<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "punto_de_venta";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

if (isset($_POST['quitar_carrito'])) {
    $id_producto_quitar = $_POST['id_producto'];
    quitarDelCarrito($id_producto_quitar);
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

    /* echo "Producto agregado al carrito: {$producto['nombre']} - {$producto['precio']}<br>"; */
}

function quitarDelCarrito($id_producto_quitar) {
    session_start();

    if (!isset($_SESSION['carrito'])) {
        $_SESSION['carrito'] = array();
    }

    foreach ($_SESSION['carrito'] as $key => $producto) {
        if ($producto['id_producto'] == $id_producto_quitar) {
            unset($_SESSION['carrito'][$key]);
            $mensaje = "Producto quitado del carrito: {$producto['nombre']} - {$producto['precio']}";
            echo '<script>alert("' . $mensaje . '");</script>';
            return;
        }
    }

    echo '<script>';
    echo 'alert("Producto no encontrado en el carrito.");';
    echo 'window.location.href="../../views/sales/sales_form.php";';
    echo '</script>';
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

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vender</title>
    <!-- CSS -->
    <link rel="stylesheet" href="../../assets/css/style.css">
    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
    </script>
</head>

<?php
include('../../includes/header.php');
?>

<body>

    <div class="container mt-4 mb-4">

        <h1>Vender</h1>

        <h2>Carrito de Compras</h2>
        <ul>
            <?php
                if (!empty($_SESSION['carrito'])) {
                    foreach ($_SESSION['carrito'] as $producto) {
                        echo "<ul class='list-group'>";
                        echo "<li class='list-group-item disabled'>{$producto['nombre']} - {$producto['precio']}</li>";
                        echo "</ul>";
                    }
                } else {
                    echo "<ul class='list-group'>";
                    echo "<li class='list-group-item disabled'>El carrito está vacío.</li>";
                    echo "</ul>";
                }
            ?>
        </ul>

        <form method="post" action="">
            <label for="id_producto" class="form-label">ID del Producto:</label>
            <input type="text" class="form-control" name="id_producto">
            <br>
            <label for="pago" class="form-label">Método de Pago:</label>
            <select name="pago" class="form-select" required>
                <option value="TDD">Tarjeta de Débito</option>
                <option value="TDC">Tarjeta de Crédito</option>
                <option value="Efectivo">Efectivo</option>
            </select>
            <br>
            <input type="submit" class="btn btn-warning" name="agregar_carrito" value="Agregar al Carrito">
            <input type="submit" class="btn btn-danger" name="quitar_carrito" value="Quitar del Carrito">
            <input type="submit" class="btn btn-success" name="finalizar_venta" value="Finalizar Venta">
        </form>

    </div>

</body>

<?php
include('../../includes/footer.php');
?>

</html>