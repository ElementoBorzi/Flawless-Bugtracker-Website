<?php
$getBugDetails = Bugs::getBugDetails($_GET['id'])->fetch();

Application::assign("bugDetails", $getBugDetails);
?>