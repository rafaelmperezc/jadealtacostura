<?php session_start();
	if(isset($_SESSION['usuario'])){
		header('Location: inicio.php');
	}else{
		header('Location: login.php');
	}
?>