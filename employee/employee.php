<?php 
    session_start(); 
    if(!isset($_SESSION['username'])){
        header('location:../index.html');
    }
?>
<html ng-app='home'>
    <head>
        <title>Employee Home</title>
        <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.9/angular.min.js"></script>
        <link rel="icon" type="image/png" href="logo1.png">
        <meta name="viewport" content="width=device-width,initial-scale=1.0">
        <style>
            body{
                margin-left: 0px;
                margin-right: 0px;
                margin-top: -2px;
                color: black;
            }
            table{
                font-family: Arial, Helvetica, sans-serif;
                font-size: 15px;
                text-align: center;
                width : 100%;
                border: none;
                table-layout: fixed;
            }
            a{
                color : yellow;
                text-decoration: none;
                font-weight: bold;
            }
            .newtab
            {
                border: 2px solid black;
                border-collapse: collapse;
            }
            .newtab tr
            {
                border: 1px solid black;
            }
            .newtab td,.newtab th
            {
                border-left: 1px solid black;
            }
            button
            {
                border: none;
                width: 80px;
                height: 25px;
                color: white;
                background-color: #0D4F8B;
                font-size: 12px;
                border-radius: 15px;  
                justify-content: center;
                cursor: pointer;
            }
            
        </style>
</head>
    <body style="color: white;" ng-controller = "homecontroller">

<table style="width :100%; height: 40px;" border = 0 cellspacing = 0 >
    <tr style="background-color: 0D4F8B; height: 30px;">
        <td style="text-align: left;"><img src = '../images/logo1.png' height='25'></td>
        <td style="text-align: center; font-size: 20px; font-family: Cambria, Cochin, Georgia, Times, 'Times New Roman', serif; font-weight: bold;">The Wallkart</td>
        <td></td>
    </tr>
</table>
<div >
<table  style="width :100%; margin-top: -4px; font-family: verdana;" border = 0 cellspacing = 0>
    <tr style="background-color:0D4F8B; height: 20px; font-size: 12px;">
        <td style="color: cyan; font-weight: bold; text-align: left;">{{date}}</td>
        <td style="color: cyan; font-weight: bold; text-align: right;">{{user|uppercase}} &nbsp;   <a style = "color: cyan;" href = "../signout.php">Sign Out</a></td>
        
    </tr>
    <tr></tr>
</table>
</div>
<table style="width :100%; margin-top: -4px; font-family: verdana;" border = 0 cellspacing = 0>
    <tr style="background-color: black; height: 25px; text-align: left; color:yellow; font-weight: bold; text-align: center">
        <td>Orders</td>
    </tr>
</table>
<script>
    var app = angular.module("home",[]);
    var date = Date();
    var d = date.slice(8,10);
    var m = date.slice(4,7);
    var y = date.slice(11,15);
    var l = location['href'];
    var n = location['href'].search('user');
    l = l.slice(n);
    l = l.split('%22');
    var usr = l[1];
    app.controller("homecontroller",["$scope",function($scope){
        $scope.date = d+' '+m+' '+y;
        $scope.user = usr;
        $scope.hm = 'http://localhost/eg1.php?user="'+l[1]+'"';
        $scope.bag = 'http://localhost/show-order-user.php?user="'+l[1]+'"';
        //'http://www.wallkart.com/userhome1.php?user="'+l[1]+'"'
    }]);
</script>
<br><br>
<div style="color: black">
        <table style="color: black; tab-size: fixed" class='newtab'>
        <tr>
            <th>Order_Id</th>
            <th>Name</th>
            <th>Address</th>
            <th>Status</th>
            <th>Amount</th>
            <th></th>
        </tr>
        <?php
            $user = $_SESSION['username'];
            $dist = $_SESSION['district'];
            $db1 = mysqli_connect('localhost','root','','wallkart');
            $db2 = mysqli_connect('localhost','root','','wallkart');
            if($db1->error)
            {
                echo 'ERROR IN CONNECTION';
                die;
            }
            if($db2->error)
            {
                echo 'ERROR IN CONNECTION';
                die;
            }
            $query = "SELECT * FROM order1";
            $result = $db1->query($query);
            while($row=mysqli_fetch_assoc($result))
            {
                $name = $row['username'];
                $q2 = "SELECT * FROM login1 WHERE username='$name'";
                $res2 = $db2->query($q2);
                $row2 = mysqli_fetch_assoc($res2);
                if($dist == $row2['district'])
                {
                    $price = $row['price'] + 40;
                    echo '<tr>
                        <td>'.$row['order_id'].'</td>
                        <td>'.$row2['username'].'</td>
                        <td style="text-align: left">'.$row2['doorno'].',<br>'.$row2['area'].',<br>'.$row2['district'].'<br>Mob:<br>'.$row2['phone'].'</td>
                        <td>'.$row['status'].'</td>
                        <td ><p style="background-color: blue; color: cyan; font-weight: bold">Rs.'.$price.'</p></td>
                        <td><button onclick="updatestatus('.$row['order_id'].',`'.$row['status'].'`)">'.$row['status'].'</button></td>
                    </tr>
                    ';
                }
            }
        ?>
        </table>
    </div>
    <script>
        let status = ['SHIPPED','ARRIVED','DELIVERED'];
        let btnstat = ['Arrived','Delivered'];
        var btn = document.getElementsByTagName('button');
        var txt,n;
        for(i=0;i<btn.length;i++)
        {
            txt = btn[i].innerText;
            n = status.indexOf(txt);
            if(n!=-1&&n!=2)
            {
                btn[i].innerText = btnstat[n];
            }
            else 
            {
                btn[i].style.display = 'none';
            }
        }

        function updatestatus(val,cur)
        {
            console.log(val,cur);
            nxt = (status.indexOf(cur))+1;
            console.log('./update-order.php?id='+val+'&status="'+status[nxt]+'"');
            window.open('./update-order.php?id='+val+'&status="'+status[nxt]+'"','_self');                
            alert('Order Updated!..');
            window.location.reload();
        }
    </script>
    </body>
</html>