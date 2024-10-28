<?php
$servername = "localhost"; // Cambia esto si tu servidor es diferente
$username = "root"; // Cambia esto por tu usuario
$password = "12345"; // Cambia esto por tu contraseña
$dbname = "smart_shop_service"; // Cambia esto por el nombre de tu base de datos

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Configurar encabezado de respuesta como JSON
header('Content-Type: application/json');

// Procesar el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Escapar los datos para prevenir inyecciones SQL
    $nombre = $conn->real_escape_string($_POST['nombre']);
    $apellido = $conn->real_escape_string($_POST['apellido']);
    $correo = $conn->real_escape_string($_POST['email']);
    $clave = password_hash($_POST['password'], PASSWORD_DEFAULT); // Encriptar la contraseña

    // Insertar datos en la base de datos
    $sql = "INSERT INTO usuario (nombre, apellido, clave, correo) VALUES ('$nombre', '$apellido', '$clave', '$correo')";

    if ($conn->query($sql) === TRUE) {
        echo json_encode(["success" => true, "message" => "Usuario registrado con éxito."]);
    } else {
        echo json_encode(["success" => false, "message" => "Error: " . $conn->error]);
    }
}

$conn->close();
?>
