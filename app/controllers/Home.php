<?php

class Home extends Controller
{

    /**
     * 404 page
     */
    public function _404() : void
    {
        $params = [
            'require_nav' => true,
            'status' => 404
        ];

        $this->view($params, []);
    }

    /**
     * Home page
     */
    public function index() : void
    {
        $params = [
            'require_nav' => true,
            'sidebar' => 'sidebar'
        ];

        $this->view($params, []);
    }

    /**
     * Contact page
     */
    public function contact() : void
    {
        $params = [
            'require_nav' => true
        ];

        $this->view($params, []);
    }

    /**
     * Signup page
     */
    public function signup() : void
    {
        $params = [
            'require_nav' => true
        ];

        $this->view($params, ['User']);
    }

    /**
     * Login page
     */
    public function login() : void
    {
        $params = [
            'require_nav' => true
        ];

        $this->view($params, ['User']);
    }

    /**
     * Logout
     */
    public function logout() : void
    {
        $this->view();
    }

}