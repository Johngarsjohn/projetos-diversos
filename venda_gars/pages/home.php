<?php
include '../includes/auth.php';
include '../includes/db.php';
$user = check_login($mysqli);
?>

<h2>Bem-vindo, <?php echo htmlspecialchars($user['name']); ?></h2>
<p>Esta é a página inicial do Sistema de Gestão de Vendas.</p>
