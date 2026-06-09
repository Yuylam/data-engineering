<?php
  include '../headers/header_student.php';
  $sql = "SELECT * 
          FROM tb_registration r
          LEFT JOIN tb_course c
          ON c.c_code = r.r_course
          LEFT JOIN tb_section s
          ON s.s_course = r.r_course AND s.s_no = r.r_section AND s.s_semester = r.r_semester
          LEFT JOIN tb_lecturer l
          ON l.l_no = s.s_lecturer
          LEFT JOIN tb_user u
          ON u.u_id = l.l_id
          WHERE r.r_student = '$student_no'
          AND r.r_status = 3
          AND r.r_semester = '$semester'";

  $result = mysqli_query($con, $sql);
?>
<style>
  h2 {
    color: #333;
    font-size: 2em;
    margin-bottom: 5px;
  }

  h6 {
    color: #888;
    font-size: 1.2em;
    margin-bottom: 20px;
  }
</style>

<div class="container">
  <h2>Hi, <?php echo htmlspecialchars($student_name); ?></h2>
  <h6>Semester <?php echo $semester?></h6>

    <div class="card mb-3">
      <div class="card-header text-white bg-primary d-flex justify-content-between align-items-center">
        Semester <?php echo $semester; ?>
      </div>
      <div class="card-body">
        <table class="table table-hover">
          <thead>
            <th>Course Code</th>
            <th>Course</th>
            <th>Credit</th>
            <th>Section</th>
            <th>Lecturer</th>
          </thead>
          <tbody>
            <?php while($course = mysqli_fetch_assoc($result)) { ?>
              <tr>
                <td><?php echo htmlspecialchars($course['s_course']); ?></td>
                <td><?php echo htmlspecialchars($course['c_name']); ?></td>
                <td><?php echo htmlspecialchars($course['c_credit']); ?></td>
                <td><?php echo htmlspecialchars($course['s_no']); ?></td>
                <td><?php echo htmlspecialchars($course['u_name']); ?></td>
              </tr>
            <?php } ?>
          </tbody>
        </table>
      </div>
    </div>
</div>

<?php include '../footer.php'; ?>