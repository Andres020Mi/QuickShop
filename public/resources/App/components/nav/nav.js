let btn_option_users = document.getElementById("btn_option_users");


btn_option_users.addEventListener("click",function(){

    let select_option_users = document.getElementById("select_option_users");

    if(select_option_users.classList.contains("hidden")){
        select_option_users.classList.remove("hidden")
    }else{
        select_option_users.classList.add("hidden")
    }
    
    
})
