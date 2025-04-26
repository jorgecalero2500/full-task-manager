<?php
include 'db.php';
session_start();

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

$id = intval($_GET['id']);
$userId = $_SESSION['user_id'];

// Obtener la categoría
$query = "SELECT * FROM category WHERE id = $id AND user_id = $userId";
$result = mysqli_query($conn, $query);
$category = mysqli_fetch_assoc($result);

if (!$category) {
    echo "Categoría no encontrada.";
    exit();
}

// Actualizar
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name']);
    if (!empty($name)) {
        $updateQuery = "UPDATE category SET name = '$name' WHERE id = $id AND user_id = $userId";
        if (mysqli_query($conn, $updateQuery)) {
            header('Location: category_list.php');
            exit();
        } else {
            echo "Error al actualizar.";
        }
    } else {
        echo "Nombre no puede estar vacío.";
    }
}
?>

<h2>Editar Categoría</h2>
<form method="POST">
    <input type="text" name="name" value="<?php echo htmlspecialchars($category['name']); ?>" required>
    <button type="submit">Actualizar</button>
</form>
<br>
<a href="category_list.php">Volver</a>
