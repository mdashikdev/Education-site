
        <div class="home_content">
            <header>
                <h1>Welcome to our education system</h1>
            </header>
            <div class="home_content_wrapper">
                <div class="home_left">
                    <div class="pst_create_box">
                       <div class="post_only_question active">
                            <form onsubmit="return false" class="form_only_question">
                                <textarea name="question" required placeholder="ask a question..."></textarea>
                                <select class="select_for_only_question" name="category" required >
                                    <option>Category</option>
                                    <option value="Bangla First">Bangla First</option>
                                    <option value="Physics">Physics</option>
                                    <option value="English">English</option>
                                    <option value="Chemistry">Chemistry</option>
                                    <option value="Biology">Biology</option>
                                    <option value="Math">Math</option>
                                    <option value="Islam">Islam</option>
                                    <option value="Ict">Ict</option>
                                </select>
                                <br>
                                <input type="submit" class="Post_Question_btn"  value="Post Question">
                            </form>
                            <a href="#" class="pst_qs_ans_btn">post question and answer</a>
                       </div>

                       <div class="post_question_with_ans">
                            <form onsubmit="return false" class="form_question_with_ans">
                                <textarea type="text" name="question" required placeholder="ask a question..."></textarea>
                                <textarea type="text" name="answer" required placeholder="answer" id=""></textarea>
                                <select name="category" required id="">
                                    <option>Category</option>
                                    <option value="Bangla First">Bangla First</option>
                                    <option value="Physics">Physics</option>
                                    <option value="English">English</option>
                                    <option value="Chemistry">Chemistry</option>
                                    <option value="Biology">Biology</option>
                                    <option value="Math">Math</option>
                                    <option value="Islam">Islam</option>
                                    <option value="Ict">Ict</option>
                                </select>
                                <br>

                                <div class="loading_wrapper loading_for_question_post">
                                    <div class="loading_gif">
                                        <span></span>
                                    </div>
                                </div>
                                <input type="submit" value="Post" id="">
                                
                            </form>
                            <a href="#" class="pst_qs_btn">post question</a>
                        </div>
                    </div>

                    <div class="left_search_question_box">
                        <li class="list searchBox user_searchbox"> 
                            <input class="text" type="search" placeholder="Search user..." name="" id="">
                            <i class='bx bx-search'></i>
                            <i class='bx bx-right-arrow-alt'></i>
                        </li> 

                        <div class="user_search_result"></div>
                        <div class="all_suggestions_users">
                        <?php
                        if (isset($current_user)) {
                            $user_query=mysqli_query($conn,"SELECT * FROM users WHERE NOT unique_id='$current_user' ORDER BY id DESC");
                        }else{
                            $user_query=mysqli_query($conn,"SELECT * FROM users ORDER BY id DESC");
                        }
                        
                        if ($user_query) {
                            while ($usr_data=mysqli_fetch_assoc($user_query)) {
                                echo '
                                <div class="post_user_details flw_user">
                                    <div>
                                        <img src="images/'.$usr_data['profile'].'" alt="">
                                        <span class="user_name">
                                            <a href="user.php?ui='.$usr_data['unique_id'].'">
                                                <strong>
                                                    '.$usr_data['name'].'
                                                </strong>
                                            </a>
                                        </span>
                                    </div>
                                    <button>Follow</button>
                                </div>
                                
                                ';
                            }
                        }
                        ?>
                    </div>
                    </div>
                </div>
                <div class="home_center">
                    <form onsubmit="return false" class="question_search_form">
                        <div class="seach_question_close_btn">
                            <button type="button">
                                <i class='bx bx-left-arrow-alt'></i>
                            </button>
                        </div>
                        <input type="search" class="question_search_input" placeholder="Search a question...">
                        <button type="submit" style="cursor:pointer" id="">
                            <i class='bx bx-search'></i>
                        </button>
                    </form>
                    <div class="search_result_container">search result</div>
                    <div class="questions_container" style="positation:relative">
                        <span class="questions_container_head">New Questions</span>


                        <?php
                        $question_query=mysqli_query($conn,"SELECT * FROM questions ORDER BY id DESC");
                        $all_userquery=mysqli_query($conn,"SELECT * FROM users ORDER BY id DESC");
                        $fetch_all_user=mysqli_fetch_assoc($all_userquery);
                        
                        if ($question_query) {
                            
                        }
                        
                        ?>
                        <div id="popular_questions_container">

                        </div>
                    </div>
                </div>

                <div class="loading_wrapper">
                    <div class="loading_gif">
                        <span></span>
                    </div>
                </div>

            </div>