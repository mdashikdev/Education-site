<?php
require("db.php");
session_start();
$ssnId=$_SESSION['ssn_id'];

$location=$_REQUEST['location_name'];
$studying_name=$_REQUEST['studying_name'];
$studied_name=$_REQUEST['studied_name'];

if (empty($location) AND empty($studying_name) AND empty($studied_name)) {
    echo "Empty";
}else{

    if(!empty($location) AND !empty($studying_name) AND !empty($studied_name)) {
        $query4=mysqli_query($conn,"UPDATE `users` SET `location`='$location', `studying`='$studying_name', `studied`='$studied_name'  WHERE unique_id='$ssnId' ");
        if ($query4) {
            echo "updated";
         }
    }
    elseif (!empty($location)) {
        $query1=mysqli_query($conn,"UPDATE users SET location='$location' WHERE unique_id='$ssnId' ");
        if ($query1) {
           echo "updated";
        }
    }
    elseif (!empty($studying_name)) {
        $query2=mysqli_query($conn,"UPDATE users SET studying='$studying_name' WHERE unique_id='$ssnId' ");
        if ($query2) {
            echo "updated";
         }
    }
    elseif(!empty($studied_name)){
        $query3=mysqli_query($conn,"UPDATE users SET `studied`='$studied_name' WHERE unique_id='$ssnId' ");
        if ($query3) {
            echo "updated";
         }
    }
    else{
        echo "Failed. You can edit one by one.";
    }

}








?>