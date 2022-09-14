<?php include('partials/menu.php'); ?>
<div class="main-content">
    <div class="wrapper">
        <h1>Add Food</h1>
        <br> <br>
        <?php
        if (isset($_SESSION['upload'])) {
            echo $_SESSION['upload'];
            unset($_SESSION['upload']);
        }
        

        ?>
        <form action="" method="POST" enctype="multipart/form-data">
            <table class="tbl-30">
                <tr>
                    <td>Title</td>
                    <td>
                        <input type="text" name="title" placeholder="Title of the Food">
                    </td>
                </tr>
                <tr>
                    <td>Description</td>
                    <td>
                        <textarea name="descripton" cols="30" rows="5" placeholder="Description of the food"></textarea>
                    </td>
                </tr>
                <tr>
                    <td>Price</td>
                    <td>
                        <input type="number" name="price">
                    </td>
                </tr>
                <tr>
                    <td>Select Image</td>
                    <td>
                        <input type="file" name="image">
                    </td>
                </tr>
                <tr>
                    <td>Category</td>
                    <td>
                        <select name="category">
                            <?php 
                                //create php code to display catogaries from database
                                $sql = "SELECT * FROM tbl_catogary WHERE active='Yes'";

                                $res = mysqli_query($conn ,$sql);

                                $count = mysqli_num_rows($res);

                                if($count>0)
                                {
                                    while($row = mysqli_fetch_assoc($res))
                                    {
                                        $id = $row['id'];
                                        $title = $row['title'];
                                        ?>

                                        <?php
                                    }
                                }
                                else
                                {
                                    ?>
                                    <option value="<?php echo $id; ?>"><?php echo $title ?> </option>

                                    <?php
                                }


                            ?>
                            
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>Featured</td>
                    <td>
                        <input type="radio" name="active" value="yes">yes
                        <input type="radio" name="active" value="no">No
                    </td>
                </tr>
                <tr>
                    <td>Active:</td>
                    <td>
                        <input type="radio" name="featured" value="yes">yes
                        <input type="radio" name="featured" value="no">No
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Add Food" class="btn-secondary">
                    </td>
                </tr>

            </table>
        </form>

        <?php
            //check whether the btn is clicked
            if (isset($_POST['submit'])) {
                ;
                $title = $_POST['title'];
                $description =$_POST['description']; 
                $price =$_POST['price']; 
                $category=$_POST['category']; 

                if(isset($_POST['featured']))
                {
                    $featured = $_POST['featured'];

                }
                else
                {
                    $featured = "No";
                }

                if(isset($_POST['active']))
                {
                    $active = $_POST['active'];
                }
                else
                {
                    $active = "No";
                }

                if (isset($_FILES['image']['name']))
                {
                    $image_name = $_FILES['image']['name'];
                    if($image_name ="")
                    {
                        $ext =end(explode('.',$image_name));

                        $image_name = "Food-name".rand(0000,9999).".".$ext;

                        $src =$_FILES['image']['tmp_name'];

                        $dst = "/images".$image_name;

                        $upload = move_uploaded_file($src , $dst);

                        if($upload == false)
                        {
                            $_SESSION['upload'] = "<div class= 'error'>Failed to upload Image</div>";
                            header('location:'.SITEURL.'Admin/add-food.php');


                            die();
                        }
                    }
                }
                else{
                    $image_name = "";
                }
            
                //sql querry to save data into database
                $sql2 = "INSERT INTO tbl_food SET title ='$title',description = '$description',price = '$price'
                ,image_name ='$image_name',category_id='$category',featured ='$featured',active = '$active'";
            
                //saving data to db
                $res2 =mysqli_query($conn ,$sql2) ;
            
                //chech whether the data is inserted or not and display appropriate msg
                if($res2 ==  True)
                {
                    //echo "Data inserted";
                    //create a session variable to display msg
                    $_SESSION['add'] = "<div class='success'>Food added successfully</div>";
                    //redirect page
                    header("location:".SITEURL.'Admin/manage-food.php');
                }
                else{
                    $_SESSION['add'] = "<div class='error'>Failed to add food</div>";
                    //redirect page
                    header("location:".SITEURL.'Admin/manage-food.php');
                }
            }
        ?>



    </div>

</div>

<?php include('partials/footer.php'); ?>