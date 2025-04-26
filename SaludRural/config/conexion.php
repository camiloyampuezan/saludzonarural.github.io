<?php
// Configuración de conexión a la base de datos
$host = 'localhost'; // Dirección del servidor (usualmente localhost para XAMPP)
$dbname = 'saludrural'; // Nombre de la base de datos
$username = 'root'; // Usuario por defecto en XAMPP
$password = ''; // Contraseña por defecto en XAMPP (vacío)

try {
    // Crear una instancia de PDO para la conexión
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    
    // Configurar el modo de error de PDO a excepción
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // Si se conecta correctamente, puedes usar esta línea para verificar
    // echo "Conexión exitosa.";
} catch (PDOException $e) {
    // Si ocurre un error de conexión, muestra un mensaje de error
    die("No se pudo conectar a la base de datos: " . $e->getMessage());
}
?>
