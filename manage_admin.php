<?php 
include('menu.php')
 ?>

 <div class="main">
 	<div class="wrapper">
 		<h1>Manage Admin</h1><br >
    <?php 
    if(isset($_SESSION['add']))
    {
      echo $_SESSION['add'];  //use to display session messge
      unset($_SESSION['add']); //use to remove session massge
    }

    if(isset($_SESSION['update']))
    {
      echo $_SESSION['update'];  //use to display session messge
      unset($_SESSION['update']); //use to remove session massge
    }

    if(isset($_SESSION['user-not-found']))
    {
      echo $_SESSION['user-not-found'];  //use to display session messge
      unset($_SESSION['user-not-found']); //use to remove session massge
    }


    if(isset($_SESSION['Pwd-not-match']))
    {
      echo $_SESSION['Pwd-not-match'];  //use to display session messge
      unset($_SESSION['Pwd-not-match']); //use to remove session massge
    }
  



    if(isset($_SESSION['Password change successfully']))
    {
      echo $_SESSION['Password change successfully'];  //use to display session messge
      unset($_SESSION['Password change successfully']); //use to remove session massge
    }
    

     ?>
    <br><br>
 		<!-- button to add admin -->
 		<a href="add-admin.php" class="btn-primary">Add Admin</a><br><br>

 		<table class="tbl" border="2px solid black">
 			<tr>
 				<th>S.N</th>
 				<th>Full Name</th>
 				<th>Username</th>
 				<th>Action</th>
 			</tr>
      <?php 
      //get all the admin
      $select="SELECT * FROM tbl_admin";
      $data=mysqli_query($con,$select);
      $sn=1;
      if($data)
      {
        // echo "yes select";
        $row=mysqli_num_rows($data);

        if($row>0)
        {
          // data have database
          while ($row=mysqli_fetch_assoc($data)) //using while loop we get the data from the database
          {
            $id=$row['id'];
            $fname=$row['full_name'];
            $uname=$row['username'];
            // display the value in table
            ?>
 
      <tr>
        <td><?php echo $sn++; ?></td>
        <td><?php  echo $fname; ?></td>
        <td><?php echo  $uname;  ?></td>
        <td>
         <a href="<?php echo SITEURL; ?>admin/changepass-admin.php?id=<?php echo $id;?>"class="btn-primary">Change password</a>
         <a href="<?php echo SITEURL; ?>admin/update-admin.php?id=<?php echo $id;?>" class="btn-secondary">Update Admin</a>
         <a href="<?php echo SITEURL; ?>admin/delete-admin.php?id=<?php echo $id;?>" onclick='return confirm("Are you sure?")'  class="btn-danger">Delete Admin</a>
        </td>
      </tr>
            <?php 


          }
        }
        else{
          //data is not here
        }
      }
      else
      {
        echo "please check again";
      }

       ?>
 		</table>


 	</div>
 </div>

 <?php 
include('footer.php')
  ?>