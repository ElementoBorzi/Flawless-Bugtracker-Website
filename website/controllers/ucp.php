<?php 
$getUser = Account::getUser($_SESSION['email'])->fetch();
$totalBugs = Account::getAccountTotalBugs($_SESSION['username']);

Application::assign("getUser", $getUser);
Application::assign("totalBugs", $totalBugs);
?>