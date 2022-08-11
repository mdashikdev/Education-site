<?php
session_start();
require("db.php");

$ssnId=$_SESSION['ssn_id'];
$img= $_FILES['image'];
$img_tmp= $_FILES['image']['tmp_name'];
$rand_name="MyeduSite".rand().".jpg";

$query=mysqli_query($conn,"UPDATE users SET profile='$rand_name' WHERE unique_id='$ssnId' ");
if ($query) {
    move_uploaded_file($img_tmp,"../images/$rand_name");
    echo "Profile Updated";
}