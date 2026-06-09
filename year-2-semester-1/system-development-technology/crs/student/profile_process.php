<?php
  include '../headers/header_student.php';

  if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $contact = $_POST['contact'];
    $address1 = $_POST['address1'];
    $address2 = $_POST['address2'];
    $city = $_POST['city'];
    $state = $_POST['state'];
    $postcode = $_POST['postcode'];

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      echo "<script>
              Swal.fire({
                title: 'Error',
                text: 'Invalid email format!',
                icon: 'error',
                confirmButtonText: 'OK'
              }).then(() => {
                window.location.href = 'profile.php';
              });
            </script>";
      exit;
    }

    $sql = "UPDATE tb_user u
            SET u.u_email = ?, u.u_contact = ?, u.u_address1 = ?, u.u_address2 = ?, 
                u.u_city = ?, u.u_state = ?, u.u_postcode = ?
            WHERE u.u_id = ?";
    
    if ($stmt = mysqli_prepare($con, $sql)) {
        mysqli_stmt_bind_param($stmt, "sssssssi", $email, $contact, $address1, $address2, $city, $state, $postcode, $user_id);

        if (mysqli_stmt_execute($stmt)) {
            echo "<script>
                  Swal.fire({
                    title: 'Success',
                    text: 'Profile updated successfully!',
                    icon: 'success',
                    confirmButtonText: 'OK'
                  }).then(() => {
                    window.location.href = 'profile.php';
                  });
                </script>";
        } else {
            echo "<script>
                  Swal.fire({
                    title: 'Error',
                    text: 'Failed to update profile. Please try again.',
                    icon: 'error',
                    confirmButtonText: 'OK'
                  }).then(() => {
                    window.location.href = 'profile.php';
                  });
                </script>";
        }
        mysqli_stmt_close($stmt);
    } else {
        echo "<script>
                Swal.fire({
                  title: 'Error',
                  text: 'Failed to prepare the query.',
                  icon: 'error',
                  confirmButtonText: 'OK'
                }).then(() => {
                  window.location.href = 'profile.php';
                });
              </script>";
    }

    mysqli_close($con);
}
?>
