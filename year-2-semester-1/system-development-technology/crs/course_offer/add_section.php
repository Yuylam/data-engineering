<?php
  include '../headers/header_staff.php';

  // Process
  if (isset($_POST['courseCode'], $_POST['sectionNo'])) {
    $courseCode = mysqli_real_escape_string($con, $_POST['courseCode']);
    $sectionNo = (int) $_POST['sectionNo'];

    if ($sectionNo > 0) {
      // Check existing sections in the database
      $sql_existing = "SELECT COUNT(*) as total 
                       FROM tb_section 
                       WHERE s_course = '$courseCode' 
                       AND s_semester = '$semester'";
      $result_existing = mysqli_query($con, $sql_existing);
      $existingSections = mysqli_fetch_assoc($result_existing)['total'];

      $newTotalSections = $existingSections + $sectionNo; // Expected total sections after adding

      echo "
        <script>
          Swal.fire({
            title: 'Confirm Adding Sections',
            text: 'There are already $existingSections sections for this course. After adding, there will be $newTotalSections sections. Are you sure you want to continue?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yes, Add Sections',
            cancelButtonText: 'Cancel'
          }).then((result) => {
            if (result.isConfirmed) {
              // Create a hidden form to send data
              var form = document.createElement('form');
              form.method = 'POST';
              form.action = 'add_section_process.php';

              // Course Code Input
              var courseCodeField = document.createElement('input');
              courseCodeField.type = 'hidden';
              courseCodeField.name = 'courseCode';
              courseCodeField.value = '" . $courseCode . "';
              form.appendChild(courseCodeField);

              // Section Number Input
              var sectionNoField = document.createElement('input');
              sectionNoField.type = 'hidden';
              sectionNoField.name = 'sectionNo';
              sectionNoField.value = '" . $sectionNo . "';
              form.appendChild(sectionNoField);

              // Append form to the body and submit
              document.body.appendChild(form);
              form.submit();
            }
          });
        </script>
      ";
    } else {
      echo "
        <script>
          Swal.fire({
            title: 'Error',
            text: 'Please enter a valid number of sections.',
            icon: 'error',
            confirmButtonText: 'OK'
          });
        </script>
      ";
    }
  }
?>

<div class="container">
  <h2>Add Courses for Registration</h2>
  <form method="POST" action="">
    <div>
      <label for="exampleSelect1" class="form-label mt-4">Course Code</label>
      <select class="form-select" id="courseCode" name="courseCode" required>
        <option value="">Choose Course</option>
        <?php
          // Fetch courses to populate dropdown
          $sql_course = "SELECT * FROM tb_course";
          $courses = mysqli_query($con, $sql_course);

          while ($course = mysqli_fetch_array($courses)) {
            echo "<option value='" . $course['c_code'] . "'>" . $course['c_code'] . " " . $course['c_name'] . "</option>";
          }
        ?>
      </select>
    </div>
    <div>
      <label class="col-form-label mt-4" for="inputDefault">Number of Sections</label>
      <input type="number" class="form-control" id="inputDefault" name="sectionNo" required min="1">
    </div>
    <div class="d-flex justify-content-center">
      <button type="submit" class="btn btn-primary mt-4"><i class="fa-solid fa-plus"></i> Add Sections</button>
    </div>
  </form>
  <?php include '../footer.php'; ?>
</div>

<script>
  $(function(){
    $("#courseCode").selectize();
  }); 
</script>
