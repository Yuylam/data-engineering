<?php include '../headers/header_main.php'; ?>

<style>
  body {
    height: 100%;
    margin: 0;
    background-image: url('../img/login_background.jpg');
    background-size: cover; 
    background-position: center;
    background-attachment: fixed;
    display: flex;
    justify-content: center;
    align-items: center;
  }

  html {
    height: 100%;
  }

  .container {
    display: flex; 
    justify-content: center;
    align-items: center; 
    height: 100%;
  }

  .login-box {
    padding: 30px;
    border: 1px solid #ccc;
    border-radius: 8px;
    width: 100%;
    max-width: 400px;
    box-sizing: border-box;
    background-color: rgba(255, 255, 255, 0.8);
  }

</style>

<div class="container">
  <div class="login-box">
    <h2>Forgot Password</h2>
    <form method="POST" action="forgot_password_process.php">
      <div class="form-floating mb-3">
        <input type="text" class="form-control" id="userId" name="userID" placeholder="User ID" required>
        <label for="userId">User ID</label>
      </div>
      <div class="form-floating mb-3">
        <input type="text" class="form-control" id="s_no" name="s_no" placeholder="Matric / Staff Number" autocomplete="off" required>
        <label for="userId">Matric / Staff Number</label>
      </div>
      <div class="form-floating mb-3">
        <input type="text" class="form-control" id="ic" name="ic" placeholder="IC Number" autocomplete="off" required>
        <label for="userId">IC Number</label>
      </div>
      <div style="display: flex; gap: 10px; justify-content: center;">
        <button type="button" class="btn btn-primary" onclick="window.location.href='login.php'"><i class="fa-solid fa-circle-chevron-left"></i> Back</button>
        <button type="submit" class="btn btn-primary"><i class="fa-solid fa-key"></i> Reset Password</button>
      </div>
    </form>
  </div>
</div>
