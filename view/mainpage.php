<?php

?>

<!DOCTYPE html>
<html>
<head>
	<title>0</title>
	<link rel="stylesheet" type="text/css" href="view/style.css">
</head>
<body>
	<div class = "header">
		<div class = "header_content">
			<div class = "header_content_left">
				ads
			</div>
			
			<div class = "header_content_right">
				<div class="header_content_right_greeting">Hello, <?=$_SESSION['username']?></div>
				<div class="header_content_right_logout">
					<a href="index.php?action=logout">Logout</a>
				</div>
			</div>
		</div>
	</div>
		
	

</body>
</html> 
