<?php
  include '../headers/header_lecturer.php';

  $sql = "SELECT s_no FROM tb_student WHERE s_advisor = '$lecturer_no'";
  $result_advisee = mysqli_query($con, $sql);
  $advisee_count = mysqli_num_rows($result_advisee);

  // Query to get students, their registration details, and courses
  $sql = "SELECT s.s_no, u.u_name, r.r_course, r.r_section, r.r_semester, c.c_name, c.c_credit, r.r_status, r.r_id
          FROM tb_student s
          RIGHT JOIN tb_registration r ON r.r_student = s.s_no
          INNER JOIN tb_user u ON u.u_id = s.s_id
          LEFT JOIN tb_course c ON c.c_code = r.r_course
          WHERE s.s_advisor = '$lecturer_no' 
          AND r.r_semester = '$semester' 
          AND (r.r_status = 2 OR r.r_status = 3 OR r.r_status = 4)";

  $result = mysqli_query($con, $sql);

  $registration_by_student = [];

  // Group courses by student
  while ($registration = mysqli_fetch_assoc($result)) {
    $student_no = $registration['s_no'];

    if (!isset($registration_by_student[$student_no])) {
      $registration_by_student[$student_no] = [
        'student_name' => $registration['u_name'],
        'courses' => []
      ];
    }

    $registration_by_student[$student_no]['courses'][] = [
      'course_code' => $registration['r_course'],
      'course_name' => $registration['c_name'],
      'section' => $registration['r_section'],
      'credit' => $registration['c_credit'], 
      'status' => $registration['r_status'],
      'id' => $registration['r_id']
    ];
  }
?>

<style>
  table td, table th {
    vertical-align: middle;
    text-align: center;
  }
</style>

<div class="container">
  <h2>Advisee</h2>

  <?php if ($advisee_count == 0): ?>
    <p>No advisee.</p>
  <?php elseif (count($registration_by_student) == 0): ?>
    <p>No advisee registered yet for semester <?php echo htmlspecialchars($semester)?>.</p>
  <?php else: ?>
  
  <!-- Loop through each student and their registered courses -->
  <?php foreach ($registration_by_student as $student_no => $registration): ?>
    <div class="card mb-3">
      <div class="card-header text-white bg-primary d-flex justify-content-between align-items-center">
        <?php echo $registration['student_name']; ?> <?php echo $student_no; ?>
      </div>
      <div class="card-body">
        <table class="table table-hover">
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
            <?php foreach ($registration['courses'] as $course): ?>
              <tr id="course-row-<?php echo $course['id']; ?>">
                <td><?php echo $course['course_code']; ?></td>
                <td><?php echo $course['course_name']; ?></td>
                <td><?php echo $course['section']; ?></td>
                <td><?php echo $course['credit']; ?></td>
                <td id="status-<?php echo $course['id']; ?>">
                  <?php if($course['status'] == 2): ?>
                    <span class="badge rounded-pill bg-primary">Submitted</span>
                  <?php elseif($course['status'] == 3): ?>
                    <span class="badge rounded-pill bg-success">Approved</span>
                  <?php elseif($course['status'] == 4): ?>
                    <span class="badge rounded-pill bg-danger">Rejected</span>
                  <?php endif; ?>
                </td>
                <td>
                  <?php if($course['status'] == 2): ?>
                    <button type="button" class="btn btn-success" onclick="action(<?php echo $course['id']; ?>, 'approve')">Approve</button>
                    <button type="button" class="btn btn-danger" onclick="action(<?php echo $course['id']; ?>, 'reject')">Reject</button>
                  <?php elseif($course['status'] == 3): ?>
                    No Action
                  <?php elseif($course['status'] == 4): ?>
                    No Action
                  <?php endif; ?>
                </td>
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>
    </div>
  <?php endforeach; ?>
  <?php endif; ?>
</div>
<?php include '../footer.php'; ?>

<script>
  // Function to handle approve/reject action
  function action(registrationID, actionType) {
    let actionMessage = '';
    let actionLabel = '';
    let newStatus = '';
    
    // Determine the action message, action label, and the new status based on the action type
    if (actionType === 'approve') {
      actionMessage = 'Are you sure you want to approve this course?';
      actionLabel = 'Approve';
      newStatus = 'Approved';
    } else if (actionType === 'reject') {
      actionMessage = 'Are you sure you want to reject this course?';
      actionLabel = 'Reject';
      newStatus = 'Rejected';
    }

    // Confirmation prompt
    Swal.fire({
      title: "Attention",
      text: actionMessage,
      icon: "question",
      showCancelButton: true,
      confirmButtonText: 'Yes, ' + actionLabel + '!',
      cancelButtonText: 'Cancel',
      reverseButtons: true
    })
    .then((result) => {
      if (result.isConfirmed) {
        fetch('approve_registration_process.php', {
          method: 'POST',
          body: new URLSearchParams({
            action: actionType,
            registrationID: registrationID
          })
        })
        .then(response => response.json())
        .then(data => {
          if (data.success) {
            // Success: Update the UI
            updateUI(registrationID, actionType);
            Swal.fire({
              title: "Success!",
              text: "The course has been " + newStatus + ".",
              icon: 'success',
              confirmButtonText: 'OK'
            });
          } else {
            Swal.fire({
              title: "Error!",
              text: "There was an error updating the status: " + (data.error || 'Unknown error'),
              icon: 'error',
              confirmButtonText: 'OK'
            });
          }
        })
        .catch(error => {
          Swal.fire({
            title: "Error!",
            text: "There was an error updating the status: " + (error || 'Unknown error'),
            icon: 'error',
            confirmButtonText: 'OK'
          });
        });
      }
    });
  }

  function updateUI(registrationID, actionType) {
    const row = document.getElementById("course-row-" + registrationID);
    const statusElement = document.getElementById("status-" + registrationID);

    if (actionType === 'approve') {
      statusElement.innerHTML = '<span class="badge rounded-pill bg-success">Approved</span>';
      row.querySelector(".btn-success").disabled = true;
      row.querySelector(".btn-danger").disabled = true;
    } else if (actionType === 'reject') {
      statusElement.innerHTML = '<span class="badge rounded-pill bg-danger">Rejected</span>';
      row.querySelector(".btn-success").disabled = true;
      row.querySelector(".btn-danger").disabled = true;
    }
  }
</script>