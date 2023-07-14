<?php
if (!empty($_POST['submit']))
{
    if (!empty($_POST['title']) && !empty($_POST['description']))
    {
        $confirmCaptcha = Common::verifyCaptcha($_POST['captcha']);

        if ($confirmCaptcha == TRUE)
        {
            $title = $_POST['title'];
            $description = $_POST['description'];
            $resources = $_POST['proof'];
            $author = $_POST['author'];
            $category = $_POST['category'];
            $tags = $_POST['tags'];

            Bugs::insertBugs($title, $description, $resources, $author, $category, $tags);
        }
        else
        {
            $message = array(
                "type" => "danger",
                "text" => "Incorrect captcha. Please try again."
            );
    
            $_SESSION['message'] = $message;
        }
    }
    else
    {
        $message = array(
            "type" => "danger",
            "text" => "In order to submit the report you need to fill in all fields."
        );

        $_SESSION['message'] = $message;
    }
}
?>