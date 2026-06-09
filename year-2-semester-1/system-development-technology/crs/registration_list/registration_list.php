<?php
  include '../headers/header_staff.php';

  $filter_course = $_GET['filter_course'] ?? '';
  $filter_section = $_GET['filter_section'] ?? '';
  $filter_search = $_GET['filter_search'] ?? '';

  $filter_course = mysqli_real_escape_string($con, $filter_course);
  $filter_section = mysqli_real_escape_string($con, $filter_section);
  $filter_search = mysqli_real_escape_string($con, $filter_search);

  $where_sql = "WHERE r.r_semester = '$semester'";
  if (!empty($filter_search)) {
    $where_sql .= " AND (c.c_name LIKE '%$filter_search%' 
      OR c.c_name LIKE '%$filter_search%'
      OR s.s_programme LIKE '%$filter_search%'
      OR r.r_course LIKE '%$filter_search%'
      OR s.s_no LIKE '%$filter_search%'
      OR u.u_name LIKE '%$filter_search%')";
  }
  if (!empty($filter_section)) {
    $where_sql .= " AND r.r_section = '$filter_section'";
  }
  if(!empty($filter_course)) {
    $where_sql .= " AND r.r_course = '$filter_course'";
  }

  $records_per_page = 10;
  $current_page = isset($_GET['page']) ? $_GET['page'] : 1;
  $start_from = ($current_page - 1) * $records_per_page;
  
  $total_sql = "SELECT COUNT(*)
              FROM tb_registration r
              LEFT JOIN tb_student s ON s.s_no = r.r_student
              LEFT JOIN tb_course c ON c.c_code = r.r_course
              LEFT JOIN tb_user u ON u.u_id = s.s_id
              $where_sql";
  $total_result = mysqli_query($con, $total_sql);
  $total_row = mysqli_fetch_row($total_result);
  $total_records = $total_row[0];
  $total_pages = ceil($total_records / $records_per_page);
  
  $sql_registration = "SELECT * FROM tb_registration r
                       LEFT JOIN tb_student s ON s.s_no = r.r_student
                       LEFT JOIN tb_course c ON c.c_code = r.r_course
                       LEFT JOIN tb_user u ON u.u_id = s.s_id
                       $where_sql
                       LIMIT $start_from, $records_per_page;";
  $result_registration = mysqli_query($con, $sql_registration);

?>

<style>
  table td, table th {
    vertical-align: middle;
    text-align: center;
  }
</style>

<div class="container">
  <h2>Registration</h2>
  <h6>Semester <?php echo "$semester"; ?></h6>

  <!-- Search and Filter form -->
  <form class="d-flex justify-content-end mb-3" method="GET" action="">
    <select class="form-select me-2" name="filter_course" id="filter_course">
      <option value="">Select Course</option>
      <?php
        $sql = "SELECT DISTINCT s.s_course, c.c_name FROM tb_section s
                LEFT JOIN tb_course c ON c.c_code = s.s_course";
        $result_course = mysqli_query($con, $sql);
        
        while ($course = mysqli_fetch_assoc($result_course)) {
          $selected = ($filter_course == $course['s_course']) ? 'selected' : '';
          echo "<option value='" . htmlspecialchars($course['s_course']) . "' $selected>" . htmlspecialchars($course['s_course'] . " - " . $course['c_name']) . "</option>";
        }
      ?>
    </select>
    <input class="form-control me-sm-2 w-25" type="search" placeholder="Section" name="filter_section" value="<?= htmlspecialchars($filter_section) ?>">
    <input class="form-control me-sm-2 w-25" type="search" placeholder="Search" name="filter_search" value="<?= htmlspecialchars($filter_search) ?>">
    <button class="btn btn-secondary my-2 my-sm-0" type="submit">Search</button>
  </form>

  <table class="table table-hover">
    <thead>
      <tr>
        <th>Student</th>
        <th>Name</th>
        <th>Course Code</th>
        <th>Course</th>
        <th>Section</th>
        <th>Status</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody>
      <?php while($row = mysqli_fetch_assoc($result_registration)){ ?>
        <tr>
          <td><?php echo $row['r_student']; ?></td>
          <td><?php echo $row['u_name']; ?></td>
          <td><?php echo $row['r_course']; ?></td>
          <td><?php echo $row['c_name']; ?></td>
          <td><?php echo $row['r_section']; ?></td>
          <td>
            <?php if($row['r_status'] == 1): ?>
              <span class="badge rounded-pill bg-secondary">Draft</span>
            <?php elseif($row['r_status'] == 2): ?>
              <span class="badge rounded-pill bg-primary">Submitted</span>
            <?php elseif($row['r_status'] == 3): ?>
              <span class="badge rounded-pill bg-success">Approved</span>
            <?php elseif($row['r_status'] == 4): ?>
              <span class="badge rounded-pill bg-danger">Rejected</span>
            <?php endif; ?>
          </td>
          <td>
            <form method="POST" action="edit_registration.php">
              <input type="hidden" name="registrationID" value="<?php echo $row['r_id']; ?>">
              <button type="submit" class="btn btn-primary"><i class="fa-solid fa-pen-to-square"></i> Edit</button>

              <!-- <button type="submit" class="btn btn-danger"><i class="fa-solid fa-trash"></i> Delete</button> -->
            </form>
          </td>
        </tr>
      <?php } ?>
    </tbody>
  </table>

  <!-- Pagination -->
  <nav>
    <ul class="d-flex justify-content-center pagination pagination-sm">
      <?php if ($current_page > 1) { ?>
        <li class="page-item"><a class="page-link" href="?page=<?= $current_page - 1; ?>&filter_course=<?= urlencode($filter_course); ?>">&laquo;</a></li>
      <?php } ?>

      <?php for ($i = 1; $i <= $total_pages; $i++) { ?>
        <li class="page-item <?= ($i == $current_page) ? 'active' : ''; ?>">
          <a class="page-link" href="?page=<?= $i; ?>&filter_course=<?= urlencode($filter_course); ?>"><?= $i; ?></a>
        </li>
      <?php } ?>

      <?php if ($current_page < $total_pages) { ?>
        <li class="page-item"><a class="page-link" href="?page=<?= $current_page + 1; ?>&filter_course=<?= urlencode($filter_course); ?>">&raquo;</a></li>
      <?php } ?>
    </ul>
  </nav>
</div>
<?php include '../footer.php'; ?>

<script>
  function submitEditForm(registrationID) {
    // Create a new form element
    var form = document.createElement('form');
    form.method = 'POST';
    form.action = 'edit_registration.php'; 

    // Create hidden input for courseCode
    var registrationField = document.createElement('input');
    registrationField.type = 'hidden';
    registrationField.name = 'registrationID';
    registrationField.value = registrationID;
    form.appendChild(registrationField);

    // Append the form to the document body
    document.body.appendChild(form);

    // Submit the form
    form.submit();
  }
</script>

<script>
  $(function(){
    $("#filter_course").selectize();
  }); 
</script>