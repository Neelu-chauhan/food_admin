<?php 
session_start();
session_destroy();
header('Location:login.php');
 ?> 
<?php
$host="localhost";
$user="root";
$password="";
$name="online_quiz";
$con=mysqli_connect($host,$user,$password,$name);
if($con)
{
    // echo "connected";
}
else
{ 

    echo "plz check again";
}

 session_start();
if(!isset($_SESSION['user']))
{
    header('Location:index.php');
}

if(isset($_POST['submit']))
{
    if(!empty($_POST['quickcheck']))
    {
        $count=count($_POST['quickcheck']);
        echo "Out of 5, You have selected ".$count."options";
        $result=0;
        $i=1;
        $select=$_POST['quickcheck'];
        print_r($select);
        $q="SELECT * FROM question ";
        $data=mysqli_query($con,$q);
        while ($row=mysqli_fetch_array($data))
        {
            print_r($row['a_id']);
            $checked=$row['a_id']==$select[$i];
            if($checked)
            {
                $result++;
            }
            $i++;
        }
        echo "<br> Your total score is ". $result;
    }
}




mysqli_select_db($con,'quiz2');
$name=$_SESSION['user'];
$final="INSERT INTO user (username, totalques, answercorrect) VALUES ('$name','5','$result')";
$data=mysqli_query($con,$final);


?>
