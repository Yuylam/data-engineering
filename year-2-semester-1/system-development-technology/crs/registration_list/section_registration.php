<?php
  include '../headers/header_staff.php';
  
  // Check if courseCode and sectionNo are set, otherwise redirect
  if (isset($_POST['courseCode']) && !empty($_POST['courseCode'])) {
    $_SESSION['courseCode'] = $_POST['courseCode'];
  }
  if (!isset($_SESSION['courseCode'])) {
    echo "<script>
            alert('Course Code not provided. Please try again.');
            window.location.href = 'registration_list.php';
          </script>";
    exit;
  }
  $courseCode = $_SESSION['courseCode'];

  if (isset($_POST['section']) && !empty($_POST['section'])) {
    $_SESSION['sectionNo'] = $_POST['section'];
  }
  if (!isset($_SESSION['sectionNo'])) {
    echo "<script>
            alert('Section not provided. Please try again.');
            window.location.href = 'registration_list.php';
          </script>";
    exit;
  }
  $sectionNo = $_SESSION['sectionNo'];

  // Get Section Info
  $sql_section = "SELECT * 
    FROM tb_section s
    LEFT JOIN tb_course c
    ON c.c_code = s.s_course
    LEFT JOIN tb_lecturer l
    ON l.l_no = s.s_lecturer
    LEFT JOIN tb_user u
    ON l.l_id = u.u_id
    LEFT JOIN tb_department d
    ON d.d_id = c.c_department
    WHERE s.s_course = '$courseCode'
    AND s.s_no = '$sectionNo'
    AND s.s_semester = '$semester'";
  $result_section = mysqli_query($con, $sql_section);
  $section = mysqli_fetch_assoc($result_section);

  $coordinator = $section['c_coordinator'];
  $sql = "SELECT u.u_name FROM tb_lecturer l
          LEFT JOIN tb_user u
          ON l.l_id = u.u_id
          WHERE l.l_no = '$coordinator'";
  $result_coordinator = mysqli_query($con, $sql);
  $coordinator = mysqli_fetch_assoc($result_coordinator);
  $coordinator = $coordinator['u_name'];

  // Get registration list (students that are already registered)
  $sql_registration = "SELECT * FROM tb_registration r
    LEFT JOIN tb_student s
    ON s.s_no = r.r_student
    LEFT JOIN tb_user u
    ON u.u_id = s.s_id
    WHERE r.r_course = '$courseCode'
    AND r.r_section = '$sectionNo'
    AND r.r_semester = '$semester'";
  $result_registration = mysqli_query($con, $sql_registration);
  $num_registrations = mysqli_num_rows($result_registration);

  // Get list of students for selection
  $sql_student = "SELECT * FROM tb_student s
          LEFT JOIN tb_user u
          ON s.s_id = u.u_id";
  $result_student = mysqli_query($con, $sql_student);
  $students = [];
  while ($student = mysqli_fetch_assoc($result_student)) {
    $students[] = $student;
  }
?>

<style>
  .center_design td, 
  .center_design th {
    vertical-align: middle;
    text-align: center;
  }
</style>

<div class="container">
  <h2>Section Registration</h2>
  <div class="card">
    <div class="card-header text-white bg-primary d-flex justify-content-between align-items-center">
      Section Information
    </div>
    <div class="card-body">
      <table class="table table-hover">
        <tr>
          <td>Lecturer</td>
          <td><?php echo $section['s_lecturer'] . " - " . $section['u_name']; ?></td>
        </tr>
        <tr>
          <td>Capacity</td>
          <td><?php echo $num_registrations . "/" . $section['s_capacity']; ?></td>
        </tr>
        <tr>
          <td>Credit</td>
          <td><?php echo $section['c_credit']; ?></td>
        </tr>
        <tr>
          <td>Coordinator</td>
          <td><?php echo $section['c_coordinator']; ?> - <?php echo $coordinator; ?></td>
        </tr>
        <tr>
          <td>Department</td>
          <td><?php echo $section['d_name']; ?></td>
        </tr>
      </table>
    </div>
  </div>
  <form method="POST" action="section_registration_process.php" id="registrationForm">
    <input type="hidden" name="courseCode" value="<?php echo $courseCode; ?>">
    <input type="hidden" name="sectionNo" value="<?php echo $sectionNo; ?>">
    <input type="hidden" name="semester" value="<?php echo $semester; ?>">

    <table class="table table-hover center_design" id="studentTable">
      <thead>
        <tr>
          <th>Matric Number</th>
          <th>Name</th>
          <th>Intake</th>
          <th>Programme</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody>
        <?php while ($student = mysqli_fetch_assoc($result_registration)) {
            $studentNo = $student['s_no']; ?>
          <tr>
            <td><?php echo $student['s_no'] ?></td>
            <td><?php echo $student['u_name'] ?></td>
            <td><?php echo $student['s_intake'] ?></td>
            <td><?php echo $student['s_programme'] ?></td>
            <td>
              <form method="POST" action="section_registration_delete_process.php">
                <input type="hidden" name="courseCode" value="<?php echo $courseCode; ?>">
                <input type="hidden" name="sectionNo" value="<?php echo $sectionNo; ?>">
                <input type="hidden" name="studentNo" value="<?php echo $studentNo; ?>">
                <input type="hidden" name="registrationID" value="<?php echo $student['r_id']; ?>">
                <button type="submit" class="btn btn-danger"><i class="fa-solid fa-trash"></i> Delete</button>
              </form>
            </td>
          </tr>
        <?php } ?>
      </tbody>
    </table>

    <div style="display: flex; gap: 10px; justify-content: center;">
      <button type="button" class="btn btn-primary" id="addStudent"><i class="fa-solid fa-plus"></i> Add Student</button>
      <button type="submit" class="btn btn-success" id="saveButton"><i class="fa-solid fa-save"></i> Save</button>
    </div>
  </form>
</div>
<?php include '../footer.php'; ?>

<script>
  let students = <?php echo json_encode($students); ?>;

  // Add student row when button is clicked
  document.getElementById("addStudent").addEventListener("click", function() {
    let tableBody = document.querySelector("#studentTable tbody");
    let row = document.createElement("tr");

    let studentSelect = `<select class="form-control studentSelect" name="students[]">
                          <option value="">Select Student</option>`;
    students.forEach(student => {
      studentSelect += `<option value="${student.s_no}" data-name="${student.u_name}" data-intake="${student.s_intake}" data-programme="${student.s_programme}">${student.s_no}</option>`;
    });
    studentSelect += `</select>`;

    row.innerHTML = `
      <td>${studentSelect}</td>
      <td><input type="text" class="form-control studentName" name="studentNames[]" readonly></td>
      <td><input type="text" class="form-control studentIntake" name="studentIntakes[]" readonly></td>
      <td><input type="text" class="form-control studentProgramme" name="studentProgrammes[]" readonly></td>
      <td><button type="button" class="btn btn-danger removeRow"><i class="fa-solid fa-trash"></i> Delete</button></td>
    `;

    tableBody.appendChild(row);

    row.querySelector(".studentSelect").addEventListener("change", function() {
      let selectedOption = this.options[this.selectedIndex];
      let studentName = selectedOption.getAttribute("data-name");
      let studentIntake = selectedOption.getAttribute("data-intake");
      let studentProgramme = selectedOption.getAttribute("data-programme");

      row.querySelector(".studentName").value = studentName;
      row.querySelector(".studentIntake").value = studentIntake;
      row.querySelector(".studentProgramme").value = studentProgramme;
    });

    row.querySelector(".removeRow").addEventListener("click", function() {
      row.remove();
    });
  });

  // Form submission check for empty student selection
  document.getElementById("registrationForm").addEventListener("submit", function(event) {
    let studentSelects = document.querySelectorAll("select[name='students[]']");
    let isValid = false;

    studentSelects.forEach(select => {
      if (select.value !== "") {
        isValid = true;
      }
    });

    if (!isValid) {
      event.preventDefault();
      alert("Please select at least one student.");
    }
  });
</script>
