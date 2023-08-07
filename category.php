   <?php include('partial-front/menu.php'); ?> 


    <!-- CAtegories Section Starts Here -->
    <section class="categories">
        <div class="container">
            <h2 class="text-center">Explore Foods</h2>
            <?php 
            $select="SELECT * FROM tbl_category WHERE active='yes'";
            $data=mysqli_query($con,$select);
            $count=mysqli_num_rows($data);
            if($count>0)
            {
                while($row=mysqli_fetch_assoc($data))
                {
                    $id=$row['id'];
                    $title=$row['title'];
                    $image_name=$row['image_name'];

                    ?>

            <a href="<?php echo SITEURL;?>food-category.php?category_id=<?php echo $id;?>">
            <div class="box1 float-container">
                <?php
                if($image_name=="")
                {
                    echo"<div class='btn-error'>Image is not Added.</div>";
                }
                else
                {

                    ?>
                <img src="<?php echo SITEURL; ?>imgs/category/<?php echo $image_name; ?>" alt="Pizza" width="100%" class="img-responsive img-curve">
                <?php 
                }
                ?>

                <h3 class="float-text text-white"><?php echo $title; ?></h3>
            </div>
            </a>
                    <?php


            }  
        }
            else
                {
                    //categories not availble
                    echo "<div class='btn-error'>Category not Found.";
                }

            ?>

            
            

            <div class="clearfix"></div>
        </div>
    </section>
    <!-- Categories Section Ends Here -->


    <!-- social Section Starts Here -->
    
    <!-- footer Section Ends Here -->
   <?php include('partial-front/footer.php'); ?> 

</body>
</html>