<?php
function clean($string) {
    return htmlentities($string);
}
function redirect($location) {
    return header("Location: {$location}");
}
function set_message($message) {
    if (!empty($message)) {
        $_SESSION['message'] = $message;
    } else {
        $message = "";
    }
}
function display_message() {
    if (isset($_SESSION['message'])) {
        echo $_SESSION['message'];
        unset($_SESSION['message']);
    }
}
function validation_errors($error_message) {
    $error_message = <<<DELIMITER
<div class="alert alert-danger bg-red text-white" role="alert">
   $error_message
</div>
DELIMITER;
    return $error_message;
}
function email_exists($email) {
    $sql = "SELECT id FROM users WHERE email = '$email'";
    $result = query($sql);
    if (row_count($result) == 1) {
        return true;
    } else {
        return false;
    }
}
function send_email($email, $subject, $msg, $headers) {
    return mail($email, $subject, $msg, $headers);
}


function validate_user_registration() {
    $errors = [];
    $min = 3;
    $max = 20;
    if ($_SERVER['REQUEST_METHOD'] == "POST") {
        $first_name = clean($_POST['first_name']);
        $last_name = clean($_POST['last_name']);
        $email = clean($_POST['email']);
        $password = clean($_POST['password']);
        $confirm_password = clean($_POST['confirm_password']);
        $plan = clean($_POST['plan']);
        if (strlen($first_name) < $min) {
            $errors[] = "First name cannot be less than {$min} characters";
        }
        if (strlen($first_name) > $max) {
            $errors[] = "First name cannot be more than {$max} characters";
        }
        if (strlen($last_name) < $min) {
            $errors[] = "Last name cannot be less than {$min} characters";
        }
        if (strlen($last_name) > $max) {
            $errors[] = "Last name cannot be more than {$max} characters";
        }
        if (email_exists($email)) {
            $errors[] = "Sorry that email already is registered";
        }
        if (strlen($email) < $min) {
            $errors[] = "Email cannot be more than {$max} characters";
        }
        if ($password !== $confirm_password) {
            $errors[] = "Password fields do not match";
        }
        if (!empty($errors)) {
            foreach ($errors as $error) {
                echo validation_errors($error);
            }
        } else {
            if (register_user($first_name, $last_name, $email, $password, $plan)) {
                set_message("
<div class='alert bg-success text-white'>Success, the account has been created.</div>
");
            } else {
                set_message("
<dv class='alert bg-danger text-white'>
Sorry, we ran into an issue.</div>");
                redirect("/app");
            }
        }
    }

}


function register_user($first_name, $last_name, $email, $password, $plan) {
    $first_name = escape($first_name);
    $last_name = escape($last_name);
    $email = escape($email);
    $password = escape($password);
    $plan = escape($plan);
    if (email_exists($email)) {
        return false;
    } else {
        $password = password_hash($password, PASSWORD_BCRYPT);
        $sql = "INSERT INTO users(first_name, last_name, email, password, plan)";
        $sql.= " VALUES('$first_name','$last_name','$email','$password', '$plan')";
        $result = query($sql);
        confirm($result);
        validate_user_login();
        return true;
    }
}


function validate_user_login() {
    $errors = [];
    $min = 3;
    $max = 20;
    if ($_SERVER['REQUEST_METHOD'] == "POST") {
        $email = clean($_POST['email']);
        $password = clean($_POST['password']);
        if (empty($email)) {
            $errors[] = "Email field cannot be empty";
        }
        if (empty($password)) {
            $errors[] = "Password field cannot be empty";
        }
        if (!empty($errors)) {
            foreach ($errors as $error) {
                echo validation_errors($error);
            }
        } else {
            if (login_user($email, $password)) {
                redirect("/app");
            } else {
                echo validation_errors("Incorrect Password");
            }
        }
    }
}


function login_user($email, $password) {
    $sql = "SELECT password, id FROM users WHERE email = '" . escape($email) . "'";
    $result = query($sql);
    if (row_count($result) == 1) {
        $row = fetch_array($result);
        $db_password = $row['password'];
        if (password_verify($password, $row['password'])) {
            setcookie('email', $email, time() + 86400);
            $_SESSION['email'] = $email;
            return true;
        } else {
            return false;
        }
        return true;
    } else {
        return false;
    }
}


function logged_in() {
    if (isset($_SESSION['email']) || isset($_COOKIE['email'])) {
        return true;
    } else {
        return false;
    }
}

?>