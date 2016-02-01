<?php 
require_once('db_connection.php');
require('header.php');

// Store messages from session (if any) to $message
$message='';
if (isset($_SESSION['message'])) {
    $message = $_SESSION['message'];
}

// if a user is already logged in then redirect to home page
if (isset($_SESSION['id'])) {
    header("Location: home.php");
}
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

                <form class="form">
                    <div class="row">
                        <div class="col-md-12"> 
                            <div id="loginForm" class="jumbotron">
                                <label class="myLabel">Username</label>
                                <div class="form-group">
                                    <input name="username" type="text" class="form-control" id="username" value="<?php echo $_POST['username']; ?>"><br>
                                </div>
                                <label class="myLabel">Password</label>
                                <div class="form-group">
                                    <input name="password" type="password" class="form-control" id="password" value="<?php echo $_POST['password']; ?>"><br>
                                </div>
                                <input name="signin" id="signin" type="submit" class="btn btn-primary" value="Sign in">
                                <label class="myLabel"><a href="forgot_password.php">Forgot password? Click here!</a></label><br>
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