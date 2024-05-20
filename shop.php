<?php
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

// Obtener los productos de la base de datos
$sql = "SELECT Producto, Categoria, Descripcion, Precio, ID_producto FROM gymguide_tienda";
$result = $conn->query($sql);

// Inicializar un array para almacenar los productos por categorías
$productos_por_categoria = [];

if ($result->num_rows > 0) {
    // Agrupar productos por categoría
    while($row = $result->fetch_assoc()) {
        $productos_por_categoria[$row["Categoria"]][] = $row;
    }
} else {
    echo "0 resultados";
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <!-- basic -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- mobile metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="viewport" content="initial-scale=1, maximum-scale=1">
    <!-- site metas -->
    <title>GymGuide - Tienda</title>
    <meta name="keywords" content="">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- bootstrap css -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <!-- style css -->
    <link rel="stylesheet" href="css/style.css">
    <!-- Responsive-->
    <link rel="stylesheet" href="css/responsive.css">
    <!-- fevicon -->
    <link rel="icon" href="images/fevicon.png" type="image/gif" />
    <!-- Scrollbar Custom CSS -->
    <link rel="stylesheet" href="css/jquery.mCustomScrollbar.min.css">
    <!-- Tweaks for older IEs-->
    <link rel="stylesheet" href="https://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.css" media="screen">
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script><![endif]-->
    <style>
        .product-section {
            margin-top: 50px;  /* Espacio superior */
            margin-bottom: 50px;  /* Espacio inferior */
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
                                    <a href="index.php" class="brand-logo"><img src="images/logo.png" alt="#" /><p>GymGuide</p></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-9 col-lg-9 col-md-9 col-sm-9">
                        <nav class="navigation navbar navbar-expand-md navbar-dark ">
                            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExample04" aria-controls="navbarsExample04" aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                            </button>
                            <div class="collapse navbar-collapse" id="navbarsExample04">
                                <ul class="navbar-nav mr-auto">
                                    <li class="nav-item">
                                        <a class="nav-link" href="http://gymguide.es">Home</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="about.html">Sobre nosotros</a>
                                    </li>
                                    <li class="nav-item dropdown active">
                                        <a class="nav-link dropdown-toggle" href="shop.php" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            Tienda
                                        </a>
                                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                            <a class="dropdown-item active" href="shop.php">Productos</a>
                                            <a class="dropdown-item" href="cart.html">Carrito</a>
                                        </div>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="contact.html">Contacto</a>
                                    </li>
                                    <li class="nav-item d_none login_btn">
                                       <a class="nav-link" href="login.php">Iniciar sesión</a>
                                   </li>
                                   <li class="nav-item d_none">
                                       <a class="nav-link" href="registro.php">Registro</a>
                                   </li>
                                </ul>
                            </div>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </header>
<!-- Product Section -->
<section class="product-section">
   <div class="container">
       <?php foreach ($productos_por_categoria as $categoria => $productos): ?>
           <h2><?php echo htmlspecialchars($categoria); ?></h2>
           <div class="row">
               <?php foreach ($productos as $producto): ?>
                   <div class="col-md-4">
                       <div class="product-item">
                           <img src="images/<?php echo htmlspecialchars($producto['ID_producto']); ?>.jpg" class="product-img" alt="<?php echo htmlspecialchars($producto['Producto']); ?>">
                           <center><h4><?php echo htmlspecialchars($producto['Producto']); ?></h4></center>
                           <p><?php echo htmlspecialchars($producto['Descripcion']); ?></p>
                           <p>
                               <?php
                               if ($producto['Precio'] == 0) {
                                   echo "Gratis";
                               } else {
                                   echo "€" . number_format($producto['Precio'], 2, ',', '.');
                               }
                               ?>
                           </p>
                           <button class="btn btn-primary">Añadir al Carrito</button>
                       </div>
                   </div>
               <?php endforeach; ?>
           </div>
       <?php endforeach; ?>
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
                       <p>© 2024 Todos los derechos reservados. Diseñado por Juan Utrera Díaz y David Miñano de la Osa</p>                     </div>
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
