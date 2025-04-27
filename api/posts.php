<?php
// Configuración de la base de datos
$host = '127.0.0.1';
$db   = 'green';
$user = 'root';
$pass = '';
$table = 'posts_2';

// Habilitar CORS
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

try {
    // Conexión a la base de datos con PDO
    $pdo = new PDO("mysql:host=$host;dbname=$db;charset=utf8mb4", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Consulta para traer todos los posts
    $sql = "SELECT id, title, image, description FROM ".$table;
    $stmt = $pdo->query("SELECT id, title, image, description FROM posts_2");

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
