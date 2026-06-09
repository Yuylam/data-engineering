<?php
  include '../headers/header_staff.php';

  if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['courseCode'], $_POST['courseName'], $_POST['courseCredit'], $_POST['department'], $_POST['coordinator'])) {
      
      $courseCode = trim($_POST['courseCode']);
      $courseName = trim($_POST['courseName']);
      $courseCredit = intval($_POST['courseCredit']);
      $department = intval($_POST['department']);
      $coordinator = trim($_POST['coordinator']);

      // Validate required fields
      if (empty($courseCode) || empty($courseName) || empty($courseCredit) || empty($department) || empty($coordinator)) {
        $_SESSION['courseCode'] = $courseCode;
        echo "<script>
                Swal.fire({
                  title: 'Error',
                  text: 'Please fill in all fields.',
                  icon: 'error',
                  confirmButtonText: 'OK'
                }).then(() => {
                  window.location.href = 'edit_course.php';
                });
              </script>";
        exit;
      }

      // Update course details
      $update_sql = "UPDATE tb_course 
                     SET c_name = ?, c_credit = ?, c_department = ?, c_coordinator = ?
                     WHERE c_code = ?";
      $stmt = mysqli_prepare($con, $update_sql);
      mysqli_stmt_bind_param($stmt, "sdiis", $courseName, $courseCredit, $department, $coordinator, $courseCode);

      if (mysqli_stmt_execute($stmt)) {
        // Delete any existing prerequisites
        $delete_sql = "DELETE FROM tb_prerequsite WHERE p_course = ?";
        $delete_stmt = mysqli_prepare($con, $delete_sql);
        mysqli_stmt_bind_param($delete_stmt, "s", $courseCode);
        mysqli_stmt_execute($delete_stmt);

        // Insert new prerequisite
        if (isset($_POST['prerequisite']) && !empty($_POST['prerequisite'])) {
          $prerequisites = array_filter($_POST['prerequisite'], function($prerequisite) {
              return !empty($prerequisite);
          });
          if (!empty($prerequisites)) {
            $insert_sql = "INSERT INTO tb_prerequsite (p_course, p_prerequisite) 
                           VALUES (?, ?)";
            $insert_stmt = mysqli_prepare($con, $insert_sql);
            foreach ($prerequisites as $prerequisite) {
                $prerequisite = trim($prerequisite);
                mysqli_stmt_bind_param($insert_stmt, "ss", $courseCode, $prerequisite);
                mysqli_stmt_execute($insert_stmt);
            }
          }
        }

        echo "<script>
                Swal.fire({
                  title: 'Success',
                  text: 'Course details updated successfully.',
                  icon: 'success',
                  confirmButtonText: 'OK'
                }).then(() => {
                  window.location.href = 'course_list.php'; 
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
                  window.location.href = 'edit_course.php';
                });
              </script>";
      }
    } else {
      $_SESSION['courseCode'] = $courseCode;
      echo "<script>
              Swal.fire({
                title: 'Error',
                text: 'Some required fields are missing.',
                icon: 'error',
                confirmButtonText: 'OK'
              }).then(() => {
                window.location.href = 'edit_course.php';
              });
            </script>";
    }
  }
?>
