
function validate() 
{
    var title = document.getElementById('Title').value;
    var description = document.getElementById('Description').value;
    var proof = document.getElementById('Proof').value;
    var author = document.getElementById('Author').value;
    var captcha = document.getElementById('Captcha').value;
    var captchaValue = document.getElementById('captchaValue').value;

    if (captcha != captchaValue)
    {
        alert("Incorrect captcha value. Please try again.");
        return false;
    }

    if (title.length > 50) 
    {
        alert("Title field contains more than 50 characters!");
        return false; // keep form from submitting
    }

    if (description.length > 5000) 
    {
        alert("Description field contains more than 5000 characters!");
        return false; // keep form from submitting
    }

    if (proof.length > 500) 
    {
        alert("Resources field contains more than 500 characters!");
        return false; // keep form from submitting
    }

    if (author.length > 50) 
    {
        alert("Author field contains more than 50 characters!");
        return false; // keep form from submitting
    }

    return true;
}
