<?php

  include('../config/init.php');
  include('../database/users.php');
  include('../tools/user.php');

  $name = strip_tags($_POST['name']);
  $password_old = $_POST['pwold'];
  $password = $_POST['pw'];
  $password_bis = $_POST['pw2'];
  $date = date('Y-m-d', strtotime($_POST['date']));
  $description = strip_tags($_POST['description']);
  $_SESSION['form_values'] = $_POST;

  if(isset($_POST['skills'])){
    $skills = $_POST['skills']; /** Array com id's de skills selecionadas **/
  }
  else $skills = NULL;


  if(!$name) {
    $_SESSION['error_message'] = 'Nome inválido';
    die(header('Location: ../edit_usr_profile.php'));
  } elseif(!$password_old) {
    $_SESSION['error_message'] = "Palavra-passe antiga inválida";
    die(header('Location: ../edit_usr_profile.php'));
  } elseif(!logUserById($_ID, $password_old)) {
    $_SESSION['error_message'] = "Palavra-passe antiga inválida";
    die(header('Location: ../edit_usr_profile.php'));
  } elseif(!$password) {
    $_SESSION['error_message'] = "Palavra-passe nova inválida";
    die(header('Location: ../edit_usr_profile.php'));
  } elseif(!$password_bis || ($password_bis != $password)) {
    $_SESSION['error_message'] = "As palavras-passe diferem.";
    die(header('Location: ../edit_usr_profile.php'));
  } else {
    try {
      editUser($name, $password, $date, $description, $_ID);
      editUserSkills($_ID, $skills);
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
    $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
    // Check if image file is a actual image or fake image
    if(isset($_POST["submit"])) {
      $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
      if(!($check !== false)) {
        /*echo "File is not an image.";*/
        $_SESSION['error_message'] = "O ficheiro tem de ser uma imagem.";
        die(header('Location: ../edit_usr_profile.php'));
      }
    }

    // Check if file already exists
    $possibleImagePath = getUserPhoto2($_ID);
    if (file_exists($possibleImagePath)) {
      $status = unlink($possibleImagePath); //remove the file
      if($status != true){
        //$_SESSION['error_message'] = $possibleImagePath . '-> não consegue apagar isto';
        $_SESSION['error_message'] = 'Ocorreu um problema ao eliminar a imagem atual.';
        die(header('Location: ../edit_usr_profile.php'));
      }
    }

    // Check file size
    if ($_FILES["fileToUpload"]["size"] > 2000000) {
      //echo "Sorry, your file is too large.";
      $_SESSION['error_message'] = "A imagem não pode exceder 2MB";
      die(header('Location: ../edit_usr_profile.php'));
    }

    // Allow certain file formats - necessário? já foi verificado atrás se é imagem, podemos permitir mais tipos
    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
    && $imageFileType != "gif" ) {
      //echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
      $_SESSION['error_message'] = "A imagem tem de ser JPG, JPEG, PNG ou GIF.";
      die(header('Location: ../edit_usr_profile.php'));
    }


    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
      //echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
      $_SESSION['success_message'] = 'Your account was successfully edited.';
    } else {
      $_SESSION['error_message'] = 'Houve um problema com o carregamento da imagem.';
      die(header('Location: ../edit_usr_profile.php'));
    }
  }

  header('Location: ../usr_profile.php');
  exit();

?>
