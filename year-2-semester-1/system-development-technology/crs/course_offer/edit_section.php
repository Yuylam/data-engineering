<?php
  include '../headers/header_staff.php';

  if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['courseCode'])) {
      $courseCode = $_POST['courseCode'];

      // Get course detail for info card
      $sql = "SELECT * FROM tb_course c
              LEFT JOIN tb_lecturer l ON l.l_no = c.c_coordinator
              LEFT JOIN tb_user u ON u.u_id = l.l_id
              LEFT JOIN tb_department d ON d.d_id = c.c_department
              WHERE c_code = '$courseCode'";
      $result_course = mysqli_query($con, $sql);
      $course = mysqli_fetch_assoc($result_course);

      // Get all sections for the table
      $sql = "SELECT * FROM tb_section s
              LEFT JOIN tb_course c ON c.c_code = s.s_course
              WHERE s.s_course = '$courseCode' AND s.s_semester = '$semester'
              ORDER BY s.s_no ASC;";
      $result_section = mysqli_query($con, $sql);

      // Get the highest section number
      $sql_max = "SELECT MAX(s_no) AS max_section FROM tb_section WHERE s_course = '$courseCode' AND s_semester = '$semester'";
      $result_max = mysqli_query($con, $sql_max);
      $maxSection = mysqli_fetch_assoc($result_max)['max_section'] ?? 0;

      // Get all lecturers for dropdown
      $sql = "SELECT * FROM tb_lecturer l
              LEFT JOIN tb_user u ON u.u_id = l.l_id;";
      $result_lecturer = mysqli_query($con, $sql);
    }
  }
?>

<div class="container">
  <h2>Edit Sections</h2>
  <div class="card">
    <div class="card-body">
      <h4 class="card-title"><?php echo $courseCode . " - " . $course['c_name']; ?></h4>
      <table class="table table-hover">
        <tr>
          <td>Credit</td>
          <td><?php echo $course['c_credit']; ?></td>
        </tr>
        <tr>
          <td>Coordinator</td>
          <td><?php echo $course['c_coordinator'] . " - " . $course['u_name']; ?></td>
        </tr>
        <tr>
          <td>Department</td>
          <td><?php echo $course['d_name']; ?></td>
        </tr>
      </table>
    </div>
  </div>

  <!-- Form to Edit Sections -->
  <form method="POST" action="edit_section_process.php">
    <input type="hidden" name="courseCode" value="<?php echo $courseCode; ?>">
    <input type="hidden" name="semester" value="<?php echo $semester; ?>">

    <table class="table table-hover">
      <thead>
        <tr>
          <th>Section</th>
          <th>Lecturer</th>
          <th>Capacity</th>
          <!-- <th>Action</th> -->
        </tr>
      </thead>
      <tbody>
        <?php while ($section = mysqli_fetch_assoc($result_section)) { ?>
          <tr>
            <td><?php echo $section['s_no']; ?></td>
            <td>
              <div>
                <select class="form-select me-2 lecturer-select" name="lecturer[<?php echo $section['s_no']; ?>]" required>
                  <option value=''>Choose Lecturer</option>
                  <?php
                    mysqli_data_seek($result_lecturer, 0); // Reset lecturer pointer
                    while ($lecturer = mysqli_fetch_array($result_lecturer)) {
                      $selected = ($section['s_lecturer'] == $lecturer['l_no']) ? 'selected' : '';
                      echo "<option value='" . $lecturer['l_no'] . "' $selected>" . $lecturer['l_no'] . " - " . $lecturer['u_name'] . "</option>";
                    }
                  ?>
                </select>
              </div>
            </td>
            <td>
              <input type="number" class="form-control" name="capacity[<?php echo $section['s_no']; ?>]" 
                     value="<?php echo htmlspecialchars($section['s_capacity']); ?>" min="1" required>
            </td>
            <!-- <td>
              <?php if ($section['s_no'] == $maxSection) { ?>
                <form method="POST" action="edit_section_delete_process.php">
                  <input type="hidden" name="courseCode" value="<?php echo $courseCode; ?>">
                  <input type="hidden" name="sectionNo" value="<?php echo $section['s_no']; ?>">
                  <button type="submit" class="btn btn-danger" data-section="<?php echo $section['s_no']; ?>">
                    <i class="fa-solid fa-trash"></i> Delete
                  </button>
                </form>
              <?php } ?>
            </td> -->
          </tr>
        <?php } ?>
      </tbody>
    </table>
    
    <div style="display: flex; gap: 10px; justify-content: center;">
        <button type="button" class="btn btn-primary" onclick="window.location.href='modify_course.php'">
          <i class="fa-solid fa-circle-chevron-left"></i> Back
        </button>
        <button type="submit" class="btn btn-success">
          <i class="fa-solid fa-floppy-disk"></i> Save
        </button>
    </div>
  </form>
  <?php include '../footer.php'; ?>
</div>

<script>
  $(function(){
    $(".lecturer-select").selectize();
  });
</script>
