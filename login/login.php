<?php
$username=$_POST['username'];
$password=$_POST['password'];

session_start();

$dbconnect=mysqli_connect('localhost','root','','wallkart');
if($dbconnect->error)
{
    echo '<script>alert("Try Again...")</script>';
    include 'index.html';
    die; 
}
$user=$dbconnect->query("SELECT * FROM login1 WHERE username='$username'");
$admin=$dbconnect->query("SELECT * FROM admin WHERE username='$username'");
$employee=$dbconnect->query("SELECT * FROM employee WHERE email='$username'");
if($user->num_rows>0)
{
    $row = mysqli_fetch_assoc($user);
    if($row['password']==$password)
    {
        $_SESSION['username'] = $row['username'];
        $_SESSION['email'] = $row['email'];
        header('Location: ../user/userhome1.php');
    }
    else
    {
        echo '<script>alert("Invalid Username!")</script>';
        header('Location: ../index.html');
    }
    
}
else if($admin->num_rows>0)
{
    $row = mysqli_fetch_assoc($admin);
    if($row['password']==$password)
    {
        $_SESSION['username'] = $row['username'];
        $_SESSION['type'] = 'admin';
        header('location:../admin/adminhome.php');
        die;
    }
    else
    {
        
        echo '<script>alert("Invalid Username!")</script>';
        header('Location: ../index.html');
    }
    
}
else if($employee->num_rows>0)
{
    $row = $employee->fetch_assoc();
    if($row['emp_id']==$password)
    {
        $dist = $row['district'];
        $_SESSION['username'] = $row['name'];
        $_SESSION['district'] = $dist;
        header('Location:../employee/employee.php');
    }
    else
    {
        echo '<script>alert("Invalid Username!")</script>';
        header('Location: ../index.html');
    }
    
}
else
{
    echo '<script>alert("Invalid Username!")</script>';
    header('Location: ../index.html');
}
$dbconnect->close();
?>