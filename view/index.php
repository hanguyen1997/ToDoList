<?php 
    include '../model/connect.php';
    include '../model/model.php';
    $array_task = select();
    $array_status = array("1"=>"Planning", "2"=>"Doing", "3"=>"Complete");

    /*get date in URL*/
    $date_start = "";
    $date_end = "";

    if((isset($_GET["date_start"]) != "") || (isset($_GET["date_end"]) != ""))
    {
        $date_start = $_GET["date_start"];
        $date_end = $_GET["date_end"];

        $array_task = select_task_by_date($date_start, $date_end);
    }
    /*end: if((isset($_GET["date_start"]) != "") || (isset($_GET["date_end"]) != ""))*/
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
            <h1>To Do List</h1>

            <div class="box-search-add">
                <div class="box-search">
                   <form id="form_search" action="../view/index.php" method="GET">
                        <label>Date start</label>
                        <input type="date" id="date_start" name="date_start" value="<?php echo $date_start ?>">
                        <label>Date end</label>
                        <input type="date" id="date_end" name="date_end" value="<?php echo $date_end ?>">
                        <button type="button" onclick="check_form_serach()">search</button>
                   </form>
                </div>
                <div class="box-add">
                    <a href="add.php"><button>ADD</button></a>
                </div>
            </div>
            <div class="notify">
                <?php
                // Starting session
                session_start();
                

                if(isset($_SESSION["message"])){
                    echo "<p>".$_SESSION["message"]."</p>";
                    unset($_SESSION["message"]);
                }
                
                ?>
            </div>
            <table class="table_task" cellpadding="10">
                <tr>
                    <th>Name Task</th>
                    <th>Date start</th>
                    <th>Date end</th>
                    <th>Status</th>
                    <th>Optional</th>
                </tr>
                <?php foreach($array_task as $value) 
                { 
                    /*reformat the date*/
                    $date_start = date("d-m-Y", strtotime($value['start_date']));
                    $date_end = date("d-m-Y", strtotime($value['end_date']));
                ?>
                    <tr>
                        <td><?php echo $value['name_task'] ?></td>
                        <td><?php echo $date_start ?></td>
                        <td><?php echo $date_end ?></td>
                        <td><?php echo $array_status[$value['status']] ?></td>
                        <td>
                            <a href="add.php?task=<?php echo $value['id'] ?>">Edit</a>
                            / <a onclick="return confirm('Are you sure you want to delete ?')" href="../controller/del.php?id=<?php echo $value['id'] ?>">Delete</a>
                        </td>
                    </tr>
                <?php } ?>
            </table>
        </div>
        <script type="text/javascript">
            function check_form_serach(){
                if(document.getElementById("date_end").value == "" || document.getElementById("date_start").value == "")
                {
                    alert("Please enter a start date and end date");
                    return;
                }

                /*check date start and date end*/
                if(document.getElementById("date_end").value < document.getElementById("date_start").value)
                {
                    alert("The end date must not be less than the start date");
                    return;
                }
                /*end: if(document.getElementById("date_end").value < document.getElementById("date_start").value)*/
               
                /*submit form*/
                document.getElementById("form_search").submit();
            }
            /*end: function check_form_serach()*/
        </script>
    </body>
</html>
