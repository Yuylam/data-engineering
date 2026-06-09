<?php
  include '../headers/header_student.php';

  $sql_registration = "
    SELECT * FROM tb_registration 
    LEFT JOIN tb_course
    ON tb_course.c_code = tb_registration.r_course
    WHERE tb_registration.r_student = '$student_no'
    AND tb_registration.r_semester = '$semester'";
  $result_registration = mysqli_query($con, $sql_registration);
  $registeredCourses = [];
  $totalCredits = 0;
  while ($row = mysqli_fetch_assoc($result_registration)) {
    if (in_array($row['r_status'], [1, 2, 3])) {
      $registeredCourses[] = $row['r_course'];
      $totalCredits += $row['c_credit']; 
    }
  }
  mysqli_data_seek($result_registration, 0);

  $courses = [];
  $sql_courses = "SELECT DISTINCT c.c_code, c.c_name, c.c_credit
                  FROM tb_section s
                  INNER JOIN tb_course c ON s.s_course = c.c_code
                  WHERE s.s_semester = '$semester'";

  $result_courses = mysqli_query($con, $sql_courses);
  while ($row = mysqli_fetch_assoc($result_courses)) {
    if (!in_array($row['c_code'], $registeredCourses)) {
      $courses[] = $row; 
    }
  }
?>

<style>
  table td, table th {
    vertical-align: middle;
    text-align: center;
  }
</style>

<div class="container">
  <h2>Course Registration</h2>
  <div class="d-flex justify-content-end mb-3">
    <button type="button" class="btn btn-primary" onclick="window.location.href='browse_course.php'">Browse Course</button>
  </div>
  <form method="POST" action="register_course_process.php" id="registrationForm">
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
                <form method="POST" action="register_course_delete_process.php">
                  <input type="hidden" name="registrationID" value="<?php echo $registration['r_id']; ?>">
                  <input type="hidden" name="studentNo" value="<?php echo $studentNo; ?>">
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
