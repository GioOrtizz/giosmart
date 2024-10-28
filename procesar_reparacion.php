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

// Procesar el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST['name'];
    $telefono = $_POST['phone'];
    $email = $_POST['email'];
    $marca = $_POST['brand'];
    $modelo = $_POST['model'];
    $problema = $_POST['issue'];
    $color = $_POST['color'];
    $fecha_solicitud = $_POST['request_date'];

    // Insertar datos en la base de datos
    $sql = "INSERT INTO reparaciones (nombre, telefono, email, marca, modelo, problema, color, fecha_solicitud)
            VALUES ('$nombre', '$telefono', '$email', '$marca', '$modelo', '$problema', '$color', '$fecha_solicitud')";
            

    if ($conn->query($sql) === TRUE) {
        echo "Solicitud enviada con éxito.";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>
