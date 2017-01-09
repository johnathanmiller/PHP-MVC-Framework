<?php

class General {

	public static function errors($errors) {

		$errors = (is_array($errors)) ? implode('</li><li>', $errors) : $errors;

		?>
		<div class="alert alert-danger error" role="alert">
			<span><strong><i class="fa fa-warning"></i> Error</strong></span>
			<ul><li><?php echo $errors; ?></li></ul>
		</div>
		<?php
	}

	public static function getDate() {
		$date = date('Y-m-d H:i:s', time());
		return $date;
	}

}