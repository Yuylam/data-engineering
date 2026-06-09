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

  .forgot-password {
    display: block;
    text-align: center;
    margin-top: 10px;
    margin-bottom: 10px;
    font-size: 14px;
  }

  .forgot-password a {
    color: #007bff;
    text-decoration: none;
  }

  .forgot-password a:hover {
    color: #0056b3;
    text-decoration: underline;
  }
</style>

<div class="container">
  <div class="login-box">
    <h2>Course Registration System</h2>
    <h2>Login</h2>
    <form method="POST" action="login_process.php">
      <div class="form-floating mb-3">
        <input type="text" class="form-control" id="userId" name="f_userId" placeholder="User ID" required>
        <label for="userId">User ID</label>
      </div>
      <div class="form-floating mb-3">
        <input type="password" class="form-control" id="password" name="f_password" placeholder="Password" autocomplete="off" required>
        <label for="password">Password</label>
      </div>
      <div class="forgot-password">
        <a href="forgot_password.php">Forgot Password?</a>
      </div>
      <div class="d-flex justify-content-center">
        <button type="submit" class="btn btn-primary">Login</button>
      </div>
      <div class="forgot-password">
        <p>Not a user? Contact your administrator to register to the system.</p>
      </div>
      <div class="forgot-password">
        <p>First time user? <a href="reset_password_example.php">Password info</a> for first-time user.</p>
      </div>
    </form>
  </div>
</div>
