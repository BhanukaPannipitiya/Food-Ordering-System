<?php

//include constants filr
include("../config/constants.php");

//echo "Delete Page";
//Check whther the id and image_name value is set or not
if (isset($_GET['id']) and  isset($_GET['image_name'])) {
    //Get the value and delete
    //echo "Get value and Delete";
    $id = $_GET['id'];
    $image_name = $_GET['image_name'];

    //Remove the physical image file is available
    if ($image_name != "") {
        //image is available.so remove it
        $path = "../images/category/" . $image_name;
        //Remove the image
        $remove = unlink($path);

        //if failed to remove image then add an error message and stop the process
        if ($remove == false) {
            //set the sessio message
            $_SESSION['remove'] = "<div class='error'>Failed to remove category image.</div>";
            //Redirect to manage category page
            header('location:' . SITEURL . 'admin/manage-category.php');

            //stop the process
            die();
        }
    }

    //delete data from database
    //sql query to delete data from database
    $sql = "DELETE FROM tbl_category where id = $id";

    //execute the sql query
    $res = mysqli_query($conn, $sql);

    //check whther the data is delete from database or not
    if ($res == true) {
        //set success message and redirect
        $_SESSION['delete'] = "<div class='success'>Category deleted Successfully</div>";
        //redirect to manage category page
        header('location:' . SITEURL . 'admin/manage-category.php');
    } else {
        //set fail message and redirect 
        $_SESSION['delete'] = "<div class='error'> failed to delete category.</div>";
        //redirect to manage category page
        header('location:' . SITEURL . 'admin/manage-category.php');
    }

    //Redirect to manage categorypage with message
} else {
    //redirect to Manage category page
    header('location:' . SITEURL . 'admin/manage-category.php');
}
