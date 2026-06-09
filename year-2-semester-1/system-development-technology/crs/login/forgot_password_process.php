<?php
include '../headers/header_main.php';

// Check if form data is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $userID = mysqli_real_escape_string($con, $_POST['userID']);
    $s_no = mysqli_real_escape_string($con, $_POST['s_no']);
    $ic = mysqli_real_escape_string($con, $_POST['ic']);

    if (empty($userID) || empty($s_no) || empty($ic)) {
      echo "<script>
              Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'All fields are required!',
              }).then(function() {
                window.location.href = 'forgot_password.php';
              });
            </script>";
      exit();
    }

    // Query to check if the user exists in the database
    $sql = "SELECT u_name, u_id, u_type FROM tb_user
            WHERE u_id = '$userID' AND u_ic = '$ic'";
    $result = mysqli_query($con, $sql);

    if (mysqli_num_rows($result) > 0) {
        $user = mysqli_fetch_assoc($result);

        if($user['u_type'] == 1){
          $sql = "SELECT s_no FROM tb_student
                  WHERE s_no = '$s_no' AND s_id = '$userID'";
          $result = mysqli_query($con, $sql);
          if(mysqli_num_rows($result) == 0){
            echo "<script>
                    Swal.fire({
                      icon: 'error',
                      title: 'Oops...',
                      text: 'Invalid Matric Number',
                    }).then(function() {
                      window.location.href = 'forgot_password.php';
                    });
                  </script>";
          }
        }
        elseif($user['u_type'] == 2){
          $sql = "SELECT l_no FROM tb_lecturer
                  WHERE l_no = '$s_no' AND l_id = '$userID'";
          $result = mysqli_query($con, $sql);
          if(mysqli_num_rows($result) == 0){
            echo "<script>
                    Swal.fire({
                      icon: 'error',
                      title: 'Oops...',
                      text: 'Invalid Staff Number',
                    }).then(function() {
                      window.location.href = 'forgot_password.php';
                    });
                  </script>";
          }
        }
        elseif($user['u_type'] == 3){
          $sql = "SELECT s_no FROM tb_staff
                  WHERE s_no = '$s_no' AND s_id = '$userID'";
          $result = mysqli_query($con, $sql);
          if(mysqli_num_rows($result) == 0){
            echo "<script>
                    Swal.fire({
                      icon: 'error',
                      title: 'Oops...',
                      text: 'Invalid Staff Number',
                    }).then(function() {
                      window.location.href = 'forgot_password.php';
                    });
                  </script>";
          }
        }

        $fullName = $user['u_name'];
        $nameParts = explode(" ", $fullName);
        $firstLetter = strtoupper(substr($nameParts[0], 0, 1));
        $lastLetter = strtoupper(substr($nameParts[count($nameParts) - 1], -1));

        // Extract the last 4 digits of the IC number
        $icDigits = substr($ic, -4);

        // Create the new password
        $newPassword = $firstLetter . $lastLetter . $icDigits;

        // Update the user's password in the database
        $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);

        // Update password query
        $updateSql = "UPDATE tb_user SET u_password = '$hashedPassword' WHERE u_id = '$userID'";

        if (mysqli_query($con, $updateSql)) {
          echo "<script>
                  Swal.fire({
                    icon: 'success',
                    title: 'Password has been reset successfully!',
                    text: 'Your new password is in the format: First letter of your name + Last letter of your name + Last 4 digits of your IC.',
                    footer: \"<a href='reset_password_example.php'>More Examples</a>\"
                  }).then(function() {
                    window.location.href = 'login.php';
                  });
                </script>";
        } else {
          echo "<script>
                  Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Error resetting password. Please try again later.',
                  }).then(function() {
                    window.location.href = 'forgot_password.php';
                  });
                </script>";
        }
    } else {
      echo "<script>
              Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'User Not Found!',
              }).then(function() {
                window.location.href = 'forgot_password.php';
              });
            </script>";
    }
}
?>
