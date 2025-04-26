<?php
// category_list.php
include 'db.php';

session_start();

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

$userId = $_SESSION['user_id'];
$query = "SELECT * FROM category WHERE user_id = $userId";
$result = mysqli_query($conn, $query);
?>

<h2>Mis Categorías</h2>
<a href="category_create.php">Crear Nueva Categoría</a>
<table border="1" cellpadding="10">
    <tr>
        <th>Nombre</th>
        <th>Acciones</th>
    </tr>
    <?php while ($row = mysqli_fetch_assoc($result)): ?>
    <tr>
        <td><?php echo htmlspecialchars($row['name']); ?></td>
        <td>
            <a href="category_edit.php?id=<?php echo $row['id']; ?>">Editar</a> |
            <a href="category_delete.php?id=<?php echo $row['id']; ?>" onclick="return confirm('¿Estás seguro de eliminar?');">Eliminar</a>
        </td>
    </tr>
    <?php endwhile; ?>
</table>
