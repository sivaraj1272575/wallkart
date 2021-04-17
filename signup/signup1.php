<?php
$username=$_POST['username'];
$password=$_POST['password'];
$email=$_POST['email'];
$phone=$_POST['phone'];
$doorno=$_POST['doorno'];
$area=$_POST['area'];
$district=$_POST['district'];
$pincode=$_POST['pincode'];
if(empty($username))
{
    echo '<script>alert("Enter Valid Username")</script>';
    include './signup.php';
    die;
}
else if(empty($password))
{
    echo '<script>alert("Enter Valid Password")</script>';
    include './signup.php';
    die;
}
$dbconnect=mysqli_connect('localhost','root','','wallkart');
if($dbconnect->error)
{
    echo '<script>alert("Error in connection Try Again!..")</script>';
    include './signup.php';
    die;
}
$resultadmin=$dbconnect->query("SELECT * FROM admin WHERE username='$username'");
$resultuser=$dbconnect->query("SELECT * FROM login1 WHERE username='$username'");
$resultmob=$dbconnect->query("SELECT * FROM login1 WHERE phone='$phone'");
$resultemail=$dbconnect->query("SELECT * FROM login1 WHERE email='$email'");
$resultemployee=$dbconnect->query("SELECT * FROM employee WHERE emp_id='$username'");
if($resultmob->num_rows>0)
{
    echo 'Mobile Number Already Registered';
    echo 'click <a href = "#"> here</a> to reset the password and username';
    die;
}
else if($resultemail->num_rows>0)
{
    echo 'Email Id Already Registered';
    echo 'click <a href = "#"> here</a> to reset the password and username';
    die;
}
else if($resultuser->num_rows>0)
{
    echo '<script>alert("Username Already Exists \n Try Another Username!..")</script>';
    include './signup.php';
    die;
}
else if($resultadmin->num_rows>0)
{
    echo '<script>alert("Username Already Exists \n Try Another Username!..")</script>';
    include './signup.php';
    die;
}
else if($resultemployee->num_rows>0)
{
    echo '<script>alert("Username Already Exists \n Try Another Username!..")</script>';
    include './signup.php';
    die;
}
else{
    $stmt=$dbconnect->prepare("INSERT INTO login1 (username,password,phone,email,doorno,area,district,pincode) values (?,?,?,?,?,?,?,?)");
    $stmt->bind_param("ssissssi",$username,$password,$phone,$email,$doorno,$area,$district,$pincode);
    $stmt->execute();
    $dbconnect->close();
    echo('<script>alert("Registration Completed Successfully...")</script>');
    include '../index.html';
}

?>