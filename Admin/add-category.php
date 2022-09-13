<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Add Category</h1>

        <br><br>

        <?php

        if (isset($_SESSION['add'])) {
            echo $_SESSION['add'];
            unset($_SESSION['add']);
        }

        if (isset($_SESSION['upload'])) {
            echo $_SESSION['upload'];
            unset($_SESSION['upload']);
        }



        ?>

        <br><br>

        <!-- Add Category form starts-->

        <form action="" method="POST" enctype="multipart/form-data">

            <table class="tbl-30">
                <tr>
                    <td>Title: </td>
                    <td>
                        <input type="text" name="title" placeholder="Category Title">
                    </td>
                </tr>
                <tr>
                    <td>Select Image: </td>
                    <td>
                        <input type="file" name="image">
                    </td>
                </tr>
                <tr>
                    <td>Featured: </td>
                    <td>
                        <input type="radio" name="featured" value="Yes">Yes
                        <input type="radio" name="featured" value="No">No
                    </td>
                </tr>

                <tr>
                    <td>Active: </td>
                    <td>
                        <input type="radio" name="active" value="Yes"> Yes
                        <input type="radio" name="active" value="No"> No
                    </td>

                </tr>
                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Add Category" class="btn-secondary">
                    </td>
                </tr>
            </table>
        </form>


        <!-- Add Category form ends-->

        <?php

        //Check whther the submit button is clicked or not
        if (isset($_POST['submit'])) {
            //1.Get the value from category form
            $title = $_POST['title'];

            //for radio input type we need to check whther the  button is selected or not
            if (isset($_POST['featured'])) {
                //Get the value from form
                $featured = $_POST['featured'];
            } else {
                //set the default value
                $featured = "No";
            }
            if (isset($_POST['active'])) {
                $active = $_POST['active'];
            } else {
                $active = "No";
            }

            //Check whether the image is selected or not and set the value for image name accordingly
            //print_r($_FILES['image']);

            //die(); //break the code here

            if (isset($_FILES['image']['name'])) {
                //upload the image
                //To upload the image we need image name and source path and destination path
                $image_name = $_FILES['image']['name'];

                //Auto rename the image
                //Get the extension of image (jpg,png,gif,etc...) e.g "food1.jpg"
                $ext = end(explode('.', $image_name));

                //Rename the image 
                $image_name = "Food_Category".rand(000, 999).'.'.$ext; //e.g. Food_Category_834.jpg

                $source_path = $_FILES['image']['tmp_name'];

                $destination_path = "../images/category/" . $image_name;

                //Finally upload the image
                $upload = move_uploaded_file($source_path, $destination_path);

                //check whther the image uploaded or not
                //and if the image is not uploaded then we will stop the process and redirect with error msg
                if ($upload == false) {
                    //set message
                    $_SESSION['upload'] = "<div class= 'error'> Failed to upload image.</div>";
                    //redirect to add categort page
                    header('location:'.SITEURL.'Admin/add-category.php');
                    //Stop the process
                    die();
                }
            } else {
                //Dont upload the image and set the image name value as blank
                $image_name = "";
            }

            //2.Create  SQL querry to insert category into database
            $sql = "INSERT INTO tbl_catogary SET
            title = '$title',
            image_name = '$image_name',
            featured = '$featured',
            active = '$active'
            ";

            //3.Execute the query and save in database
            $res = mysqli_query($conn, $sql);

            //4.Check whther the query is executed or not and data added or not
            if ($res == true) {
                //Query executed and category added
                $_SESSION['add'] = "<div class='success'> Category Added Successfully.</div>";
                // Redirect to Manage cateogry page
                header('location:' . SITEURL . 'Admin/manage-category.php');
            } else {
                //failed to add category
                $_SESSION['add'] = "<div class='error'>Failed to add category.</div>";
                // Redirect to Manage cateogry page
                header('location:' . SITEURL . 'Admin/add-category.php');
            }
        }
        ?>



    </div>
</div>

