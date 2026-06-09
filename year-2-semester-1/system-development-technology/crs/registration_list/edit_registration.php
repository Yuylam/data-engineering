<?php
  include '../headers/header_staff.php';
  $registrationID = $_POST['registrationID'];

  $sql = "SELECT * FROM tb_registration r
          LEFT JOIN tb_section sec ON sec.s_course = r.r_course AND sec.s_no = r.r_section
          LEFT JOIN tb_course c ON c.c_code = r.r_course
          LEFT JOIN tb_lecturer l ON sec.s_lecturer = l.l_no
          WHERE r.r_id = '$registrationID'";
  $result = mysqli_query($con, $sql);
  $registration = mysqli_fetch_assoc($result);

  $courseCode = $registration['r_course'];
  
  $studentNo = $registration['r_student'];
  $sql = "SELECT * FROM tb_student s
          LEFT JOIN tb_user u ON s.s_id = u.u_id
          WHERE s.s_no = '$studentNo'";
  $result = mysqli_query($con, $sql);
  $student = mysqli_fetch_assoc($result);

  $lecturerNo = $registration['l_no'];
  $advisorNo = $student['s_advisor'];

  $sql = "SELECT u.u_name 
          FROM tb_lecturer l
          LEFT JOIN tb_user u ON u.u_id = l.l_id
          WHERE l.l_no = '$lecturerNo'";
  $result_lecturer = mysqli_query($con, $sql);
  $lecturer = mysqli_fetch_assoc($result_lecturer);

  $sql = "SELECT u.u_name 
          FROM tb_user u
          LEFT JOIN tb_lecturer l ON u.u_id = l.l_id
          WHERE l.l_no = '$advisorNo'";
  $result_advisor = mysqli_query($con, $sql);
  $advisor = mysqli_fetch_assoc($result_advisor);
?>

<div class="container">
  <h2>Edit Registration</h2>
  <form method="POST" action="edit_registration_process.php" id="editRegistrationForm">
  <input type="hidden" name="registrationID" value="<?php echo $registrationID ?>">
  <input type="hidden" name="studentNo" value="<?php echo $studentNo ?>">
    <div class="card mb-3">
      <div class="card-header text-white bg-primary d-flex justify-content-between align-items-center">
        Student Information
        <button type="button" class="btn btn-info" onclick="submitForm('student_registration.php')">
          <i class="fa-solid fa-square-up-right"></i> Student Registration
        </button>
      </div>
      <div class="card-body">
        <table class="table table-hover">
          <tbody>
            <tr>
              <td>Name</td>
              <td><?php echo $student['u_name']; ?></td>
            </tr>
            <tr>
              <td>Matric Number</td>
              <td><?php echo $student['s_no']; ?></td>
            </tr>
            <tr>
              <td>Programme Code</td>
              <td><?php echo $student['s_programme']; ?></td>
            </tr>
            <tr>
              <td>Intake</td>
              <td><?php echo $student['s_intake']; ?></td>
            </tr>
            <tr>
              <td>Advisor</td>
              <td><?php echo $advisor['u_name']; ?></td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>

    <div class="card mb-3">
      <div class="card-header text-white bg-primary d-flex justify-content-between align-items-center">
        Section Information
        <input type="hidden" name="courseCode" value="<?php echo $courseCode ?>">
        <button type="button" class="btn btn-info" onclick="submitForm('section_registration.php')">
          <i class="fa-solid fa-square-up-right"></i> Section Registration
        </button>
      </div>
      <div class="card-body">
        <table class="table table-hover">
          <tbody>
            <tr>
              <td>Course Code</td>
              <td><?php echo $registration['c_code']; ?></td>
            </tr>
            <tr>
              <td>Course Name</td>
              <td><?php echo $registration['c_name']; ?></td>
            </tr>
            <tr>
              <td>Section No</td>
              <td>
                <select class="form-select me-2" name="section" id="section">
                  <?php
                    $sql = "SELECT * FROM tb_section
                            WHERE s_semester = '$semester'
                            AND s_course = '$courseCode'";
                    $result_section = mysqli_query($con, $sql);
                    
                    while ($section = mysqli_fetch_assoc($result_section)) {
                      $selected = ($registration['r_section'] == $section['s_no']) ? 'selected' : '';
                      echo "<option value='" . htmlspecialchars($section['s_no']) . "' $selected>" . htmlspecialchars($section['s_no']) . "</option>";
                    }
                  ?>
                </select>
              </td>
            </tr>
            <tr>
              <td>Lecturer</td>
              <td><?php echo $lecturer['u_name']; ?></td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>

    <select class="form-select me-2" name="status" id="status" style="max-width:300px;">
      <?php
        $sql = "SELECT * FROM tb_status";
        $result_status = mysqli_query($con, $sql);
        
        while ($status = mysqli_fetch_assoc($result_status)) {
          $selected = ($registration['r_status'] == $status['s_id']) ? 'selected' : '';
          echo "<option value='" . htmlspecialchars($status['s_id']) . "' $selected>" . htmlspecialchars($status['s_desc']) . "</option>";
        }
      ?>
    </select>
    <br>
    <div style="display: flex; gap: 10px; justify-content: center;">
      <button type="button" class="btn btn-primary" onclick="window.location.href='registration_list.php'"><i class="fa-solid fa-circle-chevron-left"></i> Back</button>
      <button type="submit" class="btn btn-primary"><i class="fa-solid fa-floppy-disk"></i> Save</button>
    </div>

  </form>
</div>
<?php include '../footer.php'; ?>

<script>
function submitForm(action) {
    let form = document.getElementById("editRegistrationForm");
    form.action = action;
    form.submit();
}
</script>