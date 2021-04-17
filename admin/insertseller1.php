<?php
session_start();
$code=$_POST['code'];
$name=$_POST['name'];
$mobile=$_POST['mobile'];
$email=$_POST['email'];
$door=$_POST['door'];
$area=$_POST['area'];
$district=$_POST['district'];
$pin=$_POST['pin'];

$db=mysqli_connect('localhost','root','','wallkart');
if($db->error)
{
    echo '<script>alert("Error in Connection")</script>';
    header("Location:./insertseller.php");
    die;
}
$resultcode=$db->query("SELECT * FROM seller WHERE code='$code'");
$resultmob=$db->query("SELECT * FROM seller WHERE mobile='$mobile'");
$resultemail=$db->query("SELECT * FROM seller WHERE email='$email'");
if($resultmob->num_rows>0)
{
    $_SESSION['alert'] = 'Mobile Number Already Registered';
    header("Location:./insertseller.php");
    die;
}
if($resultemail->num_rows>0)
{
    echo '<script>alert("Email Id Already Registered")</script>';
    header("Location:./insertseller.php");
    die;
}

if($resultcode->num_rows>0)
{
    echo '<script>alert("Seller Code Already Registered")</script>';
    header("Location:./insertseller.php");
    die;
}

$stmt= $stmt=$db->prepare("INSERT INTO seller (code,name,mobile,email,flat,area,district,pincode) values (?,?,?,?,?,?,?,?)");
$stmt->bind_param("ssssssss",$code,$name,$mobile,$email,$door,$area,$district,$pin);
$stmt->execute();
echo '<script>alert("Seller Registered Successfully!..")</script>';
header("Location:./insertseller.php");
$db->close();
die;
?>