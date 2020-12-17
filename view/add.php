<?php 
    include '../model/connect.php';
    include '../model/model.php';
    $id = "";
    $name_task = ""; 
    $status = "";
    $start_date = date("Y-m-d");
    $date_end = date("Y-m-d");

    /*check id in URL*/
    if(isset($_GET["task"]) != "")
    {
        $id = $_GET["task"];
        $array_task_by_id = get_task($id);
        if($array_task_by_id != null)
        {
            $name_task = $array_task_by_id["name_task"];
            $start_date = date("Y-m-d", strtotime($array_task_by_id["start_date"]));;
            $date_end = date("Y-m-d", strtotime($array_task_by_id["end_date"]));
            $status = $array_task_by_id["status"];
        }else{
            /*load page add*/
            header('Location: http://localhost/ToDoList/view/add.php');
        }
        /*end: if($array_task_by_id != null)*/
    }
    /*end: if(isset($_GET("id")))*/
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>ToDoList</title>
        <link rel="stylesheet" type="text/css" href="css/style.css">
    </head>
    <body>
        <div class="container">
            <h1>Add Task</h1>
            <form  class="form_add" id="form_add" action="../controller/add.php" method="POST">
                <div class="form-group">
                    <label>Name Task</label>
                    <input type="text" name="data[name_task]" class="form-control" id="name_task" value="<?php echo $name_task ?>" required  placeholder="Name task">
                </div>
                <div class="form-group">
                    <label>Date start</label>
                    <input type="date" name="data[date_start]" id="date_start" value="<?php echo $start_date ?>">
                </div>
                <div class="form-group">
                    <label>Date end</label>
                    <input type="date" id="date_end" name="data[date_end]" value="<?php echo $date_end?>">
                </div>
                <div class="form-group">
                    <label>Status</label>
                    <select name="data[status]" >
                        <option value="1" <?php if($status == 1) echo "selected" ?> >Planning</option>
                        <option value="2" <?php if($status == 2) echo "selected" ?> >Doing</option>
                        <option value="3" <?php if($status == 3) echo "selected" ?> >Complete</option>
                    </select>
                </div>
                <input type="hidden" name="data[id]" class="form-control" id="name_task" value="<?php echo $id; ?>">
                <button type="button" onclick="checkform()" >Save</button>
            </form>
        </div>
        <script language="javascript">
            function checkform(){
                /*check name_task*/
                if(document.getElementById("name_task").value == "")
                {
                    alert('Please enter the job name');
                    document.getElementById("name_task").focus();
                    return;
                }
                /*end: if(document.getElementById("form_add").value == "")*/

                /*check date*/
                if(document.getElementById("date_end").value < document.getElementById("date_start").value)
                {
                    alert("The end date must not be less than the start date");
                    return;
                }
                /*end: if(document.getElementById("date_end").value < document.getElementById("date_start").value)*/
               
                /*submit form*/
                document.getElementById("form_add").submit();
            }
        </script>
    </body>
</html>
