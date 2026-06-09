<?php
  include '../crs_session.php';
  include '../db_connect.php';

  $user_id = $_SESSION['u_id'];
  $sql = "SELECT s_no FROM tb_student WHERE s_id = '$user_id'";
  $result = mysqli_query($con, $sql);
  if ($row = mysqli_fetch_assoc($result)) {
    $studentNo = $row['s_no'];
  }
  else {
    header('../login/login.php');
  }

  if (!$studentNo) {
    echo json_encode(['success' => false, 'message' => 'User not logged in']);
    exit;
  }

  if ($_POST['action'] == 'register_course' && isset($_POST['courseCode'], $_POST['sectionNo'], $_POST['semester'])) {
    $courseCode = $_POST['courseCode'];
    $sectionNo = $_POST['sectionNo'];
    $semester = $_POST['semester'];

    $sql_check = "
                SELECT s.s_no, s.s_capacity, COUNT(r.r_section) AS count
                FROM tb_section s
                LEFT JOIN tb_registration r ON s.s_course = r.r_course AND s.s_no = r.r_section AND s.s_semester = r.r_semester
                AND (r.r_status = 1 OR r.r_status = 2 OR r.r_status = 3)
                AND r.r_semester = '$semester'
                WHERE s.s_course = '$courseCode' AND s.s_no = '$sectionNo'";

    $result_check = mysqli_query($con, $sql_check);
    $section_data = mysqli_fetch_assoc($result_check);

    if ($section_data['count'] < $section_data['s_capacity']) {
      // Proceed with registration if there is available space
      $sql = "
        INSERT INTO tb_registration (r_course, r_section, r_student, r_status, r_semester)
        VALUES ('$courseCode', '$sectionNo', '$studentNo', 3, '$semester')";
      
      if (mysqli_query($con, $sql)) {
        echo json_encode(['success' => true]);
      } else {
        echo json_encode(['success' => false, 'message' => 'Failed to register']);
      }
    } else {
      echo json_encode(['success' => false, 'message' => 'No available seats in this section']);
    }
  } else {
    echo json_encode(['success' => false, 'message' => 'Invalid request']);
  }
?>
