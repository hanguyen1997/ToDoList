<?php
	include '../model/connect.php';
    include '../model/model.php';

	/*get data form*/
	$id_task = $_GET["id"];

	/*check id_task*/
	$array_task_by_id = get_task($id_task);
	if($array_task_by_id != null){
		del($id_task);
		header('Location: http://localhost/ToDoList/view/');
	}
	else{
		header('Location: http://localhost/ToDoList/view/');
	}
	/*end: if($array_task_by_id != null)*/
?>