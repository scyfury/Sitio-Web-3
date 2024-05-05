<?php
// Incluir archivo de conexión PHP
include 'conexion.php';

// Verificar si se ha enviado el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Obtener los datos del formulario
    $nombre_usuario = $_POST["nombre_usuario"];
    $correo_electronico = $_POST["correo_electronico"];
    $contrasena = $_POST["contrasena"];



    // Validar que los campos no estén vacíos
    if (empty($nombre_usuario) || empty($correo_electronico) || empty($contrasena)) {
        echo "Todos los campos son obligatorios.";
    } else {
        // Consulta para verificar si el nombre de usuario ya está en uso
        $sql_nick = "SELECT * FROM usuario WHERE nombre_usuario = ?";
        $stmt_nick = $conn->prepare($sql_nick);
        $stmt_nick->bind_param("s", $nombre_usuario);
        $stmt_nick->execute();
        $result_nick = $stmt_nick->get_result();

        // Consulta para verificar si el correo electrónico ya está en uso
        $sql_email = "SELECT * FROM usuario WHERE correo_electronico = ?";
        $stmt_email = $conn->prepare($sql_email);
        $stmt_email->bind_param("s", $correo_electronico);
        $stmt_email->execute();
        $result_email = $stmt_email->get_result();

        // Verificar si se encontraron resultados para el nombre de usuario y el correo electrónico
        if ($result_nick->num_rows > 0) {
            echo "El nombre de usuario ya está en uso.";
        } elseif ($result_email->num_rows > 0) {
            echo "El correo electrónico ya está en uso.";
        } else {
            // Los datos son válidos, procede con la inserción en la base de datos
            // Sentencia preparada para insertar un nuevo usuario
            $sql_insert = "INSERT INTO usuario (nombre_usuario, contrasena, correo_electronico, estado) VALUES (?, ?, ?, 1)";
            $stmt_insert = $conn->prepare($sql_insert);
            // Enlazar parámetros
            $stmt_insert->bind_param("sss", $nombre_usuario, $contrasena, $correo_electronico);
            // Ejecutar la sentencia preparada
            if ($stmt_insert->execute()) {
                // Registro exitoso, redireccionar a una página de éxito
                header("Location: ../html/sesion.html");
                exit(); // Asegúrate de detener la ejecución del script después de la redirección
            } else {
                echo "Error al registrar el usuario. Por favor, inténtalo de nuevo más tarde.";
            }
        }
    }
}


// Cerrar conexión
$conn->close();
?>

