<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Course Registration System</title>
  <link href="../bootstrap.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.15.2/css/selectize.bootstrap5.min.css" integrity="sha512-Ars0BmSwpsUJnWMw+KoUKGKunT7+T8NGK0ORRKj+HT8naZzLSIQoOSIIM3oyaJljgLxFi0xImI5oZkAWEFARSA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

</head>
<body>
  <nav class="navbar navbar-expand-lg bg-primary" data-bs-theme="dark">
    <div class="container-fluid">
      <a class="navbar-brand" href="../home/home_staff.php">Course Registration System</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarColor01" aria-controls="navbarColor01" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarColor01">
        <ul class="navbar-nav me-auto">
          <li class="nav-item"><a class="nav-link active" href="../course_offer/modify_course.php">Course Offered</a></li>
          <li class="nav-item"><a class="nav-link active" href="../course_list/course_list.php">Course List</a></li>
          <li class="nav-item"><a class="nav-link active" href="../registration_list/registration_list.php">Registration</a></li>
          <li class="nav-item"><a class="nav-link active" href="../register_user/register.php">Register User</a></li>
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

  if ($_SESSION['u_type'] != 3) {
    header('Location: ../login/login.php');
    exit();
  }
  $user_id = $_SESSION['u_id'];
  $sql = "SELECT s.s_no, u.u_name FROM tb_staff s
          LEFT JOIN tb_user u
          ON u.u_id = s.s_id
          WHERE s.s_id = '$user_id'";
  $result = mysqli_query($con, $sql);
  if ($row = mysqli_fetch_assoc($result)) {
    $staff_no = $row['s_no'];
    $staff_name = $row['u_name'];
  }
?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.15.2/js/selectize.min.js" integrity="sha512-IOebNkvA/HZjMM7MxL0NYeLYEalloZ8ckak+NDtOViP7oiYzG5vn6WVXyrJDiJPhl4yRdmNAG49iuLmhkUdVsQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>