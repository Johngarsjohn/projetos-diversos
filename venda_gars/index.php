<?php
include 'includes/db.php';

$route = isset($_GET['route']) ? $_GET['route'] : 'home';
$path = 'pages/' . $route . '.php';

if (file_exists($path)) {
    include 'includes/header.php';
    include $path;
    include 'includes/footer.php';
} else {
    echo '<h1>404 - Página não encontrada</h1>';
}
