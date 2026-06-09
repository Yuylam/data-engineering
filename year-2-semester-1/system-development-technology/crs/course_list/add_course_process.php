<?php
  include '../headers/header_staff.php';

  // var_dump($_POST);

  if ($_SERVER["REQUEST_METHOD"] == "POST") {
      $courseCode = mysqli_real_escape_string($con, trim($_POST['courseCode']));
      $courseName = mysqli_real_escape_string($con, trim($_POST['courseName']));
      $courseCredit = intval($_POST['courseCredit']);
      $department = intval($_POST['department']);
      $coordinator = mysqli_real_escape_string($con, trim($_POST['coordinator']));

      $check_sql = "SELECT * FROM tb_course WHERE c_code = ?";
      $check_stmt = mysqli_prepare($con, $check_sql);
      mysqli_stmt_bind_param($check_stmt, "s", $courseCode); // "s" denotes string
      mysqli_stmt_execute($check_stmt);
      $check_result = mysqli_stmt_get_result($check_stmt);

      if (mysqli_num_rows($check_result) > 0) {
          // Course code already exists
          echo "<script>
                  Swal.fire({
                    title: 'Error',
                    text: 'Course code already exists!',
                    icon: 'error',
                    confirmButtonText: 'OK'
                  }).then(() => {
                    window.location.href = 'add_course.php';
                  });
                </script>";
      } else {
          // Insert new course into the database
          $sql = "INSERT INTO tb_course (c_code, c_name, c_credit, c_department, c_coordinator) 
                  VALUES (?, ?, ?, ?, ?)";
          $stmt = mysqli_prepare($con, $sql);
          mysqli_stmt_bind_param($stmt, "ssdis", $courseCode, $courseName, $courseCredit, $department, $coordinator);

          if (mysqli_stmt_execute($stmt)) {
              // Success message
              echo "<script>
                      Swal.fire({
                        title: 'Success',
                        text: 'Course added successfully.',
                        icon: 'success',
                        confirmButtonText: 'OK'
                      }).then(() => {
                        window.location.href = 'course_list.php';
                      });
                    </script>";
          } else {
              // Error message
              echo "<script>
                      Swal.fire({
                        title: 'Error',
                        text: 'An error occurred while adding the course. Please try again.',
                        icon: 'error',
                        confirmButtonText: 'OK'
                      }).then(() => {
                        window.location.href = 'add_course.php';
                      });
                    </script>";
          }
      }
  } else {
      // Redirect if accessed without form submission
      header("Location: add_course.php");
      exit();
  }
?>
