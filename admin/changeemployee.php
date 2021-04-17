<?php 
    session_start(); 
    if(!isset($_SESSION['username']) || $_SESSION['type']!='admin'){
        header('location:../index.html');
    }
?>
<html>
    <head>
        <title>Employee</title>
        <meta name="viewport" content="width=device-width,initial-scale=1.0">
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
#regForm
{
    color: black;
}
input[type=text],input[type=email]
{
    padding: 10px;
    width: 30%;
    font-size: 17px;
    font-family: Raleway;
    border: 1px solid #aaaaaa;
}
 
input[type=submit]
{
    border: none;
    width: 90px;
    height: 30px;
    color: white;
    background-color: #0D4F8B;
    font-size: 16px;
    border-radius: 15px;
    margin-left: 45%;
    cursor: pointer;
}
input.invalid 
{
    background-color: #ffdddd;
}
select
{
    padding: 10px;
    width: 30%;
    font-size: 17px;
    font-family: Raleway;
    border: 1px solid #aaaaaa;
}
        </style>
    
    </head>
    <body>
    <table style="width :100%; height: 40px;" border = 0 cellspacing = 0 >
            <tr style="background-color: #0D4F8B; height: 30px;">
                <td style="text-align: left;"><img src="../images/logo1.png"></td>
                <td style="text-align: center; font-size: 20px; font-family: Cambria, Cochin, Georgia, Times, 'Times New Roman', serif; font-weight: bold;color: cyan">Admin Page</td>
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
                <td><a href = "./adminhome" style="cursor: pointer;">Home</a></td>
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
        
        <form id='regForm' method="POST" action="./changeemployee1.php" style="margin-left: 50px; margin-right: 50px;">
        <center><h1>Employee Details</h1></center><br>
        <input type="text" name="id" placeholder="Emp Id" required>
        <input type="text" name="name" placeholder="Emp Name" required style="float: right"> <br><br><br>
        <input type="text" name="phone" placeholder="Mobile No"  required>
        <input type="email" name="email" placeholder="Email" required style="float: right"><br><br><br>
        <br><br><br>
        <h3>Select Old Employee:</h3>
        <select style="width: 50%" name = "oldid">
            <option value="" disabled selected>Name (District)</option>
            <?php
                $db = mysqli_connect('localhost','root','','wallkart');
                if($db->error)
                {
                    echo 'ERROR IN CONNECTION';
                    die;
                }
                $query = "SELECT * FROM employee";
                $result = $db->query($query);
                while($row = mysqli_fetch_assoc($result))
                {
                    echo '
                    <option value = "'.$row['emp_id'].'">
                    '.$row['name'].' ('.$row['district'].')</option>
                    ';
                }
            ?>
        </select><br><br><br>
        <input type="submit" value="Change" name="add"><br><br><br>
        
        </form>
    </body>
</html>