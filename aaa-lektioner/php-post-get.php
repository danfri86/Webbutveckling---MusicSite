<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<title>POST & GET</title>
</head>
<body>

	<p>$_POST[]: <pre><?php print_r($_POST); ?></pre></p>
	<p>$_GET[]: <pre><?php print_r($_GET); ?></pre></p>

	<form method="post" action="methodDemo.php?CodeOne=ISGB02&amp;CodeTwo=ISGB14" name="frmEx3">

	<input type="text" name="txtCourseName" placeholder="Ange namn!" />
	<input type="submit" name="btnSkicka" value="Skicka" />
	<input type="reset" name="btnReset" value="Rensa" />

</form>

</body>
</html>