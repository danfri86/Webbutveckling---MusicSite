<?php
    function validateUser($inDBConnection, $inUserName, $inPassWord) {
    	$inUserName = mysqli_real_escape_string($inDBConnection, $inUserName);
    	$inPassWord = mysqli_real_escape_string($inDBConnection, $inPassWord);

    	$strSQL = "SELECT * FROM tbladmin WHERE username = '". $inUserName ."' ";
    	$strSQL .= "AND password = sha1('". $inPassWord ."');";

    	$recordSet = myDBQuery($inDBConnection, $strSQL);

    	return mysqli_num_rows($recordSet);
    }
    
    function startSession() {
    	session_start();
    	session_regenerate_id(true);
    	$_SESSION["username"] = $_POST["txtUserName"];
    	$_SESSION["online"] = true;
    }

    function endSession() {
    	session_unset();

    	if( ini_get("session.use_cookies")){
    		$sessionCookieData = session_get_cookie_params();

    		$path = $sessionCookieData["path"];
    		$domain = $sessionCookieData["domain"];
    		$secure = $sessionCookieData["secure"];
    		$httponly = $sessionCookieData["httponly"];

    		setcookie(session_name(), "", time() - 42000, $path, $domain, $secure, $httponly);
    	}

    	session_destroy();
    }

    function checkSession() {
    	session_start();
    	$isOnline = false;

    	if( isset($_SESSION["online"])){
    		$isOnline = true;
    		session_regenerate_id(true);
    	} else{
    		endSession();
    	}

    	return $isOnline;
    }