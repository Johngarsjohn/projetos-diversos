<?php 
//Sessão
session_start();
//Conexão
require_once 'db_connect.php';

if(isset($_POST['btn-cadastrar'])):
	$nome = mysqli_escape_string($connect,$_POST['nome']);
	$email = mysqli_escape_string($connect,$_POST['email']);
	$pais = mysqli_escape_string($connect,$_POST['pais']);
	//$genero = mysqli_escape_string($connect,$_POST['genero']);

	$sql = "INSERT INTO clientes(nome,email,pais)VALUES('$nome','$email','$pais')";

	if(mysqli_query($connect,$sql)):
		$_SESSION['mensagem'] = "Cadastrado com sucesso!";
		header('Location:../index.php');
	else:
		$_SESSION['mensagem'] = "Erro ao cadastrar";
		header('Location:index.php');
	endif;
endif;
?>