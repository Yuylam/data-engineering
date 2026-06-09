<?php
include '../headers/header_staff.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['courseCode'], $_POST['sectionNo'])) {
    $courseCode = mysqli_real_escape_string($con, $_POST['courseCode']);
    $sectionNo = (int) $_POST['sectionNo'];
    // Get the highest section number to ensure the last section is being deleted
    $sql_max = "SELECT MAX(s_no) AS max_section FROM tb_section WHERE s_course = '$courseCode' AND s_semester = '$semester'";
    $result_max = mysqli_query($con, $sql_max);
    $maxSection = mysqli_fetch_assoc($result_max)['max_section'] ?? 0;

    // Ensure the section being deleted is the last one
    if ($sectionNo == $maxSection) {
        $sql_delete = "DELETE FROM tb_section WHERE s_course = '$courseCode' AND s_no = '$sectionNo' AND s_semester = '$semester'";
        if (mysqli_query($con, $sql_delete)) {
            echo "<script>
                    Swal.fire({
                        title: 'Success',
                        text: 'Section $sectionNo has been deleted.',
                        icon: 'success',
                        confirmButtonText: 'OK'
                    }).then(() => {
                        window.location.href = 'edit_section.php?courseCode=$courseCode';
                    });
                  </script>";
        } else {
            echo "<script>
                    Swal.fire({
                        title: 'Error',
                        text: 'There was an error deleting the section. Please try again.',
                        icon: 'error',
                        confirmButtonText: 'OK'
                    }).then(() => {
                        window.history.back();
                    });
                  </script>";
        }
    } else {
        echo "<script>
                Swal.fire({
                    title: 'Error',
                    text: 'You can only delete the last section.',
                    icon: 'error',
                    confirmButtonText: 'OK'
                }).then(() => {
                    window.history.back();
                });
              </script>";
    }
}
?>
