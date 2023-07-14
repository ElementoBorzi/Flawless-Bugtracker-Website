<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Database Error</title>
	<style>
	    body{
		    background: #fff;
			width: 80%;
			color: #666;
		    margin: 5% auto;
		}
		.main{
			background: #fff;
			border: 1px solid #d1d1d1;
			box-shadow: 0 0 10px rgba(0,0,0,0.1);
		}
		.title{
			font-family: sans-serif;
			font-weight: 300;
			font-size: 18px;
			padding: 20px 10px;
			border-bottom: 1px solid #d1d1d1;
		}	
		p{
			background: #fff;
			font-family: monospace;
			font-size: 12px;
			font-weight: lighter;
			padding: 3px 10px;
			word-break: break-all;
		}
		.footer{
			background: #fff;
			font-family: monospace;
			font-size: 12px;
			text-align: center;
			padding: 10px;
		}	
		.support{
			color: #ff4040;
			text-decoration: none;
		}
		.flawless{
			color: #53b8f0;
			text-decoration: none;
		}
	</style>
</head>
<body>
<?php
if(!empty(Application::$error))
{
    $error_text = "Error: ". Application::$error;
}
?>
	
<div class="main" align="left">
	<div class="title">Application Error</div>
	<p><?php echo $error_text;?></p>
</div>
<div class="footer">
	<p>If you're having trouble contact the <a class="support" target="_blank" href="https://github.com/Ferreira9006/Bugtracker" >Support</a></p>
    - Powered by <a class="flawless" target="_blank" href="#">Flawless</a> -
</div>
</body>
</html>
