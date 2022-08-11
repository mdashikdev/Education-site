var checkboxsignup=document.querySelector("#signup_checkbox");
var checkboxlogin=document.querySelector("#login_checkbox");
var loginDiv=document.querySelector(".login_container");
var registerDiv=document.querySelector(".registraion_container");

checkboxsignup.onclick=()=>{
    if (checkboxsignup.checked) {
        registerDiv.style.transform='translateX(0px)';
        registerDiv.style.position='relative';
        loginDiv.style.position='absolute';
        loginDiv.style.transform='translateX(-400px)';
    }else{
        registerDiv.style.transform='translateX(400px)';
        registerDiv.style.position='absolute';
        loginDiv.style.position='relative';
        loginDiv.style.transform='translateX(0px)';
    }
}
