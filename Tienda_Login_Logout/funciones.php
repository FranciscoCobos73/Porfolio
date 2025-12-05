<?php
// Función para intentar el login y devolver mensaje de error si falla
function intentar_login() {
    if (!isset($_POST['enviar'])) {
        return ""; // No hay envío => no hay error
    }

    $user = $_POST['user'];
    $password = $_POST['password'];

    if (validar_usuario($user, $password)) {
        $_SESSION['user'] = $user;
        $_SESSION['inicio'] = time();
        setcookie("user", $user, time() + 3600, "/");
        header("Location: home.php");
        exit;
    } else {
        return "Usuario o contraseña incorrectos.";
    }
}

// Función con credenciales para validar usuario
function validar_usuario($user, $password) {
    // Aquí puedes agregar la lógica para validar el usuario.
    // Por simplicidad, vamos a usar un usuario y contraseña fijos.
    if ($user === "Arkadios" && $password === "yeye") {
        return true;
    } else {
    return false;
    }
}

// Función para verificar si el usuario ha iniciado sesión
function verificar_login() {
    if (!isset($_SESSION['user'])) {
        header("Location: index.php?noLogin=1");
        exit;
    }
}

// Función para controlar expiración de sesión (en segundos)
function controlar_expiracion($limite = 120) { // 60 segundos = 1 min
    if (isset($_SESSION['inicio']) && (time() - $_SESSION['inicio']) > $limite) {

        session_unset();
        session_destroy();

        header("Location: index.php?expirado=1");
        exit;
    } else {
        // Si no ha expirado, actualizamos el tiempo para extender actividad
        $_SESSION['inicio'] = time();
    }
}

// Función para cerrar sesión
function cerrarSesion() {
    session_start();
    session_unset();
    session_destroy();
    setcookie("user", "", time() - 3600, "/");
}

// Función para formatear la hora de inicio de sesión
function hora_sesion($timestamp) {
    return date("H:i:s", $timestamp);
}

// Función para mostrar productos en home.php
function mostrar_productos() {

    // Lista de productos (antes estaba en obtener_productos)
    $productos = [
        ["nombre" => "Calabaza decorativa", "precio" => 10, "imagen" => "img/calabaza.jpg"],
        ["nombre" => "Disfraz de terror", "precio" => 25, "imagen" => "img/disfraz.jpg"],
        ["nombre" => "Latigo Castigador", "precio" => 5, "imagen" => "img/juguete_.jpg"],
    ];

    // Bucle que imprime cada tarjeta con su botón comprar
    foreach ($productos as $producto) {

        echo '
            <div class="col-md-4 mb-3">
                <div class="card h-100" style="background-color: #222; border: 2px solid #ff7518;">
                    <img src="' . $producto["imagen"] . '" class="card-img-top img-fluid" 
                         style="height: 200px; object-fit: cover;" 
                         alt="' . $producto["nombre"] . '">
                    <div class="card-body">
                        <p class="card-text" style="color: #ff7518;">' .
                            $producto["nombre"] . ' - ' . $producto["precio"] . '€</p>

                        <form method="POST">
                            <input type="hidden" name="producto" value="' . $producto["nombre"] . '">
                            <input type="hidden" name="precio" value="' . $producto["precio"] . '">
                            <button type="submit" name="comprar" class="btn btn-warning w-100">
                                🛒 Comprar
                            </button>
                        </form>

                    </div>
                </div>
            </div>
        ';
    }
}
// Funciones para gestionar el carrito de compras
function iniciar_carrito() {
    if (!isset($_SESSION['carrito'])) {
        $_SESSION['carrito'] = [];
    }
}

function procesar_compra() {
    if (isset($_POST['comprar'])) {

        $producto = $_POST['producto'];
        $precio = $_POST['precio'];

        $_SESSION['carrito'][] = [
            "nombre" => $producto,
            "precio" => $precio
        ];

        return "Has añadido '$producto' al carrito.";
    }
    return "";
}

function mostrar_carrito() {

    if (empty($_SESSION['carrito'])) {
        return;
    }

    $total = 0;

    echo '
    <div class="card mx-auto mb-5" style="max-width: 600px; box-shadow: 0 0 20px 5px #ff7518;">
        <div class="card-body">
            <h2 class="card-title mb-4" style="font-family: Creepster, cursive; color: #ff7518;">
                🛒 Carrito de Compra
            </h2>

            <ul class="list-group">
    ';

    foreach ($_SESSION['carrito'] as $item) {

        $total += $item['precio'];

        echo '
            <li class="list-group-item d-flex justify-content-between">
                ' . $item['nombre'] . '
                <strong>' . $item['precio'] . ' €</strong>
            </li>
        ';
    }

    echo '
            </ul>
            <h3 class="mt-3 text-center" style="color:#ff7518;">
                Total: ' . $total . ' € 
                <br> MODO DE PAGO: BIZUM AL 639022944
                <br> EL PRODUCTO SE ENVIA AL RECIBIR EL PAGO.
            </h3>
        </div>
    </div>
    ';
}
?>

