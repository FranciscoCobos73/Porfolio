<?php
session_start();//Esto inicia una SESION o reanuda una existente. Guarda los datos del usuario en el servidor para usarlos en varias paginas.
require_once 'funciones.php';

//SI EL USUARIO NO HA INICIADO SESION, LO REDIRIGE AL INDEX
verificar_login();

// Controlar tiempo de expiración de sesión (10 minutos)
controlar_expiracion(120); 

// Iniciar carrito
iniciar_carrito();

// Procesar compra
$mensajeCarrito = procesar_compra();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tienda de Halloween</title>
    <!-- Bootstrap CSS (siempre primero) -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Fuentes de Google (siempre después de Bootstrap) -->
    <link href="https://fonts.googleapis.com/css2?family=Creepster&display=swap" rel="stylesheet">

    <!-- CSS (siempre el último) -->
    <link rel="stylesheet" href="css/estilos.css">
    
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="#" style="font-family: 'Creepster', cursive; font-size: 2rem;">
                🎃 Tienda de Halloween 🎃
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link" href="index.php">Inicio</a></li>
                    <li class="nav-item"><a class="nav-link" href="home.php">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="logout.php">Salir</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="main-content">
        <div class="card mx-auto my-5" style="max-width: 600px; box-shadow: 0 0 30px 10px #ff7518;">
            <div class="card-body text-center">
                <div class="mb-3">
                    <h1 class="card-title mb-3" style="font-family: 'Creepster', cursive; color: #ff7518;">
                        Bienvenido a la mejor tienda de Halloween del mundo.
                    </h1>
                </div>
                <div class="mb-3">
                    <h2 class="card-subtitle mb-3" style="color: #fff; font-family: Arial, sans-serif;">
                        Hola, <?php echo htmlspecialchars($_SESSION['user']); ?>. Has iniciado sesión correctamente.
                        Tienes 2 minutos para comprar antes de que tu sesión expire.
                    </h2>
                </div>
                <div class="mb-3">
                    <span class="badge bg-warning text-dark" style="font-size:1.1rem;">
                        Hora de inicio de sesión: <?php echo date("H:i:s", $_SESSION['inicio']); ?>
                    </span>
                </div>
                <div class="mb-3">
                    <p class="card-text" style="color:#fff; font-size:1.2rem;">
                        🎃 Te damos la bienvenida a nuestro
                        <span style="color:#ff7518; font-weight:bold;">stock de productos</span> 🎃
                    </p>
                </div>
            </div>
        </div>

        <div class="card mx-auto mb-5" style="max-width: 600px; box-shadow: 0 0 20px 5px #ff7518;">
            <div class="card-body">
                <h2 class="card-title mb-4" style="font-family: 'Creepster', cursive; color: #ff7518;"> Nuestros Productos</h2>
                <div class="row justify-content-center">
                    <?php mostrar_productos(); ?>
                    <?php mostrar_carrito(); ?>
                </div>
            </div>
        </div>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    </script>

    <!-- Card para cerrar sesión al final -->
    <div class="card mx-auto mb-5" style="max-width: 400px; box-shadow: 0 0 20px 5px #ff7518;">
        <div class="card-body text-center">
            <h5 class="card-title mb-3" style="font-family: 'Creepster', cursive; color: #ff7518;">
                ¿Quieres salir de la tienda?
            </h5>
            <a href="logout.php" class="btn btn-halloween">Cerrar sesión y borrar cookie</a>
        </div>
    </div>
</body>
</html>
