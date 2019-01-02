<?php

Session::start();
Session::delete('email');
Session::delete('session_start');
Session::delete('session_expire');
Session::destroy();
Url::redirect('/login');