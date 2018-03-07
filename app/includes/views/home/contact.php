
			<!-- Non-working contact form for example with CSRF token -->
			<div class="section-wrapper main">
				<div class="container">
					<div class="col-sm-4 col-sm-offset-4 text-center">
						<div class="content-header">
							<h2>Contact</h2>
						</div>
						<div class="content-body text-left">
							<p><strong>Note: </strong>In your local environment remove or comment out the token field and then press "Send". You should get 403 Forbidden as the result. This is how you know it's working. Make sure to put the token field back!</p>

							<form method="post">
								<div class="form-group">
									<input type="email" class="form-control" name="email" id="email" placeholder="Email address">
								</div>
								<div class="form-group">
									<textarea class="form-control" name="message" id="message" rows="3" placeholder="Message"></textarea>
								</div>
								<?php echo Security::renderCSRFInput(); ?>
								<button type="submit" class="btn btn-primary">Send</button>
							</form>
							<!-- end form -->
						</div>
					</div>
				</div>
			</div>
			<!-- end .section-wrapper -->
