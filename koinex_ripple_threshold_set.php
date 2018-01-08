<html>
	<body>
		<form method="get">
			<table>
			<tr><td><input type="text" name="min"></td></tr>
			<tr><td><input type="text" name="max"></td></tr>
			<tr><td><input type="submit"></td></tr>
		</form>
	</body>
</html>

<?php
	if(!isset($_GET['max']))
		exit(1);
	
	require('db.php');
	
	$min = $_GET['min'];
	$max = $_GET['max'];
	$update_query = "UPDATE `thresholds` SET `min`=$min,`max`=$max WHERE `security` = 'ripple'";
	echo($update_query);
	
	echo($update_query);
	
	if ($conn->query($update_query) === TRUE) {
		echo "Thresholds updated";
	} else {
		echo "Error: " . $update_query . "<br>" . $conn->error;
	}
	
?>
