<?php

include('database.php');


if(isset($_GET['id'])){
$updateid=$_GET['id'];
}
else{
    $updateid="";
    $userFname="";
}
$res = $fbuser1->readupdate($updateid);
$num = mysqli_num_rows($res);


if(isset($_POST) & !empty($_POST)){
   
    $userFname = $_POST['firstName'];
   $userSname=$_POST['surName'];
   $username = $_POST['email-phone'];
   $password = $_POST['password1'];
    $dt=$_POST['date'];
    $month=$_POST['month'];
    $year=$_POST['year'];
//  user date of birth
$userDob="$year-$month-$dt";
$userGender=$_POST['gender1'];
$userPronoun=$_POST['pronoun1'];
$userG=$_POST['Gender'];
$userG=ucfirst($userG);
$oldimage=$_POST['oldimage'];  

if(!isset($_FILES['image']['name'])){
    $image1=$oldimage;
}else{

    unlink($oldimage);
     move_uploaded_file($_FILES["image"]["tmp_name"],"imgs/" . $_FILES["image"]["name"]);
     $destinationFile='imgs/'.$_FILES["image"]["name"];			
     $image1=$destinationFile;
}
  
   

 if(empty($userFname) || empty( $userSname) || empty( $username) || empty($password)){
    $showError="Email, Password and Username are required fields!";

 }
 else{
   
    $res = $fbuser1->update($userFname, $userSname,$username, $password,$dt,$month,$year, $userDob, $userGender, $userPronoun,$userG,$image1,$updateid);
   echo  var_dump($res);
   if($res){
        $updatemsg="One record has been updated successfully!";
	 	header('location:view.php?updatemsg='.$updatemsg);
	}
    else{
	 	echo "failed to update data";
	}
 }
 
 
}//end of post
?>
<!-- ------------------HTML Starts fom here----------------------- -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Update info</title>
    <link rel="stylesheet" href="css/signup-style.css">
    <link rel="stylesheet" href="css/errorstylesignup.css">
    <script src="signup.js"></script>
</head>

<body>
    <div class="container">
        <!-- <div id="img">
            <img src="imgs/fblogo.svg" alt="">
        </div> -->

        <div class="form-container">

            <div class="form-text">
                <p class="heading-text">Update Your Info</p>
                <p class="plain-text">It's quick and easy.</p>
            </div>
            <table>
               
                <form method="post" enctype="multipart/form-data">
                <?php while($r = mysqli_fetch_assoc($res))
                {
                ?>
                     <!-- error msgs -->
                     <tr>
                        <td><span id="existmsgsignup"><?php echo  $showError; ?> </span>
                            
                        </td>
                        <td><span id="insertmsgsignup"><?php echo  $fbuser1->insertmsg; ?> </span>
                            
                        </td>
                    </tr>
                    <tr>
                        <td><input type="text" name="firstName" id="firstName" placeholder="First name"
                                class="row-field"  value=" <?php echo $r['user_firstname']; ?>">
                        </td>
                        <td><input type="text" name="surName" id="surName" placeholder="Surname" class="row-field"  value="<?php echo $r['user_surname']; ?>">
                        </td>
                    </tr>
                    <!-- error msgs -->
                    <tr>
                        <td>
                            <span id="existmsgsignup"><?php echo  $fbuser1->existmsg; ?> </span>
                            <span id="existmsgsignup"><?php echo  $emailError; ?> </span>
                        </td>
                    </tr>
                    <tr>
                        <!-- email input field -->
                        <td><input type="text" name="email-phone" id="email-phone"
                                placeholder="Mobile number or email address" value=" <?php echo $r['user_email']; ?>" class="input-field row-field"></td>


                    </tr>
                    <!-- error msgs -->
                    <tr>
                        <td><span id="existmsgsignup"><?php echo  $passError; ?> </span>
                        </td>
                    </tr>
                   <!-- password input field -->
                    <tr>
                        <td><input type="text" name="password1" id="password1" placeholder="New password"
                                class="input-field row-field" value="<?php echo $r['user_password']; ?>"></td>
                    </tr>

                    <tr>
                        <td> <label for="name" class="label">
                                Date of birth
                            </label></td>
                    </tr>
                    <tr>
                        <td>
                            <select  name="date" class="dob-field row-field">
                         
                                <option value="23"   <?php if( $r['user-date']=='23'){echo "selected"; }?>>23</option>
                                
                                <option value="24" <?php if( $r['user-date']=='24'){echo "selected";}?>>24</option>
                                <option value="25" <?php if( $r['user-date']=='25'){echo "selected";}?>>25</option>

                            </select>

                        </td>
                        <td>
                            <select name="month" class="dob-field row-field">
                           
                                <option value="Jan"<?php if( $r['user_month']=='Jan'){echo "selected";}?>>Jan
                                </option>
                                <option value="Feb" <?php if( $r['user_month']=='Feb'){echo "selected";}?>>Feb
                                </option>
                                <option value="Mar" <?php if( $r['user_month']=='Mar'){echo "selected";}?>>Mar
                                </option>

                            </select>

                        </td>
                        <td>
                            <select  name="year" class="dob-field row-field">
                            
                                <option value="2022" <?php if( $r['user_year']=='2022'){echo "selected";}?>>2022
                                </option>
                                <option value="2021" <?php if( $r['user_year']=='2021'){echo "selected";}?>>2021
                                </option>
                                <option value="2019" <?php if( $r['user_year']=='2019'){echo "selected";}?>>2019
                                </option>
                            </select>
                        </td>

                    </tr>

                    <tr>
                        <td> <label for="name" class="label">
                                Gender
                            </label></td>
                    </tr>
                    <tr>
                        <td class="radio-field row-field"> <label for="Female">Female</label><input class="radio-circle"
                                type="radio"  name="gender1"
                                value="Female" <?php if($r['user_gender'] == 'Female'){ echo "checked";} ?>></td>
                        <td class="radio-field row-field"> <label for="Male">Male</label><input type="radio"
                                class="radio-circle" value="Male" <?php if($r['user_gender'] == 'Male'){ echo "checked";} ?> name="gender1"
                              >
                        </td>
                        <td class="radio-field row-field"> <label for="Custom">Custom</label><input type="radio"
                                class="radio-circle" id="Custom" name="gender1" value="Custom"
                                <?php if($r['user_gender'] == 'Custom'){ echo "checked";} ?>></td>

                    </tr>
                    <tr>
                        <td>
                            <select id="date" name="pronoun1" class="row-field pronoun">
                                <option value="" onmouseover="color()">Select your pronoun</option>
                                <option value='"She: "Wish her a happy birthday!"'
                                    <?php if( $r['user_pronoun']=='"She: "Wish her a happy birthday!"'){echo "selected";}?>>
                                    She: "Wish her a happy birthday!"</option>
                                <option value='He: "Wish him a happy birthday!"'
                                <?php if( $r['user_pronoun']=='He: "Wish him a happy birthday!"'){echo "selected";}?>>
                                    He: "Wish him a happy birthday!"</option>
                                <option value='They: "Wish them a happy birthday!"'
                                <?php if( $r['user_pronoun']=='They: "Wish them a happy birthday!"'){echo "selected";}?>>
                                    They: "Wish them a happy birthday!"</option>

                            </select>
                            <p id="pronoun">Your pronoun is visible to everyone.</p>



                        </td>

                    </tr>
                    <tr>
                        <td><input type="text" name="Gender" id="Gender" placeholder="Gender (Optional)"
                                class="input-field row-field" value="<?php echo $r['gender_opt']; ?>">
                        </td>

                    </tr>

                 <!-- image to upload -->
                 <td> <label for="image" class="label">
                                Upload Image
                            </label></td>
                 <tr><td> <input  type="file" name="image" id="imagetoupload">
                   </td>
                   <td><img src="<?php echo $r['image']; ?>" width="100" height="100" alt="">
                   <input type="hidden" name="oldimage" value="<?php  $r['image']; ?>">
                </td>
                   <td><span id="insertmsgsignup"><?php echo $statusMsg; ?> </span>
                    </td>
                    </tr>




                    <tr>
                        <td>
                            <p id="form-bottom-txt">
                                By clicking Sign Up, you agree to our <a href="#">Terms</a> <a href="#">Data Policy</a>,
                                <a href="#">Cookie Policy</a>. You may receive SMS notifications from us and can opt out
                                at any time.
                            </p>
                        </td>
                    </tr>
                    <tr>
                        <td>

                            <button type="submit" class="signup-btn">Update</button>

                        </td>

                    </tr>
                    <?php }?>
                </form>
            </table>
           
    </div>


</body>

</html>

