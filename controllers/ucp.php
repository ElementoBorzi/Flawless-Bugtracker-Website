<?php 
$getUser = $Account->getUser($_SESSION['email'])->fetch();
$totalBugs = $Account->getAccountTotalBugs($_SESSION['username']);
?>