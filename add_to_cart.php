<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    // Redirigir a la página de inicio de sesión si el usuario no ha iniciado sesión
    header("Location: login.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_id = $_SESSION['user_id'];
    $producto_id = $_POST['producto_id'];

    // Configuración de la base de datos
    $servername = "db5015817129.hosting-data.io";
    $username = "dbu3154185";
    $password = "A1234567.tfg"; // Reemplaza con tu contraseña real
    $dbname = "dbs12897556";

    // Crear conexión
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Verificar conexión
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Comprobar si el producto ya está en el carrito
    $sql = "SELECT * FROM gymguide_carrito WHERE user_id = ? AND producto_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ii", $user_id, $producto_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Si el producto ya está en el carrito, aumentar la cantidad
        $sql = "UPDATE gymguide_carrito SET cantidad = cantidad + 1 WHERE user_id = ? AND producto_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ii", $user_id, $producto_id);
    } else {
        // Si el producto no está en el carrito, añadirlo
        $sql = "INSERT INTO gymguide_carrito (user_id, producto_id, cantidad) VALUES (?, ?, 1)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ii", $user_id, $producto_id);
    }

    if ($stmt->execute()) {
        header("Location: shop.php");
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
} else {
    header("Location: shop.php");
}
?>