<html>

    <head>
        <link rel="icon" type="image/png" href="logo1.png">
        <meta name="viewport" content="width=device-width,initial-scale=0.0">
        <title>Register Form</title>
        <style>
          body
{
    background-color: #0D4F8B;
}
#regForm 
{
    background-color: #0D4F8B;
    margin-top: 10px;
    margin-left: 15%;
    padding: 70px;
    width: 50%;
    min-width: 100px;
    border: 3px solid white;
}
input[type=text],select
{
    padding: 10px;
    width: 70%;
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
 
button
{
    border: none;
    width: 90px;
    height: 30px;
    color: white;
    background-color: blue;
    font-size: 16px;
    border-radius: 15px;
    cursor: pointer;
}
input.invalid 
{
    background-color: #ffdddd;
  
}
.tab
{
    display: none;
}
  
.step
{
    height: 15px;
    width: 15px;
    margin: 0 2px;
    background-color: #bbbbbb;
    border: none;
    border-radius: 50%;
    display: inline-block;
    opacity: 0.5;
}

h2
{
    color: white;
}
  
.step.active 
{
    opacity: 1;
}
  
.step.finish 
{
    background-color: blue;
}

marquee{
    height: 25px;
    position: relative;
    animation: example 8s infinite;
    color: white;
    font-family: Verdana, Geneva, Tahoma, sans-serif;
    font-weight: bold;
}
img
{
    height : 50px;
}
a{
    color: cyan;
    
}
        </style>
    </head>
    <body>
        <div id="tit" style="color: white; font-family: 'Times New Roman', Times, serif;font-size: 40px;font-weight: bold;"><img src="../images/logo1.png"> &nbsp; The Wallkart</div>
<div style="background-color: #1874CD;margin-left: -40px;margin-top: 10px;margin-right: -40px;">
    <marquee behavior = "scroll" 
    direction ="left">Enter Your Details</marquee>
    </div>
<form id="regForm" method="POST" action="./signup1.php">

    <div class="tab"><h2>Register:</h2>
      <p><input type="text" name="username" placeholder="Username" required></p>
      <p><input type="password" name="password" placeholder="Password" required></p>
    </div>
    
    <div class="tab"><h2>Contact:</h2>
      <p><input type="text" name="email" placeholder="Email" required></p>
      <p><input type="text" name="phone" placeholder="Mobile" required></p>
    </div>
    
    <div class="tab"><h2>Address:</h2>
      <p><input type="text" name="doorno" placeholder="DoorNo/StreetName"></p>
      <p><input type="text" name="area" placeholder="Area/Loacality"></p>
      <p><select name = "district">
    <option value="" selected disabled>District</option>
    <?php
        $db = mysqli_connect('localhost','root','','wallkart');
        if($db->error)
        {
            echo 'ERROR IN CONNECTION';
            die;
        }
        $query="SELECT * FROM district";
        $result = $db->query($query);
        while($row = mysqli_fetch_assoc($result))
        {
            echo '
            <option value = "'.$row['dist_name'].'">'.$row['dist_name'].'</option>
            ';
        }
    ?>
</select></p>
      <p><input type="text" name="pincode" placeholder="PIN/ZIP Code"></p>
    </div>
    
    
    <div style="overflow:auto;">
      <div style="float:center;">
        <button type="button" id="prevBtn" onclick="nextPrev(-1)">Previous</button>
        <button type="button" id="nextBtn" style = "margin-left: 30%;" onclick="nextPrev(1)">Next</button>
      </div>
    </div>
    
    <div style="text-align:left;margin-top:40px; margin-left: 30%;">
      <span class="step"></span>
      <span class="step"></span>
      <span class="step"></span>
    </div>
    
    </form>
    <script>
        var currentTab = 0; 
showTab(currentTab); 

function showTab(n) {
  
  var x = document.getElementsByClassName("tab");
  x[n].style.display = "block";

  if (n == 0) {
    document.getElementById("prevBtn").style.display = "none";
  } else {
    document.getElementById("prevBtn").style.display = "inline";
  }
  if (n == (x.length - 1)) {
    document.getElementById("nextBtn").innerHTML = "Submit";
  } else {
    document.getElementById("nextBtn").innerHTML = "Next";
        if(n == 0){
            document.getElementById("nextBtn").style.marginLeft = "25%";
        }
        else{
            document.getElementById("nextBtn").style.marginLeft = "43%";
        }

  }
  
  fixStepIndicator(n)
}

function nextPrev(n) {
  
  var x = document.getElementsByClassName("tab");
  
  if (n == 1 && !validateForm()) return false;
  
  x[currentTab].style.display = "none";
  
  currentTab = currentTab + n;
  
  if (currentTab >= x.length) {
  
    document.getElementById("regForm").submit();
    return false;
  }
  
  showTab(currentTab);
}

function validateForm() {
  
  var x, y, i, valid = true;
  x = document.getElementsByClassName("tab");
  y = x[currentTab].getElementsByTagName("input");

  for (i = 0; i < y.length; i++) {

    if (y[i].value == "") {

      y[i].className += " invalid";

      valid = false;
    }
  }

  if (valid) {
    document.getElementsByClassName("step")[currentTab].className += " finish";
  }
  return valid;
}

function fixStepIndicator(n) {
  
  var i, x = document.getElementsByClassName("step");
  for (i = 0; i < x.length; i++) {
    x[i].className = x[i].className.replace(" active", "");
  }
  
  x[n].className += " active";
}
    </script>
</body>
</html>