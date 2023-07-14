<?php
$getBugDetails = Bugs::getBugDetails($_GET['id'])->fetch();

Application::assign("bugDetails", $getBugDetails);


if(isset($_POST['submit']))
{
    Bugs::updateBug($_POST['bugId'], $_POST['category'], $_POST['tags'], $_POST['status']);
}

if(isset($_POST['delete']))
{
    Bugs::deleteBug($_POST['bugId']);
}
?>