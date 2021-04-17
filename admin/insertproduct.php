<?php 
    session_start(); 
    if(!isset($_SESSION['username']) || $_SESSION['type']!='admin'){
        header('location:../index.html');
    }
?>
<html>
    <head>
        <title>Insert Product</title>
        <meta name='viewport' content='width=device-width,initial-scale=1.0'>
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
textarea
{
    padding: 10px;
    width: 57%;
    font-size: 17px;
    font-family: Raleway;
    border: 1px solid #aaaaaa;
    float: center;
}
input[type=file]
{
    padding: 10px;
    width: 30%;
    font-size: 17px;
    font-family: Raleway;
    border: 1px solid #aaaaaa;
}
input[type=password]
{
    padding: 10px;
    width: 70%;
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
    position: absolute;
    display: flex; 
    justify-content: center;
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
    <script>
    document.getElementById("product").reset();
    </script>
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
                <td><a href = "#" style="cursor: pointer;">Products</a></td>
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
        <h1 style="text-align: center; color : black">Product Details</h1></br></br>
        <form id="product" style = "margin-left: 50px;
    margin-right: 50px;" action="./insertproduct1.php" method="POST"  enctype="multipart/form-data">
        <input type="text" name="productcode" placeholder="Product Code" required style="float: left;">
        <input type="file" name="image" value="Image" placeholder="Image" required style="float: right;"></br></br></br></br>
        <input type="text" name="name" placeholder="Product Name" required style="float: left;">
        <input type="text" name="price" placeholder="Price" required style="float: right;"></br></br></br></br>
        <select id = 'categ' name="category">
                    <option value="" disabled selected>Category</option>
                    <option value="furniture">Furniture</option>
                    <option value="clothing">Clothing</option>
                    <option value="electronics">Electronics</option>
                    <option value="mobile">Mobile</option>
                    <option value="toys">Toys</option>
                    <option value="books">Books</option>
                </select>
        <input type="number" name="quantity" placeholder="Quantity" required style="float: right;"></br></br></br></br>
        <input type="text" name="brand" placeholder="Brand" required>
        <select name="seller" style="float: right">
        <option value="" selected disabled>Seller Name</option>
        <?php
        $dbconnect=mysqli_connect('localhost','root','','wallkart');
        if($dbconnect->error)
        {
            echo '<script>alert("Error")</script>';
            die;
        }
        $result=$dbconnect->query('SELECT * FROM seller');
        if($result->num_rows>0)
        {
            while($row=mysqli_fetch_array($result))
            {
                echo "<option value='".$row['code']."'>".$row['name']."</option>";
            }
            $dbconnect->close();
        }?></select>
        </br></br></br></br>
        <textarea id="specification" name="spec" rows="4" cols="50" placeholder="Any 3 Specifications"></textarea></br></br></br></br>
        <input type="submit" name="submit" value="add" style = "position: absolute; left: 50%;">
    </form>
    </body>
</html>