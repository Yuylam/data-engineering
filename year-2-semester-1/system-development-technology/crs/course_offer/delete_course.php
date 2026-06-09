<?php
  include '../db_connect.php';


  if (isset($_POST['courseCode']) && isset($_POST['semester'])) {
    $courseCode = mysqli_real_escape_string($con, $_POST['courseCode']);
    $semester = mysqli_real_escape_string($con, $_POST['semester']);
    
    // Start a transaction to ensure data consistency
    mysqli_begin_transaction($con);
    
    try {
      // $sql_check = "SELECT COUNT(*) as course_count FROM tb_section WHERE s_course = '$courseCode' AND s_semester = '$semester'";
      // $result_check = mysqli_query($con, $sql_check);
      // $row_check = mysqli_fetch_assoc($result_check);
      
      // if ($row_check['course_count'] == 0) {
      //     echo json_encode(['success' => false, 'error' => 'Course not found in the given semester']);
      //     exit;
      // }

      $sql_delete = "DELETE FROM tb_section WHERE s_course = '$courseCode' AND s_semester = '$semester'";
      if (mysqli_query($con, $sql_delete)) {
          mysqli_commit($con);
          echo json_encode(['success' => true]);
      } else {
          mysqli_rollback($con);
          echo json_encode(['success' => false, 'error' => 'Failed to delete the course']);
      }
    } catch (Exception $e) {
      mysqli_rollback($con);
      echo json_encode(['success' => false, 'error' => $e->getMessage()]);
    }
  } else {
    echo json_encode(['success' => false, 'error' => 'Invalid request']);
  }
  mysqli_close($con);
?>
