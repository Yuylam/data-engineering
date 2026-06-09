<?php
  include '../headers/header_student.php';

  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $studentNo = mysqli_real_escape_string($con, $_POST['studentNo']);

    // Check if courses are provided in the form
    if (isset($_POST['courses']) && is_array($_POST['courses']) && count($_POST['courses']) > 0) {
        $anyCourseAdded = false;
        foreach ($_POST['courses'] as $index => $courseCode) {
            $section = $_POST['sections'][$index];

            if (!empty($courseCode) && !empty($section)) {
                $sql_check_existing = "
                    SELECT COUNT(*) AS already_registered
                    FROM tb_registration
                    WHERE r_student = '$studentNo' 
                      AND r_course = '$courseCode' 
                      AND r_section = '$section' 
                      AND r_semester = '$semester'";

                $result_check_existing = mysqli_query($con, $sql_check_existing);
                $data_check_existing = mysqli_fetch_assoc($result_check_existing);

                if ($data_check_existing['already_registered'] > 0) {
                    echo "<script>
                            Swal.fire({
                                icon: 'error',
                                title: 'Already Registered',
                                text: 'You are already registered for this course and section.',
                                confirmButtonText: 'OK'
                            }).then(() => {
                                window.location.href = 'student_registration.php';
                            });
                          </script>";
                    exit;
                }

                $sql_check = "
                    SELECT s.s_no, s.s_capacity, COUNT(r.r_section) AS count
                    FROM tb_section s
                    LEFT JOIN tb_registration r ON s.s_course = r.r_course AND s.s_no = r.r_section AND s.s_semester = r.r_semester
                    AND (r.r_status = 1 OR r.r_status = 2 OR r.r_status = 3)
                    AND r.r_semester = '$semester'
                    WHERE s.s_course = '$courseCode' AND s.s_no = '$section'";

                $result_check = mysqli_query($con, $sql_check);
                $section_data = mysqli_fetch_assoc($result_check);

                if ($section_data['count'] < $section_data['s_capacity']) {
                    $sql = "INSERT INTO tb_registration (r_course, r_student, r_section, r_semester, r_status) 
                            VALUES ('$courseCode', '$studentNo', '$section', '$semester', '$status')";

                    if (!mysqli_query($con, $sql)) {
                        $errorMsg = mysqli_error($con); 
                        echo "<script>
                                Swal.fire({
                                icon: 'error',
                                title: 'Error',
                                text: 'Error registering courses: $errorMsg',
                                confirmButtonText: 'OK'
                                }).then(() => {
                                window.location.href = 'student_registration.php';
                                });
                            </script>";
                        exit;
                    } else {
                        $anyCourseAdded = true;
                    }
                }
                else{
                  echo "<script>
                                Swal.fire({
                                icon: 'error',
                                title: 'Error',
                                text: 'No seats left!',
                                confirmButtonText: 'OK'
                                }).then(() => {
                                window.location.href = 'student_registration.php';
                                });
                            </script>";
                };
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
                    window.location.href = 'student_registration.php';
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
                    window.location.href = 'student_registration.php';
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
                window.location.href = 'student_registration.php';
                });
            </script>";
    }
  }
?>
