<?php 
    include '../model/connect.php';
    include '../model/model.php';
    

    $array_task = select();
    $array_status = array("1"=>"Planning", "2"=>"Doing", "3"=>"Complete");

    /*get date in URL*/
    $date_start_search = "";
    $date_end_search = "";

    if((isset($_GET["date_start"]) != "") || (isset($_GET["date_end"]) != ""))
    {
        $date_start_search = $_GET["date_start"];
        $date_end_search = $_GET["date_end"];

        $array_task = select_task_by_date($date_start_search, $date_end_search);
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
                        <input type="date" id="date_start" name="date_start" value="<?= $date_start_search ?>">
                        <label>Date end</label>
                        <input type="date" id="date_end" name="date_end" value="<?= $date_end_search ?>">
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
                
                if(isset($_SESSION["message"]))
                {
                    echo "<p>".$_SESSION["message"]."</p>";
                    unset($_SESSION["message"]);
                }
                /*end: if(isset($_SESSION["message"]))*/
                
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
                <?php 
                /*check $array_task*/
                if($array_task != Null)
                {
                    foreach($array_task as $value) 
                    { 
                        /*reformat the date*/
                        $date_start = date("d-m-Y", strtotime($value['start_date']));
                        $date_end = date("d-m-Y", strtotime($value['end_date']));
                ?>
                        <tr>
                            <td><?= $value['name_task'] ?></td>
                            <td><?= $date_start ?></td>
                            <td><?= $date_end ?></td>
                            <td><?= $array_status[$value['status']] ?></td>
                            <td>
                                <a href="add.php?task=<?= $value['id'] ?>">Edit</a>
                                / <a onclick="return confirm('Are you sure you want to delete ?')" href="../controller/del.php?id=<?= $value['id'] ?>">Delete</a>
                            </td>
                        </tr>
                <?php 
                    }
                    /*end: foreach($array_task as $value)*/ 
                }else
                {
                    echo" <tr><td colspan='5'>No data</td></tr>";
                }
                /*end:  if($array_task != Null)*/
                ?>
            </table>
        </div>
        <script type="text/javascript">
            function check_form_serach(){
                if(document.getElementById("date_end").value == "" || document.getElementById("date_start").value == "")
                {
                    alert("Please enter a start date and end date");
                    return;
                }
                /*end: if(document.getElementById("date_end").value == "" || document.getElementById("date_start").value == "")*/

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
