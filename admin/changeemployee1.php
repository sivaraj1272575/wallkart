<?php
    $id = $_POST['id'];
    $name = $_POST['name'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $oldid = $_POST['oldid'];
    $db = mysqli_connect('localhost','root','','wallkart');
    if($db->error)
    {
        echo 'ERROR IN CONNECTION';
        die;
    }
    $query = "UPDATE employee SET name='$name',phone='$phone',email='$email',emp_id='$id' WHERE emp_id='$oldid'";
    $db->query($query);
    $db->close();
    echo '<script>alert("Employee Added Successfully!")</script>';
    header('Location:./changeemployee.php')
?>