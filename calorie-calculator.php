<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>GymGuide - Calculadora de Calorías</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/responsive.css">
    <link rel="icon" href="images/fevicon.png" type="image/gif" />
    <link rel="stylesheet" href="css/jquery.mCustomScrollbar.min.css">
    <link rel="stylesheet" href="https://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.css" media="screen">
    <style>
        .calculator-container {
            max-width: 600px;
            margin: 50px auto;
            padding: 20px;
            border: 1px solid #e1e1e1;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .calculator-container h2 {
            text-align: center;
            margin-bottom: 20px;
        }
    </style>
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
    <!-- Calculadora de Calorías -->
    <section class="product-section">
        <div class="container">
            <div class="calculator-container">
                <h2>Calculadora de Calorías</h2>
                <form action="calorie-calculator.php" method="post">
                    <div class="form-group">
                        <label for="weight">Peso (kg):</label>
                        <input type="number" class="form-control" id="weight" name="weight" required>
                    </div>
                    <div class="form-group">
                        <label for="age">Edad:</label>
                        <input type="number" class="form-control" id="age" name="age" required>
                    </div>
                    <div class="form-group">
                        <label for="height">Altura (cm):</label>
                        <input type="number" class="form-control" id="height" name="height" required>
                    </div>
                    <div class="form-group">
                        <label for="activity">Nivel de actividad física:</label>
                        <select class="form-control" id="activity" name="activity" required>
                            <option value="1.2">Sedentario (poco o ningún ejercicio)</option>
                            <option value="1.375">Ejercicio ligero (1-3 días a la semana)</option>
                            <option value="1.55">Ejercicio moderado (3-5 días a la semana)</option>
                            <option value="1.725">Ejercicio fuerte (6-7 días a la semana)</option>
                            <option value="1.9">Ejercicio muy fuerte (dos veces al día, entrenamientos duros)</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="goal">Objetivo:</label>
                        <select class="form-control" id="goal" name="goal" required>
                            <option value="mantener">Mantener el peso</option>
                            <option value="perdida">Perder peso</option>
                            <option value="ganancia">Ganar peso</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Calcular</button>
                </form>

                <?php
                if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                    $weight = $_POST['weight'];
                    $age = $_POST['age'];
                    $height = $_POST['height'];
                    $activity = $_POST['activity'];
                    $goal = $_POST['goal'];

                    // Calcular la TMB (Tasa Metabólica Basal) usando la fórmula de Harris-Benedict
                    // Asumiendo que es una mujer para la fórmula, puedes ajustar según el sexo del usuario.
                    $tmb = 655 + (9.6 * $weight) + (1.8 * $height) - (4.7 * $age);
                    
                    // Calcular las calorías diarias según el nivel de actividad
                    $calories = $tmb * $activity;
                    
                    // Ajustar las calorías según el objetivo
                    if ($goal == 'perdida') {
                        $calories -= 500; // Deficit calórico para perder peso
                    } elseif ($goal == 'ganancia') {
                        $calories += 500; // Superávit calórico para ganar peso
                    }

                    echo "<div class='calculator-container'>
                            <h2>Resultado</h2>
                            <p>Para tu objetivo de <strong>" . htmlspecialchars($goal) . "</strong> peso, deberías consumir aproximadamente <strong>" . round($calories) . "</strong> calorías al día.</p>
                          </div>";
                }
                ?>
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
    <!-- Javascript files-->
    <script src="js/jquery.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.bundle.min.js"></script>
    <script src="js/jquery.mCustomScrollbar.concat.min.js"></script>
    <script src="js/custom.js"></script>
</body>
</html>