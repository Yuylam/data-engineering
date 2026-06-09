<?php
  include '../db_connect.php';

  // Check if the necessary data has been sent via POST
  if (isset($_POST['action'], $_POST['registrationID'])) {
    $action = $_POST['action'];
    $registrationID = $_POST['registrationID'];
    
    // Sanitize input (important for security)
    $action = mysqli_real_escape_string($con, $action);
    $registrationID = (int) $registrationID; 
    
    // Prepare the query based on the action
    if ($action === 'approve') {
      $newStatus = 3; 
    } elseif ($action === 'reject') {
      $newStatus = 4;
    } else {
      echo json_encode(['success' => false, 'error' => 'Invalid action']);
      exit;
    }
    
    // Update the registration status in the database
    $sql = "UPDATE tb_registration SET r_status = $newStatus WHERE r_id = $registrationID";
    
    if (mysqli_query($con, $sql)) {
      echo json_encode(['success' => true]);
    } else {
      echo json_encode(['success' => false, 'error' => mysqli_error($con)]);
    }
  } else {
    // Missing data
    echo json_encode(['success' => false, 'error' => 'Missing data']);
  }

  mysqli_close($con);

?>
