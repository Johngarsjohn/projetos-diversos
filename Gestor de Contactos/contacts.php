<?php
// Configurações do banco de dados
$servername = "localhost"; // ou o endereço do seu servidor MySQL
$username = "seu_usuario";
$password = "sua_senha";
$dbname = "sua_base_de_dados";

// Conexão com o banco de dados
$conn = new mysqli($servername, $username, $password, $dbname);

// Verifica a conexão
if ($conn->connect_error) {
    die("Erro na conexão com o banco de dados: " . $conn->connect_error);
}

// Adicionar novo contato
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['name']) && isset($_POST['phone'])) {
    $name = $_POST['name'];
    $phone = $_POST['phone'];

    $sql = "INSERT INTO contacts (name, phone) VALUES ('$name', '$phone')";

    if ($conn->query($sql) === TRUE) {
        echo "Contato adicionado com sucesso.";
    } else {
        echo "Erro ao adicionar contato: " . $conn->error;
    }
}

// Remover contato
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['delete_id'])) {
    $delete_id = $_POST['delete_id'];

    $sql = "DELETE FROM contacts WHERE id=$delete_id";

    if ($conn->query($sql) === TRUE) {
        echo "Contato removido com sucesso.";
    } else {
        echo "Erro ao remover contato: " . $conn->error;
    }
}

// Atualizar contato
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update_id']) && isset($_POST['new_name']) && isset($_POST['new_phone'])) {
    $update_id = $_POST['update_id'];
    $new_name = $_POST['new_name'];
    $new_phone = $_POST['new_phone'];

    $sql = "UPDATE contacts SET name='$new_name', phone='$new_phone' WHERE id=$update_id";

    if ($conn->query($sql) === TRUE) {
        echo "Contato atualizado com sucesso.";
    } else {
        echo "Erro ao atualizar contato: " . $conn->error;
    }
}

// Fechar conexão com o banco de dados
$conn->close();
?>
