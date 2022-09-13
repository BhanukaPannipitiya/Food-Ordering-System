<?php include('partials/menu.php') ?>

<!-- Main Content section starts -->
<div class="main-content">
    <div class="wrapper">
        <h1>Manage Admin</h1>
        <br> <br>
        <?php
        if (isset($_SESSION['add'])) {
            echo $_SESSION['add'];
            unset($_SESSION['add']);
        }
        ?>
        <br><br>
        <a href="add-admin.php" class="btn-primary">Add Admin</a>
        <br> <br>
        <table class="tbl-full">
            <tr>
                <th>S.N</th>
                <th>Full Name</th>
                <th>Username</th>
                <th>Actions</th>
            </tr>

            <?php
            //querry to select admins from the database
            $sql = "SELECT * FROM tbl_admin";
            //execute the querry
            $res = mysqli_query($conn, $sql);
            //check whether the querry is executed or not
            if ($res == True) {
                //count rows to check whether we have data in db or not
                $count = mysqli_num_rows($res);

                $sn = 1;

                if ($count > 0) {
                    //we have data in db
                    while ($rows = mysqli_fetch_assoc($res)) {
                        //using while loop to get all the data from db
                        $id = $rows['id'];
                        $full_name = $rows['full_name'];
                        $username = $rows['username'];
            ?>
                        <tr>
                            <td><?php echo $sn++; ?></td>
                            <td><?php echo $full_name; ?></td>
                            <td><?php echo $username; ?></td>
                            <td>
                                <a href="a" class="btn-secondary">Update Admin</a>
                                <a href="<?php echo SITEURL; ?>Admin/delete-admin.php" class="btn-danger">Delete Admin</a>
                            </td>
                        </tr>
            <?php

                    }
                } else {
                    //we dont have data in db

                }
            }


            ?>


        </table>


    </div>

</div>
<!-- Main Content section Ends -->

<?php include('partials/footer.php'); ?>