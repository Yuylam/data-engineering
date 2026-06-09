<?php
  include '../headers/header_staff.php';

  if ($_SERVER["REQUEST_METHOD"] == "POST") {
      $courseCode = $_POST['courseCode'];
      $sectionNo = $_POST['sectionNo'];
      $semester = $_POST['semester'];

      $_SESSION['courseCode'] = $courseCode;
      $_SESSION['sectionNo'] = $sectionNo;


      if (isset($_POST['students'])) {
          foreach ($_POST['students'] as $studentNo) {
              $check_sql = "SELECT * FROM tb_registration WHERE r_course = '$courseCode' AND r_section = '$sectionNo' AND r_student = '$studentNo' AND r_semester = '$semester'";
              $check_result = mysqli_query($con, $check_sql);

              if (mysqli_num_rows($check_result) == 0) {
                  $sql = "INSERT INTO tb_registration (r_course, r_section, r_student, r_semester, r_status) 
                          VALUES ('$courseCode', '$sectionNo', '$studentNo', '$semester', 3)";
                  mysqli_query($con, $sql);
              }
          }
      }

      echo "<script>
              alert('Students successfully registered.');
              window.location.href = 'section_registration.php';
            </script>";
  }
?>
