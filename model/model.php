<?php
function add($name_task,$date_start, $date_end, $status){
    global $db;
    $sql = "INSERT INTO tasks (name_task, start_date, end_date, status) VALUES('$name_task', '$date_start', '$date_end', '$status')";
    echo $sql;
    $perform = $db->exec($sql);
}
/*end: function add($name_task,$date_start, $date_end, $status)*/

function edit($id, $name_task,$date_start, $date_end, $status){
    global $db;
    $sql = "UPDATE tasks SET name_task = '$name_task', start_date = '$date_start', end_date = '$date_end', status = '$status' WHERE id = '$id'";
    $perform = $db->exec($sql);
}
/*end: function edit($id, $name_task,$date_start, $date_end, $status)*/

function del($id){
    global $db;
    $sql = "DELETE FROM tasks WHERE id = $id";
    $perform = $db->exec($sql);
}
/*end: function del($id)*/

function select(){
    global $db;
    $sql = "SELECT * FROM tasks";
    $perform = $db->query($sql);
    $array_task = $perform->fetchAll();
    return $array_task;
}
/*end: function select()*/

function get_task($id){
    global $db;
    $sql = "SELECT * FROM tasks WHERE id=$id";
    $perform = $db->query($sql);
    $array_task_by_id = $perform->fetch();
    return $array_task_by_id;
}
/*end: function get_task($id)*/

function select_task_by_date($date_start, $date_end){
    global $db;
    $sql = "SELECT * FROM tasks WHERE start_date>='$date_start' AND end_date<='$date_end'";
    $perform = $db->query($sql);
    $array_task_by_date = $perform->fetchAll();
    return $array_task_by_date;
}
/*end: function select_task_by_date($date_start, $date_end)*/
?>