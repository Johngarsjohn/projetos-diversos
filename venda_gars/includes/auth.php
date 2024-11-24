<?php
session_start();

function check_login($mysqli) {
    if (!isset($_SESSION['user_id'])) {
        header('Location: /login');
        exit();
    }

    $user_id = $_SESSION['user_id'];
    $query = "SELECT * FROM users WHERE id = '$user_id' LIMIT 1";
    $result = $mysqli->query($query);

    if ($result && $result->num_rows > 0) {
        return $result->fetch_assoc();
    }

    return null;
}
?>
