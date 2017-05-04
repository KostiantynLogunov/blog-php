<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
</head>
<style>
	 td{
		border: 1px solid black;
		/*border-collapse: collapse;*/
		padding: 5px;
	}
	fieldset{
		width: 20%;
	}
	button:hover{
		cursor: pointer;
	}
	</style>
<body>
	<!-- Admin Panel -->
	</body>
	<?php
		error_reporting(-1);
		require_once("../db.php");
		$connect = db_connect();
		$news = art_all($connect);
		// echo '<form method="post">';
		echo '<table border="5">';
		echo "<tr>";
			echo '<th>Дата</th>';
			echo '<th>Новина</th>';
			echo '<th>Редактування</th>';
			echo '<th>Виделення</th>';
		echo "</tr>";
		foreach ($news as $new){
			echo "<tr>";
			echo '<td>'.$new['date'].'</td>';
			echo '<td>'.$new['title'].'</td>';
			echo '<td><a href="index.php?action=edit&id='.$new['id'].'">Редактувати</a></td>';
			echo '<td><a href="index.php?action=delete&id='.$new['id'].'">Видалити</a></td>';
			echo "</tr>";
	}
		echo '</table>';
		// echo "</form>"; 

		

	?>
	<form method="post" class="btns">
	 	<p>	<button type="submit" name="add">Добавити новину</button>
	 	</p>
	 </form>

	 <?php 
	/* echo "<pre>";
	 print_r($_GET);
	 echo "</pre>";*/
	 	if(isset($_POST['add'])){
	 		$_GET['action'] = "";
	 		?>
		<fieldset>
			<legend>Реєстрація нової новини</legend>
			<form method="post">
	 			<p><input type="date" name="new-date" placeholder="Дата створення новини" required="required"></p>
	 			<p><input type="text" name="new-title" placeholder="Заголовок новини" required="required"></p>
	 			<p><textarea name="content" cols="30" rows="10"></textarea></p>
	 			<p><button type="submit" name="new-save">Зберегти</button></p>
			</form>
		</fieldset>
				<?
	}
		elseif ( isset( $_POST['new-save'] ) ){
	// echo 'SAVE';
		$new_d = htmlentities(trim($_POST['new-date']));
		$new_tit = htmlentities(trim($_POST['new-title']));
		$new_cont = htmlentities(trim($_POST['content']));						
		$query = $connect->prepare("INSERT INTO news (title, date, content) VALUES (:new_tit, :new_d, :new_cont)");
		$values = ['new_tit'=>$new_tit, 'new_d'=>$new_d, 'new_cont'=>$new_cont];
		$query->execute($values);
		 #Перегрузка сторінки
		 exit("<meta http-equiv='refresh' content='0; url= $_SERVER[PHP_SELF]'>");				
	}
	if ($_GET['action'] == "delete"){
		// echo 'DELETE';
		$new_id = $_GET['id'];
		$query = $connect->prepare("DELETE FROM news WHERE id = '$new_id'");
		$query->execute();
		exit("<meta http-equiv='refresh' content='0; url= $_SERVER[PHP_SELF]'>");
	}
	else if($_GET['action'] == 'edit'){
		// echo 'EDITOR';
		$new_id = $_GET['id'];
		$new = new_get($connect, $new_id);
		foreach ($new as $new){

		}
	?>
		
		 <fieldset>
			<legend>Редагування новини</legend>
			<form method="post">
			 			<p><input type="date" name="new-date" value="<?=$new['date']?>"></p>
			 			<p><input type="text" name="new-title" value="<?=$new['title']?>"></p>
			 			<p><textarea name="content" cols="30" rows="10"><?=$new['content']?></textarea></p>
			 			<p><button type="submit" name="new-edit">Зберегти</button></p>
			</form>
		</fieldset>
		<? 
			if ( isset( $_POST['new-edit'] ) ){
				$new_d = htmlentities(trim($_POST['new-date']));
				$new_tit = htmlentities(trim($_POST['new-title']));
				$new_cont = htmlentities(trim($_POST['content']));						
				$query = $connect->prepare("UPDATE news SET title='$new_tit', date='$new_d', content='$new_cont' WHERE id='$new_id'");
				//$values = ['new_tit'=>$new_tit, 'new_d'=>$new_d, 'new_cont'=>$new_cont];
				$query->execute($values);
				 #Перегрузка сторінки
				 exit("<meta http-equiv='refresh' content='0; url= $_SERVER[PHP_SELF]'>");
			}
		}	
		
		 ?> 

	
</body>
</html>