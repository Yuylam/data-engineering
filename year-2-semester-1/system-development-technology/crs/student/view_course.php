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
          AND r.r_status = 3";

  $result = mysqli_query($con, $sql);
  $courses_by_semester = [];

  // Group courses by semester
  while ($course = mysqli_fetch_assoc($result)) {
    $semester = $course['s_semester'];
    if (!isset($courses_by_semester[$semester])) {
      $courses_by_semester[$semester] = [];
    }
    $courses_by_semester[$semester][] = $course;
  }
?>

<div class="container">
  <h2>Registered Courses</h2>

  <?php foreach ($courses_by_semester as $semester => $courses): ?>
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
            <!-- <th>Semester</th> -->
          </thead>
          <tbody>
            <?php foreach ($courses as $course): ?>
              <tr>
                <td><?php echo $course['s_course']; ?></td>
                <td><?php echo $course['c_name']; ?></td>
                <td><?php echo $course['c_credit']; ?></td>
                <td><?php echo $course['s_no']; ?></td>
                <td><?php echo $course['u_name']; ?></td>
                <!-- <td><?php echo $course['r_semester']; ?></td> -->
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>
    </div>
  <?php endforeach; ?>
</div>

<?php include '../footer.php'; ?>