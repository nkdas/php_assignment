<?php 
require_once('db_connection.php');
require('header.php');

// this variable acts as a flag to determine if user details are retrieved successfully from the database
// and weather to show the home page or not
$pass = 0;
if (isset($_SESSION['message'])) {
    $message = $_SESSION['message'];
    $_SESSION['message'] = null;
}

// check if user is signed in
if (isset($_SESSION['id'])) {
    $userId = $_SESSION['id'];

    // fetch user details from the database
    $query = mysqli_query($connection, "SELECT username, password, firstname, middlename, lastname, suffix, gender, dob, marital, employement, employer, email, 
            street, city, state, zip, telephone, mobile, fax, ostreet, ocity, ostate, ozip, otelephone, omobile, ofax,
            emailcheck, messagecheck, phonecheck, anycheck, more, photo
            FROM details
            WHERE id = $userId");
    if ($query and $row = mysqli_fetch_assoc($query)) { 
        $pass = 1;
        $name = $row['firstname'] . " " . $row['middlename'] . " " . $row['lastname'];
        $_SESSION['name'] = $name;
    }
}
// if user is not signed in, then redirect to index.php
else {
    header("Location: index.php");
}
?>

<?php if ($pass == 1) { ?>
<body>
    <nav class="navbar navbar-inverse" data-spy="affix">
        <div class="container-fluid">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#homeNavbar"> 
                    <span class="icon-bar"></span> 
                    <span class="icon-bar"></span> 
                    <span class="icon-bar"></span> 
                </button>
                <a class="navbar-brand" href="#">
                    <?php echo htmlentities($name); ?>
                </a> 
            </div>
            <div>
                <div class="collapse navbar-collapse" id="homeNavbar">
                    <ul class="nav navbar-nav">
                        <li><a href="edit.php">Edit profile</a></li>
                        <li><a href="change_password.php">Change password</a></li>
                        <li><a href="logout.php">Sign out</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>
    <div id="section1" class="container-fluid">
        <!-- This div is used to display messages to the user -->
        <div class="row">
            <div class="col-md-12">
                <?php
                    if ($message) {
                        echo '<div id="message" class="jumbotron visibleDiv">';
                        echo '<label class="myLabel">'.$message.'</label></div>';
                        if (!$_SESSION['id']) {
                            session_unset();
                            session_destroy();
                        }
                    }
                ?>
            </div>
        </div> <!-- row ends -->

        <div class="row">
            <div class="col-md-2">
                <img id="profilePhoto" src="images/<?php if ($row['photo']) { echo $row['photo']; } else { echo 'userTile.png'; }?>" class="img-responsive" alt="Profile photo"><br>
            </div>

            <div class="col-md-10">
                <div id="homeBgDiv">
                    <div class="row">
                        <div class="col-md-6">    
                            <h3 id="homeHeading" class="homeHeading">Basic information</h3>
                            
                            <div class="row"> <!-- Name -->
                                <div class="col-sm-4">
                                    <label class="myLabel">Name:</label>
                                </div>
                                <div class="col-sm-8">
                                    <label class="myLabel">
                                        <?php echo htmlentities($row['firstname']) . " " . htmlentities($row['middlename']) . " " . htmlentities($row['lastname']);?>
                                    </label>
                                </div>
                            </div> <!-- Row ends -->

                            <div class="row"> <!-- Suffix -->
                                <div class="col-sm-4">
                                    <label class="myLabel">Suffix:</label>
                                </div>
                                <div class="col-sm-8">
                                    <label class="myLabel">
                                        <?php echo htmlentities($row['suffix']); ?>
                                    </label>
                                </div>
                            </div> <!-- Row ends -->

                            <div class="row"> <!-- Gender -->
                                <div class="col-sm-4">
                                    <label class="myLabel">Gender:</label>
                                </div>
                                <div class="col-sm-8">
                                    <label class="myLabel">
                                        <?php if ($row['gender'] == '1') { echo "Male"; } else { echo "Female"; } ?>
                                    </label>
                                </div>
                            </div> <!-- Row ends -->

                            <div class="row"> <!-- DOB -->
                                <div class="col-sm-4">
                                    <label class="myLabel">Date of Birth:</label>
                                </div>
                                <div class="col-sm-8">
                                    <label class="myLabel">
                                        <?php echo htmlentities($row['dob']); ?>
                                    </label>
                                </div>
                            </div> <!-- Row ends -->

                            <div class="row"> <!-- Marital Status -->
                                <div class="col-sm-4">
                                    <label class="myLabel">Marital Status:</label>
                                </div>
                                <div class="col-sm-8">
                                    <label class="myLabel">
                                        <?php echo $row['marital']; ?>
                                    </label>
                                </div>
                            </div> <!-- Row ends -->

                            <div class="row"> <!-- Employement -->
                                <div class="col-sm-4">
                                    <label class="myLabel">Employement:</label>
                                </div>
                                <div class="col-sm-8">
                                    <label class="myLabel">
                                        <?php echo $row['employement']; ?>
                                    </label>
                                </div>
                            </div> <!-- Row ends -->

                            <div class="row"> <!-- Employer-->
                                <div class="col-sm-4">
                                    <label class="myLabel">Employer:</label>
                                </div>
                                <div class="col-sm-8">
                                    <label class="myLabel">
                                        <?php echo htmlentities($row['employer']); ?>
                                    </label>
                                </div>
                            </div> <!-- Row ends -->

                            <div class="row"> <!-- Email -->
                                <div class="col-sm-4">
                                    <label class="myLabel">Email:</label>
                                </div>
                                <div class="col-sm-8">
                                    <label class="myLabel">
                                        <?php echo htmlentities($row['email']); ?>
                                    </label>
                                </div>
                            </div> <!-- Row ends -->
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">       
                            <h3 class="homeHeading">Residence details</h3>
                            <div class="row"> <!-- Street -->
                                <div class="col-sm-4">
                                    <label class="myLabel">Street:</label>
                                </div>
                                <div class="col-sm-8">
                                    <label class="myLabel">
                                        <?php echo htmlentities($row['street']); ?>
                                    </label>
                                </div>
                            </div> <!-- Row ends -->

                            <div class="row"> <!-- City -->
                                <div class="col-sm-4">
                                    <label class="myLabel">City:</label>
                                </div>
                                <div class="col-sm-8">
                                    <label class="myLabel">
                                        <?php echo htmlentities($row['city']); ?>
                                    </label>
                                </div>
                            </div> <!-- Row ends -->

                            <div class="row"> <!-- State -->
                                <div class="col-sm-4">
                                    <label class="myLabel">State:</label>
                                </div>
                                <div class="col-sm-8">
                                    <label class="myLabel">
                                        <?php echo htmlentities($row['state']); ?>
                                    </label>
                                </div>
                            </div> <!-- Row ends -->

                            <div class="row"> <!-- Zip -->
                                <div class="col-sm-4">
                                    <label class="myLabel">Zip:</label>
                                </div>
                                <div class="col-sm-8">
                                    <label class="myLabel">
                                        <?php echo htmlentities($row['zip']); ?>
                                    </label>
                                </div>
                            </div> <!-- Row ends -->

                            <div class="row"> <!-- Telephone -->
                                <div class="col-sm-4">
                                    <label class="myLabel">Telephone:</label>
                                </div>
                                <div class="col-sm-8">
                                    <label class="myLabel">
                                        <?php echo htmlentities($row['telephone']); ?>
                                    </label>
                                </div>
                            </div> <!-- Row ends -->

                            <div class="row"> <!-- Mobile -->
                                <div class="col-sm-4">
                                    <label class="myLabel">Mobile:</label>
                                </div>
                                <div class="col-sm-8">
                                    <label class="myLabel">
                                        <?php echo htmlentities($row['mobile']); ?>
                                    </label>
                                </div>
                            </div> <!-- Row ends -->

                            <div class="row"> <!-- Fax -->
                                <div class="col-sm-4">
                                    <label class="myLabel">Fax:</label>
                                </div>
                                <div class="col-sm-8">
                                    <label class="myLabel">
                                        <?php echo htmlentities($row['fax']); ?>
                                    </label>
                                </div>
                            </div> <!-- Row ends -->
                        </div>

                        <div class="col-md-6"> 
                            <h3 class="homeHeading">Office details</h3>
                            <div class="row"> <!-- Street -->
                                <div class="col-sm-4">
                                    <label class="myLabel">Street:</label>
                                </div>
                                <div class="col-sm-8">
                                    <label class="myLabel">
                                        <?php echo htmlentities($row['ostreet']); ?>
                                    </label>
                                </div>
                            </div> <!-- Row ends -->

                            <div class="row"> <!-- City -->
                                <div class="col-sm-4">
                                    <label class="myLabel">City:</label>
                                </div>
                                <div class="col-sm-8">
                                    <label class="myLabel">
                                        <?php echo htmlentities($row['ocity']); ?>
                                    </label>
                                </div>
                            </div> <!-- Row ends -->

                            <div class="row"> <!-- State -->
                                <div class="col-sm-4">
                                    <label class="myLabel">State:</label>
                                </div>
                                <div class="col-sm-8">
                                    <label class="myLabel">
                                        <?php echo htmlentities($row['ostate']); ?>
                                    </label>
                                </div>
                            </div> <!-- Row ends -->

                            <div class="row"> <!-- Zip -->
                                <div class="col-sm-4">
                                    <label class="myLabel">Zip:</label>
                                </div>
                                <div class="col-sm-8">
                                    <label class="myLabel">
                                        <?php echo htmlentities($row['ozip']); ?>
                                    </label>
                                </div>
                            </div> <!-- Row ends -->

                            <div class="row"> <!-- Telephone -->
                                <div class="col-sm-4">
                                    <label class="myLabel">Telephone:</label>
                                </div>
                                <div class="col-sm-8">
                                    <label class="myLabel">
                                        <?php echo htmlentities($row['otelephone']); ?>
                                    </label>
                                </div>
                            </div> <!-- Row ends -->

                            <div class="row"> <!-- Mobile -->
                                <div class="col-sm-4">
                                    <label class="myLabel">Mobile:</label>
                                </div>
                                <div class="col-sm-8">
                                    <label class="myLabel">
                                        <?php echo htmlentities($row['omobile']); ?>
                                    </label>
                                </div>
                            </div> <!-- Row ends -->

                            <div class="row"> <!-- Fax -->
                                <div class="col-sm-4">
                                    <label class="myLabel">Fax:</label>
                                </div>
                                <div class="col-sm-8">
                                    <label class="myLabel">
                                        <?php echo htmlentities($row['ofax']); ?>
                                    </label>
                                </div>
                            </div> <!-- Row ends -->
                        </div>    
                    </div>
                </div>
            </div>
        </div><br>
    </div>
</body>
<?php } else { header("Location: index.php"); }?>
<?php require_once('footer.php'); ?>