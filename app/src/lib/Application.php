<?php

class Application
{

    protected $controller = 'home';
    protected $view = 'index';
    protected $params = [];

    public function run() : void
    {
        $url = $this->parseUrl();

        /**
         * If first parameter is set, isn't empty, and exists as controller, set as controller
         * Else if, first parameter is set and is empty, set to default controller
         * Else, prepend default controller to url array
         */
        if (isset($url[0]) && !empty($url[0]) && file_exists(DIR['CONTROLLERS'] . '/' . $url[0] . '.php')) {
            $this->controller = $url[0];

        } elseif (isset($url[0]) && empty($url[0])) {
            $this->controller = $this->controller;

        } else {
            array_unshift($url, $this->controller);
        }

        /**
         * Pull in the controller class and instantiate it
         */
        require_once DIR['CONTROLLERS'] . '/' . ucwords($this->controller) . '.php';

        $this->controller = new $this->controller;

        /**
         * If parameter is set and exists as method in controller class, set as view
         * Else if method doesn't exist, set controller as default controller and set view to _404
         * Otherwise, view remains as default
         */
        if (isset($url[1]) && method_exists($this->controller, $url[1])) {
            $this->view = $url[1];

        } elseif (isset($url[1]) && !method_exists($this->controller, $url[1])) {
            $default_vars = get_class_vars(__CLASS__);
            $this->controller = new $default_vars['controller']();
            $this->view = '_404';
        }

        /**
         * Remove controller and view parameters from url
         */
        unset($url[0]);
        unset($url[1]);

        /**
         * If parameters remain, only pass the values
         */
        $this->params = ($url) ? array_values($url) : [];

        ob_start();
        call_user_func_array([$this->controller, $this->view], $this->params);
        ob_get_flush();
    }

    /**
     * Parse URL
     * 
     * Parses parameter string and returns as array
     * 
     * @since 1.0.0
     * @access protected
     * 
     * @return array
     */
    protected function parseUrl() : array
    {
        if (isset($_GET['q'])) {
            return explode('/', filter_var(rtrim($_GET['q'], '/'), FILTER_SANITIZE_URL));
        }
        return [];
    }

}