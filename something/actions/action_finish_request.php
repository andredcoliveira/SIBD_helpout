<?php
	include('../config/init.php');
	include('../database/users.php');
	include('../database/requests.php');

	if(isset($_GET['id'])){
		$request_id = $_GET['id'];
	}
	else{
		$_SESSION['error_message'] = 'Falha ao terminar pedido';
		die(header("Location: ../feed.php"));
	}

	if(getRequestOwner($request_id)['id'] == $_ID){
		finishRequest($request_id);
	}
	else{
		$_SESSION['error_message'] = 'Não pode terminar um pedido que não fez.';
		die(header("Location: ../request.php?id=$request_id"));
	}

	$_SESSION['success_message'] = 'Não pode terminar um pedido que não fez.';
	header("Location: ../request.php?id=$request_id");
?>