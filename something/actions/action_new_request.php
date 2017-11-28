<?php
	include('../config/init.php');
	include('../database/users.php');
	include('../database/requests.php');
	include('../tools/request.php');

	$title = strip_tags($_POST['title']);
	$location = strip_tags($_POST['location']);
	$date = date('Y-m-d', strtotime($_POST['date']));
	$reward = strip_tags($_POST['reward']);
	$description = strip_tags($_POST['description']);


	if(!$title) {
		$_SESSION['error_message'] = 'Título Inválido';
		die(header('Location: ../new_request.php'));
	} elseif(!$location) {
		$_SESSION['error_message'] = "Localização Inválida";
		die(header('Location: ../new_request.php'));
	} elseif(!$date) {
		$_SESSION['error_message'] = "Data Inválida";
		die(header('Location: ../new_request.php'));
	}
	if(isset($_POST['skills'])){
		$skills = $_POST['skills']; /** Array com id's de skills selecionadas **/
	}
	else $skills = NULL;

	try{
		$request_id = insertRequest($title, $location, $date, $reward, $description, $skills);
	}
	catch(PDOException $e) {
      $_SESSION['error_message'] = $e->getMessage();
      die(header('Location: ../new_request.php'));
	}

	if(!isset($_FILES['fileToUpload']) || $_FILES['fileToUpload']['error'] == UPLOAD_ERR_NO_FILE) {
		/** DO NOTHING **/
	} else {
		$extension = explode('.' , basename($_FILES["fileToUpload"]["name"]));
		$extension = '.' . end($extension);

		$target_dir = "../res/uploads/requests/";
		$target_file = $target_dir . $request_id . $extension;
		$uploadOk = 1;
		$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
		// Check if image file is a actual image or fake image
		if(isset($_POST["submit"])) {
		    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
		    if($check !== false) {
		        /*echo "File is an image - " . $check["mime"] . ".";*/
		        $uploadOk = 1;
		    }
		    else {
		        /*echo "File is not an image.";*/
		        $uploadOk = 0;
		    }
		}

		// Check if file already exists
		$possibleImagePath = getRequestPhoto2($request_id);
		if (file_exists($possibleImagePath)) {
      $status = unlink($possibleImagePath); //remove the file
      if($status != true){
        $_SESSION['error_message'] = $possibleImagePath . '-> não consegue apagar isto';
        $uploadOk = 0;
      }
    }

		// Check file size
		if ($_FILES["fileToUpload"]["size"] > 2000000) {
		    //echo "Sorry, your file is too large.";
				$_SESSION['error_message'] = "Sorry, your file is too large.";
		    $uploadOk = 0;
		}

		// Allow certain file formats
		if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
		&& $imageFileType != "gif" ) {
		    //echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
				$_SESSION['error_message'] = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
		    $uploadOk = 0;
		}


		// Check if $uploadOk is set to 0 by an error
		if ($uploadOk == 0) {
		    //echo "Sorry, your file was not uploaded.";
		    //$_SESSION['error_message'] = "Imagem não foi carregada.";
		// if everything is ok, try to upload file
		}
		else {
		    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
		        //echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
		        $_SESSION['success_message'] = 'Pedido foi inserido com sucesso.';
		    } else {
		    		$_SESSION['error_message'] = 'Houve um problema com o carregamento da imagem.';
		    }
		}
	}
	header("Location: ../request.php?id=$request_id");
?>
