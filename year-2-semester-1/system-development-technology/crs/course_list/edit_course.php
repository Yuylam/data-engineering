<?php
  include '../headers/header_staff.php';

  if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['courseCode'])) {
      $courseCode = $_POST['courseCode'];

      $sql = "SELECT * FROM tb_course c
              LEFT JOIN tb_user u ON u.u_id = c.c_coordinator
              LEFT JOIN tb_department d ON d.d_id = c.c_department
              WHERE c.c_code = '$courseCode'";
      $result_course = mysqli_query($con, $sql);

      $sql = "SELECT * FROM tb_prerequsite
              WHERE p_course = '$courseCode'";
      $result_prerequsite = mysqli_query($con, $sql);
      $prerequisites = [];

      if ($result_prerequsite && mysqli_num_rows($result_prerequsite) > 0) {
        while ($row = mysqli_fetch_assoc($result_prerequsite)) {
          $prerequisites[] = $row['p_prerequisite'];
        }
      }

      if ($result_course && mysqli_num_rows($result_course) > 0) {
        $course = mysqli_fetch_assoc($result_course);
      } else {
        echo "<script>
                Swal.fire({
                  title: 'Error',
                  text: 'Course not found!',
                  icon: 'error',
                  confirmButtonText: 'OK'
                }).then(() => {
                  window.location.href = 'course_list.php';
                });
              </script>";
        exit;
      }
    }
  }
?>

<div class="container">
  <h2>Edit Course</h2>
  <form method="POST" action="edit_course_process.php">
    <div>
      <fieldset disabled="">
        <label class="form-label" for="disabledInput">Course Code</label>
        <input class="form-control" id="disabledInput" type="text" disabled value="<?php echo isset($course['c_code']) ? $course['c_code'] : ''; ?>" name="courseCode">
      </fieldset>
      <input type="hidden" name="courseCode" value="<?php echo isset($course['c_code']) ? $course['c_code'] : ''; ?>">
    </div>
    <div>
      <label class="col-form-label mt-4" for="inputDefault">Course Name</label>
      <input type="text" class="form-control" placeholder="Course Name" id="inputDefault" value="<?php echo isset($course['c_name']) ? $course['c_name'] : ''; ?>" name="courseName" required>
    </div>
    <div>
      <label class="col-form-label mt-4" for="inputDefault">Credit</label>
      <input type="number" class="form-control" placeholder="Credit" id="inputDefault" value="<?php echo isset($course['c_credit']) ? $course['c_credit'] : ''; ?>" name="courseCredit" required>
    </div>
    <div>
      <label class="col-form-label mt-4" for="inputDefault">Department</label>
      <select class="form-select me-2" name="department" required>
        <?php
          $sql = "SELECT * FROM tb_department";
          $result_department = mysqli_query($con, $sql);
          
          while ($department = mysqli_fetch_array($result_department)) {
            $selected = (isset($course['c_department']) && $course['c_department'] == $department['d_id']) ? 'selected' : '';
            echo "<option value='" . $department['d_id'] . "' $selected>" . $department['d_name'] . "</option>";
          }
        ?>
      </select>
    </div>
    <div>
      <label class="col-form-label mt-4" for="inputDefault">Coordinator</label>
      <select class="form-select me-2" name="coordinator" id="lecturer" required>
        <?php
          $sql = "SELECT * FROM tb_lecturer l
                  LEFT JOIN tb_user u ON u.u_id = l.l_id";
          $result_lecturer = mysqli_query($con, $sql);
          
          while ($lecturer = mysqli_fetch_array($result_lecturer)) {
            $selected = (isset($course['c_coordinator']) && $course['c_coordinator'] == $lecturer['l_no']) ? 'selected' : '';
            echo "<option value='" . $lecturer['l_no'] . "' $selected>" . $lecturer['u_name'] . "</option>";
          }
        ?>
      </select>
    </div>
    
    <!-- Dynamic Prerequisite Inputs -->
    <div class="mt-4" id="prerequisiteSection">
      <label class="col-form-label" for="prerequisite">Prerequisites</label>
      
      <?php
        // Fetch all courses to populate the prerequisite options
        $sql = "SELECT c_code, c_name FROM tb_course";
        $result_courses = mysqli_query($con, $sql);

        // Loop through each prerequisite and create its select field
        foreach ($prerequisites as $prerequisite) {
          echo "<div class='prerequisite-input'>
                  <select class='form-select' name='prerequisite[]'>
                    <option value=''>Select Prerequisite</option>";
                    
          // Loop through the courses again to populate the select options
          mysqli_data_seek($result_courses, 0); // Reset the result set to the beginning
          while ($course_item = mysqli_fetch_array($result_courses)) {
            $isSelected = ($course_item['c_code'] == $prerequisite) ? 'selected' : '';
            echo "<option value='" . $course_item['c_code'] . "' $isSelected>" . $course_item['c_name'] . " (" . $course_item['c_code'] . ")</option>";
          }
          
          echo "</select>
                </div>";
        }
      ?>
    </div>

    <!-- Button to Add More Prerequisite Fields -->
    <button type="button" id="addPrerequisite" class="btn btn-secondary mt-3">Add Another Prerequisite</button>

    <br><br>
    <div style="display: flex; gap: 10px; justify-content: center;">
        <button type="button" class="btn btn-primary" onclick="window.location.href='course_list.php'"><i class="fa-solid fa-circle-chevron-left"></i> Back</button>
        <button type="submit" class="btn btn-primary"><i class="fa-solid fa-floppy-disk"></i> Save</button>
    </div>
  </form>
  <?php include '../footer.php'; ?>
</div>

<script>
  $(function(){
    $("#lecturer").selectize();
    
    // Initialize selectize for the first prerequisite select input
    $("#prerequisiteSection select").selectize();
  });

  // Add a new prerequisite input field dynamically
  document.getElementById('addPrerequisite').addEventListener('click', function() {
    var prerequisiteSection = document.getElementById('prerequisiteSection');
    var newPrerequisite = document.createElement('div');
    newPrerequisite.classList.add('prerequisite-input');
    
    // Create a new select input for the prerequisite
    var newSelect = document.createElement('select');
    newSelect.name = 'prerequisite[]';
    newSelect.classList.add('form-select');
    newSelect.innerHTML = `
      <option value="">Select Prerequisite</option>
      <?php
        $sql = "SELECT c_code, c_name FROM tb_course";
        $result_courses = mysqli_query($con, $sql);
        while ($course_item = mysqli_fetch_array($result_courses)) {
          echo "<option value='" . $course_item['c_code'] . "'>" . $course_item['c_name'] . " (" . $course_item['c_code'] . ")</option>";
        }
      ?>
    `;
    
    newPrerequisite.appendChild(newSelect);
    prerequisiteSection.appendChild(newPrerequisite);

    // Re-initialize selectize for the newly added select field
    $(newSelect).selectize();
  });
</script>
