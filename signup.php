<?php include_once('database.php');
 ?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Sign up for Facebook | Facebook</title>
    <link rel="stylesheet" href="css/signup-style.css">
    <link rel="stylesheet" href="css/errorstylesignup.css">
    <script src="signup.js"></script>
</head>

<body>
    <div class="container">
        <div id="img">
            <img src="imgs/fblogo.svg" alt="">
        </div>

        <div class="form-container">

            <div class="form-text">
                <p class="heading-text">Create a new account</p>
                <p class="plain-text">It's quick and easy.</p>
            </div>
            <table>
                <form action="signup.php" method="post" enctype="multipart/form-data">
                    <!-- error msgs -->
                    <tr>
                        <td><span id="existmsgsignup"><?php echo  $showError; ?> </span>

                        </td>
                        <td><span id="insertmsgsignup"><?php echo  $fbuser1->insertmsg; ?> </span>

                        </td>
                        <td><span id="existmsgsignup"><?php echo $statusMsg; ?> </span>
                        </td>
                    </tr>
                    <!-- Input Fields for Signup Form -->
                    <tr>
                        <td><input type="text" name="firstName" id="firstName" placeholder="First name"
                                class="row-field">
                        </td>
                        <td><input type="text" name="surName" id="surName" placeholder="Surname" class="row-field">
                        </td>
                    </tr>
                    <!-- error msgs -->
                    <tr>
                        <td><span id="existmsgsignup"><?php echo  $fbuser1->existmsg; ?> </span>
                            <span id="existmsgsignup"><?php echo  $emailError; ?> </span>
                        </td>
                    </tr>
                    <tr>
                        <!-- email input field -->
                        <td><input type="text" name="email-phone" id="email-phone"
                                placeholder="Mobile number or email address" class="input-field row-field"></td>


                    </tr>
                    <!-- error msgs -->
                    <tr>
                        <td><span id="existmsgsignup"><?php echo  $passError; ?> </span>
                        </td>
                    </tr>
                    <!-- password inpit field -->
                    <tr>
                        <td><input type="password" name="password1" id="password1" placeholder="New password"
                                class="input-field row-field"></td>
                    </tr>
                    <!-- Date of Birth -->
                    <tr>
                        <td> <label for="name" class="label">
                                Date of birth
                            </label></td>
                    </tr>
                    <tr>
                        <td>
                            <select id="date" name="date" class="dob-field row-field">

                                <option value="23" <?php if( $dt=='23') 'selected="selected"'; ?>>23</option>
                                <option value="24" <?php if( $dt=='24') 'selected="selected"'; ?>>24</option>
                                <option value="25" <?php if( $dt=='25') 'selected="selected"'; ?>>25</option>

                            </select>

                        </td>
                        <td>
                            <select id="month" name="month" class="dob-field row-field">

                                <option value="Jan" <?php if($month=='Jan') 'selected="selected"'; ?>>Jan
                                </option>
                                <option value="Feb" <?php if($month=='Feb') 'selected="selected"'; ?>>Feb
                                </option>
                                <option value="March" <?php if($month=='March') 'selected="selected"'; ?>>Mar
                                </option>

                            </select>

                        </td>
                        <td>
                            <select id="year" name="year" class="dob-field row-field">

                                <option value="2022" <?php if($year=='2022') 'selected="selected"'; ?>>2022
                                </option>
                                <option value="2021" <?php if($year=='2021') 'selected="selected"'; ?>>2021
                                </option>
                                <option value="2019" <?php if($year=='2019') 'selected="selected"'; ?>>2019
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
                                type="radio" value="Female" name="gender1" checked></td>
                        <td class="radio-field row-field"> <label for="Male">Male</label><input type="radio"
                                class="radio-circle" value="Male" name="gender1">
                        </td>
                        <td class="radio-field row-field"> <label for="Custom">Custom</label><input type="radio"
                                class="radio-circle" id="Custom" name="gender1" value="Custom"></td>

                    </tr>

                    <tr>
                        <td>

                            <select id="date" name="pronoun1" class="row-field pronoun">
                                <option value="" onmouseover="color()">Select your pronoun</option>
                                <option value='"She: "Wish her a happy birthday!"'>
                                    She: "Wish her a happy birthday!"</option>
                                <option value='He: "Wish him a happy birthday!"'>
                                    He: "Wish him a happy birthday!"</option>
                                <option value='They: "Wish them a happy birthday!"'>
                                    They: "Wish them a happy birthday!"</option>

                            </select>
                            <p id="pronoun">Your pronoun is visible to everyone.</p>



                        </td>

                    </tr>
                    <tr>
                        <td><input type="text" name="Gender" id="Gender" placeholder="Gender (Optional)"
                                class="input-field row-field">
                        </td>

                    </tr>
                    <!-- image to upload -->
                    <tr>
                        <td> <label for="image" class="label">
                                Upload Image
                            </label></td>
                    </tr>
                    <tr>
                        <td> <input id="imagetoupload" type="file" name="image" id="">
                        <input type="submit" value="Upload Image" name="upload">
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

                            <button type="submit" class="signup-btn" name="submit">Sign Up</button>

                        </td>

                    </tr>
                </form>
            </table>
            <a href="login.php" class="a-bottom">Already have an account?</a>
        </div>
    </div>
    <?php include('partials/footer.php');?>

</body>

</html>