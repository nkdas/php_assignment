<?php 
require_once('db_connection.php');
require('header.php');
// check if the user is signed in
if ($_SESSION['id']) {
	$userId = $_SESSION['id'];
	if ($_POST['yes']) {
		// delete user data from the database
		$query = mysqli_query($connection, "DELETE FROM details 
	                            WHERE id = '$userId'");
		if ($query) {
			session_unset();
			session_destroy();
			session_start();
			$_SESSION['message'] = "Sorry to see you go!";
			header("Location: index.php");
		}
		else {
			$_SESSION['message'] = "Unable to delete your accout";
			header("Location: home.php");
		}
	}
	if ($_POST['no']) {
		header("Location: home.php");
	}
}
else {
	header("Location: index.php");
}
?>

<body>
        <section id="section1" class="container">
            <div class="row">              
                <div class="col-md-12">
                    <h1 id="mainHeader">EMS</h1>
                    <h3>Delete Account</h3>
                </div>
            </div>
            <div class="row">              
                <div class="col-md-12">
                    <form class="form" method="post" action="delete.php">
                        <div id="loginForm" class="jumbotron">
                            <div class="form-group">
                            	<label class="myLabel">Are you sure? You want to delete your account</label><br>
                                <input name="yes" type="submit" class="btn btn-primary" value="Yes">
                                <input name="no" type="submit" class="btn btn-primary" value="No">
                            </div>
                        </div> 
                    </form>            
                </div>
            </div>           
        </section>
    </body>
<?php require('footer.php'); ?>
