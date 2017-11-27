<?php
	include('../config/init.php');
	include('../database/users.php');
	include('../database/requests.php');

	if(isset($_GET['id'])){
		$request_id = $_GET['id'];
	}
	else{
		$_SESSION['error_message'] = 'Falha ao aderir a pedido.';
		die(header("Location: ../feed.php"));
	}

	try{
		startHelpingRequest($request_id, $_ID);
	}
	catch(PDOException $e){
		$_SESSION['error_message'] = $e->getMessage();
		die(header("Location: ../request.php?id=$request_id"));
	}

	$_SESSION['success_message'] = 'Começaste a ajudar!';
	header("Location: ../request.php?id=$request_id");
?>