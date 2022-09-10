<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Add Admin</h1>
        <br> <br>

        <?php
           if(isset($_SESSION['add']))
           {
                echo$_SESSION['add'];
                unset($_SESSION['add']);
           } 
        ?>
        <form action="" method="POST">
            <table class="tbl-30">
                <tr>
                    <td>Full Name</td>
                    <td><input type="text" name="full_name" placeholder="Enter your name"></td>
                </tr>
                <tr>
                    <td>Username</td>
                    <td><input type="text" name="username" placeholder="Enter your username"></td>
                </tr>
                <tr>
                    <td>Password</td>
                    <td><input type="password" name="password" placeholder="Enter your password"></td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Add Admin" class="btn-secondary">
                    </td>
                </tr>
            </table>
        </form>
    </div>
</div>

<?php include('partials/footer.php'); ?>


<?php
//process the value from form and save it in Database
//check whether the submit button is clicked or not

if (isset($_POST['submit'])) {
    //Button Clicked
    //echo "Button Clicked";

    //get data from form
    $full_name = $_POST['full_name'];
    $username = $_POST['username'];
    $password = md5($_POST['password']); //password encrypted with md5

    //sql querry to save data into database
    $sql = "INSERT INTO tbl_admin SET full_name ='$full_name',username = '$username',password = '$password'";

    //saving data to db
    $res =mysqli_query($conn ,$sql) ;

    //chech whether the data is inserted or not and display appropriate msg
    if($res ==  True)
    {
        //echo "Data inserted";
        //create a session variable to display msg
        $_SESSION['add'] = "Admin added successfully";
        //redirect page
        header("location:".SITEURL.'Admin/manage-admin.php');
    }
    else{
        //echo "Failed to insert data";
        $_SESSION['add'] = "Failed to Add admin";
        //redirect page
        header("location:".SITEURL.'Admin/add-admin.php');
    }
}

?>