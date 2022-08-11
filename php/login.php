<?php 
require("db.php");
session_start();

$email= $_REQUEST['email'];
$pass= sha1(md5($_REQUEST['pass']));

$query=mysqli_query($conn,"SELECT * FROM users WHERE email='$email' AND pass='$pass' ");
if ($query) {
    if (mysqli_num_rows($query) > 0) {
        $fetch=mysqli_fetch_assoc($query);
        $unid=$fetch['unique_id'];
        $_SESSION['ssn_id']=$unid;
        echo "You are logged in";
    }else {
        echo "email or password incorrect";
    }
}



?>