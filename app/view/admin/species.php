<!DOCTYPE html>
<html>
<head>
	<title>test</title>
</head>
<body>

	
	<?php
	echo "<pre>";
			echo "<a href='/species/create/'>create</a>"; 

			echo "<br/>"; 
	foreach ($a as $key => $value) {

			echo $value->name; 
			echo "  ";
			echo "<a href='/species/view/delete/$value->id'>effacer</a>"; 
			echo "  ";
			echo "<a href='/species/update/$value->id/$value->name'>modifier</a>"; 
			echo "<br/>"; 
	}
	echo "</pre>";
	?>



</body>
</html>