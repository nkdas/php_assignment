<?php 
require_once('db_connection.php');
// '$message' is used to fetch the message from the session
$message;
// if the user is already signed in then redirect to home page
if ($_SESSION['id']) {
    header("Location: home.php");
}
else
{
    // check if the user has submitted the form
    if ($_POST['submit']) {
        
        // check if $_POST contains the username and email
        if (!$_POST['username']) {
            $message = "Please enter your username<br>";
        }
        if (!$_POST['email']) {
            $message = $message . "Please enter your email";
        }
        if (!$message) {

            // fetch username and email from $_POST
            $username = mysqli_real_escape_string($connection, trim($_POST['username']));
            $email = mysqli_real_escape_string($connection, trim($_POST['email']));
            
            // fetch id, password, and firstname of the user from the database
            $query = mysqli_query($connection, "SELECT activation_key, id, firstname 
                                FROM details 
                                WHERE username = '$username' AND email = '$email'");

            // if the credentials enterd by the user is correct
            // then fetch from the database is successful
            if ($query and $row = mysqli_fetch_assoc($query)) {
                $key = $row['activation_key'];
                // set session for the details to be used for sending the email to the user
                $_SESSION['id'] = $row['id'];
                $_SESSION['mail_to'] = $email;
                $_SESSION['subject'] = "Password Recovery";
                $_SESSION['message'] = "Please check your email, We have sent you a link to change your password.";
                $_SESSION['mail_body'] = "Hi " . $row['firstname'] . "!<br>Follow the link to change your password.<br>
                <a href='http://localhost/ems/change_password.php?key=$key'>Change your password</a>";
               
                // after setting the session redirect to mail.php
                header("Location: mail.php");
            }
            // if the credentials entered by the user is incorrect then fetch is unsuccessful which mean invalid credentials
            else
            {
                $message = "Either Username or Email is Invalid! ";
            }
        }
    }
}
if ($_POST['cancel']) {
    header("Location: index.php");
}
?>

    <body>
        <section id="section1" class="container">

            <div class="row">              
                <div class="col-md-8">
                    <h1 id="mainHeader">EMS</h1>
                    <h3>Password Recovery</h3>
                    <label class="myLabel">Forgot your password? 
                            Don't worry we are there to help.<br>
                            Just enter your username and email.
                    </label>
                </div>
                <div class="col-md-4">
                    <div class="row">
                        <div class="col-md-12">
                            <div id="message" class="jumbotron">
                                <?php
                                if ($message) {
                                    echo "<label class='myLabel'>$message</label>";
                                    echo '<style type="text/css">
                                    #message { 
                                        display: block;
                                    }
                                    </style>';
                                    if (!$_SESSION['id']) {
                                        session_unset();
                                        session_destroy();
                                    }
                                }
                                else {
                                    echo '<style type="text/css">
                                    #message { 
                                        visibility:hidden; 
                                    }
                                    </style>';
                                }
                                ?>
                            </div>
                        </div>
                    </div> <!-- end of message div -->
                    <form class="form" method="post" action="password_recovery.php">
                        <div class="row">
                            <div class="col-md-12"> 
                                <div id="loginForm" class="jumbotron">
                                    <div class="form-group">
                                        <label class="myLabel">Username</label>
                                        <input name="username" type="text" class="form-control" id="username" placeholder="Username" value="<?php echo $_POST['username']; ?>"><br>
                                        <label class="myLabel">Email</label>
                                        <input name="email" type="text" class="form-control" id="email" placeholder="someone@example.com" value="<?php echo $_POST['email']; ?>"><br>
                                        <input name="submit" type="submit" class="btn btn-primary" value="Submit">
                                        <input name="cancel" type="submit" class="btn btn-primary" value="Cancel">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>            
                </div>
            </div>           
        </section>
    </body>
<?php require('footer.php'); ?>