<?php
include 'db.php';
session_start();

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

$id = intval($_GET['id']);
$userId = $_SESSION['user_id'];

$query = "UPDATE task SET status = 'Completada' WHERE id = $id AND user_id = $userId";
if (mysqli_query($conn, $query)) {
    header('Location: dashboard.php'); // o donde tengas el listado de tareas
} else {
    echo "Error al marcar como completada.";
}
?>
