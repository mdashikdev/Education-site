
// Registration
$(".register_form").on("submit",function(){
    var formdata=new FormData(this);
    $.ajax({
        url:"php/register.php",
        type:"POST",
        data:formdata,
        contentType: false,
        processData: false,
        beforeSend:function(){
            // alert("sending");
        },
        success:function(response){
            if (response == 'Registerd') {
                $(".register_form")[0].reset()
            }
            alert(response);
        }
    })
})

//Login
$(".login_form").on("submit",function(){
    var formdata=new FormData(this);
    $.ajax({
        url:"php/login.php",
        type:"POST",
        data:formdata,
        contentType: false,
        processData: false,
        beforeSend:function(){
            // alert("sending");
        },
        success:function(response){
            if (response=='You are logged in') {
                window.location.href="home.php";
            }
            alert(response);
        }
    })
})


//question post
$(".form_only_question").on("submit",function(){
    var formdata=new FormData(this);
    $.ajax({
        url:"php/post_only_question.php",
        type:"POST",
        data:formdata,
        contentType:false,
        processData:false,
        beforeSend:function(){

        },
        success:function(response){
            if (response=="Posted") {
                show_questoins();
                $(".form_only_question")[0].reset();
            }
            alert(response);
        }
    })
})

//question with answer post
$(".form_question_with_ans").on("submit",function(){
    var formdata=new FormData(this);
    $.ajax({
        url:"php/post_question_with_anser.php",
        type:"POST",
        data:formdata,
        contentType:false,
        processData:false,
        beforeSend:function(){
            $(".loading_wrapper.loading_for_question_post.active").addClass("active");
        },
        success:function(response){
            if (response=="Posted") {
                show_questoins();
                $(".loading_wrapper.loading_for_question_post.active").removeClass("active");
                $(".form_only_question")[0].reset();
            }
            alert(response);
        }
    })
})




$("#sortitem").on("change",function(){
    let val=this.value;

    if (val == "recentPost") {
        show_questoins();
    }else if (val == "mostliked") {
        mostLiked();
    }
    else{
        $("#popular_questions_container").html("response");
    }
    
})
show_questoins();
//Sort questions most liked
function mostLiked() {
    $.ajax({
        url: "php/php_core.php",
        type:"POST",
        data:{this_if_for_sort_most_liked:"this_if_for_sort_most_liked"},
        success:function(res){
            $("#popular_questions_container").html(res);
        }
    })
}

//Recent
function show_questoins(){
    $.ajax({
        url:"php/php_core.php",
        type:"POST",
        data:{this_is_for_show_questions:'this_is_for_show_questions'},
        success:function(response){
            $("#popular_questions_container").html(response);
        }
    })
}



// ===Question search===
$(".question_search_input").on("focus",function(){
    $(".seach_question_close_btn button").css("display",'block');
    $(".questions_container").css("display",'none');
    $(".search_result_container").css("display",'block');
})

$(".question_search_input").on("keyup",function(){
    $(".search_result_container").css("backgroud-color",'rgba(112, 132, 214, 0)');
    var input_value=$(this).val();
    $.ajax({
        url:"php/php_core.php",
        type:"POST",
        data:{this_is_for_search_questions:"this_is_for_search_questions",values:input_value},
        beforeSend:function(){

        },
        success:function(response){
            if (response == "") {
                $(".search_result_container").html("");
            }else{
                $(".search_result_container").html(response);
            }
            
        }
    })

    $(".question_search_form").on("submit",function(){
        $(".question_search_input").blur();
        $.ajax({
            url:"php/php_core.php",
            type:"POST",
            data:{this_is_for_search_questions_all:"this_is_for_search_questions_all",values:input_value},
            beforeSend:function(){
    
            },
            success:function(response){
                if (response == "") {
                    $(".search_result_container").html("");
                }else{
                    $(".search_result_container").html(response);
                    $(".search_result_container").css("background-color","rgba(112, 132, 214, 0.18)");
                }
                
            }
        })
    })


})

//profile change
$(".change_profile_icon").click(function(){
    var img_container=$(".selected_profile_image_show img");

    $(".profile_change_input").click();
    
    $(".profile_change_input").change(function(event){
        $(".selected_profile_image_show").css("transform","scaleY(1)");
        readURL(this);
    })

    $(".profile_uplaod_cancel_btn").click(function(){
        $(".selected_profile_image_show").css("transform","scaleY(0)");
    })

    $(".profile_upload_form").on("submit",function(){
        var formdata=new FormData(this);
        $.ajax({
            url:"php/profile_upload.php",
            type:"POST",
            data:formdata,
            contentType:false,
            processData:false,
            success:function(response){
                if (response=="Profile Updated") {
                    window.location.reload();
                }else{
                    alert("Upload Failed");
                }
            }
        })
    })


    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
    
            reader.onload = function (e) {
                $(img_container).attr('src', e.target.result);
            }
    
            reader.readAsDataURL(input.files[0]);
        }
    }
})

//profile about info change
$("#location_edit_icon").click(function(){
    $("#about_info_form").toggleClass("active");
}) 

$("#studying_edit_icon").click(function(){
    $("#about_info_form").toggleClass("active");
}) 

$("#Studied_edit_icon").click(function(){
    $("#about_info_form").toggleClass("active");
}) 

$("#about_info_form").on("submit",function(){
    var formdata=new FormData(this);
    $.ajax({
        url:"php/update_about_info.php",
        type:"POST",
        contentType:false,
        processData:false,
        data:formdata,
        beforeSend:function(){

        },
        success:function(response){
            alert(response);
            $("#about_info_form")[0].reset();
        }
    })
})

//insert like
$(document).on("click",".pst_footer_content div .react_btn.insert_like",function(){
    var id=$(this).data("id");
    $.ajax({
        url:"php/php_core.php",
        type:"POST",
        data:{ths_is_for_insert_like:"ths_is_for_insert_like",id:id},
        success:function(response){
            if (response=='Liked') {
                show_questoins();
                console.log(response);
            }else{
                alert(response);
            }
        }
    })
})

//delete like
$(document).on("click",".pst_footer_content div .react_btn.delete_like",function(){
    var id=$(this).data("id");
    $.ajax({
        url:"php/php_core.php",
        type:"POST",
        data:{ths_is_for_delete_like:"ths_is_for_delete_like",id:id},
        success:function(response){
            if (response=='Deleted') {
                show_questoins();
                console.log(response);
            }else{
                alert(response);
            }
        }
    })
})

//delete unlike
$(document).on("click",".pst_footer_content div .react_btn.delete_unlike",function(){
    var id=$(this).data("id");
    $.ajax({
        url:"php/php_core.php",
        type:"POST",
        data:{ths_is_for_delete_unlike:"ths_is_for_delete_unlike",id:id},
        success:function(response){
            if (response=='Deleted') {
                show_questoins();
                console.log(response);
            }else{
                alert(response);
            }
            
            
        }
    })
})

//insert unlike
$(document).on("click",".pst_footer_content div .react_btn.insert_unlike",function(){
    var id=$(this).data("id");
    $.ajax({
        url:"php/php_core.php",
        type:"POST",
        data:{ths_is_for_insert_unlike:"ths_is_for_insert_unlike",id:id},
        success:function(response){
            if (response=='UnLiked') {
                show_questoins();
                console.log(response);
            }else{
                alert(response);
            }
        }
    })
})


//search question
$(".seach_question_close_btn button").click(function(){
    $(".search_result_container").css("display",'none');
    $(".questions_container").css("display",'block');
    $(".seach_question_close_btn button").css("display",'none');
})


//show user details
$(document).on("mouseover",'.user_details_show_class',function(){
    var id=$(this).data("id");
    $("#user_details_container_class"+id).on("mouseover",function(){
        $("#user_details_container_class"+id).css("transform","scaleY(1)")
    })

    $("#user_details_container_class"+id).on("mouseout",function(){
        $("#user_details_container_class"+id).css("transform","scaleY(0)")
    })

    $("#user_details_container_class"+id).css("transform","scaleY(1)")
})

$(document).on("mouseout",'.user_details_show_class',function(){
    var id=$(this).data("id");
    
    $("#user_details_container_class"+id).css("transform","scaleY(0)")
})


//insert comment
$(document).on("submit",".comment_form",function(){
    var formdata=new FormData(this);

    $.ajax({
        url:"php/question_comment.php",
        type:"POST",
        data:formdata,
        processData:false,
        contentType:false,
        success:function(response){
            if (response=="commented") {
                show_questoins();
                console.log(response);
            }else{
                alert(response);
            }
        }
    })
})

//show comments
$(document).on("click",".comment_form #comment_show_icon",function(){
    var id=$(this).data("id")
    $("#comment_section"+id).toggleClass('active');

    $.ajax({
        url:"php/php_core.php",
        type:"POST",
        data:{this_is_for_show_comments:"this_is_for_show_comments",id:id},
        success:function(response){
            $("#comment_section"+id).html(response);
        }
    })
})

//user searchbox
$(".user_searchbox input").on("focus",function(){
    $(".left_search_question_box .list.searchBox .bx.bx-right-arrow-alt").css("display","block");
    $('.user_searchbox .bx.bx-search').css("display","none");
    $(".all_suggestions_users").css("display","none");
    $(".user_search_result").css("display","block");

    $(".user_searchbox input").on("keyup",function(){
        var text=$(this).val();
        $.ajax({
            url:"php/php_core.php",
            type:"POST",
            data:{this_is_for_search_user:"this_is_for_search_user",text:text},
            success:function(response){
                $(".user_search_result").html(response);
            }
        })
    })
})

$(".left_search_question_box .list.searchBox .bx.bx-right-arrow-alt").click(function(){
    $(".left_search_question_box .list.searchBox .bx.bx-right-arrow-alt").css("display","none");
    $('.user_searchbox .bx.bx-search').css("display","block");
    $(".all_suggestions_users").css("display","block");
    $(".user_search_result").css("display","none");
})