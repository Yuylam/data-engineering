<?php
  include '../headers/header_student.php'; 

  // Get the filter parameter from GET request
  $filter_course = $_GET['filter_course'] ?? '';
  $where_sql = "WHERE s.s_semester = '$semester'";

  if (!empty($filter_course)){
    $where_sql .= " AND (c.c_name LIKE '%$filter_course%' OR c.c_code LIKE '%$filter_course%')";
  }

  // Pagination
  $records_per_page = 10;
  $current_page = isset($_GET['page']) ? $_GET['page'] : 1;
  $start_from = ($current_page - 1) * $records_per_page;

  // Get total number of records
  $total_sql = "SELECT COUNT(DISTINCT c_code) FROM tb_section s
                INNER JOIN tb_course c ON s.s_course = c.c_code
                $where_sql;";
  $total_result = mysqli_query($con, $total_sql);
  $total_row = mysqli_fetch_row($total_result);
  $total_records = $total_row[0];
  $total_pages = ceil($total_records / $records_per_page);

  $sql_course = "SELECT DISTINCT c.c_code, c.c_name, c.c_credit 
                 FROM tb_section s
                 INNER JOIN tb_course c ON s.s_course = c.c_code
                 $where_sql
                 LIMIT $start_from, $records_per_page;";
  $result_course = mysqli_query($con, $sql_course);  
?>

<style>
  table td, table th {
    vertical-align: middle;
    text-align: center;
  }
</style>

<div class="container">
  <h2>Course List</h2>
  
  <!-- Search form -->
  <form class="d-flex justify-content-end mb-3" method="GET" action="">
    <input class="form-control me-sm-2 w-25" type="search" placeholder="Search" name="filter_course" value="<?= $filter_course ?>">
    <button class="btn btn-secondary my-2 my-sm-0" type="submit">Search</button>
  </form>
  
  <br>
  
  <!-- Accordion displaying courses -->
  <div class="accordion" id="accordionExample">
    <?php while ($course = mysqli_fetch_assoc($result_course)) { ?>
      <div class="accordion-item">
        <?php
          $course_code = $course['c_code'];
          $sql_check = "SELECT COUNT(*) FROM tb_registration
            WHERE r_student = '$student_no'
            AND r_course = '$course_code'
            AND r_semester = '$semester'
            AND  r_status IN (1, 2, 3);";
          $result_check = mysqli_query($con, $sql_check);
          $check_row = mysqli_fetch_row($result_check);
          $is_registered = $check_row[0] > 0;
        ?>
        <h2 class="accordion-header" id="heading-<?php echo $course['c_code']; ?>">
          <div class="d-flex justify-content-between w-100">
            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-<?php echo $course['c_code']; ?>" aria-expanded="false" aria-controls="collapse-<?php echo $course['c_code']; ?>">
              <?php echo $course['c_code'] . " " . $course['c_name']; ?>
              <?php if ($is_registered): ?>
                <span class="badge rounded-pill bg-success ms-3">Registered</span>
              <?php endif; ?>
            </button>
          </div>
        </h2>
        <div id="collapse-<?php echo $course['c_code']; ?>" class="accordion-collapse collapse" aria-labelledby="heading-<?php echo $course['c_code']; ?>" data-bs-parent="#accordionExample">
          <div class="accordion-body">
            <?php
              $sql_section = "
                SELECT s.s_no, s.s_capacity, COUNT(r.r_section) AS count
                FROM tb_section s
                LEFT JOIN tb_registration r ON s.s_course = r.r_course AND s.s_no = r.r_section
                AND (r.r_status = 1 OR r.r_status = 2 OR r.r_status = 3)
                AND r.r_semester = '$semester'
                WHERE s.s_course = '$course_code' AND s.s_semester = '$semester'
                GROUP BY s.s_course, s.s_no
                ORDER BY s.s_no ASC;";
              $result_section = mysqli_query($con, $sql_section);
            ?>
            <p>Credit Hour: <?php echo $course['c_credit'] ?></p>
            <table class="table table-hover">
              <thead>
                <tr>
                  <th>Section</th>
                  <th>Capacity</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                <?php while($section = mysqli_fetch_assoc($result_section)) { ?>
                  <tr>
                    <td><?php echo $section['s_no']; ?></td>
                    <td><?php echo $section['count'] . "/" . $section['s_capacity']; ?></td>
                    <td>
                      <?php if ($is_registered): ?>
                        <button class="btn btn-secondary" disabled>Registered</button>
                      <?php else: ?>
                        <button class="btn btn-primary register-btn" 
                          data-course="<?php echo $course['c_code']; ?>"
                          data-section="<?php echo $section['s_no']; ?>"
                          data-semester="<?php echo $semester; ?>"
                          onclick="registerCourse('<?php echo $course['c_code']; ?>', <?php echo $section['s_no']; ?>, '<?php echo $semester; ?>')">
                          Register
                        </button>
                      <?php endif; ?>
                    </td>
                  </tr>
                <?php } ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    <?php } ?>
  </div>
  <br>
  <!-- Pagination links -->
  <nav>
    <ul class="d-flex justify-content-center pagination pagination-sm">
      <?php if($current_page > 1): ?>
        <li class="page-item">
          <a class="page-link" href="?page=<?= $current_page - 1; ?>&filter_course=<?= $filter_course; ?>">&laquo;</a>
        </li>
      <?php endif; ?>

      <?php for($i = 1; $i <= $total_pages; $i++): ?>
        <li class="page-item <?= ($i == $current_page) ? 'active' : ''; ?>">
          <a class="page-link" href="?page=<?= $i; ?>&filter_course=<?= $filter_course; ?>"><?= $i; ?></a>
        </li>
      <?php endfor; ?>

      <?php if($current_page < $total_pages): ?>
        <li class="page-item">
          <a class="page-link" href="?page=<?= $current_page + 1; ?>&filter_course=<?= $filter_course; ?>">&raquo;</a>
        </li>
      <?php endif; ?>
    </ul>
  </nav>
</div>

<script>
  function registerCourse(courseCode, sectionNo, semester){
    console.log('Register button clicked for Course:', courseCode, 'Section:', sectionNo, 'Semester:', semester);  // Debug log
    
    fetch('browse_course_process.php', {
      method: 'POST',
      body: new URLSearchParams({
        action: 'register_course',
        courseCode: courseCode,
        sectionNo: sectionNo,
        semester: semester
      })
    })
    .then(res => res.json())
    .then(data => {
      console.log(data); 
      if (data.success) {
        Swal.fire({
          icon: 'success',
          title: 'Success!',
          text: 'You have successfully registered for the course.',
          confirmButtonText: 'OK'
        }).then(() => {
          location.reload();
        });
      } else {
        Swal.fire({
          icon: 'error',
          title: 'Registration Failed',
          text: 'Registration failed: ' + data.message,
          confirmButtonText: 'OK'
        });
      }
    })
    .catch(error => {
      Swal.fire({
        icon: 'error',
        title: 'An error occurred',
        text: 'Error: ' + error.message,
        confirmButtonText: 'OK'
      });
    });
  }
</script>


<?php include '../footer.php'; ?>