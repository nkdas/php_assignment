<?php
/**
* This page acts as the login page for the application.
*/

require_once('db_connection.php');

// Store messages from session (if any) to $message
$message='';
if (isset($_SESSION['message'])) {
    $message = $_SESSION['message'];
}

// if a user is already logged in then redirect to home page
if (isset($_SESSION['id'])) {
    header("Location: home.php");
}
require('header.php');
?>

<body>
    <section id="section1" class="container-fluid">
        <div class="row">
            <div class="col-md-1">
            </div>
            <div class="col-md-6">
                <h1 id="mainHeading">EMS</h1>
                <h3>Employee Management System</h3>
                <label class="myLabel">Sign up to get the most out of it!</label>
            </div>
            <div class="col-md-4">
                <div class="row">
                    <div class="col-md-12 message">
                        <?php
                        // creating a div to show messages
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
                </div>

                <form class="form" method="post">
                    <div class="row">
                        <div class="col-md-12">
                            <div id="loginForm" class="jumbotron">
                                <div class="form-group">
                                    <label class="myLabel">Username</label>
                                    <input name="username" type="text" class="form-control" id="username" value="<?php echo $_POST['username']; ?>"><br>
                                    <label class="myLabel">Password</label>
                                    <input name="password" type="password" class="form-control" id="password" value="<?php echo $_POST['password']; ?>"><br>
                                    <input name="signin" id="signin" type="button" class="btn btn-primary" value="Sign in"><br>
                                </div>
                                <label class="myLabel"><a href="forgot_password.php">Forgot password? Click here!</a></label><br>
                                <label class="myLabel"><a href="register.php">New user? Sign up here!</a></label>
                                <div id="progress" class="progress hiddenDiv">
                                	<div class="progress-bar progress-bar-striped active" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width:100%">
                                		Checking
                                	</div>
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