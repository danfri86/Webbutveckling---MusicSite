<!doctype html>
<html lang="en">

	<head>
		<meta charset="UTF-8" />
		<title>
			   File upload...
		</title>
	</head>

	<body>

        <?php ?>
		
		<p>
			Välj en *.ogg fil och tryck på Upload file för att ladda upp filen till servern!
		</p>
		
		<form action="<?php echo($_SERVER["PHP_SELF"]); ?>" method="post" name="frmFileForm" enctype="multipart/form-data">
				
			<input type="file" name="fileToUpload"  />
			<br />
			 
			<input type="submit" name="btnUpload" value="Upload file" />
	   
		</form>

	</body>

</html>
