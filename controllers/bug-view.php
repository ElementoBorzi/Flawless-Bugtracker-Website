<?php
$getBugDetails = $Bugs->getBugDetails($_GET['id']);

$bugDetails = $getBugDetails->fetch();
?>