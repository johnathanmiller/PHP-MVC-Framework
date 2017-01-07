<?php

class Controller {

	public function model($model) {
		return new $model();
	}

	public function view($data = [], $model = null) {

		$controller = strtolower(get_called_class());

		// We select the directory that matches the controller class
		$view_dir = VIEWS . $controller . DS;

		// The view we're selecting is the method
		$view = strtolower(debug_backtrace()[1]['function']);
		
		// Ignore leading underscores in method names
		if (substr($view, 0, 1) === '_') $view = substr($view, 1);
		
		if (isset($data['action']) && !empty($data['action']) && file_exists($view_dir . $view . DS . $data['action'] .'.php')) {

			/**
			 *
			 * Check for action parameter
			 * @param action - can be used for new, edit, update, delete, etc.
			 *
			 */

			$new_view = $view . DS . $data['action'] .'.php';

		} else if (isset($data['view'])) {

			/**
			 *
			 * Check for view parameter
			 * @param view - can be used to view all objects or a specific object.
			 *
			 */

			$new_view = $view . DS .'view.php';

		} else if (is_dir($view_dir . $view)) {

			// If parameter is a directory let's retrieve the index file
			$new_view = $view . DS .'index.php';

		} else {

			// Get the view file
			$new_view = $view .'.php';

		}

		// If model is passed in let's make it callable on our page
		if (file_exists(MODELS . $model .'.php')) {
			$model = $this->model($model);
		}

		// Load methods before rendering view
		$get = $this->loadBeforeView($controller, $view);

		require_once $view_dir .'template/header.php';
		require_once $view_dir . $new_view;
		require_once $view_dir .'template/footer.php';
	}

	private function loadBeforeView($controller, $view) {

		return array(
			'site_title' => General::site_title($controller, $view),
			'component' => new Component($controller)
		);

	}
	
}