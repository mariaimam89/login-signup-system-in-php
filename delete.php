    
<?php
include_once('database.php');
$id=$_GET['id'];
$res=$fbuser1->delete($id);
if($res){
   
    $delmsg="One record has been deleted successfully!";
  
   header('location:view.php?msg='.$delmsg);
}
else{
   echo "Data cannot be deleted";
}


?>



