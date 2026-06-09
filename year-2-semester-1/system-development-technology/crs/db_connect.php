<?php
// Set DB Parameter
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "db_crs1";

// Connect DB
$con = mysqli_connect($servername, $username, $password, $dbname);
mysqli_set_charset($con, "utf8mb4");

// Connection Check (continue as indivual project)
if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
  }

  // Semester Calculation
  $currentYear = date("Y");
  $currentMonth = date("m");

  if ($currentMonth >= 9) {
    $semester = $currentYear . '/' . ($currentYear + 1) . '-1';
  } 
  elseif ($currentMonth <= 1) {
    $semester = ($currentYear - 1) . '/' . $currentYear . '-1';
  } 
  elseif ($currentMonth >= 2 && $currentMonth <= 6) {
      $semester = ($currentYear - 1) . '/' . $currentYear . '-2';
  } 
  elseif ($currentMonth >= 7 && $currentMonth <= 8) {
      $semester = ($currentYear - 1) . '/' . $currentYear . '-3';
  }
?>