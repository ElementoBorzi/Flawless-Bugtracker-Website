<?php
Application::loadController("home");
Application::loadView("header-inc");
?>
<div class="row w-75 p-3 mx-auto">
	<h2 class="p-3"><?= APP_NAME ?> - <?= APP_SLOGAN ?></h2>
	<div class="card text-white bg-dark">
		<div class="card-body">
			<h3 class="card-title">Installation</h3>
			<hr />
            <?= Application::userMessage($_SESSION['message']) ?>
			<form method="post" action="">
				<fieldset class="p-3">
					<legend>Hostname Information</legend>
					<div class="col-12">
						<label for="Host">Host</label>
						<input type="text" class="form-control" name="host" id="Host" placeholder="Enter your Hostname." >
						<div id="HostHelp" class="form-text">Required field.</div>
					</div>
			
					<div class="col-12">
						<label for="Username">Username</label>
						<input type="text" class="form-control" name="username" id="Username" placeholder="Enter your Username." >
						<div id="UsernameHelp" class="form-text">Required field.</div>
					</div>
			
					<div class="col-12">
						<label for="Password">Password</label>
						<input type="password" class="form-control" name="password" id="Password" placeholder="Enter your password." >
						<div id="PasswordHelp" class="form-text">Required field.</div>
					</div>
			
					<div class="col-12">
						<label for="Database">Database</label>
						<input type="text" class="form-control" name="database" id="Database" placeholder="Enter your Database." >
						<div id="DatabaseHelp" class="form-text">Database must be created before installing <?= APP_NAME ?>.</div>
					</div>
				</fieldset>

				<fieldset class="p-3">
					<legend>Website Information</legend>
					<div class="col-12">
						<label for="WebTitle">Website Title</label>
						<input type="text" class="form-control" name="title" id="WebTitle" placeholder="Enter your Website title." >
						<div id="WebTitleHelp" class="form-text">Required field.</div>
					</div>
			
					<div class="col-12">
						<label for="WebHeader">Website Header</label>
						<input type="text" class="form-control" name="header" id="WebHeader" placeholder="Enter your Header." >
						<div id="WebHeaderHelp" class="form-text">Required field.</div>
					</div>
				</fieldset>

				<fieldset class="p-3">
					<legend>Admin Panel</legend>
					<div class="col-12">
						<label for="PasswordACP">Password</label>
						<input type="password" class="form-control" name="acpPassword" id="PasswordACP" placeholder="Enter your password." >
						<div id="PasswordACPHelp" class="form-text">Required field.</div>
					</div>
				</fieldset>
		
				<div class="d-grid gap-2 p-3">
					<input type="submit" class="btn btn-primary" name="submit" value="Install"/>
				</div>
			</form>
		</div>
	</div>
</div>
<?php
Application::loadView("footer-inc");
?>