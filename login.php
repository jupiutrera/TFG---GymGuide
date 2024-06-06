<?php
// Habilitar la visualización de errores
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();

// Inicializar variables para almacenar mensajes de error
$username_error = $password_error = $general_error = "";

// Inicializar variables para mantener los valores ingresados
$username = "";

// Configuración de la base de datos
$servername = "db5015817129.hosting-data.io";
$username_db = "dbu3154185";
$password_db = "A1234567.tfg";  // Reemplaza con tu contraseña real
$dbname = "dbs12897556";

// Crear conexión
$conn = new mysqli($servername, $username_db, $password_db, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    $general_error = "Connection failed: " . $conn->connect_error;
} else {
    // Verificar si el formulario fue enviado
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Obtener los datos del formulario
        $username = $_POST['username'];
        $password = $_POST['password'];

        // Verificar que el nombre de usuario existe en la tabla `gymguide_usuarios`
        $sql_check_user = "SELECT ID, Passwd FROM gymguide_usuarios WHERE Nom_usu = ?";
        $stmt_check_user = $conn->prepare($sql_check_user);
        $stmt_check_user->bind_param("s", $username);
        $stmt_check_user->execute();
        $stmt_check_user->bind_result($user_id, $hashed_password);
        $stmt_check_user->fetch();
        $stmt_check_user->close();

        if ($hashed_password) {
            // Verificar la contraseña
            if (password_verify($password, $hashed_password)) {
                // Iniciar sesión y almacenar información del usuario
                $_SESSION['user_id'] = $user_id;
                $_SESSION['username'] = $username;

                // Redirigir al usuario a la página principal
                header("Location: index.php");
                exit();
            } else {
                $password_error = "Contraseña incorrecta.";
            }
        } else {
            $username_error = "El nombre de usuario no existe.";
        }
    }

    // Cerrar la conexión
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login - GymGuide</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
    <style>
        body, html {
            height: 100%;
            margin: 0;
        }
        .main-layout {
            display: flex;
            flex-direction: column;
            height: 100%;
        }
        header, footer {
            flex-shrink: 0; /* Evita que header y footer se reduzcan */
        }
        .login-section {
            flex: 1; /* Ocupa el espacio restante */
            display: flex;
            align-items: center; /* Centra verticalmente el contenido de login */
            justify-content: center; /* Centra horizontalmente */
            padding-top: 100px;
        }
        .form-wrapper {
            width: 100%; /* O ajusta según necesidades específicas */
            max-width: 400px; /* Máximo ancho del formulario */
        }
        .error-message {
            color: red;
            margin-bottom: 15px;
            font-size: 0.875em;
        }
    </style>
</head>
<body class="main-layout">
    <header>
        <!-- header inner -->
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
                                        <li class="nav-item d_none login_btn">
                                            <a class="nav-link" href="login.php">Iniciar sesión</a>
                                        </li>
                                        <li class="nav-item d_none">
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

    <section class="login-section">
        <div class="container">
            <div class="form-wrapper">
                <h3>Login</h3>
                <?php if (!empty($general_error)) { echo "<p class='error-message'>$general_error</p>"; } ?>
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
                    <div class="form-group">
                        <label for="username">Nombre de usuario:</label>
                        <input type="text" class="form-control" id="username" name="username" value="<?php echo htmlspecialchars($username); ?>" required>
                        <?php if (!empty($username_error)) { echo "<p class='error-message'>$username_error</p>"; } ?>
                    </div>
                    <div class="form-group">
                        <label for="password">Contraseña:</label>
                        <input type="password" class="form-control" id="password" name="password" required>
                        <?php if (!empty($password_error)) { echo "<p class='error-message'>$password_error</p>"; } ?>
                    </div>
                    <button type="submit" class="btn btn-primary">Entrar</button>
                </form>
            </div>
        </div>
    </section>

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
     </footer>
     
    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.bundle.min.js"></script>
</body>
</html>
