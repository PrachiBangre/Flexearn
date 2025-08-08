<?php
@session_start();
require_once("db_config.php");

if (isset($_SESSION['name'])) {
    header("location: dashboard.php");
}

if (isset($_POST['register'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];
    
    if (empty($name) || empty($email) || empty($password) || empty($confirm_password)) {
        $_SESSION['msg'] = "All fields are required!";
    } elseif ($password !== $confirm_password) {
        $_SESSION['msg'] = "Passwords do not match!";
    } else {
        $checkUser = $conn->query("SELECT * FROM admin1 WHERE email='$email'");
        if ($checkUser->num_rows > 0) {
            $_SESSION['msg'] = "Email already registered!";
        } else {
            $conn->query("INSERT INTO admin1 (name, email, password) VALUES ('$name', '$email', '$password')");
            $_SESSION['msg'] = "Registration successful! You can now login.";
            header("location: login.php");
            exit;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            background: linear-gradient(135deg, #6a11cb 0%, #2575fc 100%);
            font-family: 'Arial', sans-serif;
        }
        .form-body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .form-holder {
            background: #ffffff;
            border-radius: 10px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
            padding: 40px;
            max-width: 400px;
            width: 100%;
        }
        .form-holder h4 {
            text-align: center;
            margin-bottom: 20px;
        }
        .form-button button {
            width: 100%;
            background: #6a11cb;
            color: #fff;
            border: none;
            padding: 10px;
            border-radius: 50px;
            cursor: pointer;
            transition: background 0.3s;
        }
        .form-button button:hover {
            background: #2575fc;
        }
        .error-msg {
            color: red;
            font-size: 14px;
            text-align: center;
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <div class="form-body">
        <div class="form-holder">
            <h4>Register</h4>
            <form method="post" action="">
                <input class="form-control" type="text" name="name" placeholder="Full Name" required>
                <input class="form-control" type="email" name="email" placeholder="E-mail Address" required>
                <input class="form-control" type="password" name="password" placeholder="Password" required>
                <input class="form-control" type="password" name="confirm_password" placeholder="Confirm Password" required>
                <div class="form-button">
                    <button type="submit" name="register">Register</button>
                </div>
                <?php if (isset($_SESSION['msg'])) { ?>
                    <p class="error-msg">
                        <?= $_SESSION['msg']; ?>
                    </p>
                <?php } ?>
            </form>
            <p class="text-center mt-3">Already have an account? <a href="login.php">Login</a></p>
        </div>
    </div>
</body>
</html>
