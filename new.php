<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<link rel="stylesheet" type="text/css" href="css/style.css" >
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"
	 integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous"> 
	<title>Блог новин</title>
</head>
<body>
	<?php
		error_reporting(-1);
		require_once("db.php");
		$connect = db_connect();
		$new = new_get($connect, $_GET['id']);

		foreach ($new as $data){
			echo '<h2>'.$data['title'].'</h2>';	
			echo '<em>Опублікованно: '.$data['date'].'</em>';
			echo '<p>'.$data['content'].'</p><br>';
		}
	?>
	<footer>
		<p>By KOS Copyright &copy; 2017</p>
	</footer>
</body>
</body>
</html>