<?php
  if(!session_id()){
    session_start();
  }

  if(isset($_SESSION['s_id']) != session_id()){
    header('Location: ../login/login.php');
  }

  if (!isset($_SESSION['u_type'])) {
    header('Location: ../login/login.php');
    exit();
  }
?>