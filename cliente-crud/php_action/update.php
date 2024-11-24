<?php 
//Sessão
session_start();
//Conexão
require_once 'db_connect.php';

if(isset($_POST['btn-editar'])):
	$nome = mysqli_escape_string($connect,$_POST['nome']);
	$email = mysqli_escape_string($connect,$_POST['email']);
	$pais = mysqli_escape_string($connect,$_POST['pais']);
	//$genero = mysqli_escape_string($connect,$_POST['genero']);

	$id = mysqli_escape_string($connect,$_POST['id']);

	$sql = "UPDATE clientes SET nome = '$nome',email = '$email',pais = '$pais' WHERE id = '$id'";

	if(mysqli_query($connect,$sql)):
		$_SESSION['mensagem'] = "Atualizado com sucesso!";
		header('Location:../index.php');
	else:
		$_SESSION['mensagem'] = "Erro ao atualizar";
		header('Location:index.php');
	endif;
endif;
?>