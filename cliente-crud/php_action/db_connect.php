<?php
//Conexão com o banco de dados

$servername = "localhost";
$username = "root";
$password = "";
$db_name = "toque";

$connect = mysqli_connect($servername,$username,$password,$db_name);
mysqli_set_charset($connect,"utf8"); //para corrigir a acentuação

if(mysqli_connect_error()):
	echo "Erro na conexão: ".mysqli_connect_error();
endif;
?>