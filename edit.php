<?php
include 'config.php';

if(isset($_GET['edit_id']))
{
    $id = $_GET['edit_id'];
    extract($toDo->getList($id));
}
if(isset($_POST['btn-save']))
{
    $taskId = $id;
    $taskTitle = $_POST['task_title'];
    $taskCompleted = $_POST['completed'];
    $toDo->setTitle($taskTitle);
    $toDo->setId($taskId);
    $toDo->setCompleted($taskCompleted);

    if($toDo->edit())
    {
        header("Location: index.php?inserted");
    }
    else
    {
        header("Location: edit.php?failure");
    }
}?>



<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title></title>
    <link href="main.css" rel="stylesheet" media="screen">

</head>

<body>

<div class="navbar navbar-default navbar-static-top" role="navigation">
    <div class="container">

        <div class="">
            <a class="" href="#">Home</a>
        </div>

    </div>
</div>
<div id="content">
    <form method="post">
        <h3>Edit Task</h3>
        <input type='text' name='task_title' value="<?php echo $title; ?>" class='form-control' required>
        <h3> is the task completed ? </h3>
        <?php
        if ($completed == 1){
            echo "<input type='radio' name='completed' value='1' class='chkbox' checked /> Completed task <br/>";
            echo "<input type='radio' name='completed' value='0' class='chkbox'/> An incomplete task <br/>";
        }else{
            echo "<input type='radio' name='completed' value='1'  /> Completed task <br/>";
            echo "<input type='radio' name='completed' value='0' checked/> An incomplete task <br/>";
        }
        ?>
        <button type="submit" id="<?php echo $id; ?>" class="btn12" name="btn-save">
            Update
        </button>
    </form>
</div>








