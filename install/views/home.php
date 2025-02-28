<?php
Application::loadController("home");
Application::loadView("header-inc");
?>

<div class="container">
	<div class="row p-3 mx-auto">
		<h2 class="p-3"><?= APP_NAME ?> - <?= APP_SLOGAN ?></h2>
		<div class="card">
			<div class="card-body">
				<h3 class="card-title">Installation</h3>
				<hr />
				<?= Application::userMessage($_SESSION['message']) ?>
				<form method="post" action="">
					<div class="accordion" id="accordionInstall">
						<!-- Hostname Information Accordion -->
						<div class="accordion-item">
							<h2 class="accordion-header">
								<button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
									Hostname Information
								</button>
							</h2>
							<div id="collapseOne" class="accordion-collapse collapse" data-bs-parent="#accordionInstall">
								<div class="accordion-body">
									<fieldset class="p-3">
										<div class="col-12">
											<label for="Host">Host</label>
											<input type="text" class="form-control" name="host" id="Host" placeholder="Enter your Hostname.">
											<div id="HostHelp" class="form-text">Required field.</div>
										</div>
										<div class="col-12 mt-2">
											<label for="Username">Username</label>
											<input type="text" class="form-control" name="username" id="Username" placeholder="Enter your Username.">
											<div id="UsernameHelp" class="form-text">Required field.</div>
										</div>
										<div class="col-12 mt-2">
											<label for="Password">Password</label>
											<input type="password" class="form-control" name="password" id="Password" placeholder="Enter your password.">
											<div id="PasswordHelp" class="form-text">Required field.</div>
										</div>
										<div class="col-12 mt-2">
											<label for="Database">Database</label>
											<input type="text" class="form-control" name="database" id="Database" placeholder="Enter your Database.">
											<div id="DatabaseHelp" class="form-text">Database must be created before installing <?= APP_NAME ?>.</div>
										</div>
									</fieldset>
								</div>
							</div>
						</div>
						<!-- End of Hostname Information Accordion -->

						<!-- Website Information Accordion -->
						<div class="accordion-item">
							<h2 class="accordion-header">
								<button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
									Website Information
								</button>
							</h2>
							<div id="collapseTwo" class="accordion-collapse collapse" data-bs-parent="#accordionInstall">
								<div class="accordion-body">
									<fieldset class="p-3">
										<div class="col-12">
											<label for="WebTitle">Website Title</label>
											<input type="text" class="form-control" name="title" id="WebTitle" placeholder="Enter your Website title.">
											<div id="WebTitleHelp" class="form-text">Required field.</div>
										</div>

										<div class="col-12 mt-2">
											<label for="WebHeader">Website Header</label>
											<input type="text" class="form-control" name="header" id="WebHeader" placeholder="Enter your Header.">
											<div id="WebHeaderHelp" class="form-text">Required field.</div>
										</div>
									</fieldset>
								</div>
							</div>
						</div>
						<!-- End of Website Information Accordion -->

						<!-- Accordion - Admin Panel -->
						<div class="accordion-item">
							<h2 class="accordion-header">
								<button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
									Admin Panel
								</button>
							</h2>
							<div id="collapseThree" class="accordion-collapse collapse" data-bs-parent="#accordionInstall">
								<div class="accordion-body">
									<fieldset class="p-3">
										<div class="col-12">
											<label for="PasswordACP">Password</label>
											<input type="password" class="form-control" name="acpPassword" id="PasswordACP" placeholder="Enter your password.">
											<div id="PasswordACPHelp" class="form-text">Required field.</div>
										</div>
									</fieldset>
								</div>
							</div>
						</div>
						<!-- End of Admin Panel Accordion -->
					</div>

					<!-- Submit Button -->
					<div class="d-grid gap-2 p-3">
						<input type="submit" class="btn btn-primary" name="submit" value="Install" />
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
<?php
Application::loadView("footer-inc");
?>