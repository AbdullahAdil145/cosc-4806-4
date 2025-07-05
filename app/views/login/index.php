<?php require_once 'app/views/templates/headerPublic.php' ?>
<main role="main" class="container">
		<div class="page-header" id="banner">
				<div class="row">
						<div class="col-lg-12">
								<h1>You are not logged in</h1>
						</div>
				</div>
		</div>

		<div class="row">
				<div class="col-sm-auto">

						<?php
						if (isset($_SESSION['loginError'])) {
								echo "<p style='color:red; font-weight:bold;'>" . $_SESSION['loginError'] . "</p>";
								unset($_SESSION['loginError']);
						}
						if (isset($_SESSION['registerSuccess'])) {
							echo "<p style='color:green; font-weight:bold;'>" . $_SESSION['registerSuccess'] . "</p>";
							unset($_SESSION['registerSuccess']);
					}

						?>

						<div style="margin-bottom: 40px;">
								<form action="/login/verify" method="post">
										<fieldset>
												<div class="form-group">
														<label for="username">Username</label>
														<input required type="text" class="form-control" name="username">
												</div>
												<div class="form-group">
														<label for="password">Password</label>
														<input required type="password" class="form-control" name="password">
												</div>
												<br>
											<div class="d-flex gap-2">
													<button type="submit" class="btn btn-primary">Login</button>
													<a href="/create" class="btn btn-primary">Register</a>
											</div>

										</fieldset>
								</form>
						</div>

						<p class="text-muted" style="text-align:center; margin-top: 20px;">Copyright,&copy; 2025</p>

				</div>
		</div>
</main>
