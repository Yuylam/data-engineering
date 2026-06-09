<?php
  include '../headers/header_student.php';

  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $status = 3;

    // Check if courses are provided in the form
    if (isset($_POST['courses']) && is_array($_POST['courses']) && count($_POST['courses']) > 0) {
        
        $anyCourseAdded = false;

        foreach ($_POST['courses'] as $index => $courseCode) {
            $section = $_POST['sections'][$index];

            if (!empty($courseCode) && !empty($section)) {
                $sql = "INSERT INTO tb_registration (r_course, r_student, r_section, r_semester, r_status) 
                        VALUES ('$courseCode', '$student_no', '$section', '$semester', '$status')";

                if (!mysqli_query($con, $sql)) {
                    $errorMsg = mysqli_error($con); 
                    echo "<script>
                        Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'Error registering courses: $errorMsg',
                        confirmButtonText: 'OK'
                        }).then(() => {
                        window.location.href = 'register_course.php';
                        });
                    </script>";
                    exit;
                } else {
                    $anyCourseAdded = true;
                }
            }
        }

        if ($anyCourseAdded) {
            echo "<script>
                    Swal.fire({
                    icon: 'success',
                    title: 'Success!',
                    text: 'Courses successfully registered!',
                    confirmButtonText: 'OK'
                    }).then(() => {
                    window.location.href = 'register_course.php';
                    });
                </script>";
        } else {
            echo "<script>
                    Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Please ensure all fields are filled before submitting.',
                    confirmButtonText: 'OK'
                    }).then(() => {
                    window.location.href = 'register_course.php';
                    });
                </script>";
        }
    } else {
        echo "<script>
                Swal.fire({
                icon: 'error',
                title: 'No Courses Selected',
                text: 'Please add at least one course to proceed.',
                confirmButtonText: 'OK'
                }).then(() => {
                window.location.href = 'register_course.php';
                });
            </script>";
    }
  }
?>
