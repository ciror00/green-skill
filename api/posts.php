<?php
// Configuración de la base de datos
$host = '';       // o IP del servidor de base de datos
$db   = ''; // reemplaza con el nombre de tu base de datos
$user = '';         // usuario MySQL
$pass = '';      // contraseña MySQL

// Habilitar CORS
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

try {
    // Conexión a la base de datos con PDO
    $pdo = new PDO("mysql:host=$host;dbname=$db;charset=utf8mb4", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Consulta para traer todos los posts
    $stmt = $pdo->query("SELECT id, title, image, description FROM posts");

    $posts = [];
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $posts[] = $row;
    }

    // Devolver resultado como JSON
    echo json_encode($posts, JSON_PRETTY_PRINT);

} catch (PDOException $e) {
    // En caso de error
    http_response_code(500);
    echo json_encode([
        "error" => "Error de conexión a la base de datos",
        "mensaje" => $e->getMessage()
    ]);
}
?>
