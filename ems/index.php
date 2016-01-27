<?php 
require_once('db_connection.php');
// '$message' is used to store messages from the session
$message;
// if the session contains 'messages' then store them to variable '$message'
if ($_SESSION['message']) {
    $message = $_SESSION['message'];
}
// if a user is already logged in then redirect to home
if ($_SESSION['id']) {
    header("Location: home.php");
}
else
{
    if ($_POST['signin']) {
        
        // check if the login form is submitted and $_POST contains the username and password
        if (!$_POST['username']) {
            $message = "Please enter your username<br>";
        }
        if (!$_POST['password']) {
            $message = $message . "Please enter your Password";
        }
        if (!$message) {
            // fetch username and password from $_POST
            $username = mysqli_real_escape_string($connection, trim($_POST['username']));
            $password = mysqli_real_escape_string($connection, trim($_POST['password']));
            $password = md5($password);
            $query = mysqli_query($connection, "SELECT id, activation
                                                FROM details 
                                                WHERE username = '$username' AND password = '$password'");
            // if the query executes successfully then the user is registered and the credentials are valid
            if ($query and $row = mysqli_fetch_assoc($query)) {
                // check if the account of the registered user is activated
                if($row['activation'] == 1) {
                    // if the account of the user is activated, then create sessions for the user and
                    // display the users home page.
                    $_SESSION['id'] = $row['id'];
                    header("Location: home.php");
                }
                else {
                    $message = "Please activate your account before signing in";
                }
            }
            else
            {
                $message = "Either Username or Password is Invalid! ";
            }
        }
    }
}
?>

  	<body>
        <section id="section1" class="container-fluid">
            <div class="row">
                <div class="col-md-1">
                </div>
                <div class="col-md-6">
                    <h1 id="mainHeader">EMS</h1>
                    <h3>Employee Management System</h3>
                    <label class="myLabel">Sign up to get the most out of it!</label>
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

                    <form class="form" method="post" action="index.php">
                        <div class="row">
                            <div class="col-md-12"> 
                                <div id="loginForm" class="jumbotron">
                                    <div class="form-group">
                                        <label class="myLabel">Username</label>
                                        <input name="username" type="text" class="form-control" id="username" value="<?php echo $_POST['username']; ?>"><br>
                                        <label class="myLabel">Password</label>
                                        <input name="password" type="password" class="form-control" id="password" value="<?php echo $_POST['password']; ?>"><br>
                                        <input name="signin" type="submit" class="btn btn-primary" value="Sign in">
                                    </div>
                                    <label class="myLabel"><a href="password_recovery.php">Forgot password? Click here!</a></label><br>
                                    <label class="myLabel"><a href="register.php">New user? Sign up here!</a></label>
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