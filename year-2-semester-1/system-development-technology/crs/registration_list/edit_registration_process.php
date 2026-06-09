<?php
  include '../headers/header_staff.php';

  $registrationID = $_POST['registrationID'];
  $section = $_POST['section'];
  $status = $_POST['status'];

  $sql = "UPDATE tb_registration
          SET r_section = '$section', r_status = '$status'
          WHERE r_id = '$registrationID'";

  if (mysqli_query($con, $sql)) {
    echo "<script>
            Swal.fire({
              title: 'Success',
              text: 'Course details updated successfully.',
              icon: 'success',
              confirmButtonText: 'OK'
            }).then(() => {
              window.location.href = 'registration_list.php'; 
            });
          </script>";
  } else {
    $_SESSION['courseCode'] = $courseCode;
    echo "<script>
            Swal.fire({
              title: 'Error',
              text: 'An error occurred while updating the course. Please try again.',
              icon: 'error',
              confirmButtonText: 'OK'
            }).then(() => {
              window.location.href = 'registration_list.php';
            });
          </script>";
  }
?>