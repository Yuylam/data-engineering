<?php
  include '../headers/header_lecturer.php';
  $sql = "SELECT * FROM tb_section s
          LEFT JOIN tb_course c
          ON c.c_code = s.s_course
          WHERE s.s_lecturer = '$lecturer_no'
          AND s.s_semester = '$semester'";
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
  <h2>Hi, <?php echo htmlspecialchars($lecturer_name); ?></h2>
  <h6>Semester <?php echo $semester?></h6>

  <div class="card mb-3">
      <div class="card-header text-white bg-primary d-flex justify-content-between align-items-center">
        Semester <?php echo $semester; ?>
      </div>
      <div class="card-body">
      <?php if(mysqli_num_rows($result) == 0): ?>
        <p>No course assigned for this semester.</p>
        <?php else: ?>
        <table class="table table-hover">
          <thead>
            <th>Course Code</th>
            <th>Course</th>
            <th>Credit</th>
            <th>Section</th>
          </thead>
          <tbody>
            <?php while($course = mysqli_fetch_assoc($result)) { ?>
              <tr>
                <td><?php echo htmlspecialchars($course['s_course']); ?></td>
                <td><?php echo htmlspecialchars($course['c_name']); ?></td>
                <td><?php echo htmlspecialchars($course['c_credit']); ?></td>
                <td><?php echo htmlspecialchars($course['s_no']); ?></td>
              </tr>
            <?php } ?>
          </tbody>
        </table>
        
        <?php endif; ?>
      </div>
    </div>
  </div>

<?php include '../footer.php'; ?>
</div>