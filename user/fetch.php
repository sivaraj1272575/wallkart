<?php 
    session_start(); 
    if(!isset($_SESSION['username'])){
        header('location:../index.html');
    }
?>
<html ng-app = "home">
    <head>
        <title>Product</title>
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
            div.gallery {
  margin: 5px;
  border: 1px solid #ccc;
  float: left;
  width: 180px;
  height : 270px;
  display: inline-block;
}

div.gallery:hover {
  border: 1px solid #777;
}

div.gallery img {
  width: 100%;
  height: 180px;
}

div.desc {
  padding: 15px;
  text-align: center;
}
button,input[type=button]
{
    border: none;
    width: 70px;
    height: 26px;
    color: white;
    background-color: blue;
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
.modal {
            display: none; 
            position: fixed;
            z-index: 1; 
            padding-top: 100px;
            left: 0;
            top: 0;
            width: 100%; 
            height: 100%;
            overflow: auto;
            background-color: rgb(13, 79, 139);
            background-color: rgb(13, 79, 139, 0.5)
        }
        .modal_content
        {
            background-color:  rgb(13, 79, 139);
            margin: auto;
            padding: 20px;
            border: 1px solid #888;
            width: 50%;
            height: auto;
            margin-top: 10%;
        }
        .close 
        {
            color: #aaaaaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }

        .close:hover,
        .close:focus 
        {
            color: #000;
            text-decoration: none;
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
                <td style="color: cyan; font-weight: bold; text-align: right;"><?php echo strtoupper($_SESSION['username']); ?> &nbsp;   <a style = "color: cyan;" href = "#">Sign Out</a></td>
                
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
            }]);
        </script>

<div class="modal">
            <div class="modal_content">
                <center>
                <h2>Payment Method</h2><span class="close">&times;</span>
                <h4><input type="radio" name ="payment" value ="COD" style="cursor: pointer;">Cash On Delivery<br><br>
                <input type="radio" name ="payment" value ="Card" style="margin-left: -6px; cursor: pointer;">Credit/Debit Card<br><br></h4></center>
                <input type="button" name = "order" value="order" style="margin-left: 30%; background-color: blue" id="order-prod" >
            </div>
</div>

<div style="color: black; margin-left :2%">
<?php
    $code = $_GET['code'];
    function viewproduct($code)
    {
        $db=mysqli_connect('localhost','root','','wallkart');
        if($db->error)
        {
            echo 'EROOR';
            die;
        }
        
        $query = "SELECT * FROM product WHERE code = $code";
        $result = $db->query($query);
        if($result->num_rows>0)
        {
            $row = mysqli_fetch_assoc($result);
            $selcode = $row['seller'];
            $selq = "SELECT * FROM seller WHERE code ='".$selcode."'";
            $result1 = $db->query($selq);
            $seller = mysqli_fetch_assoc($result1);
            echo "
            <center><h1>".$row['name']."</h1></center>
            <center><img src = '".$row['image']."'height = '300' width = '300'></center>
            <br>
            <center><h4>Brand : ".$row['brand']."</h4></center>
            ";
            $arr = array($row['spec']);
            $news=(str_replace(".","</li><li>",$arr))[0];
            echo '
            <h4>Specification :<br>
                <li>'.$news.'
                </h4>
            ';
            echo '
            <h3>Seller Details:</h3><br>
            ';
            echo '
            <div style = "text-align: left">
            <h4>Seller Name : '.$seller['name'].'
            <h4>Address&nbsp;&nbsp; :<br><br>
            '.$seller['flat'].',<br>
            '.$seller['area'].',<br>
            '.$seller['district'].',<br>
            '.$seller['pincode'].'.
            </div>';
            echo '
            <h3>Price : <mark style="background-color : cyan; color :#0D4F8B">Rs '.$row['price'].'</mark></h3>
            ';
        }
    }
    viewproduct($code);
    
?></div><div class ='btns'>
<button onclick ='back()' style = 'float:left'>Back</button>
<button onclick = 'order()' style = 'float:right; margin-right:20%'>Order</button></div>
<script>
    var usr = l[1];
    var code = <?php  echo $code; ?>;
    var modal = document.querySelector('.modal');
        var btn = document.getElementById('pay');
        var close1 = document.querySelector('.close');
        close1.onclick = function()
        {
            modal.style.display = "none";
        }
        window.onclick = function(event)
        {
            if(event.target == modal)
            {
                modal.style.display = "none";
            }
        }
    function order()
    {
        modal.style.display = "block";
    }
    function back()
    {
        window.close();
    }
    var btn = document.getElementById('order-prod');

    btn.onclick = function()
    {
        names = document.getElementsByName('payment');
        if(names[0].checked)
        {
            window.open('order.php?code='+code,'_self');
            alert('Product Ordered Successfully!.');
        }
        else if(names[1].checked)
        {

        }
    }


</script>
</body>
</html>
