<?php
session_start();

// Conexión a la base de datos
$conexion = new mysqli("localhost", "root", "", "saludrural");

if ($conexion->connect_error) {
    die("Conexión fallida: " . $conexion->connect_error);
}

// Verificar si llegan datos
if (isset($_POST['usuario']) && isset($_POST['contraseña'])) {
    $usuario = $_POST['usuario'];
    $contraseña = $_POST['contraseña'];

    // Usamos consulta segura (prepared statement)
    $sql = "SELECT * FROM pacientes WHERE usuario = ?";
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("s", $usuario);
    $stmt->execute();
    $resultado = $stmt->get_result();

    if ($resultado->num_rows === 1) {
        $fila = $resultado->fetch_assoc();

        // Validación directa (sin hash)
        if (trim($contraseña) === trim($fila['contrasena'])) {
        $_SESSION['usuario'] = $usuario;
            header("Location: ../Panel_paciente.html");
            exit();
        } else {
            echo "<script>alert('⚠️ Contraseña incorrecta'); window.location.href='../Inicio_sesion.html';</script>";
        }
    } else {
        echo "<script>alert('❌ Usuario no encontrado'); window.location.href='../Inicio_sesion.html';</script>";
    }

    $stmt->close();
} else {
    echo "🚫 No llegaron datos del formulario.";
}

$conexion->close();
?>
