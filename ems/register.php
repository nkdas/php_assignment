<?php
require_once('db_connection.php');
require('set_post_data.php');
require('validate.php');
require('db_functions.php');

// $photo to store image file name
if (!$_SESSION['photo']) {
    $photo = "";    
}
// if the form is submitted
if ($_POST['submit']) {
    // set submitted data to an array $record
    $record = set_post_data($_POST, $_FILES, $connection);
    // set session to store the name of the photo so that we can have the photo during resubmission 
    // (in case of validation errors)
    $_SESSION['photo'] = $record['photo'];
    // validate data in $record
    $errors = validate($record, $connection, "register");
    
    if (!$errors) { 
        // encrypt the password
        $record['password'] = md5($record['password']);
        // insert data into the database
    	$status = insert_record($record, $connection);
        if ($status == 1) {
            header("Location: mail.php");
        }
        else {
            $errors .= $status;
        }
    }
    
}
?>

<body data-spy="scroll" data-target=".navbar" data-offset="50">

    <!-- Navigation bar -->
    <nav class="navbar navbar-inverse" data-spy="affix" >
        <div class="container-fluid">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar"> 
                    <span class="icon-bar"></span> 
                    <span class="icon-bar"></span> 
                    <span class="icon-bar"></span> 
                </button>
                <a class="navbar-brand" href="index.php">EMS</a> 
                <a class="navbar-brand" href="index.php">Back</a>
            </div>
            <div>
                <div class="collapse navbar-collapse" id="myNavbar">
                    <ul class="nav navbar-nav">
                        <li><a href="#section1">Basic Information</a></li>
                        <li><a href="#section2">Residence Details</a></li>
                        <li><a href="#section3">Office Details</a></li>
                        <li><a href="#section4">Other Details</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>
   
    <!-- Registration form -->
<<<<<<< HEAD
    <form id="section1" name="form" class="form" enctype="multipart/form-data" action="register.php" onsubmit="return validate('register');" method="post">
=======
    <form id="section1" class="form" enctype="multipart/form-data" action="register.php" method="post">
>>>>>>> 31d8f3c8993cf33afb6207eb8b431cf60d969658
        <div id="section1" class="container-fluid">

            <!-- This div is used to display messages to the user -->
            <div class="row">
                <div class="col-md-12">
                    <div id="message" class="jumbotron">
                        <?php

                        // if errors exit then show the div and the errors
                        if ($errors) {
                            echo "<br><label class='myLabel'>Please Fix the following errors:</label><br>";
                            foreach($errors as $e => $e_value) {
                                echo "<label class='myLabel'>" . $e_value . "</label>"; 
                                echo "<br>";
                            }
                            echo '<style type="text/css">

                            #message { 
                                display: block;
                            }
                            </style>';
                        }

                         // if errors doesnot exit then hide the div
                        else {
                            echo '<style type="text/css">
                            #message { 
                                display: none; 
                            }
                            </style>';
                        }
                        ?>
                    </div>
                </div>
            </div>

            <h1>Basic Information</h1>
            
            <div class="row">
                <div class="col-md-3">
                    <label class="myLabel">Profile photo:</label>
                    <img id="profilePhoto" src="images/<?php if ($record['photo']) { echo $record['photo']; } else { echo 'userTile.png'; }?>" class="img-responsive" alt="Profile photo"><br>
                    <input name="photo" id="uploadBtn" type="file" accept="image/x-png, image/gif, image/jpeg" onchange="readURL(this);"><br>
                </div>
                <div class="col-md-9">

                    <div class="row"> <!-- Username and password -->
                        <div class="col-sm-4">
                            <label class="myLabel">Username:</label>
                            <div class="form-group">
                                <input name="username" type="text" class="form-control" id="username" value="<?php echo $record['username']; ?>">
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <label class="myLabel">Password:</label>
                            <div class="form-group">
                                <input name="password" type="password" class="form-control" id="password" value="<?php echo $record['password']; ?>">
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <label class="myLabel">Re-enter Password:</label>
                            <div class="form-group">
                                <input name="rpassword" type="password" class="form-control" id="rpassword" value="<?php echo $record['rpassword']; ?>">
                            </div>
                        </div>
                    </div> <!-- Row ends -->

                    <label class="myLabel">Name:</label>
<<<<<<< HEAD
=======
                    
>>>>>>> 31d8f3c8993cf33afb6207eb8b431cf60d969658
                    <div class="row"> <!-- Name -->
                        <div class="col-sm-4">
                            <div class="form-group">
                                <input name="firstname" type="text" class="form-control" id="firstname" placeholder="First name" value="<?php echo $record['firstname']; ?>">
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <input name="middlename" type="text" class="form-control" id="middlename" placeholder="Middle name" value="<?php echo $record['middlename']; ?>">
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <input name="lastname" type="text" class="form-control" id="lastname" placeholder="Last name" value="<?php echo $record['lastname']; ?>">
                            </div>
                        </div>
                    </div> <!-- Row ends -->
                    
                    <div class="row"> <!-- Suffix -->
                        <div class="col-md-4">
                            <label class="myLabel">Suffix:</label>
                            <select name="suffixSelector" class="form-control" id="suffixSelector">
                                <option <?php if($record['suffix'] == "M.Tech") {echo "selected";} ?> >M.Tech</option>
                                <option <?php if($record['suffix'] == "B.Tech") {echo "selected";} ?> >B.Tech</option>
                                <option <?php if($record['suffix'] == "M.B.A") {echo "selected";} ?> >M.B.A</option>
                                <option <?php if($record['suffix'] == "B.B.A") {echo "selected";} ?> >B.B.A</option>
                                <option <?php if($record['suffix'] == "M.C.A") {echo "selected";} ?> >M.C.A</option>
                                <option <?php if($record['suffix'] == "B.C.A") {echo "selected";} ?> >B.C.A</option>
                                <option <?php if($record['suffix'] == "Ph.D") {echo "selected";} ?> >Ph.D</option>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="myLabel">Date of Birth:</label>
                                <div class="form-group date">
                                    <input name="datePicker" type="date" class="form-control" id="datePicker" placeholder="mm/dd/yyyy" value="<?php echo $record['dob']; ?>">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label class="myLabel">Marital status:</label>
                            <select name="maritalSelector" class="form-control" id="maritalSelector">
                                <option <?php if($record['marital'] == "Single") {echo "selected";} ?> >Single</option>
                                <option <?php if($record['marital'] == "Married") {echo "selected";} ?> >Married</option>
                                <option <?php if($record['marital'] == "Separated") {echo "selected";} ?> >Separated</option>
                                <option <?php if($record['marital'] == "Divorced") {echo "selected";} ?> >Divorced</option>
                                <option <?php if($record['marital'] == "Widowed") {echo "selected";} ?> >Widowed</option>
                            </select>
                        </div>
                    </div> <!-- Row ends -->

                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="myLabel">Employment:</label>
                                <select name="employementSelector" class="form-control" id="employementSelector">
                                    <option <?php if($record['employment'] == "Student") {echo "selected";} ?> >Student</option>
                                    <option <?php if($record['employment'] == "Self-employed") {echo "selected";} ?> >Self-employed</option>
                                    <option <?php if($record['employment'] == "Unemployed") {echo "selected";} ?> >Unemployed</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="myLabel">Employer:</label>
                                <input name="employer" type="text" class="form-control" id="employer" value="<?php echo $record['employer']; ?>">
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label class="myLabel">Email:</label>
                                <input name="email" type="text" class="form-control" id="email" placeholder="someone@example.com" value="<?php echo $record['email']; ?>">
                            </div>
                        </div>
                    </div> <!-- Row ends -->

                    <div class="row"> <!-- Row starts -->
                        <div class="col-md-12">
                            <div class="radio">
                                <label id="genderLabel">Gender:</label>&nbsp;&nbsp;
<<<<<<< HEAD
                                <label><input id="male" type="radio" name="genderRadio" value="1" <?php if($record['gender'] == "1") {echo "checked";} ?> >Male</label>&nbsp;&nbsp;
                                <label><input id="female" type="radio" name="genderRadio" value="2" <?php if($record['gender'] == "2") {echo "checked";} ?> >Female</label>
=======
                                <label><input type="radio" name="genderRadio" value="1" <?php if($record['gender'] == "1") {echo "checked";} ?> >Male</label>&nbsp;&nbsp;
                                <label><input type="radio" name="genderRadio" value="2" <?php if($record['gender'] == "2") {echo "checked";} ?> >Female</label>
>>>>>>> 31d8f3c8993cf33afb6207eb8b431cf60d969658
                            </div>
                        </div>
                    </div> <!-- Row ends -->

                </div>
            </div>
        </div>

        <div id="section2" class="container-fluid">
            <h1>Residence Details</h1>
            <div class="row"> <!-- Create labels -->
                <div class="col-md-12">
                    <label class="myLabel">Address:</label>
                </div>
            </div>
            <div class="row"> <!-- Create input fields -->
                <div class="col-sm-3">
                    <div class="form-group">
                        <input name="street" type="text" class="form-control" id="street" placeholder="Street" value="<?php echo $record['street']; ?>">
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="form-group">
                        <input name="city" type="text" class="form-control" id="city" placeholder="City" value="<?php echo $record['city']; ?>">
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="form-group">
                        <input name="state" type="text" class="form-control" id="state" placeholder="State" value="<?php echo $record['state']; ?>">
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="form-group">
                        <input name="zip" type="text" class="form-control" id="zip" placeholder="Zip" value="<?php echo $record['zip']; ?>">
                    </div>
                </div>
            </div>
            
            <div class="row"> <!-- Create labels -->
                <div class="col-md-8">
                    <label class="myLabel">Contact:</label>
                </div>
            </div>
            <div class="row"> <!-- Create input fields -->
                <div class="col-sm-3">
                    <div class="form-group">
                        <input name="telephone" type="text" class="form-control" id="telephone" placeholder="Telephone" value="<?php echo $record['telephone']; ?>">
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="form-group">
                        <input name="mobile" type="text" class="form-control" id="mobile" placeholder="Mobile" value="<?php echo $record['mobile']; ?>">
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="form-group">
                        <input name="fax" type="text" class="form-control" id="fax" placeholder="Fax" value="<?php echo $record['fax']; ?>">
                    </div>
                </div>
            </div>
        </div>
        <div id="section3" class="container-fluid">
            <h1>Office Details</h1>
            <div class="row"> <!-- Create labels -->
                <div class="col-md-12">
                    <label class="myLabel">Address:</label>
                </div>
            </div>
            <div class="row"> <!-- Create input fields -->
                <div class="col-sm-3">
                    <div class="form-group">
                        <input name="ostreet" type="text" class="form-control" id="ostreet" placeholder="Street" value="<?php echo $record['ostreet']; ?>">
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="form-group">
                        <input name="ocity" type="text" class="form-control" id="ocity" placeholder="City" value="<?php echo $record['ocity']; ?>">
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="form-group">
                        <input name="ostate" type="text" class="form-control" id="ostate" placeholder="State" value="<?php echo $record['ostate']; ?>">
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="form-group">
                        <input name="ozip" type="text" class="form-control" id="ozip" placeholder="Zip" value="<?php echo $record['ozip']; ?>">
                    </div>
                </div>
            </div>
            
            <div class="row"> <!-- Create labels -->
                <div class="col-md-8">
                    <label class="myLabel">Contact:</label>
                </div>
            </div>
            <div class="row"> <!-- Create input fields -->
                <div class="col-sm-3">
                    <div class="form-group">
                        <input name="otelephone" type="text" class="form-control" id="otelephone" placeholder="Telephone" value="<?php echo $record['otelephone']; ?>">
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="form-group">
                        <input name="omobile" type="text" class="form-control" id="omobile" placeholder="Mobile" value="<?php echo $record['omobile']; ?>">
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="form-group">
                        <input name="ofax" type="text" class="form-control" id="ofax" placeholder="Fax" value="<?php echo $record['ofax']; ?>">
                    </div>
                </div>
            </div>
        </div>
        <div id="section4" class="container-fluid">
            <h1>Other Details</h1>
                <div class="row"> <!-- Create labels -->
                    <div class="col-md-8">
                        <label class="myLabel">Prefered mode of communication:</label>
                    </div>
                </div>
                <div class="row"> <!-- Create input fields -->
                    <div class="col-sm-3">
                        <div class="checkbox">
                            <label><input name="emailCheck" type="checkbox" value="1" <?php if($record['emailcheck'] == "1") {echo "checked";} ?> >Email</label>
                        </div>
                </div>
                <div class="col-sm-3">
                    <div class="checkbox">
                        <label><input name="messageCheck" type="checkbox" value="1" <?php if($record['messagecheck'] == "1") {echo "checked";} ?> >Message</label>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="checkbox">
                        <label><input name="phoneCheck" type="checkbox" value="1" <?php if($record['phonecheck'] == "1") {echo "checked";} ?> >Phone call</label>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="checkbox">
                        <label><input name="anyCheck" type="checkbox" value="1" <?php if($record['anycheck'] == "1") {echo "checked";} ?> >Any</label>
                    </div>
                </div>
            </div>
            <div class="row"> <!-- Create input fields -->
                <div class="col-sm-12">
                    <div class="form-group">
                        <label class="myLabel">More about you:</label>
                        <textarea name="more" class="form-control" rows="5" id="more"><?php echo stripslashes($record['more']); ?></textarea>
                    </div>
                </div>
            </div>
        </div>
        <div id="section5" class="container-fluid">
            <div class="row"> <!-- Create input fields -->
                <div class="col-sm-12">
                    <input name="submit" type="submit" class="btn btn-default" value="submit">
                </div>
            </div>
        </div>
    </form>
</body>
<?php require_once('footer.php'); ?>