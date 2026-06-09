<?php 
  include '../headers/header_staff.php';
  $sql = "SELECT COUNT(*) as count 
          FROM tb_student";
  $result = mysqli_query($con, $sql);
  $row = mysqli_fetch_assoc($result);
  $student_count = $row['count'];

  $sql = "SELECT COUNT(*) as count 
          FROM tb_staff";
  $result = mysqli_query($con, $sql);
  $row = mysqli_fetch_assoc($result);
  $staff_count = $row['count'];

  $sql = "SELECT COUNT(*) as count 
          FROM tb_lecturer";
  $result = mysqli_query($con, $sql);
  $row = mysqli_fetch_assoc($result);
  $lecturer_count = $row['count'];

  $sql = "SELECT COUNT(*) as count 
          FROM tb_course";
  $result = mysqli_query($con, $sql);
  $row = mysqli_fetch_assoc($result);
  $course_count = $row['count'];

  $sql = "SELECT COUNT(*) as count 
          FROM tb_section WHERE s_semester = '$semester'";
  $result = mysqli_query($con, $sql);
  $row = mysqli_fetch_assoc($result);
  $section_count = $row['count'];

  $sql = "SELECT COUNT(*) as count
          FROM tb_registration WHERE r_semester = '$semester'";
  $result = mysqli_query($con, $sql);
  $row = mysqli_fetch_assoc($result);
  $registration_count = $row['count'];
?>

<style>
.container {
  max-width: 1200px;
  margin: 30px auto;
  padding: 20px;
}

h2 {
  color: #333;
  font-size: 2em;
  margin-bottom: 5px;
}

h6 {
  color: #888;
  font-size: 1.2em;
  margin-bottom: 20px;
}

.card {
  border-radius: 10px;
  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
  transition: all 0.3s ease-in-out;
}

.card:hover {
  transform: translateY(-10px);
  box-shadow: 0 6px 16px rgba(0, 0, 0, 0.15);
}

.card-body {
  text-align: center;
  padding: 20px;
}

.card-title {
  font-size: 1.4em;
  color:rgb(64, 108, 155);
  margin-bottom: 10px;
}

.card-text {
  font-size: 1.5em;
  font-weight: bold;
  color: #333;
}

.card.mb-3 {
  margin-bottom: 20px;
}

.card.bg-light {
  background-color: #f8f9fa;
}

/* Responsive Styles */
@media (max-width: 768px) {
  .card {
    max-width: 100%;
    margin: 10px 0;
  }

  .container {
    padding: 10px;
  }
}

</style>

<div class="container">
  <h2>Hi, <?php echo htmlspecialchars($staff_name); ?></h2>
  <h6>Semester <?php echo $semester?></h6>

  <div class="row">
    <div class="col-md-4">
      <div class="card bg-light mb-3">
        <div class="card-body">
          <h4 class="card-title">Number of students</h4>
          <p class="card-text"><?php echo $student_count?></p>
        </div>
      </div>
    </div>

    <div class="col-md-4">
      <div class="card bg-light mb-3">
        <div class="card-body">
          <h4 class="card-title">Number of staffs</h4>
          <p class="card-text"><?php echo $staff_count?></p>
        </div>
      </div>
    </div>

    <div class="col-md-4">
      <div class="card bg-light mb-3">
        <div class="card-body">
          <h4 class="card-title">Number of lecturers</h4>
          <p class="card-text"><?php echo $lecturer_count?></p>
        </div>
      </div>
    </div>
  </div>

  <div class="row">
    <div class="col-md-4">
      <div class="card bg-light mb-3">
        <div class="card-body">
          <h4 class="card-title">Number of courses</h4>
          <p class="card-text"><?php echo $course_count?></p>
        </div>
      </div>
    </div>

    <div class="col-md-4">
      <div class="card bg-light mb-3">
        <div class="card-body">
          <h4 class="card-title">Number of sections</h4>
          <p class="card-text"><?php echo $section_count?></p>
        </div>
      </div>
    </div>

    <div class="col-md-4">
      <div class="card bg-light mb-3">
        <div class="card-body">
          <h4 class="card-title">Number of registrations</h4>
          <p class="card-text"><?php echo $registration_count?></p>
        </div>
      </div>
    </div>
  </div>
  <?php include '../footer.php'; ?>
</div>
