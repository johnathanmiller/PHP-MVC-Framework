	<nav class="navbar-nav navbar-inverse">
		<div class="container">
			<div class="col-sm-12">
				<div class="navbar-header">
					<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#main-nav" aria-expanded="false">
						<span class="sr-only">Toggle navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
					<a href="<?php print SITE_URL; ?>" class="navbar-brand">
						<span><?php print SITE_NAME; ?></span>
					</a>
				</div>
				<div class="collapse navbar-collapse" id="main-nav">
					<ul class="nav navbar-nav navbar-right">
						<li><a href="<?php print SITE_URL; ?>/404">404</a></li>
						<li><a href="<?php print SITE_URL; ?>/contact">Contact</a></li>
						<?php if (!empty(Session::get('email'))): ?>
						<li class="dropdown">
							<a href="" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><?php echo $get_user['email']; ?> <span class="caret"></span></a>
		                    <ul class="dropdown-menu">
								<li><a href="/logout"><i class="fa fa-sign-out fa-fw"></i> Logout</a></li>
		                    </ul>
		                </li>
						<?php else: ?>
						<li><a href="/login">Login</a></li>
						<li><a href="/signup">Sign up</a></li>
						<?php endif; ?>
					</ul>
				</div>
			</div>
		</div>
	</nav>
	<!-- end nav -->
