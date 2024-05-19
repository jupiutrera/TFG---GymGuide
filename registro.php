<?php
// Configuración de la base de datos
$servername = "db5015817129.hosting-data.io";
$username = "dbu3154185"; // Reemplaza con tu nombre de usuario de la base de datos
$password = "tucontraseña"; // Reemplaza con tu contraseña de la base de datos
$dbname = "dbs12897556"; // Reemplaza con el nombre de tu base de datos

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Obtener los datos del formulario
$user = $_POST['username'];
$email = $_POST['email'];
$pass = $_POST['password'];
$pass_repeat = $_POST['password-repeat'];

// Verificar que las contraseñas coincidan
if ($pass !== $pass_repeat) {
    die("Las contraseñas no coinciden.");
}

// Encriptar la contraseña
$hashed_password = password_hash($pass, PASSWORD_DEFAULT);

// Preparar y ejecutar la consulta SQL
$sql = "INSERT INTO gymguide_usuarios (Nom_usu, Correo, Passwd) VALUES (?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("sss", $user, $email, $hashed_password);

if ($stmt->execute()) {
    echo "Registro exitoso!";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

// Cerrar la conexión
$stmt->close();
$conn->close();
?>