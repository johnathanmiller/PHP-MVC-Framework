<?php

class Controller {

	/**
	 * Model
	 * 
	 * Method to call model by name
	 * 
	 * @since 1.0.0
	 * @access private
	 * 
	 * @param string $model
	 * @return object
	 */
	private function model($model) {
		return new $model();
	}

	/**
	 * View
	 * 
	 * Data argument passes in controller parameters. Model argument can be used to load in a model from the view method in the controller class. This method will render the view using require_once.
	 * 
	 * @since 1.0.0
	 * @access public
	 * 
	 * @param object $data Object of controller parameters being passed in from controller.
	 * @param string|null $model Model to load into view (optional).
	 */
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
			 * Check for action key
			 * @var object $data
			 * @var string $data['action'] Usually contains value of 'new' or 'edit'.
			 */

			$new_view = $view . DS . $data['action'] .'.php';

		} else if (isset($data['view'])) {

			/**
			 * Check for view key
			 * @var object $data
			 * @var string $data['view'] Usually set when viewing a specific object.
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

		// Create soft fallback to 404 when view file doesn't exist
		if (!file_exists($view_dir . $new_view)) {
			$controller = 'home';
			$new_view = '404.php';
		}

		// Load methods before rendering view
		$get = $this->loadBeforeView($controller, $view);

		require_once $view_dir .'template/header.php';
		require_once $view_dir . $new_view;
		require_once $view_dir .'template/footer.php';

		return;
	}

	/**
	 * Load before view is rendered
	 * 
	 * @since 1.0.6
	 * @access protected
	 * 
	 * @param string $controller
	 * @param string $view
	 * @return object
	 */
	protected function loadBeforeView($controller, $view) {
		return [
			'component' => new Component($controller, $view),
			'user' => new User()
		];
	}
	
}