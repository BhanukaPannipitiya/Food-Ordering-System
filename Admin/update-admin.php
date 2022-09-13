<?php include('partials/menu.php')?>
<div class="main-content">
    <div class="wrapper">
        <h1>Update Admin</h1>
        <br><br>
        <?php
            $id =$_GET['id'];

            $sql = "SELECT *FROM tbl_admin";

            $res=mysqli_query($conn,$sql);

            if($res== true)
            {
                $count =mysqli_num_rows($res);
                if($count==1)
                {
                    //echo "Admin available";
                    $row=mysqli_fetch_assoc($res);

                    $full_name = $row['full_name'];
                    $username =$row['username'];
                }
                else
                {
                   header('location:'.SITEURL.'Admin/manage-admin.php'); 
                }
            }


        ?>

        <form action="" method="POST">
            <table class="tbl-30">
                <tr>
                    <td>Full Name:</td>
                    <td>
                        <input type="text" name="full_name" value="<?php echo $full_name;?>">
                    </td>
                </tr>
                <tr>
                    <td>Username</td>
                    <td>
                        <input type="text" name="username" value="<?php echo $username;?>">
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="hidden" name="id" value="<?php echo $id;?>">
                        <input type="submit" name="submit" value="Update" class="btn-secondary">
                    </td>
                </tr>
            </table>


        </form>
    </div>
</div>
<?php
    //check whether the submit btn is clicked or not
    if(isset($_POST['submit']))
    {
        //echo "Button Clicked";
        //get all the values from form to update
        $id = $_POST['id'];
        $full_name = $_POST['full_name'];
        $username = $_POST['username'];

        $sql = "UPDATE tbl_admin SET
        full_name ='$full_name',
        username = '$username'
        where id ='$id'";
        $res = mysqli_query($conn,$sql);
        if($res == true)
        {

            $_SESSION['update'] = "<div class='success'>Admin Updated Successfully</div>";
            header('location:'.SITEURL.'Admin/manage-admin.php');
        }
        else
        {
            $_SESSION['update'] = "<div class='error'>Failed to delete admin</div>";
            header('location:'.SITEURL.'Admin/manage-admin.php');
        }
    }
?>

<?php include('partials/footer.php')?>

