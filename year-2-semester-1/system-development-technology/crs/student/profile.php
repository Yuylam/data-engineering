<?php
  include '../headers/header_student.php';

  $sql = "SELECT * FROM tb_user u
          LEFT JOIN tb_student s
          ON u.u_id = s.s_id
          WHERE u.u_id = '$user_id'";
  $result = mysqli_query($con, $sql);
  $student = mysqli_fetch_assoc($result);

?>

<div class="container">
  <h2>Profile</h2>
  <form method="POST" action="profile_process.php">
    <div>
        <label class="form-label" for="disabledInput">Name</label>
        <input class="form-control" id="disabledInput" type="text" placeholder="<?php echo $student['u_name']?>" disabled="">
    </div>
    <br>
    <div>
        <label class="form-label" for="disabledInput">Matric Number</label>
        <input class="form-control" id="disabledInput" type="text" placeholder="<?php echo $student['s_no']?>" disabled="">
    </div>
    <br>
    <div>
        <label class="form-label" for="disabledInput">IC Number</label>
        <input class="form-control" id="disabledInput" type="text" placeholder="<?php echo $student['u_ic']?>" disabled="">
    </div>
    <div>
      <label class="col-form-label mt-4" for="inputDefault">Email address</label>
      <input type="email" class="form-control" id="inputDefault" name="email" value="<?php echo $student['u_email']?>">
    </div>
    <div>
      <label class="col-form-label mt-4" for="inputDefault">Contact Number</label>
      <input type="text" class="form-control" id="inputDefault" name="contact" value="<?php echo $student['u_contact']?>">
    </div>
    <div>
      <label class="col-form-label mt-4" for="inputDefault">Address</label>
      <input type="text" class="form-control" id="inputDefault" name="address1" value="<?php echo $student['u_address1']?>">
      <input type="text" class="form-control" id="inputDefault" name="address2" value="<?php echo $student['u_address2']?>">
    </div>
    <br>
    <div class="row g-3">
      <div class="col-md-6">
          <label class="form-label">City</label>
          <input type="text" class="form-control" name="city" 
            value="<?php echo $student['u_city']; ?>" 
            pattern="[A-Za-z\s]+" 
            required>
      </div>
      <div class="col-md-4">
          <label class="form-label">State</label>
          <select class="form-select" name="state" id="state" required>
            <?php
              $sql = "SELECT * FROM tb_state";
              $result_state = mysqli_query($con, $sql);
              
              while ($state = mysqli_fetch_array($result_state)) {
                $selected = (isset($student['u_state']) && $student['u_state'] == $state['s_id']) ? 'selected' : '';
                echo "<option value='" . $state['s_id'] . "' $selected>" . $state['s_desc'] . "</option>";
              }
            ?>
          </select>
      </div>
      <div class="col-md-2">
          <label class="form-label">Postcode</label>
          <input type="text" class="form-control" name="postcode" 
            value="<?php echo $student['u_postcode']; ?>" 
            pattern="\d{5}" 
            title="Please enter the correct postcode format" required>
      </div>
    </div>
    <br>

    <div style="display: flex; gap: 10px; justify-content: center;">
        <button type="button" class="btn btn-primary" onclick="window.location.href='reset_password.php'"><i class="fa-solid fa-key"></i> Reset Password</button>
        <button type="save" class="btn btn-success"><i class="fa-solid fa-floppy-disk"></i> Save</button>
    </div>
  </form>
</div>

<script>
  $(function(){
    $("#state").selectize();
  }); 
</script>

<?php include '../footer.php'; ?>