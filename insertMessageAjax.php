<?php
session_start();
include 'init.php';
include  $tpl."header.php";
if(isset($_SESSION['name']))
{
    $id=FetchidUser($_SESSION['name'])['id_user'];
}
if($_SERVER['REQUEST_METHOD']=="POST")
{
    $msg=$_POST['msg'];
    $sendto=$_POST['sendTo'];

    $check=insertMessage($msg,$id,$sendto);
    //header("Location: room.php");
}