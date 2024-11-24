<?php
include '../includes/db.php';
include '../includes/auth.php';

$user = check_login($mysqli);

$id = $_GET['id'];
$query = "DELETE FROM users WHERE id = $id";
$mysqli->query($query);

header('Location: manage_users.php');
exit();
?>
