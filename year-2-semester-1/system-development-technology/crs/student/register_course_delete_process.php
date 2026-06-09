<?php
  include '../headers/header_student.php';

  $registrationID = $_POST['registrationID'];

  $sql = "DELETE FROM tb_registration
          WHERE r_id = '$registrationID'";

  if (mysqli_query($con, $sql)) {
    echo "<script>
            Swal.fire({
              title: 'Success',
              text: 'Registration deleted.',
              icon: 'success',
              confirmButtonText: 'OK'
            }).then(() => {
              window.location.href = 'register_course.php'; 
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
              window.location.href = 'register_course.php';
            });
          </script>";
  }

?>