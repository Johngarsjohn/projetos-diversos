<?php
$host = 'localhost';
$user = 'root';
$password = '';
$database = 'sistema_vendas';

$mysqli = new mysqli($host, $user, $password, $database);

if ($mysqli->connect_error) {
    die('Erro de Conexão (' . $mysqli->connect_errno . ') ' . $mysqli->connect_error);
}
?>
