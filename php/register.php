<?php
require("db.php");

$nickname= $_REQUEST['nickname'];
$email= $_REQUEST['email'];
$location= $_REQUEST['location'];
$pass= sha1(md5($_REQUEST['pass']));
$unique_id=uniqid();

$query1=mysqli_query($conn,"SELECT * FROM users WHERE email='$email' ");
if ($query1) {
    if (mysqli_num_rows($query1) > 0) {
        echo "This email already registered";
    }else{
        $query=mysqli_query($conn,"INSERT INTO users (`unique_id`,`name`,`email`,`pass`,`location`) VALUES ('$unique_id','$nickname','$email','$pass','$location') ");
        if($query){
            echo "Registerd";
        }else {
            echo "failed";
        }
    }
}




?>