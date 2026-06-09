<?php
  include '../headers/header_student.php';

  if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $currentPassword = $_POST['currentPassword'];
    $newPassword = $_POST['newPassword'];
    $confirmPassword = $_POST['confirmPassword'];

    if ($newPassword !== $confirmPassword) {
      echo "<script>
              Swal.fire({
                title: 'Error',
                text: 'New password and confirm password do not match!',
                icon: 'error',
                confirmButtonText: 'OK'
              }).then(() => {
                window.location.href = 'reset_password.php';
              });
            </script>";
      exit;
    }

    if (strlen($newPassword) < 8) {
      echo "<script>
              Swal.fire({
                title: 'Error',
                text: 'New password must be at least 8 characters long.',
                icon: 'error',
                confirmButtonText: 'OK'
              }).then(() => {
                window.location.href = 'reset_password.php';
              });
            </script>";
      exit;
    }

    $sql = "SELECT * FROM tb_user WHERE u_id = '$user_id'";
    $result = mysqli_query($con, $sql);
    $row = mysqli_fetch_array($result);
    $count = mysqli_num_rows($result);

    if($count == 1){
      if (!password_verify($currentPassword, $row['u_password'])) {
        echo "<script>
                Swal.fire({
                  title: 'Error',
                  text: 'Current password is incorrect!',
                  icon: 'error',
                  confirmButtonText: 'OK'
                }).then(() => {
                  window.location.href = 'reset_password.php';
                });
              </script>";
        exit;
      }
      $hashedNewPassword = password_hash($newPassword, PASSWORD_DEFAULT);
      $sql = "UPDATE tb_user SET u_password = '$hashedNewPassword' WHERE u_id = '$user_id'";
      if(mysqli_query($con, $sql)){
        echo "<script>
                  Swal.fire({
                    title: 'Success',
                    text: 'Password updated successfully!',
                    icon: 'success',
                    confirmButtonText: 'OK'
                  }).then(() => {
                    window.location.href = 'profile.php';
                  });
                </script>";
      }
      else{
        echo "<script>
                Swal.fire({
                  title: 'Error',
                  text: 'Failed to update the password. Please try again.',
                  icon: 'error',
                  confirmButtonText: 'OK'
                }).then(() => {
                  window.location.href = 'reset_password.php';
                });
              </script>";
      }
    }
    else{
      echo "<script>
              Swal.fire({
                title: 'Error',
                text: 'Failed to fetch current password. Please try again.',
                icon: 'error',
                confirmButtonText: 'OK'
              }).then(() => {
                window.location.href = 'reset_password.php';
              });
            </script>";
    }
    mysqli_close($con);
  }
?>
