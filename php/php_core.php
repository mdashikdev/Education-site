<?php 
require("db.php");
require("function.php");
session_start();

if (isset($_SESSION['ssn_id'])) {
    $current_user=$_SESSION['ssn_id'];
}





//show all questions
if (isset($_REQUEST['this_is_for_show_questions'])) {
    if ($_REQUEST['this_is_for_show_questions']=="this_is_for_show_questions") {
        $check_like_query=mysqli_query($conn,"SELECT * FROM questions ORDER BY id DESC ");

        if (mysqli_num_rows($check_like_query) > 0) {
            while ($data=mysqli_fetch_assoc($check_like_query)) {

                $userinfo=get_user_details($conn,$data['owner']);
                $like_react=question_like_count($conn,$data['question_unique_id']);
                $unlike_count=question_unlike_count($conn,$data['question_unique_id']);
                $comment_count=question_comment_count($conn,$data['question_unique_id']);
                $like_btn='
                    <button class="react_btn insert_like" style="background: var(--white-color-);border: 1px solid var(--primary-color--);color: var(--font-color--);" data-id="'.$data['question_unique_id'].'"><i class="bx bx-like"></i></button>
                    <button class="react_btn insert_unlike wrng" style="background: background: var(--white-color-);border: 1px solid var(--primary-color--);color: var(--font-color--);" data-id="'.$data['question_unique_id'].'"><i class="bx bx-dislike" ></i></button>
                    ';

                if (isset($_SESSION['ssn_id'])) {
                    $fetch=check_like_or_not($conn,$data['question_unique_id'],$current_user);
                    if ($fetch == 0) {
                        $like_status='';
                    }else {
                        $like_status= $fetch['like_statur'];
                        
                    }
                    if ($like_status == "Like") {
                        $like_btn='
                        '.$like_react.'
                        <button class="react_btn delete_like" style="background:#7084d6;" data-id="'.$data['question_unique_id'].'"><i style="color:white" class="bx bx-like"></i></button>
                        '.$unlike_count.'
                        <button class="react_btn insert_unlike wrng" style="background: background: var(--white-color-);border: 1px solid var(--primary-color--);color: var(--font-color--);" data-id="'.$data['question_unique_id'].'"><i class="bx bx-dislike" ></i></button>
                        ';
                    }
                    elseif ($like_status == "UnLike") {
                        $like_btn='
                        '.$like_react.'
                        <button class="react_btn insert_like" style="background: background: var(--white-color-);border: 1px solid var(--primary-color--);color: var(--font-color--);" data-id="'.$data['question_unique_id'].'"><i class="bx bx-like"></i></button>
                        '.$unlike_count.'
                        <button class="react_btn delete_unlike wrng" style="background:#7084d6;" data-id="'.$data['question_unique_id'].'"><i style="color:white" class="bx bx-dislike" ></i></button>
                        ';
                    }else {
                        $like_btn='
                        '.$like_react.'
                        <button class="react_btn insert_like" style="background: var(--white-color-);border: 1px solid var(--primary-color--);color: var(--font-color--);" data-id="'.$data['question_unique_id'].'"><i class="bx bx-like"></i></button>
                        '.$unlike_count.'
                        <button class="react_btn insert_unlike wrng" style="background: background: var(--white-color-);border: 1px solid var(--primary-color--);color: var(--font-color--);" data-id="'.$data['question_unique_id'].'"><i class="bx bx-dislike" ></i></button>
                        ';
                    }
                }

                if ($data['answer'] !== "") {
                    $ansText='Answer: ';
                    $asked_text="posted a answer";
                }
                else {
                    $ansText="";
                    $asked_text='asked';
                }
                if ($userinfo['studying']=="") {
                    $studying='';
                }else {
                    $studying='
                        <div>
                            <i class="bx bx-book-open"></i>
                            <span class="default_text">Studying at: </span>
                            <span class="dynamic_text">'.$userinfo['studying'].'</span>
                        </div>
                    ';
                }
                if ($userinfo['studied']=="") {
                    $studied='';
                }else {
                    $studied='
                    <div>
                        <i class="bx bxs-graduation" ></i>  
                        <span class="default_text">Studied at: </span>
                        <span class="dynamic_text">'.$userinfo['studied'].'</span>
                    </div>
                    ';
                }

                if ($userinfo['location']=="") {
                    $location='';
                }else {
                    $location='
                    <div>
                        <i class="bx bx-current-location"></i>
                        <span class="default_text">From: </span>
                        <span class="dynamic_text">'.$userinfo['location'].'</span>
                    </div>
                    ';
                }


                echo '
                    <div class="question_posts">
                    <div class="user_details_container_class" id="user_details_container_class'.$userinfo['unique_id'].'" style="
                    width: fit-content;
                    height: fit-content;
                    top: 24%;
                    left: 4%;
                    background: var(--white-color-);
                    box-shadow: 0px 0px 20px var(--primary-light-color--);
                    position: absolute;
                    border-radius: 6px;
                    padding: 4px;
                    border: 1px solid var(--primary-color--);
                    transform:scaleY(0);
                    transition:0.3s ease-in;
                    transform-origin:top;
                    z-index:3;
                    ">
                    
                    <div>
                        <div style="display:flex;border-bottom:1px solid #ccc">
                            <img src="images/'.$userinfo['profile'].'" style="width:35px;height:35px;border-radius:50%;object-fit:cover">
                                <strong>
                                    '.$userinfo['name'].'
                                </strong>
                        </div>
                        <div id="user_detail_center_content" style="display:flex;flex-direction:column;line-height: 13px;">
                            '.$studying.'
                            '.$studied.'
                            '.$location.'
                            <button>Follow</button>
                        </div>
                        
                    </div>
                    

                    </div>
                        <div>
                            <div class="post_user_details">
                                <img src="images/'.$userinfo['profile'].'" alt="">
                                <span class="user_name">
                                    <a class="user_details_show_class" data-id="'.$userinfo['unique_id'].'" href="user.php?ui='.$userinfo['unique_id'].'">
                                        <strong>
                                            '.$userinfo['name'].'
                                        </strong>
                                    </a>
                                    '.$asked_text.'
                                </span>
                            </div>
                            
                            <span class="question_text">
                               '.$data['question'].'
                            </span>
                        </div>
                        <div style="min-height:25px">
                            <span class="answer_text">
                                '.$ansText.'
                            </span>
                            <span>
                            '.$data['answer'].'
                            </span>
                        </div>
                        <div class="pst_footer_content">
                            <div>
                                '.$like_btn.'
                            </div>
                            <form onsubmit="return false" class="comment_form">
                                <button type="button" id="comment_show_icon" data-id="'.$data['question_unique_id'].'" style="
                                    display: flex;
                                    justify-content: space-between;
                                    align-items: center;
                                    gap: 5px;
                                ">
                                    <i class="bx bx-comment"></i>
                                    '.$comment_count.'
                                </button>
                                <button type="button" class="react_btn cmnt">
                                    <input type="text" required name="comment_text" placeholder="reply a answer..">
                                    <input type="hidden" name="pst_id" value="'.$data['question_unique_id'].'">
                                    <button type="submit" class="sent_comment">
                                        <i class="bx bx-paper-plane"></i>
                                    </button>
                                
                                </button>
                            </form>
                        </div>

                        <div class="comment_section" id="comment_section'.$data['question_unique_id'].'">
                            
                        </div>
                    </div>                                
                ';
            }
        }else {
            echo "Now questions are availabe";
        }
    }
}


// search onkeyup
if (isset($_REQUEST['this_is_for_search_questions'])) {
    if ($_REQUEST['this_is_for_search_questions'] == 'this_is_for_search_questions') {
        $values= $_REQUEST['values'];
        if (!empty($values)) {
            $query=mysqli_query($conn,"SELECT * FROM questions WHERE question LIKE '%$values%' ORDER BY id DESC LIMIT 3 ");
            if (mysqli_num_rows($query) > 0) {
                echo "Search Result: "; echo  mysqli_num_rows($query);
                while ($data=mysqli_fetch_assoc($query)) {
                    echo '
                    <div class="post_user_details">
                        <a href="#">
                            <span class="question_text">
                            '.$data['question'].'
                            </span>
                        </a>
                    </div>
                    ';
                }
            }else {
                echo "No question we are Found";
            }
        }
        
    }
}

// search submited value
if (isset($_REQUEST['this_is_for_search_questions_all'])) {
    if ($_REQUEST['this_is_for_search_questions_all'] == 'this_is_for_search_questions_all') {
        $values= $_REQUEST['values'];
        if (!empty($values)) {
            $query=mysqli_query($conn,"SELECT * FROM questions WHERE question LIKE '%$values%' ORDER BY id DESC ");
            if (mysqli_num_rows($query) > 0) {
                echo "Search Result: "; echo  mysqli_num_rows($query);
                while ($data=mysqli_fetch_assoc($query)) {
                    echo '
                    <div class="post_user_details">
                        <a href="#">
                            <span class="question_text">
                            '.$data['question'].'
                            </span>
                        </a>
                    </div>
                    ';
                }
            }else {
                echo "No question we are Found";
            }
        }
        
    }
}

//ths_is_for_insert_like
if (isset($_REQUEST['ths_is_for_insert_like'])) {
    if ($_REQUEST['ths_is_for_insert_like']=="ths_is_for_insert_like") {
        $id= $_REQUEST['id'];

        if (isset($_SESSION['ssn_id'])) {
            $check_like_query=mysqli_query($conn,"SELECT * FROM likes WHERE like_user='$current_user' AND like_question_id='$id' ");
            if (mysqli_num_rows($check_like_query) == 0) {
                $insert_like_query=mysqli_query($conn,"INSERT INTO likes (like_user,like_question_id,like_statur) VALUES ('$current_user','$id','Like') ");
                if ($insert_like_query) {
                    echo "Liked";
                }else {
                    echo "Failed Like insert";
                }
            }else {
                $update_like_query=mysqli_query($conn,"UPDATE likes SET like_statur='Like' WHERE like_user='$current_user' AND like_question_id='$id' ");
                if ($update_like_query) {
                    echo "Liked";
                }
            }
        }else {
            echo "Please login or register to react this post";
        }

    }
}


//ths_is_for_insert_unlike
if (isset($_REQUEST['ths_is_for_insert_unlike'])) {
    if ($_REQUEST['ths_is_for_insert_unlike']=="ths_is_for_insert_unlike") {
        $id= $_REQUEST['id'];

        if (isset($_SESSION['ssn_id'])) {
            $check_like_query=mysqli_query($conn,"SELECT * FROM likes WHERE like_user='$current_user' AND like_question_id='$id' ");
            if (mysqli_num_rows($check_like_query) == 0) {
                $insert_like_query=mysqli_query($conn,"INSERT INTO likes (like_user,like_question_id,like_statur) VALUES ('$current_user','$id','UnLike') ");
                if ($insert_like_query) {
                    echo "UnLiked";
                }else {
                    echo "Failed to unlike";
                }
            }else {
                $update_like_query=mysqli_query($conn,"UPDATE likes SET like_statur='UnLike' WHERE like_user='$current_user' AND like_question_id='$id' ");
                if ($update_like_query) {
                    echo "UnLiked";
                }
            }
        }else {
            echo "Please login or register to react this post";
        }
    }
}


//ths_is_for_delete_like
if (isset($_REQUEST['ths_is_for_delete_like'])) {
    if ($_REQUEST['ths_is_for_delete_like']=="ths_is_for_delete_like") {
        $id= $_REQUEST['id'];

        if (isset($_SESSION['ssn_id'])) {
            $check_like_query=mysqli_query($conn,"DELETE FROM likes WHERE like_user='$current_user' AND like_question_id='$id' ");
            if ($check_like_query) {
                echo "Deleted";
            }else {
                echo "failed to delete";
            }
        }else {
            echo "Please login or register to react this post";
        }
    }
}

//ths_is_for_delete_unlike
if (isset($_REQUEST['ths_is_for_delete_unlike'])) {
    if ($_REQUEST['ths_is_for_delete_unlike']=="ths_is_for_delete_unlike") {
        $id= $_REQUEST['id'];
        if (isset($_SESSION['ssn_id'])) {
            $check_like_query=mysqli_query($conn,"DELETE FROM likes WHERE like_user='$current_user' AND like_question_id='$id' ");
            if ($check_like_query) {
                echo "Deleted";
            }else {
                echo "failed to delete";
            }
        }else {
            echo "Please login or register to react this post";
        }
    }
}

//this_is_for_show_comments
if (isset($_REQUEST['this_is_for_show_comments'])) {
    if ($_REQUEST['this_is_for_show_comments']=="this_is_for_show_comments") {
        $id=$_REQUEST['id'];

        $query=mysqli_query($conn,"SELECT * FROM comments WHERE question_id='$id'");
        if (mysqli_num_rows($query) > 0) {
            echo "All Answers:";
            while ($data = mysqli_fetch_assoc($query)) {
                $fetch=get_user_details($conn,$data['usr_id']);

                echo '
                    <div class="post_user_details">
                        <img src="images/'.$fetch['profile'].'" alt="">
                        <span class="user_name">
                            <a class="" data-id="'.$fetch['unique_id'].'" href="user.php?ui='.$fetch['unique_id'].'">
                                <strong>
                                    '.$fetch['name'].'
                                </strong>
                            </a>
                            <span style="font-size:12px">
                                commented a answer
                            </span>
                        </span>
                    </div>
                    <div>
                    <strong> '.$data['comment_text'].'</strong>
                    </div>
                ';
            }
        }else {
            echo "No comment available";
        }
    }
}


//search user
if (isset($_REQUEST['this_is_for_search_user'])) {
   if ($_REQUEST['this_is_for_search_user']=="this_is_for_search_user") {
       $text=$_REQUEST['text'];
       if (isset($_SESSION['ssn_id'])) {
            $query=mysqli_query($conn,"SELECT * FROM users WHERE name LIKE '%$text%' AND unique_id!='$current_user' ");
        }else {
            $query=mysqli_query($conn,"SELECT * FROM users WHERE name LIKE '%$text%' ");
        }
       
       if ($query) {
           while ($data=mysqli_fetch_assoc($query)) {
               echo '
               <div class="post_user_details flw_user">
                    <div>
                        <img src="images/'.$data['profile'].'" alt="">
                        <span class="user_name">
                            <a href="user.php?ui='.$data['unique_id'].'">
                                <strong>
                                    '.$data['name'].'
                                </strong>
                            </a>
                        </span>
                    </div>
                    <button>Follow</button>
                </div>
               ';
           }
       }
   }
}



?>