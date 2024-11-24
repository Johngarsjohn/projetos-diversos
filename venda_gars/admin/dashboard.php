<?php
include '../includes/auth.php';
$user = check_login($mysqli);

if ($user['role'] != 'admin') {
    header('Location: /home');
    exit();
}
?>

<h2>Painel de Administração</h2>
<p>Bem-vindo ao painel do administrador.</p>
<!-- Adicione funcionalidades específicas para o administrador -->

<?php
include '../includes/db.php';
include '../includes/auth.php';

$user = check_login($mysqli);

// Verifique se o usuário é administrador
if (!$_SESSION['is_admin']) {
    header('Location: /home.php');
    exit();
}
?>

<h2>Painel de Controle do Administrador</h2>
<ul>
    <li><a href="manage_users.php">Gerenciar Usuários</a></li>
    <li><a href="../relatorios.php">Relatórios Detalhados</a></li>
    <li><a href="../produtos.php">Gerenciar Produtos</a></li>
    <li><a href="../clientes.php">Gerenciar Clientes</a></li>
    <li><a href="../vendas.php">Gerenciar Vendas</a></li>
</ul>

// index.php
<?php
include '../includes/db.php';
include '../includes/auth.php';

$user = check_login($mysqli);

// Verifique se o usuário é administrador
if (!$_SESSION['is_admin']) {
    header('Location: /home.php');
    exit();
}
?>

<h2>Painel de Controle do Administrador</h2>
<ul>
    <li><a href="manage_users.php">Gerenciar Usuários</a></li>
    <li><a href="../relatorios.php">Relatórios Detalhados</a></li>
    <li><a href="../produtos.php">Gerenciar Produtos</a></li>
    <li><a href="../clientes.php">Gerenciar Clientes</a></li>
    <li><a href="../vendas.php">Gerenciar Vendas</a></li>
</ul>

