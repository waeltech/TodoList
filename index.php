<?php
include 'config.php';

if(isset($_POST['btn-save'])){
    $taskTitle = $_POST['task_title'];
    $toDo->setTitle($taskTitle);

    if($toDo->create())
    {
        header("Location: index.php?inserted");
    }
    else
    {
        header("Location: index.php?failure");
    }
}
if(isset($_POST['btn-complete'])){
    $taskId = $_POST['btn-complete'];
    $toDo->setId($taskId);
    if($toDo->complete())
    {
        header("Location: index.php?completed");
    }
    else
    {
        header("Location: index.php?notcompleted");
    }
}
if(isset($_POST['btn-delete'])){
    $taskId = $_POST['btn-delete'];
    $toDo->setId($taskId);
    if($toDo->delete())
    {
        header("Location: index.php?completed");
    }
    else
    {
        header("Location: index.php?notcompleted");
    }
}
if(isset($_POST['btn-edit']))
{
    $taskId = $_POST['btn-edit'];

    header("Location: edit.php?edit_id=$taskId");
}

$toDo->getList('35');
?>



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
        <h3>Add New Task</h3>
        <input type='text' name='task_title' class='form-control' required>
        <button type="submit" class="btn12" name="btn-save">
            Add New Task
        </button>
    </form>
</div>
<ul>
    <?php
    $toDo->getAll();
    ?>
</ul>







