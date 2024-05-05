<?php

// Datos de conexión a la base de datos por xampp
$servername = "localhost"; // Nombre del servidor 
$username = "root"; // Nombre de usuario predeterminado de MySQL en XAMPP
$password = ""; // Contraseña predeterminada de MySQL en XAMPP (generalmente está vacía por defecto)
$database = "infsea"; // Nombre de la base de datos

// Crear conexión
$conn = new mysqli($servername, $username, $password, $database);

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

?>
