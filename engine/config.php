<?php

session_start();

#Website Information
DEFINE ("HEADER", "WoWEmu 5.4.8 Repack Bugtracker");
DEFINE ("TITLE", "Bugtracker");

#Number of letters on the Captcha (Switch the 10 to any value to your liking)
DEFINE ("CAPTCHA", "10");
    
#Error handling
unset($_SESSION['message']);
$_SESSION['message'] = null;


#System Initialization
require ("classes/Application.php");
$Application = new Application();
$Application->AppInit();


#Include Models and Initialize them
require ("classes/Database.php");
require ("classes/Account.php");
require ("classes/Admin.php");
require ("classes/Bugs.php");
require ("classes/Common.php");

$Database = new Database();
$Account = new Account();
$Admin = new Admin();
$Bugs = new Bugs();
$Common = new Common();


?>