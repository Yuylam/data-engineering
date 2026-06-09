<?php
  include '../headers/header_staff.php'; 

  // Check if form data is submitted
  if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $uid = mysqli_real_escape_string($con, $_POST['uid']);
    $name = mysqli_real_escape_string($con, $_POST['name']);
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $ic = mysqli_real_escape_string($con, $_POST['ic']);
    $contact = mysqli_real_escape_string($con, $_POST['contact']);
    $address1 = mysqli_real_escape_string($con, $_POST['address1']);
    $address2 = mysqli_real_escape_string($con, $_POST['address2']);
    $city = mysqli_real_escape_string($con, $_POST['city']);
    $postcode = mysqli_real_escape_string($con, $_POST['postcode']);
    $state = mysqli_real_escape_string($con, $_POST['state']);
    $utype = mysqli_real_escape_string($con, $_POST['utype']); // User type (student, staff, or lecturer)

    if (empty($name) || empty($uid) || empty($email) || empty($ic) || empty($contact) || empty($utype)) {
        echo "<script>
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'All fields are required!',
                }).then(function() {
                    window.location.href = 'register.php';
                });
              </script>";
        exit();
    }

    // Default Password
    $nameParts = explode(" ", $name);
    $firstLetter = strtoupper(substr($nameParts[0], 0, 1));
    $lastLetter = strtoupper(substr($nameParts[count($nameParts) - 1], -1));
    $icDigits = substr($ic, -4);
    $newPassword = $firstLetter . $lastLetter . $icDigits;
    $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);

    $sql_insert_user = "INSERT INTO tb_user (u_id, u_password, u_type, u_name, u_ic, u_email, u_contact, u_address1, u_address2, u_city, u_postcode, u_state) 
                      VALUES ('$uid', '$hashedPassword', '$utype', '$name', '$ic', '$email', '$contact', '$address1', '$address2', '$city', '$postcode', '$state')";
    
    if (mysqli_query($con, $sql_insert_user)) {
        if ($utype == 1) { // Student
            $s_no = mysqli_real_escape_string($con, $_POST['st_no']);
            $s_programme = mysqli_real_escape_string($con, $_POST['s_programme']);
            $s_advisor = mysqli_real_escape_string($con, $_POST['s_advisor']);
            $s_faculty = mysqli_real_escape_string($con, $_POST['s_faculty']);
            
            // Insert into tb_student
            $sql_insert_student = "INSERT INTO tb_student (s_id, s_no, s_programme, s_intake, s_advisor, s_faculty) 
                                 VALUES ('$uid', '$s_no', '$s_programme', '$semester', '$s_advisor', '$s_faculty')";
            mysqli_query($con, $sql_insert_student);
        }
        elseif ($utype == 3) {
            $s_no = mysqli_real_escape_string($con, $_POST['s_no']);
            
            $sql_insert_staff = "INSERT INTO tb_staff (s_id, s_no) 
                               VALUES ('$uid', '$s_no')";
            mysqli_query($con, $sql_insert_staff);
        }
        elseif ($utype == 2) {
            $l_no = mysqli_real_escape_string($con, $_POST['l_no']);
            $l_department = mysqli_real_escape_string($con, $_POST['l_department']);
            $l_faculty = mysqli_real_escape_string($con, $_POST['l_faculty']);
            
            $sql_insert_lecturer = "INSERT INTO tb_lecturer (l_id, l_no, l_department, l_faculty) 
                                  VALUES ('$uid', '$l_no', '$l_department', '$l_faculty')";
            mysqli_query($con, $sql_insert_lecturer);
        }
        
        // Success Message
        echo "<script>
                Swal.fire({
                    icon: 'success',
                    title: 'Registration successful!',
                }).then(function() {
                    window.location.href = 'register.php';
                });
              </script>";
    } else {
        // Error handling if user registration fails
        echo "<script>
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Error registering user. Please try again later.',
                }).then(function() {
                    window.location.href = 'register.php';
                });
              </script>";
    }
} else {
    header("Location: register.php");
    exit();
}

// Close the database connection
mysqli_close($con);
?>
