<?php
  include '../headers/header_staff.php';

  $registrationID = $_POST['registrationID'];

  $sql = "DELETE FROM tb_registration
          WHERE r_id = '$registrationID'";

  if (mysqli_query($con, $sql)) {
    $_SESSION['studentNo'] = $_POST['studentNo'];
    echo "<script>
            Swal.fire({
              title: 'Success',
              text: 'Registration deleted.',
              icon: 'success',
              confirmButtonText: 'OK'
            }).then(() => {
              window.location.href = 'student_registration.php'; 
            });
          </script>";
  } else {
    echo "<script>
            Swal.fire({
              title: 'Error',
              text: 'An error occurred while deleting the registration. Please try again.',
              icon: 'error',
              confirmButtonText: 'OK'
            }).then(() => {
              window.location.href = 'student_registration.php';
            });
          </script>";
  }

?>