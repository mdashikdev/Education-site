<?php

function get_user_details($conn,$id){
    $query=mysqli_query($conn,"SELECT * FROM users WHERE unique_id='$id' ");
    $fetch=mysqli_fetch_assoc($query);
    return $fetch;
}

function check_like_or_not($conn,$question_id,$user_id){
    $query=mysqli_query($conn,"SELECT * FROM `likes` INNER JOIN questions ON questions.question_unique_id=likes.like_question_id WHERE likes.like_user='$user_id' AND questions.question_unique_id='$question_id'");
    if (mysqli_num_rows($query) > 0) {
        $fetch=mysqli_fetch_assoc($query);
        return $fetch;
    }else {
        return mysqli_num_rows($query);
    }
}

function question_like_count($conn,$questin_id){
    $query=mysqli_query($conn,"SELECT * FROM `likes` WHERE like_question_id='$questin_id' AND like_statur='Like' ");
    if ($query) {
        return mysqli_num_rows($query);
    }
}

function question_unlike_count($conn,$questin_id){
    $query=mysqli_query($conn,"SELECT * FROM `likes` WHERE like_question_id='$questin_id' AND like_statur='UnLike' ");
    if ($query) {
        return mysqli_num_rows($query);
    }
}

function question_comment_count($conn,$questin_id){
    $query=mysqli_query($conn,"SELECT * FROM `comments` WHERE question_id='$questin_id' ");
    if ($query) {
        return mysqli_num_rows($query);
    }
}

?>