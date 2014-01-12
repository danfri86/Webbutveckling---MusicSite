<?php
	include("src/loginFunctions.php");
	include("src/databaseFunctions.php");

	if(checkSession()){
		header("location: adminArtist.php");
		exit;
	}

	if(isset($_POST["btnLogin"])){
		try{
			$dbConnection = myDBConnect();

			if(validateUser($dbConnection, $_POST["txtUserName"], $_POST["txtPassWord"]) == 1){
				startSession();
				header("location: adminArtist.php");
				exit;
			} else{
				throw new Exception("<p>Felaktigt användarnamn och/eller lösenord</p>");
			}

			myDBClose($dbConnection);
		}
		catch(Exception $oException){
			$errorMessage = $oException->getMessage();
		}
	}

	$title="Login";
	include("incl/header.php");
	
?>
<div id="content">

	<h1><?php echo($title); ?></h1>
	
	<?php if( isset($errorMessage)){
		echo($errorMessage);
	} ?>
	
	<fieldset>
	  <legend>Type username and password</legend>
	   <form action="login.php" method="post" id="frmLogin" name="frmLogin" >
			<label>
				Name
				<br />
				<input type="text" name="txtUserName" id="txtUserName" title="Username" placeholder="Type your username!" autofocus="autofocus" required="required" />
			</label>
			<br />
			<label>
				Password
				<br />
				<input type="password" name="txtPassWord" id="txtPassWord" title="Password" placeholder="Type your Password!" required="required" />
			</label>
			<br />
			<input type="submit" name="btnLogin" id="btnLogin" value="Login" />
			<input type="reset" class="btnReset" name="btnReset" value="Reset" />
	  </form>
	</fieldset>
</div>

<?php include("incl/footer.php");