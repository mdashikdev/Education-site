<?php
session_start();
require("db.php");

if (isset($_SESSION['ssn_id'])) {
    $text= $_REQUEST['comment_text'];
    $post_id= $_REQUEST['pst_id'];
    $current_id=$_SESSION['ssn_id'];
    $rand=uniqid();
    $query=mysqli_query($conn,"INSERT INTO comments ( usr_id,question_id,comment_text,comment_id ) VALUES ('$current_id','$post_id','$text','$rand') ");
    if ($query) {
        echo "commented";
    }

}else {
    echo "Please Login or register your account";
}






?>