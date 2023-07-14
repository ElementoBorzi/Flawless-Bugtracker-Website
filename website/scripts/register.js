
function validate() 
{
    var username = document.getElementById('Username').value;
    var email = document.getElementById('Email').value;
    var password = document.getElementById('Password').value;
    var passwordRepeat = document.getElementById('PasswordRepeat').value;
    var captcha = document.getElementById('Captcha').value;
    var captchaValue = document.getElementById('captchaValue').value;

    if (captcha != captchaValue)
    {
        alert("Incorrect captcha value. Please try again.");
        return false;
    }

    if (password != passwordRepeat)
    {
        alert("Passwords don't match. Please try again.");
        return false;
    }

    if (username.length > 20) 
    {
        alert("Username field contains more than 20 characters!");
        return false;
    }

    if (email.length > 30) 
    {
        alert("Email field contains more than 30 characters!");
        return false;
    }

    if (password.length > 30) 
    {
        alert("Password field contains more than 30 characters!");
        return false;
    }

    return true;
}