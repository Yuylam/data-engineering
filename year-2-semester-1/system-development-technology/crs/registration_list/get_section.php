<?php
  include '../db_connect.php';

  if (!isset($_GET['course_code']) || empty($_GET['course_code'])) {
    echo json_encode([]);
    exit;
  }

  $course_code = mysqli_real_escape_string($con, $_GET['course_code']);

  $sql = "SELECT s_no FROM tb_section WHERE s_course = '$course_code' AND s_semester = '$semester'";
  $result = mysqli_query($con, $sql);

  $sections = [];
  while ($row = mysqli_fetch_assoc($result)) {
      $sections[] = $row['s_no'];
  }

  header('Content-Type: application/json');
  echo json_encode($sections);
?>
