
<!-- user authentication -->
<?php 
session_start();
$msg="";
if(isset($_GET['msg'])){
    $msg= $_GET['msg'];
}
$login= false;
$showError="";
if(isset($_POST["login"])){
    include('partials/databasetest.php');
    $useremail = $_POST["email-phone"];
    $password = $_POST["login-pass"];
    if(!empty($useremail)&&!empty($password)){
    $sql = "SELECT * from `users` WHERE user_email='$useremail'";
    $resultlogin = mysqli_query($conn, $sql);
    $enc_pass=md5($password);
    $num = mysqli_num_rows($resultlogin);
    if ($num>0){
        
     while($row=mysqli_fetch_assoc($resultlogin)){
                if($enc_pass==$row['user_password']){
                $login = true;
               
                $_SESSION['logged_in'] = true;
                $_SESSION['user_name'] = $row['user_firstname'];
                header('location:view.php');
                }
                else{
                    $showError = "Invalid Credentials!"; 
                }
            
          
        }
    } 
    
    else{
        $showError = "Invalid Credentials!";
    }
    }
    else{
        $showError = "Please fill out all the fields!"; 
    }

}
?>
<!-- ........................html starts from here....................... -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Facebook - log in or sign up </title>
    <link rel="icon" type="image/x-icon" href="imgs/fb_icon_325x325.png">
    <link rel="stylesheet" href="css/login-style.css">
    <link rel="stylesheet" href="css/errorstyle.css">
    <script src="login.js"></script>

</head>

<body>


    <!-- First section contain content starts from here -->
    <div class="flex-container">
        <div class="flex-child1">
            <div class="logo-img">
                <img src="imgs/fblogo.svg" alt="fb-logo">
            </div>
            <div class="heading-text">
                <p>Facebook helps you connect and share with the people in your life.</p>
            </div>
        </div>
        
        <!-- second section contains form start from here -->
        <div class="flex-child">
            <!-- div to show errors -->
      
           
                
          
            <div class="fb-form">
            <span id="existmsg"><?php echo $msg;
              ?></span>
                <form  action="login.php" method="post" name="loginForm">
                <span id="existmsg"><?php echo $showError;
              ?></span>
                <!-- <span id="insert"><?php echo  $fbuser1->insertmsg; ?> </span> -->
                    <input type="text" name="email-phone" id="email-phone" placeholder="Email adress or phone number" class="input-field" value="" />
              
                    <!-- <span id="existmsg"><?php echo  $fbuser1->existmsg; ?> </span><br>
                    <span id="existmsg"><?php echo  $emailError; ?> </span>
              -->


                    <input type="password" name="login-pass" id="login-pass" placeholder="Password" class="input-field" value="" />
                  
                    <!-- <span id="existmsg"><?php echo $passError ;?> </span> -->


                    <input type="submit" name="login" value="Login" class="login-btn" id="log-in" />



                    <a href="" id="password-anchor">Forgotten password?</a>
                    <hr>

                </form>
                <button type="submit"  class="signup-btn"  onclick="window.location.href='signup.php'">Create New Account</button>
            </div>

            <p><a href="#" class="bottom-anchor bottom-text">Create a Page</a> for a celebrity, brand or business.</p>
        </div>


    </div>





    <!-- Footer starts from here -->
    <div class="container">
    <?php include('partials/footer.php');?>
    </div>

</body>


</html>