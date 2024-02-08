function checkProfile()
{
    validate = false;

    var username= document.getElementById("username");
    var password= document.getElementById("password");
    localStorage.setItem("user", username.value);
    alert(user);

    if(username.value=="admin" &&password.value=="password" )
    {
        validate = true;

        return validate;
    }
    else
    {
        openPopup();
        return validate;
    }

}

function openPopup() {
    document.getElementById("popup").style.display = "flex";
    setTimeout(closePopup, 300);
  }

  function closePopup() {
    document.getElementById("popup").style.display = "none";
  }