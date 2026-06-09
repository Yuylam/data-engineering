<?php
  include '../headers/header_staff.php';

  if (isset($_POST['courseCode'], $_POST['sectionNo'])) {
    $courseCode = mysqli_real_escape_string($con, $_POST['courseCode']);
    $sectionNo = (int) $_POST['sectionNo'];

    if ($sectionNo > 0) {
      // Get the highest existing section number
      $sql_max = "SELECT MAX(s_no) AS max_section FROM tb_section WHERE s_course = '$courseCode' AND s_semester = '$semester'";
      $result_max = mysqli_query($con, $sql_max);
      $maxSection = mysqli_fetch_assoc($result_max)['max_section'] ?? 0;

      for ($x = 1; $x <= $sectionNo; $x++) {
        $newSectionNo = $maxSection + $x;
        $sql_insert = "INSERT INTO tb_section (s_course, s_no, s_semester) 
                       VALUES ('$courseCode', '$newSectionNo', '$semester')";
        mysqli_query($con, $sql_insert);
      }

      echo "
        <script>
          Swal.fire({
            title: 'Success',
            text: '$sectionNo new sections for course $courseCode have been successfully added.',
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

            document.body.appendChild(form);
            form.submit();
          });
        </script>
      ";
    } else {
      echo "
        <script>
          Swal.fire({
            title: 'Error',
            text: 'Invalid number of sections!',
            icon: 'error',
            confirmButtonText: 'OK'
          }).then(() => {
            window.history.back();
          });
        </script>
      ";
    }
  }
?>
