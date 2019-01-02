<?php

if (!empty($_POST)) {

    $errors = [];

    if (isset($_POST['email'])) {
        $template['form']['data']['email'] = $_POST['email'];
    }

    $email = Sanitize::email($_POST['email']);
    $password = $_POST['password'];
    $repeat_password = $_POST['repeat_password'];

    if (empty($email)) {
        $errors[] = 'Email should not be empty.';

    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = 'Please enter a valid email address.';
    }

    if (empty($password)) {
        $errors[] = 'Password should not be empty.';

    } elseif (strlen($password) < 8) {
        $errors[] = 'Password should be at least 8 characters in length.';
    }

    if (empty($repeat_password)) {
        $errors[] = 'Repeat Password should not be empty.';
    }

    if ($repeat_password !== $password) {
        $errors[] = 'Password fields do not match.';
    }

    if (empty($errors)) {
        if (!$models['user']->get($email, ['id'])) {
            $signup_data = [
                'email' => $email,
                'password' => $password
            ];

            if ($models['user']->signup($signup_data)) {
                Url::redirect(SITE_URL . '/login');

            } else {
                $errors[] = 'Unable to register account.';
            }

        } else {
            $errors[] = 'An account with this email address already exists.';
        }
    }
}

if (!empty($errors)) {
    $data['errors'] = General::message('error', $errors);
}

return print (new Template())->render($data['path'], $data);