<?php
$code=$_POST['productcode'];
$name=$_POST['name'];
$image = $_FILES['image']['name'];
$price=$_POST['price'];
$category=$_POST['category'];
$quantity=$_POST['quantity'];
$seller=$_POST['seller'];
$spec=$_POST['spec'];
$brand=$_POST['brand'];
$previous = "javascript:history.go(-1)";
$db = mysqli_connect('localhost','root','','wallkart');
if($db->error)
{
    echo '<script>alert("Error in Connection")</script>';
    header("Location:./insertproduct.php");
    die;
}
$result=$db->query("SELECT * FROM product WHERE code='$code'");
if($result->num_rows>0)
{
    echo '<script>alert("Product Already Exists")</script>';
    header("Location:./insertproduct.php");
    die;
}
$ext = end(explode('.',$_FILES['image']['name']));

$imgname = $code.'.'.$ext;
$imgpath = '../images/'.$imgname;
move_uploaded_file($_FILES['image']['tmp_name'],$imgpath);
$sql = "INSERT INTO product (code,name,price,quantity,image,seller,spec,brand,category) VALUES(?,?,?,?,?,?,?,?,?)";
$stmt = mysqli_prepare($db,$sql);

mysqli_stmt_bind_param($stmt, "sssisssss",$code,$name,$price,$quantity,$imgpath,$seller,$spec,$brand,$category);
mysqli_stmt_execute($stmt);
echo '<script>alert("Product Added Successfully..")</script>';
header("Location:./insertproduct.php");
mysqli_close($db);
?>