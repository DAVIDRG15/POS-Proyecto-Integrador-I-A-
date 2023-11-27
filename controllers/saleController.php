<?php

include_once(__DIR__ . '/../config/config.php');
include_once(__DIR__ . '/../models/sale.php');

class SaleController {
    
    public function readSales() {
        global $conn;
    
        $sql = "SELECT * FROM registro_de_venta";
        $result = $conn->query($sql);
    
        $sales = [];
    
        if ($result->num_rows > 0) {
            echo '<table class="table table-bordered">';
            echo '<thead>';
            echo '<tr>';
            echo '<th>ID</th>';
            echo '<th>Pago</th>';
            echo '<th>Productos</th>';
            echo '<th>Fecha</th>';
            echo '<th>Total</th>';
            echo '</tr>';
            echo '</thead>';
            echo '<tbody>';
    
            while ($row = $result->fetch_assoc()) {
                $sale = new Sale();
                $sale->id_venta = $row['id_venta'];
                $sale->pago = $row['pago'];
                $sale->productos = $row['productos'];
                $sale->fecha = $row['fecha'];
                $sale->total = $row['total'];
    
                $sales[] = $sale;
    
                echo '<tr>';
                echo '<td>' . $sale->id_venta . '</td>';
                echo '<td>' . $sale->pago . '</td>';
                echo '<td>' . $sale->productos . '</td>';
                echo '<td>' . $sale->fecha . '</td>';
                echo '<td>' . '$'.$sale->total . '</td>';
                echo '</tr>';
            }
    
            echo '</tbody>';
            echo '</table>';
        } else {
            echo "No hay productos disponibles";
        }
    }    

}

?>