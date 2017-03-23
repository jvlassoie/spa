<!DOCTYPE html>
<html>
<head>
	<title>test</title>
</head>
<body>

	
	<?php
	echo "<pre>";
			echo "<a href='/test/create/'>create</a>"; 

			echo "<br/>"; 
	foreach ($a as $key => $value) {

			echo $value->name; 
			echo "<a href='/test/view/delete/$value->id'>effacer</a>"; 
			echo "<br/>"; 
	}
	echo "</pre>";
	?>



</body>
</html>