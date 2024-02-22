<?php 
  if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    require_once($_SERVER['DOCUMENT_ROOT'] . "/server/index.php");
    Add_Ingre_Handler::handlePostRequest($conn);
  }
?>
