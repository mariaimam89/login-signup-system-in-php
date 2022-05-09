<?php
include_once ('database.php');

$statusMsg="";
$result = $fbuser1->read();
$row = mysqli_fetch_assoc($result);

$delmsg="";
$updatemsg="";
$str="";


if(isset($_GET['msg'])){
    $delmsg= $_GET['msg'];
}
if(isset($_GET['updatemsg'])){
    $updatemsg= $_GET['updatemsg'];
}
//sessions code

session_start();

if(!isset($_SESSION['logged_in']) || $_SESSION['logged_in']!=true){
    $msg="Please login to continue!";
    header("location: login.php?msg=".$msg);
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP Grid using OOP</title>
    <link rel="stylesheet" href="css/view.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="js/bulk_delete.js"></script>
    <script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
    <script>


</script>

</head>

<body>
    <div class="container">
        <div class="upper-container">
        <h1>
          Welcome <?php echo $_SESSION['user_name']; ?>
      </h1>

      <a class="del-btn" id="logout-btn" onClick="return confirm('Are you sure you want to Log Out?')" href="logout.php" >Log Out</a><br><br>
        </div>
        <!-- alert msgs -->
        <div class="alert">
            <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
            <?php echo $delmsg; echo $updatemsg; echo $statusMsg;
          
            ?>
        </div>
    
        <!-- table starts from here -->
      <form method="POST"> 
  
      <button type="button" id="delete-btn" class="del-btn">Delete</button><br><br>
    <table class="table" id="table-data">
            <tr>
            <th> <input type="checkbox" id="select_all">  </th>
                <th>S No.</th>
                <th>First Name</th>
                <th>Sur Name</th>
                <th>Email</th>
             
                <th>Date of Birth</th>
                <th>Gender</th>
                <th>Pronoun</th>
                <th>Gender(Optional)</th>
                <th>Image</th>

                <th>Edit</th>
                <th>Delete</th>

            </tr>
            <?php
            while($row = mysqli_fetch_assoc($result)){
         ?>
            <tr>
                <td><input type="checkbox" name="row-check" class="checkbox" value=" <?php echo $row['user_id'];?>"></td>
                <td><?php echo $row['user_id']; ?></td>
                <td><?php echo $row['user_firstname'] ?></td>
                <td><?php echo $row['user_surname'] ?></td>
                <td><?php echo $row['user_email'] ?></td>
              
                <td><?php echo $row['user_dob']; ?></td>
                <td><?php echo $row['user_gender']; ?></td>
                <td><?php echo $row['user_pronoun']; ?></td>
                <td><?php echo $row['gender_opt']; ?></td>
                <td><img src="<?php echo $row['image']; ?>" height="100px" width="100px"></td>


                <td><a href="update.php?id=<?php echo $row['user_id']; ?>"><i class='fas fa-edit'
                            style='color:#4f7bb6'></i></a></td>
               <td> <a onClick="return confirm('Are you sure you want to delete?')"
                    href="delete.php?id=<?php echo $row['user_id']; ?>"><i class='fas fa-trash-alt'
                        style='color:red'></i></a></td>

            </tr>

            <?php } ?>
         </table>
      </form>
    </div>

   <!-- code for pagination -->
<div>
    <?php 
           if(isset($_GET['page_id'])){
            $page=$_GET['page_id'];
        }
        else{
            $page=1;
        }
        $totalRecords= $fbuser1->totalrecords();
        if($totalRecords>=10){
        $limit=10;
        $totalPage=ceil($totalRecords/$limit);
        // echo $totalPage;
        echo'<ul class="pagination">';
        if($page>1){
            echo '<li><a href="view.php?page_id='.($page-1).'">Prev</a></li>';
        }
       
        for($i=1; $i<=$totalPage; $i++){
            if($i==$page){
                $active="active";
            }
            else{
                $active="";
            }
            echo '<li><a class="'.$active.'" href="view.php?page_id='.$i.'">'.$i.'</a></li>';
        }
        if($totalPage >  $page){
            echo '<li><a href="view.php?page_id='.($page+1).'">Next</a></li>';
        }
       
     
        echo '</ul>';
    }
        ?>
</div>
</body>
</html>