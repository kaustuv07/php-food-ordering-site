document.addEventListener("DOMContentLoaded", function() {
    var user = localStorage.getItem("user");
    var profileName =document.getElementById("profileName");
    console.log(user);
    if (user===undefined){
        
    }else{
        profileName.textContent = user;
        profileName.href="#";
    }
    
});