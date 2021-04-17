<?php

session_start(); 
if(!isset($_SESSION['username']) || $_SESSION['type']!='admin'){
    header('location:../index.html');
}


$id = $_GET['id'];
$cur = $_GET['status'];
$loc = "javascript:history.go(-1)";
$db = mysqli_connect('localhost','root','','wallkart');
if($db->error)
{
    echo 'ERROR IN CONNECTION';
    die;
}
$curdt = date('Y-m-d');
if($cur=='"CONFIRMED"')
{
    $q1 = "SELECT * FROM order1 WHERE order_id=$id";
    $result=$db->query($q1);
    $row = mysqli_fetch_assoc($result);
    $dt = $row['ordered_date'];
    $ndt = date('Y-m-d',strtotime($dt.'+15days'));
    $q1 = "UPDATE order1 SET estimate='$ndt' WHERE order_id=$id";
    $db->query($q1);
    $q2 = "UPDATE dates SET confirm_date='$curdt'";
    $db->query($q2);
}
if($cur=='"PACKED"')
{
    $q2 = "UPDATE dates SET pack_date='$curdt' WHERE order_id=$id";
    $db->query($q2);
}
if($cur=='"SHIPPED"')
{
    $q2 = "UPDATE dates SET ship_date='$curdt' WHERE order_id=$id";
    $db->query($q2);
}
if($cur=='"ARRIVED"')
{
    $q2 = "UPDATE dates SET arrive_date='$curdt'WHERE order_id=$id";
    $db->query($q2);
}
if($cur=='"DELIVERED"')
{
    $q2 = "UPDATE dates SET delivery_date='$curdt'WHERE order_id=$id";
    $db->query($q2);
}
$query = "UPDATE order1 SET status=$cur WHERE order_id=$id";
$db->query($query);
$db->close();
header("Location:".$loc);

?>