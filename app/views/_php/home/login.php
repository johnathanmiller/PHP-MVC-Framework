<?php

if (!empty($_POST)) {

    $errors = [];

    if (isset($_POST['email'])) {
        $template['form']['data']['email'] = $_POST['email'];
    }

    $email = Sanitize::email($_POST['email']);
    $password = $_POST['password'];

    if (empty($email)) {
        $errors[] = 'Email should not be empty.';

    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = 'Please enter a valid email address.';
    }

    if (empty($password)) {
        $errors[] = 'Password should not be empty.';
    }

    if (empty($errors)) {
        if ($models['user']->login($email, $password)) {
            Url::redirect(SITE_URL);

        } else {
            $errors[] = 'Email address and/or password is incorrect.';
        }
    }
}

if (!empty($errors)) {
    $data['errors'] = General::message('error', $errors);
}

return print (new Template())->render($data['path'], $data);