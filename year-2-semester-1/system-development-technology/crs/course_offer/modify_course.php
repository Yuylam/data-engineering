<?php
  include '../headers/header_staff.php';

  $sql = "SELECT c.c_code, c.c_name , COUNT(s.s_no) AS count
          FROM tb_section s
          LEFT JOIN tb_course c
          ON c.c_code = s.s_course
          WHERE s.s_semester = '$semester'
          GROUP BY c.c_code, c.c_name";

  $result = mysqli_query($con, $sql);
?>

<style>
  table td, table th {
    vertical-align: middle;
    text-align: center;
  }
</style>

<div class="container">
  <h2>Courses for Registration</h2>
  <h6>Semester <?php echo "$semester"; ?></h6>
  <table class="table table-hover">
    <thead>
      <tr>
        <th>Course Code</th>
        <th>Course Name</th>
        <th>Number of Sections</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody>
      <?php while($course = mysqli_fetch_assoc($result)) { ?>
        <tr id="course-row-<?php echo $course['c_code']; ?>">
          <td><?php echo $course['c_code']; ?></td>
          <td><?php echo $course['c_name']; ?></td>
          <td><?php echo $course['count']; ?></td>
          <td>
            <button type="button" class="btn btn-primary"  onclick="submitEditForm('<?php echo $course['c_code']; ?>', '<?php echo $semester; ?>')"><i class="fa-solid fa-pen-to-square"></i> Edit</button>
            <button type="button" class="btn btn-danger" onclick="deleteCourse('<?php echo $course['c_code']; ?>', '<?php echo $semester; ?>')"><i class="fa-solid fa-trash"></i> Delete</button>
          </td>
        </tr>
      <?php } ?>
    </tbody>
  </table>
  <div class="d-flex justify-content-center">
    <button type="button" class="btn btn-primary" onclick="window.location.href='add_section.php'"><i class="fa-solid fa-plus"></i> Add Course</button>
  </div>
  <?php include '../footer.php'; ?>
</div>

<script>
  function submitEditForm(courseCode, semester) {
    // Create a new form element
    var form = document.createElement('form');
    form.method = 'POST';
    form.action = 'edit_section.php'; // Target page

    // Create hidden input for courseCode
    var courseCodeField = document.createElement('input');
    courseCodeField.type = 'hidden';
    courseCodeField.name = 'courseCode';
    courseCodeField.value = courseCode; // Set value to courseCode
    form.appendChild(courseCodeField);

    // Create hidden input for semester
    var semesterField = document.createElement('input');
    semesterField.type = 'hidden';
    semesterField.name = 'semester';
    semesterField.value = semester; // Set value to semester
    form.appendChild(semesterField);

    // Append the form to the document body
    document.body.appendChild(form);

    // Submit the form
    form.submit();
  }

  function deleteCourse(courseCode, semester) {
    Swal.fire({
      title: "Attention",
      text: "Are you sure to delete this course?",
      icon: "question",
      showCancelButton: true,
      confirmButtonText: 'Yes, Delete!',
      cancelButtonText: 'Cancel',
      reverseButtons: true
    })
    .then((result) => {
      if (result.isConfirmed) {
        fetch('delete_course.php', {
          method: 'POST',
          headers: {
            'Content-Type': 'application/x-www-form-urlencoded'
          },
          body: new URLSearchParams({
            'courseCode': courseCode,
            'semester': semester
          })
        })
        .then(response => response.json())
        .then(data => {
          if (data.success) {
            // Successfully deleted, remove the course row from the table
            Swal.fire({
              title: "Success!",
              text: "The course has been deleted.",
              icon: 'success',
              confirmButtonText: 'OK'
            });

            // Remove the course row from the table
            document.getElementById('course-row-' + courseCode).remove();
          } else {
            Swal.fire({
              title: "Error!",
              text: data.error || 'There was an error deleting the course.',
              icon: 'error',
              confirmButtonText: 'OK'
            });
          }
        })
        .catch(error => {
          Swal.fire({
            title: "Error!",
            text: "There was an error processing your request.",
            icon: 'error',
            confirmButtonText: 'OK'
          });
        });
      }
    });
  }
</script>