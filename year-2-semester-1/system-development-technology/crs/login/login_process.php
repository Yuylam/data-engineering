<?php
  session_start();

  include('../db_connect.php');

  $f_userId = $_POST['f_userId'];
  $f_password = $_POST['f_password'];

  $sql = "SELECT * FROM tb_user
          WHERE u_id = '$f_userId'";
  $result = mysqli_query($con, $sql);
  $row = mysqli_fetch_array($result);
  $count = mysqli_num_rows($result);

  if($count == 1){
    if (password_verify($f_password, $row['u_password'])) {
      $_SESSION['s_id'] = session_id();
      $_SESSION['u_id'] = $f_userId;
      // $_SESSION['u_no'] = $row['u_no'];
      $_SESSION['u_type'] = $row['u_type'];

      if($row['u_type'] == 1){
        header('Location: ../home/home_student.php');
      }
      if($row['u_type'] == 2){
        header('Location: ../home/home_lecturer.php');
      }
      if($row['u_type'] == 3){
        header('Location: ../home/home_staff.php');
      }
    } else{
      header('Location: login.php?error=invalid_password');
    }
  }
  else {
    header('Location: login.php?error=user_not_found');
  }
  mysqli_close($con);
?>
