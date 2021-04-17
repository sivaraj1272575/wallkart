<?php 
    session_start(); 
    if(!isset($_SESSION['username']) || $_SESSION['type']!='admin'){
        header('location:../index.html');
    }
?>
<html ng-app = "newapp">
    <head>
        <title>Admin Home</title>
        <link rel="icon" type="image/png" href="logo1.png">
        <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.9/angular.min.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.9/angular-route.js"></script>
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
            img
            {
                height: 25px;
            }
        </style>
    </head>
    <body style="color: white;  ">
        <table style="width :100%; height: 40px;" border = 0 cellspacing = 0 >
            <tr style="background-color: #0D4F8B; height: 30px;">
                <td style="text-align: left;"><img src="../images/logo1.png"></td>
                <td style="text-align: center; font-size: 20px; font-family: Cambria, Cochin, Georgia, Times, 'Times New Roman', serif; font-weight: bold;">Admin Page</td>
                <td style="text-align: right;color: cyan; font-weight: bold"> <?php echo strtoupper($_SESSION['username']) ?></td>
            </tr>
        </table>
        <table style="width :100%; margin-top: -4px; font-family: verdana;" border = 0 cellspacing = 0>
            <tr style="background-color:0D4F8B; height: 20px; font-size: 12px;">
                <td style="color: cyan; font-weight: bold; text-align: left;"><div id="date"></div</td>
                <td style="color: cyan; font-weight: bold; text-align: right;"><a style = "color: cyan;" href = "../signout.php">Sign Out</a></td>
                
            </tr>
            <tr></tr>
        </table>
        <table style="width :100%; margin-top: -4px; font-family: verdana;" border = 0 cellspacing = 0>
            <tr style="background-color: black; height: 25px; text-align: left;">
                <td><a href = "#" style="cursor: pointer;">Home</a></td>
                <td><a href = "./insertseller.php" style="cursor: pointer;">Seller</a></td>
                <td><a href = "./insertproduct.php" style="cursor: pointer;">Products</a></td>
                <td><a href = "./addemployee.php" style="cursor: pointer;">Employee</td>
                <td><a href = "./show-order-admin.php" style="cursor: pointer;">Orders</a></td>
                
            </tr>
            <tr></tr>
        </table>
        <script>
            var date = Date();
            var d = date.slice(8,10);
            var m = date.slice(4,7);
            var y = date.slice(11,15);
            var x = document.getElementById('date').innerText = d+' '+m+' '+y;
        </script>
        
    </body>
</html>