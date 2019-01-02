<?php

class Controller
{

    /**
     * View
     * 
     * Searches for view file
     * 
     * @since 1.0.0
     * @access public
     * 
     * @param array $params View paramaters, empty by default
     * @param array $models Array of model names, null by default
     */
    public function view(array $params = [], array $models = null) : void
    {
        $data = $params;

        $controller = strtolower(get_called_class());
        $view = strtolower(debug_backtrace()[1]['function']);
        
        if (substr($view, 0, 1) === '_') {
            $view = substr($view, 1);
        }
        
        $php_path = DIR['VIEWS'] . '/_php/' . $controller;

        /**
         * If action and action file exists, set view path
         * Else if id, set file in view path to view
         * Else if directory, set view path to index file in directory
         * Else, set file to view
         */
        if (isset($params['action']) && !empty($params['action']) && file_exists($php_path . '/' . $view . '/' . $params['action'] . '.php')) {
            $view_path = $view . '/' . $params['action'] . '.php';

        } elseif (isset($params['id'])) {
            $view_path = $view . '/view.php';

        } elseif (is_dir($php_path . '/' . $view)) {
            $view_path = $view . '/index.php';

        } else {
            $view_path = $view . '.php';
        }

        /**
         * Fallback to 404 if view file doesn't exist
         */
        if (!file_exists($php_path . '/' . $view_path)) {
            $controller = 'home';
            $view_path = '404.php';
        }

        /**
         * Set status code
         */
        if (isset($params['status']) && !empty($params['status']) && is_numeric($params['status'])) {
            http_response_code($params['status']);
        }

        /**
         * Load models
         */
        if (!is_null($models)) {
            $models = $this->loadModels($models);
        }

        /**
         * Set title
         */
        $data['title'] = Page::title([
            'controller' => $controller,
            'view' => $view
        ]);

        /**
         * Check for require_session
         */
        if (!isset($params['require_session'])) {
            $params['require_session'] = false;
        }

        /**
         * Start session
         */
        Session::start();
        Url::requireRedirect($params['require_session']);

        /**
         * Set template path
         */
        $data['path'] = $controller . '/' . str_replace('.php', '.twig', $view_path);

        require_once $php_path . '/' . $view_path;
    }

    /**
	 * Model
	 * 
	 * Method to call model by name
	 * 
	 * @since 1.0.0
	 * @access protected
	 * 
	 * @param string $model Model name
	 * @return object
	 */
	protected function model(string $model)
	{
		return new $model();
	}

	/**
     * Load models
     * 
     * @since 2.0.0
     * @access protected
     * 
     * @param array $models Array of model names
     * @return array
     */
    protected function loadModels(array $models) : array
    {
        $load_models = [];

        if (!is_null($models) && count($models) > 0) {
            foreach ($models as $model) {
                if (file_exists(DIR['MODELS'] . '/' . $model . '.php')) {
                    $load_models[strtolower($model)] = $this->model($model);

                } else {
                    throw new \Exception('Model not found (' . $model . ')');
                }
            }
        }

        return $load_models;
    }

}