<html>
    <head>
        <style>
            body
            {
                margin-left :50px;
                margin-top: 50px;
            }
            .circle
            {
                width: 60%;
                height: 50px;
                border-radius: 50%;
                background-color: #0D4F8B;
                display: block;
                margin-left: 20%;
                color: white;
                font-weight: bold;
                text-align: center;
            }
            .con
            {
                width: 1%;
                height: 20px;
                background-color:blue;
                display: block;
                margin-left: 49%;
            }
            .date
            {
                text-align: center;
                margin-top: 1%;
                display: block;
                color: cyan;
            }
            
        </style>
    </head>
    <body>
        
        <?php
            $id = $_GET['id'];
            $db=mysqli_connect('localhost','root','','wallkart');
            if($db->error)
            {
                echo 'ERROR IN CONNECTION';
                die;
            }
            $query = "SELECT * FROM dates WHERE order_id=$id";
            $q2 = "SELECT * FROM order1 WHERE order_id=$id";
            $result = $db->query($query);
            $res2 = $db->query($q2);
            if($result->num_rows>0)
            {
                $row = mysqli_fetch_assoc($result);
                $row2 = mysqli_fetch_assoc($res2);
                echo '
                <span class= "circle" id="ordered">ORDERED<span class="date">'.$row['order_date'].'</span></span>
                <span class="con"></span>
                <span class= "circle" id="confirmed">CONFIRMED<span class="date">'.$row['confirm_date'].'</span></span>
                <span class="con"></span>
                <span class= "circle" id="packed">PACKED<span class="date">'.$row['pack_date'].'</span></span>
                <span class="con"></span>
                <span class= "circle" id="shipped">SHIPPED<span class="date">'.$row['ship_date'].'</span></span>
                <span class="con"></span>
                <span class= "circle" id="arrived">ARRIVED<span class="date">'.$row['arrive_date'].'</span></span>
                <span class="con"></span>
                <span class= "circle" id="delivered">DELIVERED<span class="date">'.$row['delivery_date'].'</span><span hidden>Expected : '.$row2['estimate'].'</span></span>
                ';
            }

        ?>
        <script>
            var circ = document.querySelectorAll('.circle');
            var con = document.querySelectorAll('.con');
            var temp;
            for(i=0;i<circ.length;i++)
            {
                temp = circ[i].childNodes;
                if(temp[1].innerText=="")
                {
                    circ[i].style.backgroundColor = "#d9d9d9";
                    con [i-1].style.backgroundColor="#d9d9d9";
                    if(i===5)
                    {
                        temp[2].style.display ="block";
                        temp[2].style.color = "#0D4F8B";
                    }
                }
            }
        </script>
    </body>
</html>