<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "punto_de_venta";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

?>