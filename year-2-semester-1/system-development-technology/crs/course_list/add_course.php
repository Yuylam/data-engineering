<?php
  include '../headers/header_staff.php';
?>

<div class="container">
  <h2>Add Course</h2>
  <form method="POST" action="add_course_process.php">
    <div>
      <label class="form-label" for="disabledInput">Course Code</label>
      <input class="form-control" id="disabledInput" type="text" name="courseCode" placeholder="Course Code" required>
    </div>
    <div>
      <label class="col-form-label mt-4" for="inputDefault">Course Name</label>
      <input type="text" class="form-control" placeholder="Course Name" id="inputDefault" name="courseName" required>
    </div>
    <div>
      <label class="col-form-label mt-4" for="inputDefault">Credit</label>
      <input type="number" class="form-control" placeholder="Credit" id="inputDefault" name="courseCredit" required>
    </div>
    <div>
      <label class="col-form-label mt-4" for="inputDefault">Department</label>
      <select class="form-select me-2" name="department" required>
        <option value="">Select Department</option>
        <?php
          $sql = "SELECT * FROM tb_department";
          $result_department = mysqli_query($con, $sql);
          
          while ($department = mysqli_fetch_array($result_department)) {
            echo "<option value='" . $department['d_id'] . "' $selected>" . $department['d_name'] . "</option>";
          }
        ?>
      </select>
    </div>
    <div>
      <label class="col-form-label mt-4" for="inputDefault">Coordinator</label>
      <select class="form-select me-2" name="coordinator" id="lecturer" required>
        <option value="">Select Lecturer</option>
        <?php
          $sql = "SELECT * FROM tb_lecturer l
                  LEFT JOIN tb_user u ON u.u_id = l.l_id";
          $result_lecturer = mysqli_query($con, $sql);
          
          while ($lecturer = mysqli_fetch_array($result_lecturer)) {
            echo "<option value='" . $lecturer['l_no'] . "' $selected>" . $lecturer['u_name'] . "</option>";
          }
        ?>
      </select>
    </div>
    <br>
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
  }); 
</script>
