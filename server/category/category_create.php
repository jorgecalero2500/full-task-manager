<?php
// category_create.php
include 'db.php'; // tu conexión a base de datos

session_start();

// Verificar si el usuario está logueado
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

// Insertar categoría
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name']);
    $userId = $_SESSION['user_id'];

    if (!empty($name)) {
        $query = "INSERT INTO category (name, user_id) VALUES ('$name', $userId)";
        if (mysqli_query($conn, $query)) {
            header('Location: category_list.php');
            exit();
        } else {
            echo "Error al crear categoría.";
        }
    } else {
        echo "El nombre de la categoría es obligatorio.";
    }
}
?>

<h2>Crear Categoría</h2>
<form method="POST">
    <input type="text" name="name" placeholder="Nombre de la categoría" required>
    <button type="submit">Crear</button>
</form>
<br>
<a href="category_list.php">Volver al listado de categorías</a>
