<?php 
    session_start(); 
    if(!isset($_SESSION['username'])){
        header('location:../index.html');
    }
?>
<?php
    $db = mysqli_connect('localhost','root','','wallkart');
    if($db->error)
    {
        echo 'Error in Connection';
        die;
    }
    $user = $_SESSION['username'];
    $code = $_GET['code'];
    $query = "SELECT * FROM product WHERE code = '$code'";
    $result = $db->query($query);
    $row = mysqli_fetch_assoc($result);
    $price = $row['price'];
    $loc = 'javascript:history.go(-1)';
    $p_state = 'COD';
    $state = 'ORDERED';
    $dt = date('Y-m-d');
    $query = "INSERT INTO order1 (username,p_code,price,ordered_date,status,pay_state) VALUES (?,?,?,?,?,?)";
    $stmt = mysqli_prepare($db,$query);
    mysqli_stmt_bind_param($stmt,"ssisss",$user,$code,$price,$dt,$state,$p_state);
    mysqli_stmt_execute($stmt);
    $q2 = "SELECT * FROM product WHERE code = '$code'";
    $res2 = $db->query($q2);
    if($res2->num_rows>0)
    {
        $row2 = mysqli_fetch_assoc($res2);
        $val = $row2['quantity'];
        $val = $val - 1;
        $q3 = "UPDATE product SET quantity = $val WHERE code = '$code'";
        $db ->query($q3);
    }
    $q2 = "INSERT INTO dates (order_date) VALUES(?)";
    $stmt = mysqli_prepare($db,$q2);
    mysqli_stmt_bind_param($stmt,"s",$dt);
    mysqli_stmt_execute($stmt);
    mysqli_close($db);
    echo ' Ordered';
    //header('Location:'.$loc.'');
?>