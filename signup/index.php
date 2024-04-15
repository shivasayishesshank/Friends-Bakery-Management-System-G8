<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LOGIN | Friends Bakery Management System</title>
    <link rel="stylesheet" href="./css/bootstrap.min.css">
    <script src="./js/jquery-3.6.0.min.js"></script>
    <script src="./js/popper.min.js"></script>
    <script src="./js/bootstrap.min.js"></script>
    <script src="./js/script.js"></script>
    <style>
        html, body{
            height:100%;
        }
        body{
            background-image:url('wallpaper.jfif') !important;
            background-size:cover;
            background-repeat:no-repeat;
            background-position:center center;
            color: white; /* Set text color to white */
        }
        h1#sys_title {
            font-size: 6em;
            text-align : center;
            text-shadow: 6px 6px 10px #000000;
            margin-bottom: 40px; /* Added space below the title */
        }
        
        .signup-form {
            max-width: 350px;
            margin: 0 auto; /* Center the form horizontally */
        }
        .signup-form header {
            margin-bottom: 15px; /* Added space below the header */
        }
        .field {
            margin-bottom: 15px; /* Added space between form fields */
        }
        .form-control {
            background-color: transparent; /* Set background color of form controls to transparent */
            color: white; /* Set text color of form controls to white */
            border: none; /* Remove border */
            border-bottom: 1px solid white; /* Add underline effect */
            height: 45px; /* Increase field height */
            width: calc(70% - 30px); /* Set width with space for label */
            margin-left: 10px; /* Add space between label and input box */
        }
        .form-control:focus {
            outline: none; /* Remove outline on focus */
            border-bottom: 1px solid green; /* Change underline color on focus */
        }
        .links {
            margin-top: 20px; /* Added space between form and link */
            text-align: center;
        }
        .btn-register {
            background-color: green; /* Set register button color to green */
            color: white; /* Set text color of register button to white */
            border: none; /* Remove button border */
            width: 100%; /* Set button width to 100% */
            height: 50px; /* Increase button height */
        }
        .header1 {
        font-size: 8em; /* Adjust the font size as needed */
        }

    </style>
</head>
<body class="">
   <div class="h-100 d-flex justify-content-center align-items-center">
       <div class='w-100'>
        <h1 class="py-5 text-center text-light px-4" id="sys_title">Friends Bakery Management System</h1>
        <div class="card my-3 signup-form">
            <div class="card-body">
                <?php
                include("signup.php"); 

                if(isset($_POST['submit'])){
                    $username = $_POST['username'];
                    $email = $_POST['email'];
                    $password = $_POST['password'];

                    // Escape variables for security
                    $username = mysqli_real_escape_string($con, $username);
                    $email = mysqli_real_escape_string($con, $email);
                    $password = mysqli_real_escape_string($con, $password);

                    // Check if email already exists
                    $verify_query = mysqli_query($con,"SELECT username FROM user_list WHERE username='$email'");
                    
                    if(mysqli_num_rows($verify_query) != 0 ){
                        echo "<div class='message'>
                                <p>This email is already in use. Please try another one.</p>
                            </div> <br>";
                        echo "<a href='javascript:self.history.back()'><button class='btn'>Go Back</button>";
                    } else {
                        // Insert new user into database
                        $insert_query = "INSERT INTO user_list (fullname, username, password, type, status) VALUES ('$username', '$email', '$password', 2, 1)";
                        if(mysqli_query($con, $insert_query)){
                            echo "<div class='message'>
                                    <p>Registration successful!</p>
                                </div> <br>";
                            echo "<a href='index.php'><button class='btn'>Login Now</button>";
                        } else {
                            echo "Error: " . $insert_query . "<br>" . mysqli_error($con);
                        }
                    }
                }
                ?>
                <center> <header1>Sign Up Form</header1> </center>
                <form action="" method="post">
                    <div class="field input">
                        <label for="username">Username</label>
                        <input type="text" name="username" id="username" class="form-control" autocomplete="off" required>
                    </div>

                    <div class="field input">
                        <label for="email">Email</label>
                        <input type="text" name="email" id="email" class="form-control" autocomplete="off" required>
                    </div>
                    <div class="field input">
                        <label for="password">Password</label>
                        <input type="password" name="password" id="password" class="form-control" autocomplete="off" required>
                    </div>

                    <div class="field">
                        <input type="submit" class="btn btn-register" name="submit" value="Signup" required>
                    </div>
                    <div class="links">
                        <p>Already a member? <a href="http://localhost/bsms/login.php">Sign In</a></p>
                    </div>
                </form>
            </div>
        </div>
      </div>
</body>
</html>
