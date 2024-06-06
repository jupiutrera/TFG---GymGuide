<?php
session_start();

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

// Activar reporte de errores para depuración
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Verificar si el usuario está logueado
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

$user_id = $_SESSION['user_id'];

// Obtener los productos en el carrito del usuario desde la base de datos
$sql = "SELECT producto_id FROM gymguide_carrito WHERE user_id = ?";
$stmt = $conn->prepare($sql);
if (!$stmt) {
    die("Prepare failed: (" . $conn->errno . ") " . $conn->error);
}

$stmt->bind_param("i", $user_id);
if (!$stmt->execute()) {
    die("Execute failed: (" . $stmt->errno . ") " . $stmt->error);
}

$result = $stmt->get_result();
$product_ids = [];
while ($row = $result->fetch_assoc()) {
    $product_ids[] = $row['producto_id'];
}
$stmt->close();

if (!empty($product_ids)) {
    $product_ids_str = implode(",", $product_ids);

    // Insertar los detalles de la compra en la tabla de compras
    $sql = "INSERT INTO gymguide_compras (user_id, product_ids) VALUES (?, ?)";
    $stmt = $conn->prepare($sql);
    if (!$stmt) {
        die("Prepare failed: (" . $conn->errno . ") " . $conn->error);
    }
    $stmt->bind_param("is", $user_id, $product_ids_str);
    if (!$stmt->execute()) {
        die("Execute failed: (" . $stmt->errno . ") " . $stmt->error);
    }
    $stmt->close();

    // Borrar el carrito del usuario
    $sql = "DELETE FROM gymguide_carrito WHERE user_id = ?";
    $stmt = $conn->prepare($sql);
    if (!$stmt) {
        die("Prepare failed: (" . $conn->errno . ") " . $conn->error);
    }
    $stmt->bind_param("i", $user_id);
    if (!$stmt->execute()) {
        die("Execute failed: (" . $stmt->errno . ") " . $stmt->error);
    }
    $stmt->close();

    // Limpiar la variable de sesión del carrito
    unset($_SESSION['cart']);
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirmación de Compra</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/responsive.css">
    <link rel="icon" href="images/fevicon.png" type="image/gif" />
    <link rel="stylesheet" href="css/jquery.mCustomScrollbar.min.css">
    <link rel="stylesheet" href="https://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.css" media="screen">
</head>
<body class="main-layout position_head">
    <header>
        <div class="header">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 col logo_section">
                        <div class="full">
                            <div class="center-desk">
                                <div class="logo">
                                    <a href="index.php" class="brand-logo"><img src="images/logo.png" alt="#" />
                                        <p>GymGuide</p>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-9 col-lg-9 col-md-9 col-sm-9">
                        <nav class="navigation navbar navbar-expand-md navbar-dark ">
                            <button class="navbar-toggler" type="button" data-toggle="collapse"
                                data-target="#navbarsExample04" aria-controls="navbarsExample04" aria-expanded="false"
                                aria-label="Toggle navigation">
                                <span class="navbar-toggler-icon"></span>
                            </button>
                            <div class="collapse navbar-collapse" id="navbarsExample04">
                                <ul class="navbar-nav mr-auto">
                                    <li class="nav-item">
                                        <a class="nav-link" href="index.php">Inicio</a>
                                    </li>
                                    <li class="nav-item dropdown">
                                        <a class="nav-link dropdown-toggle" href="shop.php" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            Funcionalidades Fitness
                                        </a>
                                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                            <a class="dropdown-item" href="calorie-calculator.php">Calculadora de calorias</a>
                                            <a class="dropdown-item" href="1RM-calculator.php">Calculadora de 1RM</a>
                                            <a class="dropdown-item" href="bloquesdefuerza.php">Programación en Bloques de fuerza</a>
                                        </div>
                                    </li>
                                    <li class="nav-item dropdown">
                                        <a class="nav-link dropdown-toggle" href="shop.php" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            Tienda
                                        </a>
                                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                            <a class="dropdown-item" href="shop.php">Productos</a>
                                            <a class="dropdown-item" href="cart.php">Carrito</a>
                                        </div>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="contact.php">Contacto</a>
                                    </li>
                                    <?php if (isset($_SESSION['user_id'])): ?>
                                        <li class="nav-item">
                                            <a class="nav-link" href="micuenta.php">Mi Cuenta</a>
                                        </li>
                                    <?php else: ?>
                                        <li class="nav-item">
                                            <a class="nav-link" href="login.php">Iniciar sesión</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="registro.php">Registro</a>
                                        </li>
                                    <?php endif; ?>
                                </ul>
                            </div>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <!-- Confirmación de Compra -->
    <section class="product-section">
        <div class="container">
            <h2>Confirmación de Compra</h2>
            <div class="alert alert-success">
                ¡Gracias por su compra! Su pedido ha sido confirmado.
            </div>
            <div class="text-center mt-4">
                <a href="index.php" class="btn btn-primary">Volver al Inicio</a>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer>
        <div class="footer">
            <div class="container">
                <div class="row">
                    <div class="col-md-8 offset-md-2">
                        <ul class="location_icon">
                            <li><a href="#"><i class="fa fa-map-marker" aria-hidden="true"></i></a><br> C/San Benito 6</li>
                            <li><a href="#"><i class="fa fa-envelope" aria-hidden="true"></i></a><br> tfg.gymguide@gmail.com</li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="copyright">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <p>© 2024 Todos los derechos reservados. Diseñado por Juan Utrera Díaz y David Miñano de la Osa</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <!-- JavaScript -->
    <script src="js/jquery.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.bundle.min.js"></script>
    <script src="js/jquery.mCustomScrollbar.concat.min.js"></script>
    <script src="js/custom.js"></script>
</body>
</html>