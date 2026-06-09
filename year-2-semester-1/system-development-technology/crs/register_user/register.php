<?php
  include '../headers/header_staff.php'; 
?>

<div class="container">
    <h2>Register New User</h2>
    
    <form action="register_process.php" method="POST">
        <!-- User Information Fields -->
        <div class="form-group">
            <label for="name">Full Name</label>
            <input type="text" class="form-control" id="name" name="name" required>
        </div>
        <br>
        <div class="form-group">
            <label for="name">User ID</label>
            <input type="text" class="form-control" id="uid" name="uid" required>
        </div>
        <br>
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" class="form-control" id="email" name="email" required>
        </div>
        <br>
        <div class="form-group">
            <label for="ic">IC Number</label>
            <input type="text" class="form-control" id="ic" name="ic" required
            pattern="\d{6}-\d{2}-\d{4}" 
            title="IC Number must follow the format of XXXXXX-XX-XXXX">
        </div>
        <br>
        <div class="form-group">
            <label for="contact">Contact Number</label>
            <input type="text" class="form-control" id="contact" name="contact" required>
        </div>
        <br>
        <div class="form-group">
            <label for="address1">Address</label>
            <input type="text" class="form-control" id="address1" name="address1" required>
            <input type="text" class="form-control" id="address2" name="address2">
        </div>
        <br>
        <div class="row g-3">
          <div class="col-md-6">
              <label class="form-label">City</label>
              <input type="text" class="form-control" name="city" 
                pattern="[A-Za-z\s]+" 
                required>
          </div>
          <div class="col-md-4">
              <label class="form-label">State</label>
              <select class="form-select" name="state" id="state" required>
                <option value="">Select State</option>
                <?php
                  $sql = "SELECT * FROM tb_state";
                  $result_state = mysqli_query($con, $sql);
                  
                  while ($state = mysqli_fetch_array($result_state)) {
                    echo "<option value='" . $state['s_id'] . "'>" . $state['s_desc'] . "</option>";
                  }
                ?>
              </select>
          </div>
          <div class="col-md-2">
              <label class="form-label">Postcode</label>
              <input type="text" class="form-control" name="postcode" 
                pattern="\d{5}" 
                title="Please enter the correct postcode format" required>
          </div>
        </div>
        <br>
        <div class="form-group">
            <label for="utype">User Type</label>
            <select name="utype" id="utype" class="form-control" required>
                <option value="">Select User Type</option>
                <option value="1">Student</option>
                <option value="3">Staff</option>
                <option value="2">Lecturer</option>
            </select>
        </div>
        <br>
        <!-- Student-specific fields -->
        <div id="studentFields" style="display:none;">
            <div class="form-group">
                <label for="s_no">Matric Number</label>
                <input type="text" class="form-control" id="s_no" name="st_no">
            </div>
            <br>
            <div class="form-group">
                <label for="s_programme">Programme</label>
                <select name="s_programme" id="s_programme" class="form-control">
                    <?php 
                      $sql = "SELECT * FROM tb_programme";
                      $result_programme = mysqli_query($con, $sql);
                      while ($row = mysqli_fetch_assoc($result_programme)) { ?>
                        <option value="<?= $row['p_code'] ?>"><?= $row['p_name'] ?></option>
                    <?php } ?>
                </select>
            </div>
            <br>
            <div>
                <label for="s_advisor">Advisor</label>
                <select class="form-select me-2 lecturer-select" id="s_advisor" name="s_advisor">
                  <option value=''>Choose Advisor</option>
                  <?php
                    $sql = "SELECT * FROM tb_lecturer l
                            LEFT JOIN tb_user u ON u.u_id = l.l_id;";
                    $result_lecturer = mysqli_query($con, $sql);
                    while ($lecturer = mysqli_fetch_array($result_lecturer)) {
                      echo "<option value='" . $lecturer['l_no'] . "'>" . $lecturer['l_no'] . " - " . $lecturer['u_name'] . "</option>";
                    }
                  ?>
                </select>
            </div>
            <br>
            <div class="form-group">
                <label for="s_faculty">Faculty</label>
                <select name="s_faculty" id="s_faculty" class="form-control">
                <option value=''>Choose Faculty</option>
                    <?php 
                      $sql = "SELECT * FROM tb_faculty";
                      $result_faculty = mysqli_query($con, $sql);
                      while ($row = mysqli_fetch_assoc($result_faculty)) { ?>
                        <option value="<?= $row['f_id'] ?>"><?= $row['f_desc'] ?></option>
                    <?php } ?>
                </select>
            </div>
        </div>

        <!-- Staff-specific fields -->
        <div id="staffFields" style="display:none;">
            <div class="form-group">
                <label for="s_no">Staff Number</label>
                <input type="text" class="form-control" id="s_no" name="s_no">
            </div>
        </div>

        <!-- Lecturer-specific fields -->
        <div id="lecturerFields" style="display:none;">
            <div class="form-group">
                <label for="l_no">Staff Number</label>
                <input type="text" class="form-control" id="l_no" name="l_no">
            </div>
            <br>
            <div>
              <label class="col-form-label mt-4" for="inputDefault">Department</label>
              <select class="form-select me-2" name="l_department" id="l_department">
                <option value=''>Choose Department</option>
                <?php
                  $sql = "SELECT * FROM tb_department";
                  $result_department = mysqli_query($con, $sql);
                  
                  while ($department = mysqli_fetch_array($result_department)) {
                    $selected = (isset($course['c_department']) && $course['c_department'] == $department['d_id']) ? 'selected' : '';
                    echo "<option value='" . $department['d_id'] . "' $selected>" . $department['d_name'] . "</option>";
                  }
                ?>
              </select>
            </div>
            <br>
            <div class="form-group">
                <label for="l_faculty">Faculty</label>
                <select name="l_faculty" id="l_faculty" class="form-control">
                <option value=''>Choose Faculty</option>
                    <?php 
                      $sql = "SELECT * FROM tb_faculty";
                      $result_faculty = mysqli_query($con, $sql);
                      while ($row = mysqli_fetch_assoc($result_faculty)) { ?>
                        <option value="<?= $row['f_id'] ?>"><?= $row['f_desc'] ?></option>
                    <?php } ?>
                </select>
            </div>
        </div>
        <br>
        <div class="d-flex justify-content-center">
          <button type="submit" class="btn btn-primary">Register User</button>
        </div>
    </form>
</div>
<?php include '../footer.php'; ?>

<script>
  document.getElementById('utype').addEventListener('change', function() {
      var userType = this.value;

      document.getElementById('studentFields').style.display = 'none';
      document.getElementById('staffFields').style.display = 'none';
      document.getElementById('lecturerFields').style.display = 'none';

      if (userType == '1') {
          document.getElementById('studentFields').style.display = 'block';
      } else if (userType == '3') {
          document.getElementById('staffFields').style.display = 'block';
      } else if (userType == '2') {
          document.getElementById('lecturerFields').style.display = 'block';
      }
  });

</script>

<script>
  $(function(){
    $("#l_faculty").selectize();
    $("#l_department").selectize();
    $("#s_programme").selectize();
    $("#s_advisor").selectize();
    $("#s_faculty").selectize();
    $("#state").selectize();
  }); 
</script>
