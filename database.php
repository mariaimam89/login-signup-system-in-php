<?php class fbusers
{
    public $db_host = "localhost";
    public $db_user = "root";
    public $db_pass = "";
    public $db_name = "facebook";

    public $conn = "";
    public $error="";
    public $existmsg="";
    public $insertmsg="";
   

    //construct to initialize db connection
    function __construct()
    {
        $this->conn = mysqli_connect($this->db_host, $this->db_user, $this->db_pass, $this->db_name);
        // echo "successfully connected";
        if (!$this->conn) {
            die("sorry we failed to connect" . mysqli_connect_error());
        }
    }
    //Function to check if user email already exists
    public function isExists($f, $s, $e, $p, $da,$m,$y,$d, $g, $pr,$go,$img){
       
        $user=$e;
        $password=$p;
       
    $existSql = "SELECT * FROM `users` WHERE user_email = '$user'";
    $result = mysqli_query($this->conn, $existSql);
    if(isset($result)){
    $numExistRows = mysqli_num_rows($result);
    }
    if($numExistRows > 0){
        // $exists = true;
        $this->existmsg= "Username Already Exists!";
       
    }
    else{
        $this->insertRecord($f, $s, $e, $p,$da,$m,$y, $d, $g, $pr,$go,$img);
    }
  
    }
    //Function to insert record in data base
    public function insertRecord($f, $s, $e, $p,$da,$m,$y, $d, $g, $pr,$go,$img)
    {
        $password= md5($p);
       
            $result = mysqli_query($this->conn, "INSERT INTO `users` ( `user_firstname`, `user_surname`, `user_email`, `user_password`, `user-date`, `user_month`, `user_year`, `user_dob`, `user_gender`, `user_pronoun`, `gender_opt`,`image`) VALUES ('$f', '$s', '$e', '$password', '$da', '$m', '$y', '$d', '$g', '$pr', '$go','$img')");
         
            $this->insertmsg= "Record inserted in db successfully!";
            return $result;
        
    }
    //Function to display records
    public function read(){
	
     
        if(isset($_GET['page_id'])){
            $page=$_GET['page_id'];
        }
        else{
            $page=1;
        }
        $limit=10;
        $offset=($page-1)*$limit;
            $sql= "SELECT * FROM `users` LIMIT {$offset} , {$limit}";
            $res = mysqli_query($this->conn, $sql);
           
            return $res;
         
    
        
	}
    //Function that will return total number of records
    public function totalrecords(){
	
		
      
        $sql1= "SELECT * FROM `users`";
        $res1 = mysqli_query($this->conn, $sql1);
        $total=mysqli_num_rows($res1);
       
        return $total;
     

    
}
//Function to display the selected record
    public function readupdate($id){
	
		
      
        $sql= "SELECT * FROM `users` where user_id='$id'";
        $res = mysqli_query($this->conn, $sql);
       
        return $res;
     

    
}
//Function to delete record
    public function delete($id){
        $delSql="DELETE FROM `users` WHERE user_id =$id ";
        $res=mysqli_query($this->conn, $delSql);
        return $res;
    }
    //Function to update record
    public function update($fname, $sname, $uemail, $upass,$udate, $umonth, $uyear,$udob, $ugender,$upronoun, $ugenderopt,$img, $uid){
        $updatesql="UPDATE `users` SET `user_firstname` = '$fname', `user_surname` = '$sname', `user_email` = '$uemail', `user_password` = '$upass', `user-date` = '$udate', `user_month` = '$umonth', `user_year` = '$uyear', `user_dob` = '$udob',`user_gender` = '$ugender', `user_pronoun` = '$upronoun' , `gender_opt` = '$ugenderopt' , `image` = '$img'  WHERE `users`.`user_id` = $uid";
        $res = mysqli_query($this->conn, $updatesql);
		return $res;
    }
    //Function for bulk deletion
    public function bulkDelete($idStr){
        $deleteall="DELETE from users where user_id IN ($idStr)";
        $res2=mysqli_query($this->conn, $deleteall);
        return $res2;

    }

}//class ends here


$fbuser1 = new fbusers();
$showError=$emailError=$passError="";
$username="";
$password="";
$userFname ="";
$userSname="";
$month="";

$dt="";

$year="";


$userGender="";
$userPronoun="";
$userG="";

$files="";
$statusMsg="";
$image="";
//checks to remove undefined variable error
if(isset($_POST["submit"])){
if(isset($_POST['firstName'])){
    $userFname = $_POST['firstName'];
}else{
    $userFname= "Name not set in POST Method";
}

if(isset($_POST['surName'])){
    $userSname=$_POST['surName'];
}else{
    $userSname = "Name not set in POST Method";
}
if(isset($_POST['month'])){
    $month=$_POST['month'];
}else{
    $month = "Name not set in POST Method";
}
if(isset($_POST['date'])){
    $dt=$_POST['date'];
  
}else{
    $dt = "Name not set in POST Method";
}
if(isset($_POST['year'])){
    $year=$_POST['year'];
}else{
    $year = "Name not set in POST Method";
}

if(isset($_POST['gender1'])){
    $userGender=$_POST['gender1'];
}else{
    $userGender = "Name not set in POST Method";
}
if(isset($_POST['pronoun1'])){
    $userPronoun=$_POST['pronoun1'];
}else{
    $userPronoun = "Name not set in POST Method";
}

if(isset($_POST['Gender'])){
    $userG=$_POST['Gender'];
    $userG=ucfirst($userG);
}else{
    $userG = "Name not set in POST Method";
}



if(isset($_POST['email-phone'])){
    $username = $_POST['email-phone'];
}else{
    $name = "Name not set in POST Method";
}
if(isset($_POST['password1'])){
    $password = $_POST['password1'];
}else{
    $name = "<br>password not set in post Method";
}

$userDob="$year-$month-$dt";


if(isset($_FILES['image'])){
$files=$_FILES['image'];

// print_r($files);
}



$filename=$files['name'];
$fileerror=$files['error'];
$filetmp=$files['tmp_name'];
// $fileext = pathinfo($filename, PATHINFO_EXTENSION);
$fileext=explode('.',$filename);
$filecheck=strtolower(end($fileext));
$allowTypes = array('jpg','png','jpeg','gif');

if(in_array($filecheck,$allowTypes) && ($_FILES["image"]["size"] < 500000)){
    $destinationFile='imgs/'.$filename;
    move_uploaded_file($filetmp,$destinationFile);
    $image=$destinationFile;
} 
else{
 $statusMsg="Image not uploaded! Please choose the file with the valid extension and the size should be < 500mb";
}

    




// $targetDir = "uploads/";
// $fileName = basename($_FILES["image"]["name"]);
// $targetFilePath = $targetDir . $fileName;
// $fileType = pathinfo($targetFilePath,PATHINFO_EXTENSION);
// $allowTypes = array('jpg','png','jpeg','gif','pdf');
// if(in_array($fileType, $allowTypes)){
//     // Upload file to server
//     move_uploaded_file($_FILES["image"]["tmp_name"], $targetFilePath);
// }
// else{
//     $stasusMsg='Sorry, only JPG, JPEG, PNG, GIF files are allowed to upload.'; 
// }



// $username = $_POST['email-phone'];
// $password = $_POST['login-pass'];
$number = preg_match('@[0-9]@', $password);
$uppercase = preg_match('@[A-Z]@', $password);
$lowercase = preg_match('@[a-z]@', $password);



//Checks to validate Form

//Email and password sould not be blanked
if (empty($username) || empty($password) || empty($filename)){
    $showError="Email password and image fields must be filled out!";
}
// Email validation
else  if (!filter_var($username, FILTER_VALIDATE_EMAIL)) {
    $emailError = "Invalid email format!";
}
// password validation
 else if (strlen($password) < 8 || !$number || !$uppercase || !$lowercase) {
    $passError = "Password must be at least 8 characters in length and must contain at least<br> one number, one upper case letter, and one lower case letter.";
} 




else{
$fbuser1->isExists($userFname, $userSname,$username, $password,$dt,$month,$year, $userDob, $userGender, $userPronoun,$userG,$image);
}

}//isset submit bracket
//image upload



?>
