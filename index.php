<?php
include "config.php";

//System Variables
$installDir = "install/";

//Page Action
if (file_exists($installDir)){
	header("Location: ".$installDir);
} else {
	Application::AppInit();
}
?>