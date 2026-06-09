<?php
  include '../headers/header_student.php';
?>

<div class="container">
  <h2>Reset Password</h2>
  <form method="POST" action="reset_password_process.php">
    <div>
      <label class="col-form-label mt-4" for="inputDefault">Current Password</label>
      <input type="password" class="form-control" id="inputDefault" name="currentPassword">
    </div>
    <div>
      <label class="col-form-label mt-4" for="inputDefault">New Password</label>
      <input type="password" class="form-control" id="inputDefault" name="newPassword">
    </div>
    <div>
      <label class="col-form-label mt-4" for="inputDefault">Confirm Password</label>
      <input type="password" class="form-control" id="inputDefault" name="confirmPassword">
    </div>
    <br>
    <div class="d-flex justify-content-center">
      <button type="submit" class="btn btn-primary"><i class="fa-solid fa-lock"></i> Reset Password</button>
    </div>
</form>
</div>

<?php include '../footer.php'; ?>