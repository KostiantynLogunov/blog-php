<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf8">
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
	$news = art_all($connect);

	echo "<h1>Blog on PHP</h1><br>";
	echo '<a href="admin">Панель адміна</a><br><br><br>';
	// echo '<table border="2">';
	foreach ($news as $new){
		echo '<h2><a href="new.php?id='.$new['id'].'">'.$new['title'].'</a></h2>';
		echo '<em>Опублікованно: '.$new['date'].'</em>';
		echo '<p>'.mb_substr($new['content'], 0, 350).'...</p><br>';// виводимо не більше 350 символов
	}
?>
<footer>
		<p>By KOS Copyright &copy; 2017</p>
	</footer>
</body>
</html>