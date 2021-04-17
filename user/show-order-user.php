<?php 
    session_start(); 
    if(!isset($_SESSION['username'])){
        header('location:../index.html');
    }
?>
<html ng-app = "home">
    <head>
        <title>Home</title>
        <link rel="icon" type="image/png" href="logo1.png">
        <meta name = "viewport" content = "width = device-width, initial-scale= 1.0">
        <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.9/angular.min.js"></script>
        <style>
             body{
                margin-left: 0px;
                margin-right: 0px;
                margin-top: -2px;
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

button,input[type=button]
{
    border: none;
    width: 70px;
    height: 26px;
    color: white;
    background-color: #0D4F8B;
    font-size: 15px;
    border-radius: 16px;
    position: relative;
    display: flex; 
    justify-content: center;
    cursor: pointer;
    left: 35px;
    
}
div.btns{
    display: inline;
}

#order
{
    border: 2px solid black;
    border-collapse: collapse;
}
#order td
{
    border-right: 1px solid black;
}
#order tr
{
    border: 1px solid black;
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
                <td style="color: cyan; font-weight: bold; text-align: right;"><?php  echo strtoupper($_SESSION['username']); ?> &nbsp;   <a style = "color: cyan;" href = "http://localhost/index2.html">Sign Out</a></td>
                
            </tr>
            <tr></tr>
        </table>
</div>
        <table style="width :100%; margin-top: -4px; font-family: verdana;" border = 0 cellspacing = 0>
            <tr style="background-color: black; height: 25px; text-align: left;">
                <td><a href = {{hm}} style="cursor: pointer;">Home</a></td>
                <td><a href = {{bag}} style="cursor: pointer;">Mybag</a></td>
                <td><a href = '#' style="cursor: pointer;">Filter</a></th>
                <td><a href = {{offer}} style="cursor: pointer;">Offers</a></th>
            </tr>
            <tr></tr>
        </table>
        <script>
            var app = angular.module("home",[]);
            var date = Date();
            var d = date.slice(8,10);
            var m = date.slice(4,7);
            var y = date.slice(11,15);
            var l = location['href'];
            var n = location['href'].search('user');
            var dt = d+'-'+m+'-'+y;
            l = l.slice(n);
            l = l.split('%22');
            app.controller("homecontroller",["$scope",function($scope){
                $scope.date = dt;
                $scope.user = l[1];
                $scope.hm = 'http://localhost/userhome1.php?user="'+l[1]+'"';
                //'http://www.wallkart.com/userhome1.php?user="'+l[1]+'"'
            }]);
        </script>
        <br>
        <h2 style="color: black">Your Orders:</h2>
        
<?php
            $db = mysqli_connect('localhost','root','','wallkart');
            if($db->error)
            {
                echo "Error in Connection";
                die;
            }
            $user = $_SESSION['username'];
            $query = "SELECT * FROM order1 WHERE username='$user'";
            $result = $db->query($query);
            if($result->num_rows>0)
            {
                echo' <table style="color: black; width: 100%; tab-size: fixed; text-align: left;" id = "order">
                <tr style="font-weight: bold; border: 1px solid black">
                <td>OrderId</td>
                <td>P_Code</td>
                <td>P_Name</td>
                <td>Amount</td>
                <td></td>
                </tr>';
                while($row = mysqli_fetch_assoc($result))
                {
                    $code = $row['p_code'];
                    $price = $row['price']+40;
                    $q2 = "SELECT * FROM product WHERE code= '$code'";
                    $res2 = $db->query($q2);
                    $row2 = mysqli_fetch_assoc($res2);
                    echo "<tr style='height: 40px;border: 1px solid black'>
                    <td>".$row['order_id']."</td>
                    <td>".$row['p_code']."</td>
                    <td>".$row2['name']."</td>
                    <td>".$price."</td>
                    <td><button class='click' onclick = 'showstatus(".$row['order_id'].")'>Track</button></td>
                    </tr>
                    ";
                }
            }
        ?>
<script>
    function showstatus(val)
    {
        window.open('./trackorder.php?id='+val);
    }

</script>
</body>
</html>
