<?php 
    session_start(); 
    if(!isset($_SESSION['username']) || $_SESSION['type']!='admin'){
        header('location:../index.html');
    }
?>

<html>
    <head>
        <title>Admin Home</title>
        <link rel="icon" type="image/png" href="logo1.png">
        <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.9/angular.min.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.9/angular-route.js"></script>
        <style>
            button
            {
                border: none;
                width: 70px;
                height: 20px;
                color: white;
                background-color: #0D4F8B;
                font-size: 10px;
                border-radius: 16px;
                position: relative;
                display: flex; 
                justify-content: center;
                cursor: pointer;
                left: 35px; 
                margin-left: -10%;
            }
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
    <body>
    <table style="width :100%; height: 40px;" border = 0 cellspacing = 0 >
            <tr style="background-color: #0D4F8B; height: 30px;">
                <td style="text-align: left;"><img src="../images/logo1.png"></td>
                <td style="text-align: center; font-size: 20px; font-family: Cambria, Cochin, Georgia, Times, 'Times New Roman', serif; font-weight: bold; color: white">Admin Page</td>
                <td style="text-align: right; font-weight: bold; color: cyan"><?php echo strtoupper($_SESSION['username']); ?></td>
            </tr>
        </table>
        <table style="width :100%; margin-top: -4px; font-family: verdana;" border = 0 cellspacing = 0>
            <tr style="background-color:0D4F8B; height: 20px; font-size: 12px;">
                <td style="color: cyan; font-weight: bold; text-align: left;"><div id="date"></div></td>
                <td style="color: cyan; font-weight: bold; text-align: right;"> &nbsp;   <a style = "color: cyan;" href = "../signout.php">Sign Out</a></td>
                
            </tr>
            <tr></tr>
        </table>
        <table style="width :100%; margin-top: -4px; font-family: verdana;" border = 0 cellspacing = 0>
            <tr style="background-color: black; height: 25px; text-align: left;">
                <td><a href = "./adminhome.php" style="cursor: pointer;">Home</a></td>
                <td><a href = "./insertseller.php" style="cursor: pointer;">Seller</a></td>
                <td><a href = "./insertproduct.php" style="cursor: pointer;">Products</a></th>
                <td><a href = "./addemployee.php">Employee</a></td>
                <td><a href = "#" style="cursor: pointer;">Orders</a></th>
            </tr>
            <tr></tr>
        </table>
    <br><br>
            
        <?php
            $db = mysqli_connect('localhost','root','','wallkart');
            if($db->error)
            {
                echo "Error in Connection";
                die;
            }
            $query = "SELECT * FROM order1";
            $result = $db->query($query);
            if($result->num_rows>0)
            {
                echo '<table style ="width: 100%; tab-size: fixed; border: 1px solid black; color: black; text-align: left;">
                <tr style="font-weight: bold; border: 1px solid black;">
                <td style = "border: 1px solid black;">OrderId</td>
                <td style = "border: 1px solid black;">Username</td>
                <td style = "border: 1px solid black;">Payment</td>
                <td style = "border: 1px solid black;">P_Code</td>
                <td style = "border: 1px solid black;">status</td>
                <td style = "border: 1px solid black;">name</td>
                </tr>';
                while($row = mysqli_fetch_assoc($result))
                {
                    echo "<tr style='border: 1px solid black; height: 35px'>
                    <td style = 'border: 1px solid black;'>".$row['order_id']."</td>
                    <td style = 'border: 1px solid black;'>".$row['username']."</td>
                    <td style = 'border: 1px solid black;'>".$row['pay_state']."</td>
                    <td style = 'border: 1px solid black;'>".$row['p_code']."</td>
                    <td style = 'border: 1px solid black;'>".$row['status']."</td>
                    <td style = 'border: 1px solid black;'><button style = 'color: white;' class='click' onclick = 'update(".$row['order_id'].",`".$row['status']."`)'></button></td>
                    </tr>
                    ";
                }
            }
            
        ?>
        
        </table>
        <script>
            let status = ["ORDERED","CONFIRMED","PACKED","SHIPPED","DELIVERED"];
            let state = ["Order","Confirm","Packed","Shipped"];
            t = document.getElementsByTagName('tr');
            btn = document.getElementsByTagName('button');
            for(i=6;i<t.length;i++)
            {
                n = status.indexOf(t[i].cells[4].innerText);
                if(status[n]!="SHIPPED")
                {
                    btn[i-6]. innerText= state[n+1];
                }
                else
                {
                    btn[i-6].style.display = "none";
                }
            }

            function update(val,cur)
            {
                console.log(val,cur);
                nxt = (status.indexOf(cur))+1;
                window.open('./update-order.php?id='+val+'&status="'+status[nxt]+'"','_self');                
                alert('Order Updated!..');
                window.location.reload();
            }
            var date = Date();
            var d = date.slice(8,10);
            var m = date.slice(4,7);
            var y = date.slice(11,15);
            var x = document.getElementById('date').innerText = d+' '+m+' '+y;
        </script>
    </body>
</html>