<?php 
include_once('database.php');
$idStr="";
        //get and the ids and convert them into string
        if(isset($_POST['id'])){
        $idStr=$_POST['id'];
        $idStr=implode(',',  $idStr);
        }
        
  
        //delete records from the database
       
        $delete=$fbuser1->bulkDelete($idStr);
        // echo var_dump($delete);
      
        if($delete){
           echo 1;
        }
        else{
            echo 0;
        }
  
  

?>