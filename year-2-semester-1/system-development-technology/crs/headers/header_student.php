<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Course Registration System</title>
  <link href="../bootstrap.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
  <nav class="navbar navbar-expand-lg bg-primary" data-bs-theme="dark">
    <div class="container-fluid">
      <a class="navbar-brand" href="../home/home_student.php">Course Registration</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarColor01" aria-controls="navbarColor01" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarColor01">
        <ul class="navbar-nav me-auto">
          <li class="nav-item"><a class="nav-link" href="../student/view_course.php">Courses</a></li>
          <li class="nav-item"><a class="nav-link" href="../student/register_course.php">Register</a></li>
          <li class="nav-item"><a class="nav-link" href="../student/profile.php">Profile</a></li>
        </ul>
      </div>
      <a href="../login/logout.php" class="btn btn-dark d-flex">Logout</a>
    </div>
  </nav>
  <style>
  body {
    background-color: #f4f7fc;
  }
</style>
<?php
  include '../crs_session.php';
  include '../db_connect.php';

  if(!session_id()){
    session_start();
  }

  if ($_SESSION['u_type'] != 1) {
    header('Location: ../login/login.php');
    exit();
  }
  $user_id = $_SESSION['u_id'];
  $sql = "SELECT s.s_no, u.u_name FROM tb_student s
          LEFT JOIN tb_user u
          ON u.u_id = s.s_id
          WHERE s.s_id = '$user_id'";
  $result = mysqli_query($con, $sql);
  if ($row = mysqli_fetch_assoc($result)) {
    $student_no = $row['s_no'];
    $student_name = $row['u_name'];
  }
  else {
    header('../login/login.php');
  }

?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>