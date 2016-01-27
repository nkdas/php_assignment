 <?php 
require_once('db_connection.php');
require('set_post_data.php');
require('validate.php');
require('db_functions.php');

// variable to store the file name of the photo
if (!$_SESSION['photo']) {
    $photo = "";    
}
// if the user has submitted the form
if ($_POST['update']) {   
    $userId = $_SESSION['id'];
    // set the submitted data to the array $row
    $row = set_post_data($_POST, $_FILES, $connection);
    // validate $row
    $errors = validate($row, $connection, "update");

    // if no error exists from the user side after validation then update the details of the user
    if (!$errors) { 
        $status = update_record($userId, $connection, $row);
        if($status == 1) {
            $_SESSION['message'] = "Your changes have been saved successfully";
            header("Location: home.php");
        }
        else {
            $_SESSION['message'] = "Sorry! Unable to save your changes";
            header("Location: home.php");
        }
    }
}
else {
    // populate the fields for editing if user is logged in
    if ($_SESSION['id']) {
        $userId = $_SESSION['id'];
        $row = get_record_for_updation($userId, $connection);
        $_SESSION['photo'] = $row['photo'];
    }
    else {
        header("Location: index.php");
    }
}
?>

<body data-spy="scroll" data-target=".navbar">
    <nav class="navbar navbar-inverse" data-spy="affix" >
        <div class="container-fluid">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar"> 
                    <span class="icon-bar"></span> 
                    <span class="icon-bar"></span> 
                    <span class="icon-bar"></span> 
                </button>
                <a class="navbar-brand" href="home.php"><?php echo htmlentities($row['firstname']) . " " . htmlentities($row['middlename']) . " " . htmlentities($row['lastname']);?></a>
                <a class="navbar-brand" href="home.php">Back</a>
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
    <form id="section1" class="form" enctype="multipart/form-data" onsubmit="return validate('edit');" action="edit.php"  method="post">
        <div id="section1" class="container-fluid">
            <!-- this div is used to display messages to the user -->
            <div class="row">
                <div class="col-md-12">
                    <div id="message" class="jumbotron">
                        <?php

                        // if error exists then show the div and the errors
                        if ($errors) {
                            echo "<br><label class='myLabel'>Please Fix the following errors: </label><br>";
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
                        // if error doesnot exists then hide the div
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
                    <img id="profilePhoto" src="images/<?php if ($row['photo']) { echo $row['photo']; } else { echo 'userTile.png'; }?>" class="img-responsive" alt="Profile photo"><br>
                    <input id="uploadBtn" name="photo" type="file" accept="image/x-png, image/gif, image/jpeg" onchange="readURL(this);"><br>
                </div>
                <div class="col-md-9">

                    <label class="myLabel">Name:</label>
                    
                    <div class="row"> <!-- New row for the name -->
                        <div class="col-sm-4">
                            <div class="form-group">
                                <input name="firstname" type="text" class="form-control" id="firstname" placeholder="First name" value="<?php echo htmlentities($row['firstname']); ?>">
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <input name="middlename" type="text" class="form-control" id="middlename" placeholder="Middle name" value="<?php echo htmlentities($row['middlename']); ?>">
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <input name="lastname" type="text" class="form-control" id="lastname" placeholder="Last name" value="<?php echo htmlentities($row['lastname']); ?>">
                            </div>
                        </div>
                    </div> <!-- Row ends -->
                    
                    <div class="row"> <!-- Row starts -->
                        <div class="col-md-4">
                            <label class="myLabel">Suffix:</label>
                            <select name="suffixSelector" class="form-control" id="suffixSelector">
                                <option <?php if($row['suffix'] == "M.Tech") {echo "selected";} ?> >M.Tech</option>
                                <option <?php if($row['suffix'] == "B.Tech") {echo "selected";} ?> >B.Tech</option>
                                <option <?php if($row['suffix'] == "M.B.A") {echo "selected";} ?> >M.B.A</option>
                                <option <?php if($row['suffix'] == "B.B.A") {echo "selected";} ?> >B.B.A</option>
                                <option <?php if($row['suffix'] == "M.C.A") {echo "selected";} ?> >M.C.A</option>
                                <option <?php if($row['suffix'] == "B.C.A") {echo "selected";} ?> >B.C.A</option>
                                <option <?php if($row['suffix'] == "Ph.D") {echo "selected";} ?> >Ph.D</option>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="myLabel">Date of Birth:</label>
                                <div class="form-group date">
                                    <input name="datePicker" type="date" class="form-control" id="datePicker" placeholder="mm/dd/yyyy" value="<?php echo $row['dob']; ?>">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label class="myLabel">Marital status:</label>
                            <select name="maritalSelector" class="form-control" id="maritalSelector">
                                <option <?php if($row['marital'] == "Single") {echo "selected";} ?> >Single</option>
                                <option <?php if($row['marital'] == "Married") {echo "selected";} ?> >Married</option>
                                <option <?php if($row['marital'] == "Separated") {echo "selected";} ?> >Separated</option>
                                <option <?php if($row['marital'] == "Divorced") {echo "selected";} ?> >Divorced</option>
                                <option <?php if($row['marital'] == "Widowed") {echo "selected";} ?> >Widowed</option>
                            </select>
                        </div>
                    </div> <!-- Row ends -->

                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="myLabel">Employment:</label>
                                <select name="employementSelector" class="form-control" id="employementSelector">
                                    <option <?php if($row['employement'] == "Student") {echo "selected";} ?> >Student</option>
                                    <option <?php if($row['employement'] == "Self-employed") {echo "selected";} ?> >Self-employed</option>
                                    <option <?php if($row['employement'] == "Unemployed") {echo "selected";} ?> >Unemployed</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="myLabel">Employer:</label>
                                <input name="employer" type="text" class="form-control" id="employer" value="<?php echo htmlentities($row['employer']); ?>">
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label class="myLabel">Email:</label>
                                <input name="email" type="text" class="form-control" id="email" placeholder="someone@example.com" value="<?php echo htmlentities($row['email']); ?>">
                            </div>
                        </div>
                    </div> <!-- Row ends -->

                    <div class="row"> <!-- Row starts -->
                        <div class="col-md-12">
                            <div class="radio">
                                <label id="genderLabel">Gender:</label>&nbsp;&nbsp;
                                <label><input type="radio" id="male" name="genderRadio" value="1" <?php if($row['gender'] == "1") {echo "checked";} ?> >Male</label>&nbsp;&nbsp;
                                <label><input type="radio" id="female" name="genderRadio" value="2" <?php if($row['gender'] == "2") {echo "checked";} ?> >Female</label>
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
                        <input name="street" type="text" class="form-control" id="street" placeholder="Street" value="<?php echo htmlentities($row['street']); ?>">
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="form-group">
                        <input name="city" type="text" class="form-control" id="city" placeholder="City" value="<?php echo htmlentities($row['city']); ?>">
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="form-group">
                        <input name="state" type="text" class="form-control" id="state" placeholder="State" value="<?php echo htmlentities($row['state']); ?>">
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="form-group">
                        <input name="zip" type="text" class="form-control" id="zip" placeholder="Zip" value="<?php echo htmlentities($row['zip']); ?>">
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
                        <input name="telephone" type="text" class="form-control" id="telephone" placeholder="Telephone" value="<?php echo htmlentities($row['telephone']); ?>">
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="form-group">
                        <input name="mobile" type="text" class="form-control" id="mobile" placeholder="Mobile" value="<?php echo htmlentities($row['mobile']); ?>">
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="form-group">
                        <input name="fax" type="text" class="form-control" id="fax" placeholder="Fax" value="<?php echo htmlentities($row['fax']); ?>">
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
                        <input name="ostreet" type="text" class="form-control" id="ostreet" placeholder="Street" value="<?php echo htmlentities($row['ostreet']); ?>">
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="form-group">
                        <input name="ocity" type="text" class="form-control" id="ocity" placeholder="City" value="<?php echo htmlentities($row['ocity']); ?>">
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="form-group">
                        <input name="ostate" type="text" class="form-control" id="ostate" placeholder="State" value="<?php echo htmlentities($row['ostate']); ?>">
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="form-group">
                        <input name="ozip" type="text" class="form-control" id="ozip" placeholder="Zip" value="<?php echo htmlentities($row['ozip']); ?>">
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
                        <input name="otelephone" type="text" class="form-control" id="otelephone" placeholder="Telephone" value="<?php echo htmlentities($row['otelephone']); ?>">
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="form-group">
                        <input name="omobile" type="text" class="form-control" id="omobile" placeholder="Mobile" value="<?php echo htmlentities($row['omobile']); ?>">
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="form-group">
                        <input name="ofax" type="text" class="form-control" id="ofax" placeholder="Fax" value="<?php echo htmlentities($row['ofax']); ?>">
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
                            <label><input name="emailCheck" type="checkbox" value="1" <?php if($row['emailcheck'] == "1") {echo "checked";} ?> >Email</label>
                        </div>
                </div>
                <div class="col-sm-3">
                    <div class="checkbox">
                        <label><input name="messageCheck" type="checkbox" value="1" <?php if($row['messagecheck'] == "1") {echo "checked";} ?> >Message</label>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="checkbox">
                        <label><input name="phoneCheck" type="checkbox" value="1" <?php if($row['phonecheck'] == "1") {echo "checked";} ?> >Phone call</label>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="checkbox">
                        <label><input name="anyCheck" type="checkbox" value="1" <?php if($row['anycheck'] == "1") {echo "checked";} ?> >Any</label>
                    </div>
                </div>
            </div>
            <div class="row"> <!-- Create input fields -->
                <div class="col-sm-12">
                    <div class="form-group">
                        <label class="myLabel">More about you:</label>
                        <textarea name="more" class="form-control" rows="5" id="more"><?php echo htmlentities(stripslashes($row['more'])); ?></textarea>
                    </div>
                </div>
            </div>
        </div>
        <div id="section5" class="container-fluid">
            <div class="row"> <!-- Create input fields -->
                <div class="col-sm-12">
                    <input name="update" type="submit" class="btn btn-default" value="Update">
                </div>
            </div>
        </div>
    </form>
</body>
<?php require_once('footer.php'); ?>