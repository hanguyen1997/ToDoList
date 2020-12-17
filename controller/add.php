<?php
	include '../model/connect.php';
    include '../model/model.php';

	/*get data form*/
	$array_data = $_POST["data"];

	/*check $array_data != null*/
	if($array_data != null)
	{
		$name_task = $array_data["name_task"];
		$date_start = $array_data["date_start"];
		$date_end = $array_data["date_end"];
		$status = $array_data["status"];
		$id = $array_data["id"];
		
		/*if id is edit*/
		if($id != "")
		{
			/*edit by id task*/
			$id = $array_data["id"];
			edit($id, $name_task,$date_start, $date_end, $status);
			header('Location: http://localhost/ToDoList/view/');
		}
		else{
			/*add new task*/
			add($name_task,$date_start, $date_end, $status);
			header('Location: http://localhost/ToDoList/view/');
		}
		/*end: if($array_data["id"] != "")*/
	}
	else{
		header('Location: http://localhost/ToDoList/view/');
	}
	/*end: if($array_data != null)*/
?>