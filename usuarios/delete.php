<?php
require_once('functions.php');

if (!isset($_SESSION))
  session_start();

if(isset($_SESSION['user'])){
  if (isset($_GET['id'])) {
    delete($_GET['id']);
  } else {
    die("ERRO: ID não definido.");
  }
} else{
  header("Location: index.php");
}

?>
