<?php
  session_start();

  $conn = new PDO('pgsql:host=dbm.fe.up.pt;port=5432;dbname=sibd17g21', 'sibd17g21', 'batatinhas');
  $conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  $conn->query("SET SCHEMA 'helpout_new'");

  if (isset($_SESSION['error_message'])) {
    $_ERROR_MESSAGE = $_SESSION['error_message'];
    unset($_SESSION['error_message']);
  }

  if (isset($_SESSION['success_message'])) {
    $_SUCCESS_MESSAGE = $_SESSION['success_message'];
    unset($_SESSION['success_message']);
  }

  if (isset($_SESSION['username'])) {
    $_USERNAME = $_SESSION['username'];
  }

  if (isset($_SESSION['name'])) {
    $_NAME = $_SESSION['name'];
  }

  if (isset($_SESSION['id'])) {
    $_ID = $_SESSION['id'];
  }

  if (isset($_SESSION['form_values'])) {
    $_FORM_VALUES = $_SESSION['form_values'];
    unset($_SESSION['form_values']);
  }

  if (isset($_SESSION['results'])) {
    $_RESULTS = $_SESSION['results'];
    unset($_SESSION['results']);
  }

  if(isset($_SESSION['current_request'])) {
    $_CURR_REQ = $_SESSION['current_request'];
    unset($_SESSION['current_request']);
  }

?>
