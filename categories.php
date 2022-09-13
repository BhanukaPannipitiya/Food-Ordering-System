<?php include('partials-front/menu.php'); ?>


<!-- CAtegories Section Starts Here -->
<section class="categories">
    <div class="container">
        <h2 class="text-center">Explore Foods</h2>

        <?php
        //display all the cats active
        //sql q
        $sql = "SELECT * FROM tbl_catogary WHERE active='Yes'";
        //exc
        $res = mysqli_query($conn, $sql);
        //count rows
        $count = mysqli_num_rows($res);
        //check
        if ($count > 0) {
            //cat avai
            while ($row = mysqli_fetch_assoc($res)) {
                //get values
                $id = $row['id'];
                $title = $row['title'];
                $image_name = $row['image_name'];
        ?>
                <a href="<?php echo SITEURL; ?>category-foods.php?category_id=<?php echo $id;?>">
                    <div class="box-3 float-container">
                    <?php
                        //check whether the image is available or not
                        if ($image_name == "") 
                        {
                            //display msg
                            echo "<div class='error'> Image not Found</div>";
                        } 
                        else 
                        {
                            //image available
                            ?>
                            <img src="<?php echo SITEURL; ?>images<?php echo $image_name; ?>" alt="Pizza" class="img-responsive img-curve">
                            <?php
                        }
                        ?>
                        

                        <h3 class="float-text text-white"><?php echo $title;?></h3>
                    </div>
                </a>
        <?php
            }
        } else {
            //cat not avail
            echo "<div class = 'error'>Category not found .</div>";
        }
        ?>







        <div class="clearfix"></div>
    </div>
</section>
<!-- Categories Section Ends Here -->


<?php include('partials-front/footer.php'); ?>