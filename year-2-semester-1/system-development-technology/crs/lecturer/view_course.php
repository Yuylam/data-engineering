<?php
  include '../headers/header_lecturer.php';
  
  $sql = "SELECT * FROM tb_section s
          LEFT JOIN tb_course c
          ON c.c_code = s.s_course
          WHERE s.s_lecturer = '$lecturer_no'";
  $result = mysqli_query($con, $sql);
  $courses_by_semester = [];

  while ($course = mysqli_fetch_assoc($result)) {
    $semester = $course['s_semester'];
    if (!isset($courses_by_semester[$semester])) {
      $courses_by_semester[$semester] = [];
    }
    $courses_by_semester[$semester][] = $course;
  }
?>

<div class="container">
  <h2>Courses</h2>
  <?php if (count($courses_by_semester) == 0): ?>
    <p>No course assigned.</p>
  <?php else: ?>

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
            <th>Section</th>
            <th>Students</th>
          </thead>
          <tbody>
            <?php foreach ($courses as $course): ?>
              <tr>
                <td><?php echo $course['s_course']; ?></td>
                <td><?php echo $course['c_name']; ?></td>
                <td><?php echo $course['s_no']; ?></td>
                <td><a href="view_student.php?semester=<?php echo $semester; ?>&course_code=<?php echo $course['s_course']; ?>&section=<?php echo $course['s_no']; ?>"><i class="fa-solid fa-circle-info"></i></a></td>
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
