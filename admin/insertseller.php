<?php 
    session_start(); 
    if(!isset($_SESSION['username']) || $_SESSION['type']!='admin'){
        header('location:../index.html');
    }
    if(isset($_SESSION['alert'])){
        echo '<script>alert("'.$_SESSION['alert'].'")<script>';
        unset($_SESSION['alert']);
    }
?>
<html>
    <head>
        <title>Insert Seller</title>
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
    background-color: #ffffff;
    margin-left: 100px;
    margin-right: 50px;
    margin-top: 10px;
    width: 50%;
    min-width: 100px;
}
input[type=text]
{
    padding: 10px;
    width: 30%;
    font-size: 17px;
    font-family: Raleway;
    border: 1px solid #aaaaaa;
}

input[type=number]
{
    padding: 10px;
    width: 30%;
    font-size: 17px;
    font-family: Raleway;
    border: 1px solid #aaaaaa;
}

input[type=file]
{
    padding: 10px;
    width: 30%;
    font-size: 17px;
    font-family: Raleway;
    border: 1px solid #aaaaaa;
}
input[type=email]
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
    background-color: 0D4F8B;
    font-size: 16px;
    border-radius: 15px;
    position: absolute;
    display: flex; 
    justify-content: center;
}
input.invalid 
{
    background-color: #ffdddd;
  
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
                <td><a href = "./adminhome.php" style="cursor: pointer;">Home</a></td>
                <td><a href = "#" style="cursor: pointer;">Seller</a></td>
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
    
    
    
        <h1 style="text-align: center; color: black;">Seller Details</h1></br>
    <form style = "margin-left: 50px;margin-right: 50px;" action="./insertseller1.php" method="POST">
        <input type="text" name="code" placeholder="Seller Code" style="float: left;" required>
        <input type="text" name="name" placeholder="Seller Name" style="float: right;" required></br></br></br></br>
        <input type="text" name="mobile" placeholder="Mob Number" style="float: left;" required>
        <input type="email" name="email" placeholder="Email ID" style="float: right;"></br></br></br></br>
        <h3 style="text-align: center; color: black;" required>Address:</h3></br></br>
        <input type="text" name="door" placeholder="Flat No" required></br></br>
        <input type="text" name="area" placeholder="Area" required>  </br></br>
        <input type="text" name="district" placeholder="District" required></br></br>
        <input type="text" name="pin" placeholder="ZIP/PIN" required></br></br>
        <input style = "float: center; position: absolute; left: 50%;" type="submit" name="submit" value="add">
    </form>
    </body>
</html>
