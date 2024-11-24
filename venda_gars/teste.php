<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="João Garcia João">
    <meta name="description" content="Sistema de Gestão de vendas">
    <meta name="keywords" content="Gestão,vendas">
    <link rel="stylesheet" href="estilo.css">
    <title>Sistema de Gestão de Vendas</title>
</head>
<body>
    <header>
        <h1>Sistema de Gestão de Vendas</h1>
        <nav>
            <ul>
                <li><a href="/">Home</a></li>
                <li><a href="/vendas">Vendas</a></li>
                <li><a href="/produtos">Produtos</a></li>
                <li><a href="/clientes">Clientes</a></li>
                <li><a href="/relatorios">Relatórios</a></li>
                <li><a href="/logout">Logout</a></li>
            </ul>
        </nav>
    </header>
    <main>
        <h2>Adicionar Cliente</h2>
<form method="POST" action="?action=store">
    <input type="text" name="name" placeholder="Nome do Cliente" required>
    <input type="email" name="email" placeholder="Email do Cliente" required>
    <button type="submit">Salvar</button>
</form>

<h2>Painel de Controle do Administrador</h2>
<ul>
    <li><a href="manage_users.php">Gerenciar Usuários</a></li>
    <li><a href="../relatorios.php">Relatórios Detalhados</a></li>
    <li><a href="../produtos.php">Gerenciar Produtos</a></li>
    <li><a href="../clientes.php">Gerenciar Clientes</a></li>
    <li><a href="../vendas.php">Gerenciar Vendas</a></li>
</ul>

<h2>Login</h2>
<form method="POST" action="">
    <input type="email" name="email" placeholder="E-mail" required>
    <input type="password" name="password" placeholder="Senha" required>
    <button type="submit">Entrar</button>
    <?php if (isset($error)) { echo "<p style='color:red;'>$error</p>"; } ?>
</form>

 </main>
    <footer>
        <p>&copy; <?php echo date("Y"); ?> Sistema de Gestão de Vendas. Todos os direitos reservados.</p>
    </footer>
</body>
</html>