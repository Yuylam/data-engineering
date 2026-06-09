<?php
  include '../headers/header_staff.php';

  // Fetch courses for selection
  $sql_courses = "SELECT DISTINCT c.c_code, c.c_name, c.c_credit
  FROM tb_section s
  INNER JOIN tb_course c ON s.s_course = c.c_code
  WHERE s.s_semester = '$semester'";
  $result_courses = mysqli_query($con, $sql_courses);
  $courses = [];
  while ($course = mysqli_fetch_assoc($result_courses)) {
    $courses[] = $course;
  }

  // Fetch existing registrations
  $sql_registration = "SELECT * FROM tb_registration r 
          LEFT JOIN tb_course c ON r.r_course = c.c_code
          WHERE r.r_student = '$student_no'
          AND r.r_semester = '$semester'";
  $result_registration = mysqli_query($con, $sql_registration);

  $sql = "SELECT * FROM tb_student s
          LEFT JOIN tb_user u ON s.s_id = u.u_id
          WHERE s.s_no = '$student_no'";
  $result = mysqli_query($con, $sql);
  $student = mysqli_fetch_assoc($result);

  $advisorNo = $student['s_advisor'];

  $sql = "SELECT u.u_name 
          FROM tb_user u
          LEFT JOIN tb_lecturer l ON u.u_id = l.l_id
          WHERE l.l_no = '$advisorNo'";
  $result_advisor = mysqli_query($con, $sql);
  $advisor = mysqli_fetch_assoc($result_advisor);
?>

<style>
  .center_design td, 
  .center_design th {
    vertical-align: middle;
    text-align: center;
  }
</style>

<div class="container">
  <form method="POST" action="student_registration_process.php" id="registrationForm">
    <div class="container">
      <h2>Student Registration</h2>

      <div class="card mb-3">
        <div class="card-header text-white bg-primary d-flex justify-content-between align-items-center">
          Student Information
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
      
      <table class="table table-hover center_design" id="courseTable">
        <thead>
          <tr>
            <th>Course Code</th>
            <th>Course</th>
            <th>Section</th>
            <th>Credit</th>
            <th>Status</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          <?php while ($registration = mysqli_fetch_assoc($result_registration)){ ?>
            <tr id="course-row-<?php echo $registration['r_id']; ?>">
              <td><?php echo $registration['r_course']; ?></td>
              <td><?php echo $registration['c_name']; ?></td>
              <td><?php echo $registration['r_section']; ?></td>
              <td><?php echo $registration['c_credit']; ?></td>
              <td id="status-<?php echo $registration['r_id']; ?>">
                <?php if($registration['r_status'] == 1): ?>
                  <span class="badge rounded-pill bg-secondary">Draft</span>
                <?php elseif($registration['r_status'] == 2): ?>
                  <span class="badge rounded-pill bg-primary">Submitted</span>
                <?php elseif($registration['r_status'] == 3): ?>
                  <span class="badge rounded-pill bg-success">Approved</span>
                <?php elseif($registration['r_status'] == 4): ?>
                  <span class="badge rounded-pill bg-danger">Rejected</span>
                <?php endif; ?>
              </td>
              <td>
                <form method="POST" action="student_registration_delete_process.php">
                  <input type="hidden" name="registrationID" value="<?php echo $registration['r_id']; ?>">
                  <input type="hidden" name="studentNo" value="<?php echo $student_no; ?>">
                  <button type="submit" class="btn btn-danger"><i class="fa-solid fa-trash"></i> Delete</button>
                </form>
              </td>
            </tr>
          <?php } ?>
        </tbody>
      </table>

      <div style="display: flex; gap: 10px; justify-content: center;">
        <button type="button" class="btn btn-primary" id="addCourse"><i class="fa-solid fa-plus"></i> Add Course</button>
        <button type="submit" class="btn btn-success"><i class="fa-solid fa-save"></i> Save</button>
      </div>
    </div>
  </form>

</div>
<?php include '../footer.php'; ?>

<script>
  let courses = <?php echo json_encode($courses); ?>;

  document.getElementById("addCourse").addEventListener("click", function() {
    let tableBody = document.querySelector("#courseTable tbody");
    let row = document.createElement("tr");

    let courseSelect = `<select class="form-control courseSelect" name="courses[]">
                          <option value="">Select Course</option>`;
    courses.forEach(course => {
      courseSelect += `<option value="${course.c_code}" data-name="${course.c_name}" data-credit="${course.c_credit}">${course.c_code}</option>`;
    });
    courseSelect += `</select>`;

    row.innerHTML = `
      <td>${courseSelect}</td>
      <td><input type="text" class="form-control courseName" readonly></td>
      <td>
        <select class="form-control sectionSelect" name="sections[]">
          <option value="">Select Section</option>
        </select>
      </td>
      <td><input type="text" class="form-control courseCredit" readonly></td>
      <td><span class="badge rounded-pill bg-warning">New</span></td>
      <td><button type="button" class="btn btn-danger removeRow"><i class="fa-solid fa-trash"></i> Delete</button></td>
    `;

    tableBody.appendChild(row);

    row.querySelector(".courseSelect").addEventListener("change", function() {
      let selectedOption = this.options[this.selectedIndex];
      let courseName = selectedOption.getAttribute("data-name");
      let courseCredit = selectedOption.getAttribute("data-credit");

      row.querySelector(".courseName").value = courseName;
      row.querySelector(".courseCredit").value = courseCredit;

      let courseCode = this.value;
      fetch("get_section.php?course_code=" + courseCode)
        .then(response => response.json())
        .then(data => {
          let sectionSelect = row.querySelector(".sectionSelect");
          sectionSelect.innerHTML = `<option value="">Select Section</option>`;
          data.forEach(section => {
            sectionSelect.innerHTML += `<option value="${section}">${section}</option>`;
          });
        });
    });

    row.querySelector(".removeRow").addEventListener("click", function() {
      row.remove();
    });
  });
</script>