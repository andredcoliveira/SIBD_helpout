<?php
  //session_start();

  $conn = new PDO('pgsql:host=dbm.fe.up.pt;port=5432;dbname=sibd17g21', 'sibd17g21', 'batatinhas');
  $conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  $conn->query("SET SCHEMA 'helpout'");

  /* check later */
  /*
  if (isset($_SESSION['error_message'])) {
    $_ERROR_MESSAGE = $_SESSION['error_message'];
    unset($_SESSION['error_message']);
  }

  if (isset($_SESSION['success_message'])) {
    $_SUCCESS_MESSAGE = $_SESSION['success_message'];
    unset($_SESSION['success_message']);
  }

  if (isset($_SESSION['form_values'])) {
    $_FORM_VALUES = $_SESSION['form_values'];
    unset($_SESSION['form_values']);
  }
  */
?>

<?php //if (isset($_ERROR_MESSAGE)) { ?>
  <!-- <div id="errors"> -->
    <?//=$_ERROR_MESSAGE?>
  <!-- </div> -->
<?php //} ?>

<?php //if (isset($_SUCCESS_MESSAGE)) { ?>
  <!-- <div id="success"> -->
    <?//=$_SUCCESS_MESSAGE?>
  <!-- </div> -->
<?php //} ?>
