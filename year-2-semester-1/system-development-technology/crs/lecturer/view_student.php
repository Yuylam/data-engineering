<?php
  include '../headers/header_lecturer.php';

  $course_code = $_GET['course_code']; 
  $section = $_GET['section']; 
  $semester = $_GET['semester'];
  
  $sql = "SELECT * FROM tb_registration r
          LEFT JOIN tb_student s
          ON r.r_student = s.s_no
          LEFT JOIN tb_user u
          ON u.u_id = s.s_id
          WHERE r.r_course = '$course_code'
          AND r.r_section = '$section'
          AND r.r_semester = '$semester'
          ORDER BY u.u_name ASC";
  $result = mysqli_query($con, $sql);

  $sql_course = "SELECT * FROM tb_course c
              LEFT JOIN tb_lecturer l
              ON l.l_no = c.c_coordinator
              LEFT JOIN tb_user u
              ON u.u_id = l.l_id
              LEFT JOIN tb_department d
              ON d.d_id = c.c_department
              WHERE c_code = '$course_code'";
  $result_course = mysqli_query($con, $sql_course);
  $course = mysqli_fetch_assoc($result_course);
?>

<div class="container">
  <h2>Students</h2>
  <div class="card">
    <div class="card-body">
      <h4 class="card-title"><?php echo $course_code . " " . $course['c_name']; ?></h4>
      <table class="table table-hover">
        <tr>
          <td>Credit</td>
          <td><?php echo $course['c_credit']; ?></td>
        </tr>
        <tr>
          <td>Coordinator</td>
          <td><?php echo $course['c_coordinator']; ?> <?php echo $course['u_name']; ?></td>
        </tr>
        <tr>
          <td>Department</td>
          <td><?php echo $course['d_name']; ?></td>
        </tr>
      </table>
    </div>
  </div>
  <table class="table table-hover">
    <thead>
      <tr>
        <th>Student Name</th>
        <th>Matric Number</th>
        <th>Intake</th>
      </tr>
    </thead>
    <tbody>
      <?php while ($student = mysqli_fetch_assoc($result)) { ?>
        <tr>
          <td><?php echo $student['u_name']; ?></td>
          <td><?php echo $student['s_no']; ?></td>
          <td><?php echo $student['s_intake']; ?></td>
        </tr>
      <?php } ?>
    </tbody>
  </table>
</div>
<?php include '../footer.php'; ?>