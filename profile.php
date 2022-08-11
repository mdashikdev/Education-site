<?php
require("php/function.php");
require("php/db.php");
session_start();
if (isset($_SESSION['ssn_id'])) {
    $ssnId=$_SESSION['ssn_id'];
    $query_for_check_user=mysqli_query($conn,"SELECT * FROM users WHERE unique_id='$ssnId' ");
    if (mysqli_num_rows($query_for_check_user) == 0 ) {
        $profile='images/default.jpg';
        $name="Default User";
        $bio="default bio";
    }else {
        $current_user=$_SESSION['ssn_id'];
        $query=mysqli_query($conn,"SELECT * FROM users WHERE unique_id='$current_user' ");
        $fetch=mysqli_fetch_assoc($query);
        $name= $fetch['name'];
        $profile='images/'.$fetch['profile'];
        $bio=$fetch['bio'];
        
    }
    
$loginBtn='Logout';
}else {
    $profile='images/default.jpg';
    $name="Default User";
    $bio="default bio";
    $loginBtn='Login';
}



?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $name; ?></title>
    <link href='https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="style/primary_style.css">
</head>
<body>
    <div class="main_wrapper">
        
        <div class="navbar_main">
            <div class="nav_header">
                <img src="<?php echo $profile; ?>" alt="">
                <div class="text">
                    <span class="name">
                    <?php echo $name; ?>
                    </span>
                    <span class="bio">
                    <?php echo $bio; ?>
                    </span>
                </div>
                <span>
                    <i id="toggle_btn" class='bx bx-chevron-left'></i>
                </span>
            </div>
            <ul>
               <li class="list item home_mobo">
                   <a href="home.php">
                       <i class='bx bx-home-alt'></i>
                        <span class="text list_text">
                            Home
                        </span>
                    </a>
                    <span class="toltip">
                        Home
                    </span>

                <li class="footer_content_wrapper">
                    <ul>
                        <a href="php/logout.php">
                            <li class="footer_content">
                                <i class='bx bx-log-out'></i>
                                <span class="text"><?php echo $loginBtn; ?></span>
                            </li>
                        </a>
                        <a href="profile.php">
                            <li class="footer_content">
                                <i class="fa-solid fa-user-tie"></i>
                                <span class="text">Profile</span>
                            </li>
                        </a>
                    <li  class="footer_content darkmode">
                        <div class="text">
                            <i class='bx bxs-sun sun'></i>
                            <i class='bx bxs-moon moon'></i>
                            <span class="text add_text">Dark Mode</span>
                        </div>
                        <i class="fa-solid fa-toggle-off tglicon"></i>
                    </li>
                    </ul>
                </li>
            </ul>
        </div>
        <div class="profile_main_div">
            <center>Profile</center>
            <form onsubmit="return false" class="profile_upload_form">
                <input type="file" name="image" hidden class="profile_change_input">
                <div class="selected_profile_image_show">
                    <img >
                    <div>
                        <button type="button" class="profile_uplaod_cancel_btn">Cancel</button>
                        <button type="submit" class="profile_uplaod_btn">Upload</button>
                    </div>
                </div>
            </form>
            <div class="profile_image">
                <div class="profile_img_name_wrapper">
                    <i class='bx bx-image-add change_profile_icon'></i>
                    <img src="<?php echo $profile ?>" alt="">
                    <span class="profile_name">
                        <?php echo $name ?>
                    </span>
                </div>
                <div class="profile_bio">
                <?php echo $bio ?>
                </div>
            </div>

            <div class="about_me_div">
                
                    <div>
                        <i class='bx bx-current-location'></i>
                        <span class="default_text">From : </span>
                        <span class="dynamic_text"><?php echo $fetch['location'] ?></span>
                        <i id="location_edit_icon" class='bx bx-edit-alt edit_icon'></i>
                    </div>
                    <div>
                        <i class='bx bx-book-open'></i>
                        <span class="default_text">Studying at : </span>
                        <span class="dynamic_text"><?php echo $fetch['studying'] ?></span>
                        <i id="studying_edit_icon" class='bx bx-edit-alt edit_icon'></i>
                    </div>
                    <div>
                        <i class='bx bxs-graduation' ></i>
                        <span class="default_text">Studied at : </span>
                        <span class="dynamic_text"><?php echo $fetch['studied'] ?></span>
                        <i id="Studied_edit_icon" class='bx bx-edit-alt edit_icon'></i>
                    </div>
                    

                    <form onsubmit="return false" id="about_info_form">
                        <input type="text" class="about_info_input location" name="location_name" placeholder="Your Home town">
                        <input type="text" class="about_info_input studying" name="studying_name" placeholder="Studying information">
                        <input type="text" class="about_info_input studied" name="studied_name" placeholder="Studied information">
                        <input type="submit" class="about_update" value="Update">
                    </form>
            </div>
            <div class="questions_container profile" style="positation:relative">
                        <?php
                        $question_query=mysqli_query($conn,"SELECT * FROM questions WHERE owner='$ssnId' ORDER BY id DESC");
                        $all_userquery=mysqli_query($conn,"SELECT * FROM users ORDER BY id DESC");
                        $fetch_all_user=mysqli_fetch_assoc($all_userquery);
                        
                        if ($question_query) {
                            echo "<h4>Your Posts</h4>";
                            while ($data=mysqli_fetch_assoc($question_query)) {
                                $userinfo=get_user_details($conn,$data['owner']);
                                echo '
                                <div class="question_posts">
                                    <div>
                                        <div class="post_user_details">
                                            <img src="images/'.$userinfo['profile'].'" alt="">
                                            <span class="user_name">
                                                <a class="user_details_show_class" data-id="'.$userinfo['unique_id'].'" href="user.php?ui='.$userinfo['unique_id'].'">
                                                    <strong>
                                                        '.$userinfo['name'].'
                                                    </strong>
                                                </a>
                                            </span>
                                        </div>
                                        
                                        <span class="question_text">
                                           '.$data['question'].'
                                        </span>
                                    </div>

            
                                    <div class="comment_section" id="comment_section'.$data['question_unique_id'].'">
                                        
                                    </div>
                                </div>                                
                            ';
                            }
                        }
                        ?>
                    </div>
                </div>
        </div>

        <div class="navbar_for_bottom">
            <ul class="mob-nav-bar">
                <li class="mobo_home_icon">
                    <a href="home.php">
                        <i class='bx bx-home-alt'></i>
                    </a>
                </li>
                
                <li class="show_books">
                    <i class='bx bx-book-alt'></i>
                </li>
                <li href="profile.php">
                    <a href="profile.php">
                        <img src="<?php echo $profile; ?>" alt="">
                    </a>
                </li>
            </ul>
        </div>
        </div>
    </div>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="script/jequery.js"></script>

    <script>
        var tglbtn=document.querySelector("#toggle_btn");
        var sidebar=document.querySelector(".navbar_main");
        var darkallbtn=document.querySelector(".darkmode");
        var darkall=document.querySelector("body");
        var darktext=document.querySelector('.add_text');
        var sun_change=document.querySelector(".darkmode .sun");
        var moon_change=document.querySelector(".darkmode .moon");
        var tglicon=document.querySelector(".tglicon");
        var show_booksbtn=document.querySelector(".show_books");


    
        tglbtn.addEventListener("click",()=>{
            tglbtn.classList.toggle('hide');
            sidebar.classList.toggle('hide');
        })

        darkallbtn.addEventListener("click",()=>{
            darkall.classList.toggle("darkAll");
        })

        function darkall_class(params) {
            if(darkall.classList.contains('darkAll')){
                darktext.innerText="Light Mode";
                sun_change.classList.remove('active');
                moon_change.classList.add('active');
                tglicon.style.transform="rotateY(180deg)";
            }else{
                darktext.innerText="Dark Mode";
                sun_change.classList.add('active');
                moon_change.classList.remove('active');
                tglicon.style.transform="rotateY(0deg)";
            }
        }
        setInterval(() => {
            darkall_class();
        }, 100);


        show_booksbtn.addEventListener("click",()=>{
            sidebar.classList.toggle('mobo_active');
        })



    </script>
</body>
</html>