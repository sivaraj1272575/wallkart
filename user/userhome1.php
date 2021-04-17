<?php 
    session_start(); 
    if(!isset($_SESSION['username'])){
        header('location:../index.html');
    }
?>
<html ng-app = "home">
    <head>
        <title>Home</title>
        <link rel="icon" type="image/png" href="../images/logo1.png">
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
            height : 300px;
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
                background-color: #0D4F8B;
                font-size: 15px;
                border-radius: 16px;
                position: relative;
                display: flex; 
                justify-content: center;
                cursor: pointer;
                left: 35px;
                
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
            float: right;
            padding: 20px;
            border: 1px solid #888;
            width: 20%;
            height: 100%;
            margin-top: -8%;
            color: white ;
            text-align: center;
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
                <td style="color: cyan; font-weight: bold; text-align: right;"><?php echo strtoupper($_SESSION['username']) ?> &nbsp;   <a style = "color: cyan;" href = "http://localhost/index2.html">Sign Out</a></td>
                
            </tr>
            <tr></tr>
        </table>
</div>
        <table style="width :100%; margin-top: -4px; font-family: verdana;" border = 0 cellspacing = 0>
            <tr style="background-color: black; height: 25px; text-align: left;">
                <td><a href = {{hm}} style="cursor: pointer;">Home</a></td>
                <td><a href = './show-order-user.php' style="cursor: pointer;">Mybag</a></td>
                <td><a onclick="filterOpen()" style="cursor: pointer;">Filter</a></th>
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
            l = l.slice(n);
            l = l.split('%22');
            var usr = l[1];
            app.controller("homecontroller",["$scope",function($scope){
                $scope.date = d+' '+m+' '+y;
                $scope.user = usr;
                $scope.hm = '../user/userhome1.php';
                $scope.bag = '../user/mybag.php';
            }]);
        </script>
        <div class = 'output'>
        <div style="background-color :black;height :30px; margin-left:0px; margin-right:0px">
        <input type = "text" id = "search" placeholder="Search" onkeyup='searchprod()' style = "float :right;margin-right : 10px">
</div>
        <br><br>
        <?php
        $db=mysqli_connect('localhost','root','','wallkart');
        if($db->error)
        {
            echo "<script>alert('ERRROR')</script>";
            die;
        }
        $result=$db->query("SELECT * FROM product");
            if($result->num_rows>0)
            {
                while($row=mysqli_fetch_array($result))
                {
                    if($row['quantity']>0)
                    {
                        echo "<div class = 'gallery' id ='".$row['category']."'>
                        <img src = '".$row['image']."' height = '180' width = '600'>
                        <div class = 'price' hidden>".$row['price']."</div>
                        <div class = 'brand' hidden>".$row['brand']."</div>
                        <div class = 'cat' hidden>".$row['category']."</div>
                        <div class = 'desc' style = 'color : black'>".$row['name']."</br></br>
                        <button onclick = myprod('".$row['code']."')>view</button></div>
                        </div>
                        ";
                    }
                }
            }
        ?>
        </div>

        
        <div class="modal">
            <div class="modal_content">
                <span class="close" onclick="closefilt()">&times;</span><h3>Filter</h3>
                <input type="number" id = "price-lower" name="price-lower" placeholder="Lower Price.." style="width: 85%; height: 30px;"><br><br>
                <input type="number" id ="price-upper" placeholder="Upper Price.." style="width: 85%; height: 30px;"><br><br>
                <select id = 'categ' style="width: 85%; height: 30px;" onchange="catselect()">
                    <option value="" disabled selected>Category</option>
                    <option value="furniture">Furniture</option>
                    <option value="clothing">Clothing</option>
                    <option value="electronics">Electronics</option>
                    <option value="mobile">Mobile</option>
                    <option value="toys">Toys</option>
                    <option value="books">Books</option>
                </select><br><br>
                <select id = 'selectbrand' style="width : 85%; height: 30px;">
                <option value="" disabled selected>Brand</option> 
                </select><br><br>
                <input type="button" value="Apply" style = "background-color: blue; margin-left: 12%" name="aplyfilt" onclick="applyFilter()">
            </div>
        </div>
        <script>
            var val = document.getElementById('categ');
            mod = document.querySelector('.modal');
            function filterOpen()
            {
                mod.style.display = 'block';
            }
            cls = document.querySelector('.close');
            function closefilt()
            {
                mod.style.display = 'none';
            }

            tr = document.querySelectorAll(".gallery");
            var lst =[];
            for(i=0;i<tr.length;i++)
            {
                td = tr[i].childNodes;
                if(tr[i])
                    lst.push({
                        category : td[7].innerText,
                        brand : td[5].innerText
                    });
            }
            function catselect()
            {
                sel = document.getElementById('selectbrand');
                for(i=1;i<sel.options.length;i++)
                {
                    sel.remove(i);
                }
                console.log(String(val.value));
                var brandlist = [];
                for(i=0;i<lst.length;i++)
                {
                    if(lst[i].category==val.value && brandlist.indexOf(lst[i].brand)==-1)
                    {
                        brandlist.push(lst[i].brand);
                    }
                }
                for(i=0;i<brandlist.length;i++)
                {
                    op=document.createElement('option');
                    op.innerText = brandlist[i];
                    op.value = brandlist[i];
                    sel.add(op);
                    console.log('hello');
                }
            }
            function applyFilter()
            {
                low = document.getElementById('price-lower');
                high = document.getElementById('price-upper');
                cat = document.getElementById('categ');
                br = document.getElementById('selectbrand');
                tr = document.querySelectorAll(".gallery");
                if(low.value=="" && high.value=="" && cat.value=="" && br.value=="")
                {
                    closefilt();
                    return;
                }
                for(i=0;i<tr.length;i++)
                {
                    td=tr[i].childNodes;
                    if(parseInt(low.value)!=null && parseInt(high.value)!=null && parseInt(td[3].innerText)>parseInt(low.value) && parseInt(td[3].innerText)<parseInt(high.value))
                    {
                        if(cat.value===td[7].innerText)
                        {
                            if(br.value===td[5].innerText)
                            {
                                tr[i].style.display = '';
                            }
                        }    
                    } 
                    else
                    {
                        tr[i].style.display = 'none';
                    }
                }
                closefilt();

            }

        </script>
        <script type="text/javascript">

            function myprod(val)
            {
                window.open('http://localhost:8080/wallkart/user/fetch.php?code="'+val+'"');
            }
            function searchprod()
            {
                var input, filter, table, tr, td, i, txtValue,categ;
                input = document.getElementById("search");
                filter = input.value.toUpperCase();
                tr = document.querySelectorAll(".gallery");
                for (i = 0; i < tr.length; i++) 
                {
                    td = tr[i].childNodes[9];
                    if (td) 
                    {
                        txtValue = td.innerText;
                        categ = tr[i].id;
                        if (txtValue.toUpperCase().indexOf(filter) > -1||categ.toUpperCase().indexOf(filter) > -1) 
                        {
                            tr[i].style.display = "";
                        }
                        else 
                        {
                            tr[i].style.display = "none";
                        }
                    } 
                    
                }       
            }
        </script>
    </body>
</html>





