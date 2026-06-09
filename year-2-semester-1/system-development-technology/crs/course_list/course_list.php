<?php
  include '../headers/header_staff.php';

  $records_per_page = 10;
  $current_page = isset($_GET['page']) ? $_GET['page'] : 1;
  $start_from = ($current_page - 1) * $records_per_page;

  $filter_course = isset($_GET['filter_course']) ? mysqli_real_escape_string($con, $_GET['filter_course']) : '';
  $filter_department = isset($_GET['filter_department']) ? mysqli_real_escape_string($con, $_GET['filter_department']) : '';

  $where_sql = "WHERE 1 = 1";
  $params = [];
  if (!empty($filter_course)) {
    $where_sql .= " AND (c.c_name LIKE ? OR c.c_code LIKE ?)";
    $params[] = "%$filter_course%";
    $params[] = "%$filter_course%";
  }
  if (!empty($filter_department)) {
    $where_sql .= " AND c.c_department = ?";
    $params[] = $filter_department;
  }

  $sql = "SELECT c.c_code, c.c_name, c.c_credit, d.d_name, u.u_name
          FROM tb_course c
          LEFT JOIN tb_department d ON c.c_department = d.d_id
          LEFT JOIN tb_lecturer l ON l.l_no = c.c_coordinator
          LEFT JOIN tb_user u ON u.u_id = l.l_id
          $where_sql
          LIMIT ?, ?";
  $stmt = mysqli_prepare($con, $sql);

  $params[] = $start_from;
  $params[] = $records_per_page;

  mysqli_stmt_bind_param($stmt, str_repeat('s', count($params) - 2) . 'ii', ...$params);
  mysqli_stmt_execute($stmt);
  $result = mysqli_stmt_get_result($stmt);

  $total_sql = "SELECT COUNT(*) 
                FROM tb_course c
                LEFT JOIN tb_department d ON c.c_department = d.d_id
                LEFT JOIN tb_lecturer l ON l.l_no = c.c_coordinator
                LEFT JOIN tb_user u ON u.u_id = l.l_id
                $where_sql;";
  $total_stmt = mysqli_prepare($con, $total_sql);
  mysqli_stmt_bind_param($total_stmt, str_repeat('s', count($params) - 2), ...$params);
  mysqli_stmt_execute($total_stmt);
  $total_result = mysqli_stmt_get_result($total_stmt);
  $total_row = mysqli_fetch_row($total_result);
  $total_records = $total_row[0];
  $total_pages = ceil($total_records / $records_per_page);
?>

<style>
  table td, table th {
    vertical-align: middle;
    text-align: center;
  }
</style>

<div class="container">
  <h2>Course List</h2>

  <!-- Search and Filter form -->
  <form class="d-flex justify-content-end mb-3" method="GET" action="">
    <select name="filter_department" class="form-select me-2" style="width: 300px;">
      <option value="">Select Department</option>
      <?php
        $sql_department = "SELECT * FROM tb_department";
        $department_result = mysqli_query($con, $sql_department);
        while ($department = mysqli_fetch_assoc($department_result)) {
          $selected = (isset($_GET['filter_department']) && $_GET['filter_department'] == $department['d_id']) ? 'selected' : '';
          echo "<option value='{$department['d_id']}' $selected>{$department['d_name']}</option>";
        }
      ?>
    </select>
    <input class="form-control me-sm-2 w-25" type="search" placeholder="Search" name="filter_course" value="<?= $filter_course ?>">
    <button class="btn btn-secondary my-2 my-sm-0" type="submit">Search</button>
  </form>

  <table class="table table-hover">
    <thead>
      <tr>
        <th>Course Code</th>
        <th>Course</th>
        <th>Credit</th>
        <th>Department</th>
        <th>Coordinator</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody>
      <?php while ($row = mysqli_fetch_assoc($result)) { ?>
        <tr>
          <td><?php echo $row['c_code']; ?></td>
          <td><?php echo $row['c_name']; ?></td>
          <td><?php echo $row['c_credit']; ?></td>
          <td><?php echo $row['d_name']; ?></td>
          <td><?php echo $row['u_name']; ?></td>
          <td><button type="button" class="btn btn-primary"  onclick="submitEditForm('<?php echo $row['c_code']; ?>')"><i class="fa-solid fa-pen-to-square"></i> Edit</button></td>
        </tr>
      <?php } ?>
    </tbody>
  </table>

  <div class="d-flex justify-content-center">
    <button type="button" class="btn btn-primary" onclick="window.location.href='add_course.php'"><i class="fa-solid fa-plus"></i> Add Course</button>
  </div>
  <br>

  <!-- Pagination links -->
  <nav>
    <ul class="d-flex justify-content-center pagination pagination-sm">
      <?php if ($current_page > 1): ?>
        <li class="page-item">
          <a class="page-link" href="?page=<?= $current_page - 1; ?>&filter_course=<?= urlencode($filter_course); ?>&filter_department=<?= urlencode($filter_department); ?>">&laquo;</a>
        </li>
      <?php endif; ?>

      <?php for ($i = 1; $i <= $total_pages; $i++): ?>
        <li class="page-item <?= ($i == $current_page) ? 'active' : ''; ?>">
          <a class="page-link" href="?page=<?= $i; ?>&filter_course=<?= urlencode($filter_course); ?>&filter_department=<?= urlencode($filter_department); ?>"><?= $i; ?></a>
        </li>
      <?php endfor; ?>

      <?php if ($current_page < $total_pages): ?>
        <li class="page-item">
          <a class="page-link" href="?page=<?= $current_page + 1; ?>&filter_course=<?= urlencode($filter_course); ?>&filter_department=<?= urlencode($filter_department); ?>">&raquo;</a>
        </li>
      <?php endif; ?>
    </ul>
  </nav>
  <?php include '../footer.php'; ?>
</div>

<script>
  function submitEditForm(courseCode) {
    // Create a new form element
    var form = document.createElement('form');
    form.method = 'POST';
    form.action = 'edit_course.php'; 

    // Create hidden input for courseCode
    var courseCodeField = document.createElement('input');
    courseCodeField.type = 'hidden';
    courseCodeField.name = 'courseCode';
    courseCodeField.value = courseCode;
    form.appendChild(courseCodeField);

    // Append the form to the document body
    document.body.appendChild(form);

    // Submit the form
    form.submit();
  }
</script>
