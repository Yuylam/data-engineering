<?php
  include '../headers/header_staff.php';

  if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $courseCode = mysqli_real_escape_string($con, $_POST['courseCode']);
    $lecturers = $_POST['lecturer'];
    $capacities = $_POST['capacity'];

    foreach ($lecturers as $section_no => $lecturer_no) {
      $capacity = intval($capacities[$section_no]);

      if (empty($lecturer_no) || $capacity < 1) {
        echo "
          <script>
            Swal.fire({
              title: 'Error',
              text: 'Please select a lecturer and enter a valid capacity!',
              icon: 'error',
              confirmButtonText: 'OK'
            }).then(() => {
              window.history.back();
            });
          </script>";
        exit;
      }

      // Update section details
      $sql = "UPDATE tb_section SET 
              s_lecturer = '$lecturer_no', 
              s_capacity = '$capacity' 
              WHERE s_no = '$section_no' AND s_course = '$courseCode' AND s_semester = '$semester'";

      if (!mysqli_query($con, $sql)) {
        echo "<script>alert('Database Error: " . mysqli_error($con) . "');</script>";
        exit;
      }
    }

    echo "
      <script>
        Swal.fire({
          title: 'Success',
          text: 'Sections updated successfully!',
          icon: 'success',
          confirmButtonText: 'OK'
        }).then(() => {
          var form = document.createElement('form');
          form.method = 'POST';
          form.action = 'edit_section.php';

          var courseCodeField = document.createElement('input');
          courseCodeField.type = 'hidden';
          courseCodeField.name = 'courseCode';
          courseCodeField.value = '" . $courseCode . "';
          form.appendChild(courseCodeField);

          var semesterField = document.createElement('input');
          semesterField.type = 'hidden';
          semesterField.name = 'semester';
          semesterField.value = '" . $semester . "';
          form.appendChild(semesterField);

          document.body.appendChild(form);
          form.submit();
        });
      </script>";
  }
?>
