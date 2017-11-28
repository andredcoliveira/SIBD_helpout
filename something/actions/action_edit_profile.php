<?php

  include('../config/init.php');
  include('../database/users.php');
  include('../tools/user.php');

  $name = strip_tags($_POST['name']);
  $password = $_POST['pw'];
  $password_bis = $_POST['pw2'];
  $date = date('Y-m-d', strtotime($_POST['date']));
  $description = strip_tags($_POST['description']);

  if(!$name) {
    $_SESSION['error_message'] = 'Invalid name';
    die(header('Location: ../edit_usr_profile.php'));
  } elseif(!$password) {
    $_SESSION['error_message'] = "Invalid password";
    die(header('Location: ../edit_usr_profile.php'));
  } elseif(!$password_bis || ($password_bis != $password)) {
    $_SESSION['error_message'] = "Passwords don't match";
    die(header('Location: ../edit_usr_profile.php'));
  } else {
    try {
      editUser($name, $password, $date, $description, $_ID);
    } catch(PDOException $e) {
      $_SESSION['error_message'] = $e->getMessage();
      die(header('Location: ../edit_usr_profile.php'));
    }
  }


  if(!isset($_FILES['fileToUpload']) || $_FILES['fileToUpload']['error'] == UPLOAD_ERR_NO_FILE) {
    /** DO NOTHING **/
  } else {
    $extension = explode('.' , basename($_FILES["fileToUpload"]["name"]));
    $extension = '.' . end($extension);

    $target_dir = "../res/uploads/users/";
    $target_file = $target_dir . $_ID . $extension;
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
            $_SESSION['error_message'] = "File is not an image.";
            $uploadOk = 0;
        }
    }

    // Check if file already exists
    $possibleImagePath = getUserPhoto2($_ID);
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
        $_SESSION['error_message'] = "File is too large";
        $uploadOk = 0;
    }

    // Allow certain file formats
    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
    && $imageFileType != "gif" ) {
        //echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        $_SESSION['error_message'] = "File doesn't have one of the allowed extensions.";
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


  $_SESSION['success_message'] = 'Your account was successfully edited.';
  header('Location: ../usr_profile.php');
  exit();

?>
