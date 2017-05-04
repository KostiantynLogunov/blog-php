<?php 
	define('SERVER_NAME', 'loacalhost');
	define('SERVER_db', 'db_news');
	define('SERVER_USER', 'root');
	define('SERVER_PASSWORD', '');

	function db_connect(){
		$db = new PDO ('mysql:host=localhost;dbname=db_news', 'root','');
	 	// $db->exec("SET NAMES UTF8");

	 	return $db;
	 }

	 function art_all($db){
	 	$query = $db->prepare("SELECT * FROM news");
	 	 $query->execute();
	 	
	 	$arts= $query->fetchAll(PDO::FETCH_ASSOC);
	 	return $arts;
	 }
	
	function new_get($db, $id_new)
	{
		$query = $db->prepare("SELECT * FROM news WHERE id='$id_new'");//!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
		$query->execute();
		$new= $query->fetchAll(PDO::FETCH_ASSOC);
	 	return $new;
	}
 ?>