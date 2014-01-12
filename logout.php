<?php
	include("src/loginFunctions.php");

	if( checkSession() ){
		endSession();
	} else{
		header("location: login.php");
		exit();
	}

	$title="Logout";
	include("incl/header.php");
?>
				<div id="content">
					
					<h1> You are no longer logged on!</h1>

                </div>

<?php 
	include("incl/footer.php");
?>