<?php include('partials-front/menu.php'); ?>

<!-- fOOD sEARCH Section Starts Here -->
<section class="food-search text-center">
    <div class="container">

        <form action="<?php echo SITEURL; ?>food-search.php" method="POST">
            <input type="search" name="search" placeholder="Search for Food.." required>
            <input type="submit" name="submit" value="Search" class="btn btn-primary">
        </form>

    </div>
</section>
<!-- fOOD sEARCH Section Ends Here -->

<!-- CAtegories Section Starts Here -->
<section class="categories">
    <div class="container">
        <h2 class="text-center">Explore Foods</h2>

        <?php
        //create a sql q to display categories from the db
        $sql = "SELECT * FROM tbl_catogary WHERE active='Yes' AND featured='Yes' LIMIT 3";
        //execyte the q
        $res = mysqli_query($conn, $sql);
        //check rows to check whether the cat is available or not
        $count = mysqli_num_rows($res);
        if ($count > 0) {
            while ($row = mysqli_fetch_assoc($res)) {
                //get the values like title image name
                $id = $row['id'];
                $title = $row['title'];
                $image_name = $row['image_name'];
        ?>

                <a href="<?php echo SITEURL; ?>category-foods.php?category_id=<?php echo $id;?>">
                    <div class="box-3 float-container">
                        <?php
                        //check whether the image is available or not
                        if ($image_name == "") {
                            //display msg
                            echo "<div class='error'> Image not available</div>";
                        } else {
                            //image available
                        ?>
                            <img src="<?php echo SITEURL; ?>images<?php echo $image_name; ?>" alt="Pizza" class="img-responsive img-curve">
                        <?php
                        }
                        ?>


                        <h3 class="float-text text-white"><?php echo $title; ?></h3>
                    </div>
                </a>
        <?php
            }
        } else {
            //cat no available
            echo "<div class='error'> Category not added</div>";
        }
        ?>


        <div class="clearfix"></div>
    </div>
</section>
<!-- Categories Section Ends Here -->

<!-- fOOD MEnu Section Starts Here -->
<section class="food-menu">
    <div class="container">
        <h2 class="text-center">Food Menu</h2>
        <?php
        //create a sql q to display categories from the db
        $sql2 = "SELECT * FROM tbl_food WHERE active='Yes' AND featured='Yes' LIMIT 6";
        //execyte the q
        $res2 = mysqli_query($conn, $sql2);
        //check rows to check whether the cat is available or not
        $count2 = mysqli_num_rows($res2);
        if ($count2 > 0) {
            while ($row = mysqli_fetch_assoc($res2)) {
                //get the values like title image name
                $id = $row['id'];
                $title = $row['title'];
                $price = $row['price'];
                $description = $row['description'];
                $image_name = $row['image_name'];
        ?>
                <div class="food-menu-box">
                    <div class="food-menu-img">
                        <?php
                        //check whether the image is available or not
                        if ($image_name == "") {
                            //display msg
                            echo "<div class='error'> Image not available</div>";
                        } else {
                            //image available
                        ?>
                            <img src="<?php echo SITEURL; ?>images<?php echo $image_name; ?>" alt="Chicke Hawain Pizza" class="img-responsive img-curve">
                        <?php
                        }
                        ?>

                    </div>

                    <div class="food-menu-desc">
                        <h4><?php echo $title; ?></h4>
                        <p class="food-price"><?php echo $price; ?></p>
                        <p class="food-detail">
                            <?php echo $description; ?>
                        </p>
                        <br>

                        <a href="order.html" class="btn btn-primary">Order Now</a>
                    </div>
                </div>
        <?php
            }
        } else {
            //food no available
            echo "<div class='error'> Food not available</div>";
        }
        ?>







        <div class="clearfix"></div>



    </div>

    <p class="text-center">
        <a href="#">See All Foods</a>
    </p>
</section>
<!-- fOOD Menu Section Ends Here -->

<?php include('partials-front/footer.php'); ?>