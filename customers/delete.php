<?php 
  // require_once('functions.php'); 

  // if (isset($_GET['id'])){
  //   delete($_GET['id']);
  // } else {
  //   die("ERRO: ID não definido.");
  // }

  //esse é o delete.php
  require_once("functions.php");

  if (isset($_GET['id'])){
    try {
      delete($_GET['id']);

    } catch (Exception $e) {
      $_SESSION['message'] = "Não foi possivel realizar a operação" . $e->getMessage();
      $_SESSION['type'] = "danger";
    } 
   
  }else {
    die("ERRO: ID não definido.");
  }

  
?>