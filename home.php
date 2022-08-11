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
        $profile_btn_mobo='
            <li>
                <a href="profile.php">
                    <img src="'.$profile.'" alt="">
                </a>
            </li>
        ';
        $profile_btn_desk='
            <a href="profile.php">
                <li class="footer_content">
                    <i class="fa-solid fa-user-tie"></i>
                    <span class="text">Profile</span>
                </li>
            </a>
        ';
        
    }
    
$loginBtn='Logout';
}else {
    $profile='images/default.jpg';
    $name="Default User";
    $bio="default bio";
    $loginBtn='Login';
    $profile_btn_mobo="";
    $profile_btn_desk="";
}



?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Learning Technology</title>
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
                   <a href="">
                       <i class='bx bx-home-alt'></i>
                        <span class="text list_text">
                            Home
                        </span>
                    </a>
                    <span class="toltip">
                        Home
                    </span>
               </li>
               <li class="list item">
                <a href="category.php?id=Bangla First">
                    <i class='bx bx-book-alt'></i>
                        <span class="text list_text">
                            Bangla First
                        </span>
                    </a>
                    <span class="toltip">
                        Bangla First
                    </span>
                </li>
                <li class="list item">
                    <a href="category.php?id=Bangla Second">
                    <i class='bx bx-book-alt'></i>
                        <span class="text list_text">
                            Bangla Second
                        </span>
                    </a>
                    <span class="toltip">
                        Banlga Second
                    </span>
                </li> 
                <li class="list item">
                    <a href="category.php?id=English">
                    <i class='bx bx-book-alt'></i>
                        <span class="text list_text">
                            English
                        </span>
                    </a>
                    <span class="toltip">
                        English
                    </span>
                </li>
                <li class="list item">
                    <a href="category.php?id=Physics">
                    <i class='bx bx-book-alt'></i>
                        <span class="text list_text">
                            Physics
                        </span>
                    </a>
                    <span class="toltip">
                        Physics
                    </span>
                </li> 
                <li class="list item">
                    <a href="category.php?id=Chemistry">
                    <i class='bx bx-book-alt'></i>
                        <span class="text list_text">
                            Chemistry
                        </span>
                    </a>
                    <span class="toltip">
                        Chemistry
                    </span>
                </li> 
                <li class="list item">
                    <a href="category.php?id=Biology">
                    <i class='bx bx-book-alt'></i>
                        <span class="text list_text">
                            Biology
                        </span>
                    </a>
                    <span class="toltip">
                        Biology
                    </span>
                </li>
                <li class="list item">
                    <a href="category.php?id=Math">
                    <i class='bx bx-book-alt'></i>
                        <span class="text list_text">
                            Math
                        </span>
                    </a>
                    <span class="toltip">
                        Math
                    </span>
                </li>
                <li class="list item">
                    <a href="category.php?id=Islam">
                    <i class='bx bx-book-alt'></i>
                        <span class="text list_text">
                            Islam
                        </span>
                    </a>
                    <span class="toltip">
                        Islam
                    </span>
                </li> 
                <li class="list item">
                    <a href="category.php?id=Ict">
                    <i class='bx bx-book-alt'></i>
                        <span class="text list_text">
                            Ict
                        </span>
                    </a>
                    <span class="toltip">
                        Ict
                    </span>
                </li> 
                <li class="footer_content_wrapper">
                    <ul>
                        <a href="php/logout.php">
                            <li class="footer_content">
                                <i class='bx bx-log-out'></i>
                                <span class="text"><?php echo $loginBtn; ?></span>
                            </li>
                        </a>
                    <?php echo $profile_btn_desk; ?>
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
                <?php 
                 echo $profile_btn_mobo;
                ?>
            </ul>
        </div>

<?php require("home_content.php"); ?>


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
        var pst_qs_ans_btn=document.querySelector(".pst_qs_ans_btn");
        var post_question_with_ans=document.querySelector(".post_question_with_ans");
        var post_only_question=document.querySelector('.post_only_question');
        var pst_qs_btn=document.querySelector(".pst_qs_btn");
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

        pst_qs_ans_btn.addEventListener("click",()=>{
            post_question_with_ans.classList.toggle('active');
            post_only_question.classList.toggle('active');
        })

        pst_qs_btn.addEventListener("click",()=>{
            post_question_with_ans.classList.toggle('active');
            post_only_question.classList.toggle('active');
        })

        show_booksbtn.addEventListener("click",()=>{
            sidebar.classList.toggle('mobo_active');
        })



    </script>
</body>
</html>