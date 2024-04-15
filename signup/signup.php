<?php
include('connection.php');

if (isset($_POST['submit'])) {
    $username = mysqli_real_escape_string($con, $_POST['username']);
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $password = mysqli_real_escape_string($con, $_POST['password']);
   

    $user_query = "SELECT * FROM user_list WHERE fullname='$username'";
    $email_query = "SELECT * FROM user_list WHERE username='$email'";

    $user_result = mysqli_query($con, $user_query);
    $email_result = mysqli_query($con, $email_query);

    $count_user = mysqli_num_rows($user_result);
    $count_email = mysqli_num_rows($email_result);

    if ($count_user == 0 && $count_email == 0) {
            //$hash = password_hash($password, PASSWORD_DEFAULT);
            $insert_query = "INSERT INTO user_list(fullname, username, password, type, status) VALUES('$username', '$email', '$password',1,1)";
            $insert_result = mysqli_query($con, $insert_query);

            if ($insert_result) {
                header("Location: index.php");
                exit();
            } else {
                echo "Error: " . mysqli_error($con);
            }
        
    } else {
        if ($count_user > 0) {
            echo '<script>
                    alert("Username already exists!!");
                    window.location.href = "index.php";
                  </script>';
        }
        if ($count_email > 0) {
            echo '<script>
                    alert("Email already exists!!");
                    window.location.href = "index.php";
                  </script>';
        }
    }
}
?>