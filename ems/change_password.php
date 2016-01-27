<?php 
require_once('db_connection.php');
try {
    $key = $_GET['key'];
    if(!$_SESSION['key']) {
        $_SESSION['key'] = $key;
    }
}
catch (Exception $ex) {}

// check if the user is signed in
if ($_SESSION['id'] || $_SESSION['key']) {
    
    if(!$_SESSION['key']) {
        $userId = $_SESSION['id'];
        $name = $_SESSION['name'];
    }
    // check if the user has submitted the form
    if ($_POST['submit']) {
        // fetch form details  from $_POST
        if(!$_SESSION['key']) {
            $password = mysqli_real_escape_string($connection, trim($_POST['password']));
        }
        $newPassword = mysqli_real_escape_string($connection, trim($_POST['newPassword']));
        $rNewPassword = mysqli_real_escape_string($connection, trim($_POST['rNewPassword']));
          
        // array to store the errors
        $errors = array(); 
        //i serves as the key or index to the array errors.
        $i = 1; 

        // check if the new password meets length requirements
        if (strlen($newPassword) < 6) {
            $errors[$i] = "Passwords must be of at least 6 characters";
            $i++;
        } 
        // check if new password and repeat new password fields contain the same value
        if($newPassword != $rNewPassword) {
            $errors[$i] = "Passwords entered in the 'Password' and 'Re-enter Password' fields donot match";
            $i++;
        }

        if(!$_SESSION['key']) {
            $passwordBackup = $password;
            $password = md5($password);
        }
        $newPasswordBackup = $newPassword;
        $rNewPasswordBackup = $rNewPassword;

        $newPassword = md5($newPassword);
        $rNewPassword = md5($rNewPassword);

        if(!$_SESSION['key']) {
            // fetch old password from the database
            $query = mysqli_query($connection, "SELECT password 
                                FROM details 
                                WHERE id = '$userId'");
            if ($query and $row = mysqli_fetch_assoc($query)) {
                $opassword = $row['password'];

                    // check if the password matches with the old password
                    if($password != $opassword) {
                    $errors[$i] = "The old password you entered is invalid";
                    $i++;
                }
            }
        }

        // if no errors exists then update the new password and redirect to users home page
        if (!$errors) { 
            if(!$_SESSION['key']) {
                $query = mysqli_query($connection, "UPDATE details SET password = '$newPassword'
                        WHERE id = $userId");
                if($query) {
                    $_SESSION['message'] = "Your password was changed successfully";
                    header("Location: home.php");
                }
            }
            else {
                $activation_key = $_SESSION['key'];
                $query = mysqli_query($connection, "UPDATE details SET password = '$newPassword'
                        WHERE activation_key = '$activation_key'");
                if($query) {
                    $_SESSION['message'] = "Your password was changed successfully";
                    header("Location: index.php");
                }
                else
                {
                    $_SESSION['message'] = "Unable to change your password!<br>Please try again.";
                    header("Location: index.php");
                }
            }
        }
    }
    if ($_POST['cancel']) {
        if(!$_SESSION['key']) {
            header("Location: home.php");
        }
        else {
            header("Location: index.php");
        }
    }
}
else
{
    header("Location: index.php");
}
?>
    <body>
        <?php if (!$_SESSION['key']) { ?>
        <nav class="navbar navbar-inverse" data-spy="affix">
            <div class="container-fluid">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#homeNavbar"> 
                        <span class="icon-bar"></span> 
                        <span class="icon-bar"></span> 
                        <span class="icon-bar"></span> 
                    </button>
                    <a class="navbar-brand" href="home.php">
                        <?php if (!$_SESSION['key']) {echo htmlentities($name);} ?>
                    </a> 
                </div>
                <div>
                    <div class="collapse navbar-collapse" id="homeNavbar">
                        <ul class="nav navbar-nav">
                            <li><a href="home.php">Back</a></li>
                            <li><a href="edit.php">Edit profile</a></li>
                            <li><a href="logout.php">Sign out</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </nav>
        <?php } ?>
        <section id="section1" class="container-fluid">

            <div class="row">  
                <div class="col-md-1">            
                </div>
                <div class="col-md-6">
                    <h1 id="mainHeader">EMS</h1>
                    <h3>Change password</h3>
                </div>
                <div class="col-md-4">
                    <div class="row">
                        <div class="col-md-12">
                            <div id="message" class="jumbotron">
                                <?php
                                if ($errors) {
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
                                // if errors doesnot exist then hide the div
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
                    </div> <!-- end of message div -->

                    <form class="form" method="post" action="change_password.php">
                        <div class="row">
                            <div class="col-md-12"> 
                                <div id="loginForm" class="jumbotron">
                                    <div class="form-group">
                                        <?php if (!$_SESSION['key']) { ?>
                                        <label class="myLabel">Old Password</label>
                                        <input name="password" type="password" class="form-control" id="password" value='<?php echo htmlentities($passwordBackup) ?>'><br>
                                        <?php } ?>
                                        <label class="myLabel">New Password</label>
                                        <input name="newPassword" type="password" class="form-control" id="newPassword" value='<?php echo htmlentities($newPasswordBackup) ?>'><br>
                                        <label class="myLabel">Re-enter New Password</label>
                                        <input name="rNewPassword" type="password" class="form-control" id="rNewPassword" value='<?php echo htmlentities($rNewPasswordBackup) ?>'>
                                        <br>
                                        <input name="submit" type="submit" class="btn btn-primary" value="Change Password">
                                        <input name="cancel" type="submit" class="btn btn-primary" value="Cancel">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>            
                </div>
                <div class="col-md-1">            
                </div>
            </div>           
        </section>
    </body>
<?php require('footer.php'); ?>