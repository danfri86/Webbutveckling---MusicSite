<?php 
    error_reporting(E_ALL);
    ini_set("display_errors", 1);
?>
<!doctype html>
    <html lang="en">

        <head>

            <meta charset="utf-8" />
			<link href="style/stilmall.css" rel="stylesheet" type="text/css" />
			
			<?php if(isset($jquery)) { ?>
				<script type="text/javascript" src="jquery/jquery-2.0.2.js"></script>
			<?php }

			if(isset($accordion)) {
			?>
				<link rel="stylesheet" href="accordion/css/smoothness/jquery-ui-1.10.3.custom.min.css" />
			
				<script type="text/javascript" src="accordion/js/jquery-ui-1.10.3.custom.js"></script>
			<?php }
			if(isset($slimbox)) {
			?>
				<link rel="stylesheet" href="slimbox2/css/slimbox2.css" />
			
				<script type="text/javascript" src="slimbox2/js/slimbox2.js"></script>
			<?php }
			if(isset($script)) {
				?>
				<script type="text/javascript" src="script/<?php echo($script); ?>"></script>
			<?php }
			?>
			
            
            <title><?php echo($title); ?></title>

        </head>

        <body>			
			<header>
				<div id="wrapper">
					My MusicSite
				<div id="wrapper">
			</header>

			<div id="wrapper">
				
				<div id="main">