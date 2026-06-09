<?php 
include '../headers/header_main.php';

echo "<script>
    Swal.fire({
        title: 'Password Example',
        html: 'Your password is in the format: First letter of your name + Last letter of your name + Last 4 digits of your IC.<br>Name: <strong>Ali bin Abu</strong><br>IC: <strong>121212-12-1234</strong><br>Password: <strong>AU1234</strong>',
        icon: 'info',
        confirmButtonText: 'OK'
    }).then(function() {
        window.location.href = 'login.php';
    });
</script>";

?>