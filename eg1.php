<html>
    <head>
        <title>Home</title>
        <meta name="viewport" content="width=device-width,initial-scale=1.0">
        
    </head>
    <body>
    <style>
            td, th
            {
                text-align: left;
                padding: 8px;
            }
        </style>
        <input type="text" id="search" Onkeyup="myFunction()" placeholder="Search">
        <table id="product" style = "width :100%;font-family: 'Times New Roman', Times, serif;border-collapse: collapse; color : black; font-size: 20px;">
        <tr>
        <th>Code</th>
        <th>Name</th>
        <th>Category</th>
        <th>Image</th>
        <th>Detailes</th>
        </tr>
        <?php
            $db=mysqli_connect('sql108.epizy.com','epiz_25497315','siva13701','epiz_25497315_product');
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
                    echo "<tr id =".$row['code'].">
                    <td>".$row['code']."</td>
                    <td>".$row['name']."</td>
                    <td>".$row['category']."</td>
                    <td>
                    </tr>";
                }
            }
        ?>
        </table>
        <script>
        function myFunction() {
        var input, filter, table, tr, td, i, txtValue;
        input = document.getElementById("search");
        filter = input.value.toUpperCase();
        table = document.getElementById("product");
        tr = table.getElementsByTagName("tr");
        for (i = 0; i < tr.length; i++) 
        {
        td = tr[i].getElementsByTagName("td")[1];
        td2 = tr[i].getElementsByTagName("td")[2];
        if (td) {
        txtValue = td.textContent || td.innerText;
        if (txtValue.toUpperCase().indexOf(filter) > -1) {
        tr[i].style.display = "";
        } else {
        tr[i].style.display = "none";
        }
        }       
        }
        }
        var x = document.getElementsByTagName("tr");
        var idval;
        function viewFunction(val)
        {
            if (val.id == null)
            {
                idval = x[1].id;
            }
            else
            {
                idval = val.id;
            }
            console.log(idval);
            t = document.querySelector('body');
            t.innerHTML = "";
            t.innerHTML += 'Siva';
        }
        </script>
    </body>
</html>