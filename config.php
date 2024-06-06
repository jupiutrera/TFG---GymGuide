<?php
// Configuración de la base de datos
$servername = "db5015817129.hosting-data.io";
$username = "dbu3154185";
$password = "A1234567.tfg";
$dbname = "dbs12897556";

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>