<?php
    $id = $_POST['id'];
    $name = $_POST['name'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $district = $_POST['district'];
    $db = mysqli_connect('localhost','root','','wallkart');
    if($db->error)
    {
        echo 'ERROR IN CONNECTION';
        die;
    }
    $query = "INSERT INTO employee(emp_id,name,phone,email,district) VALUES (?,?,?,?,?)";
    $stmt=mysqli_prepare($db,$query);
    mysqli_stmt_bind_param($stmt,"sssss",$id,$name,$phone,$email,$district);
    mysqli_stmt_execute($stmt);
    $db->close();
    echo '<script>alert("Employee Added Successfully!")</script>';
    header('Location:./addemployee.php');
?>