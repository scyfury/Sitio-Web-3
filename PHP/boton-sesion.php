<?php
session_start();
if (isset($_SESSION['nombre_usuario'])) {
    echo $_SESSION['nombre_usuario'];
} else {
    echo "Bienvenido";
}
?>

