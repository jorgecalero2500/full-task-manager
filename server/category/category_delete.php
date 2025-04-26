<?php
include 'db.php';
session_start();

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

$id = intval($_GET['id']);
$userId = $_SESSION['user_id'];

$query = "DELETE FROM category WHERE id = $id AND user_id = $userId";
if (mysqli_query($conn, $query)) {
    header('Location: category_list.php');
} else {
    echo "Error al eliminar.";
}
?>
