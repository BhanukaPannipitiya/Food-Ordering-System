<?php include('partials/menu.php') ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Manage Catogory</h1>

        <br>
        <?php

        if (isset($_SESSION['add'])) {
            echo $_SESSION['add'];
            unset($_SESSION['add']);
        }



        ?>
        <br><br>
        <a href="<?php echo SITEURL; ?>admin/add-category.php" class="btn btn-primary">Add Catogary</a>
        <br> <br>
        <table class="tbl-full">
            <tr>
                <th>S.N</th>
                <th>Title</th>
                <th>Image</th>
                <th>Featured</th>
                <th>Active</th>
                <th>Actions</th>
            </tr>

            <?php
            //Query to get all categories from database
            $sql = "SELECT * FROM tbl_category";

            //Execute the query
            $res = mysqli_query($conn, $sql);

            //count the rows
            $count = mysqli_num_rows($res);

            //create serial number variable and assign value as 1
            $sn = 1;

            //check whther we have data in database or not
            if ($count > 0) {
                //we have data in database
                //get the data and display
                while ($row = mysqli_fetch_assoc($res)) {
                    $id = $row['id'];
                    $title = $row['title'];
                    $image_name = $row['image_name'];
                    $featured = $row['featured'];
                    $active = $row['active'];

            ?>

                    <tr>
                        <td><?php echo $sn++; ?></td>
                        <td><?php echo $title; ?></td>

                        <td>
                            <?php
                            //check whther image name is available or not
                            if ($image_name != "") {
                                //Display image
                            ?>
                                <img src="<?php echo SITEURL; ?>images/category/<?php echo $image_name; ?>" width="100px">
                            <?php


                            } else {
                                //Display the message
                                echo "<div class='error'> Image not added.</div>";
                            }

                            ?>
                        </td>

                        <td><?php echo $featured; ?></td>
                        <td><?php echo $active; ?></td>

                        <td>
                            <a href="a" class="btn-secondary">Update Category</a>
                            <a href="a" class="btn-danger">Delete Category</a>
                        </td>
                    </tr>

                <?php

                }
            } else {
                //we donot have data in database
                //we will display the message inside table
                ?>
                <tr>
                    <td colspan="6">
                        <div class="error">No category added.</div>
                    </td>

                </tr>


            <?php
            }





            ?>




        </table>

    </div>
</div>

<?php include('partials/footer.php') ?>