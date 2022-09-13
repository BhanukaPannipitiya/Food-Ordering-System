<?php include('../config/constants.php'); ?>

<html>

<head>
    <title>Log in-Food order System</title>
    <link rel="stylesheet" href="../css/admin.css">


</head>

<body>
    <div class="login">
        <h1 class="text-center">Login</h1>
        <br></br>
        <?php

        if (isset($_SESSION['login'])) {
            echo $_SESSION['login'];
            unset($_SESSION['login']);
        }

        if (isset($_SESSION['no-login-message'])) {
            echo  $_SESSION['no-login-message'];
            unset($_SESSION['no-login-message']);
        }


        ?>
        <br></br>

        <!-- Login Form starts here -->
        <form action="" method="post" class="text-center">
            Username :<br>
            <input type="text" name="username" placeholder="Enter  Username"><br></br>

            Password: <br>
            <input type="password" name="password" placeholder="Enter Password"><br></br>

            <input type="submit" value="Login" name="submit" class="btn-primary"></input>
            <br></br>

        </form>
        <!-- Login Form ends here -->


    </div>
</body>



</html>

<?php



//Check whether the submit button is clicked or not


if (isset($_POST['submit'])) {
    //process for login 
    //1.Get the data from log in from
    $username = $_POST['username'];
    $password = md5($_POST['password']);

    //2.SQL to check whther the username and password are exists or not
    $sql = "SELECT * FROM tbl_admin WHERE username = '$username' AND password = '$password'";

    //3.execute the querry
    $res = mysqli_query($conn, $sql);

    //4.Count rows to check whether the the user exists or not
    $count = mysqli_num_rows($res);

    if ($count == 1) {
        //user available and login success
        $_SESSION['login'] = "<div class='success'>Login Successful.</div>";
        //$_SESSION['user'] = $username; //to check whether the user logged in or not and logout will unset it
        // Redirect to home page 
        header('location:' . SITEURL . 'Admin/');
    } else {
        //User not available and login failure
        $_SESSION['login'] = "<div class='error text-center'>Username or password didnot match.</div>";
        // Redirect to home page 
        header('location:' . SITEURL . 'Admin/login.php');
    }
}




?> 