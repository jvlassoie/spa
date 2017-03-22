<!DOCTYPE html>
<html>
<head>
	<title>test</title>
</head>
<body>

	
	<?php
	echo "<pre>";
	// var_dump(get_object_vars($a));

	foreach ($a as $key => $value) {
	// foreach ($a as $key => $value) {
	  // print_r(get_object_vars($value));
			// echo $key; 
			echo $value->name; 
			echo "<br/>"; 
		
	// }
	}
	echo "</pre>";
	?>



</body>
</html>