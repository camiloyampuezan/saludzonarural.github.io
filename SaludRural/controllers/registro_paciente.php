<?php
$host = "localhost";
$db = "saludrural";  // Asegúrate que sea el nombre correcto
$user = "root";
$pass = "";

// Crear conexión
$conn = new mysqli($host, $user, $pass, $db);

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Recibir datos del formulario
$nombre = $_POST['nombre'];
$apellido = $_POST['apellido'];
$cedula = $_POST['cedula'];
$fechaNacimiento = $_POST['fechaNacimiento'];
$correo = $_POST['correo'];
$telefono = $_POST['telefono'];
$genero = $_POST['genero'];
$usuario = $_POST['usuario'];
$contrasena = $_POST['contraseña'];

// Preparar consulta
$sql = "INSERT INTO pacientes (nombre, apellido, cedula, fecha_nacimiento, correo, telefono, genero, usuario, contrasena)
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";

$stmt = $conn->prepare($sql);
$stmt->bind_param("sssssssss", $nombre, $apellido, $cedula, $fechaNacimiento, $correo, $telefono, $genero, $usuario, $contrasena);

// Ejecutar
if ($stmt->execute()) {
    echo "Registro exitoso";
} else {
    echo "Error al registrar: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>
