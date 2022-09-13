<?php
        //Include constants .php file here 
        include('../config/constants.php');
        //get id of admin to be deleted
        $id =$_GET['id'];
        // create a querry to delete admin
        $sql = "DELETE FROM tbl_admin WHERE id = $id";
        //execute the querry
        $res = mysqli_query($conn ,$sql);
        //check whether the querry executed successfully
        if($res == true)
       {
                //echo "Admin Deleted";
                $_SESSION['delete'] = "<div class='success'>Admin Deleted Successfully</div>";
                //redirect
                header('location:'.SITEURL.'Admin/manage-admin.php');
                
       }
       else{
                //echo "Failed to delete admin";
                $_SESSION['delete'] = "<div class='error'>Failed to delete admin.</div>";
                //redirect
                header('location:'.SITEURL.'Admin/manage-admin.php');

       }
        
        //redirect to manage admin pg message(success/fail)
?>