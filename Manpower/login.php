<?php
@session_start();
require_once("db_config.php");
if (isset($_SESSION['name'])) {
    header("location: dashboard.php");
}
$serverName = 'http://' . $_SERVER['SERVER_NAME'] . '/man_power';

if (isset($_POST['user'])) {
    $email = $_POST['user'];
    $password = $_POST['passwd'];
    $status = "error";
    unset($_SESSION['id']);
    unset($_SESSION['type']);
    if (empty($email) || empty($password)) {
        $_SESSION['msg'] = "Fields should not be empty!";
    } else { 
        $adminRows = $conn->query("SELECT id, name, status FROM admin1 where email = '".$email."' and password = '".$password."'")->fetch_row();
        $workerRows = $conn->query("SELECT id, name, status FROM worker where email = '".$email."' and password = '".$password."'")->fetch_row();
        $customerRows = $conn->query("SELECT id, name, case is_active when 0 then 'inactive' when 1 then 'active' end as status FROM customers where email = '".$email."' and password = '".$password."'")->fetch_row();
        if ($adminRows && count($adminRows) >= 1) {
            $_SESSION['id'] = $adminRows[0];
            $_SESSION['type'] = 'admin';
            $_SESSION['name'] = $adminRows[1];
            $_SESSION['status'] = $adminRows[2];
        } elseif ($workerRows && count($workerRows) >= 1) {
            $_SESSION['id'] = $workerRows[0];
            $_SESSION['type'] = 'worker';
            $_SESSION['name'] = $workerRows[1];
            $_SESSION['status'] = $workerRows[2];
        } elseif ($customerRows && count($customerRows) >= 1) {
            $_SESSION['id'] = $customerRows[0];
            $_SESSION['type'] = 'customer';
            $_SESSION['name'] = $customerRows[1];
            $_SESSION['status'] = $customerRows[2];
        }
        if (isset($_SESSION['id']) && isset($_SESSION['type'])) {
            unset($_SESSION['msg']);
            $status = '';
            if ($_SESSION['type'] == 'admin') {
                header("location: dashboard.php");
            } elseif ($_SESSION['type'] == 'worker') {
                header("location: worker_dashboard.php");
            } elseif ($_SESSION['type'] == 'customer') {
                header("location: customer_dashboard.php");
            }
            
        }

        if ($status == "error") {
            $_SESSION['msg'] = "Username or password not matched!";
            header("location: index.php");
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Form</title> 
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="<?= $serverName; ?>/assets/css/iofrm-style.css">
    <link rel="stylesheet" href="<?= $serverName; ?>/assets/css/iofrm-theme9.css">
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
            overflow: hidden;
            max-width: 900px;
            display: flex;
            width: 100%;
        }

        .img-holder {
            flex: 1;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            background: url('<?= $serverName; ?>/assets/images/graphic5.svg') center/cover no-repeat;
        }

        .form-content {
            flex: 1;
            padding: 40px;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .form-content h4 {
            color: #333;
            text-align: center;
            margin-bottom: 20px;
        }

        .form-content input {
            margin-bottom: 15px;
        }

        .form-button {
            text-align: center;
        }

        .form-button button {
            background: #6a11cb;
            color: #fff;
            border: none;
            padding: 10px 20px;
            border-radius: 50px;
            font-size: 16px;
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
<center><img src="manpower1.jpg" alt="buildonclick" class="logo" width=150, height=150>
    <div class="form-body">
        <div class="form-holder">
            <div class="img-holder">
                <h3>Local Workers Web Based System  .</h3><a href="adhar.html/">adhar</a>
				<h5>To Provide Work And Verfication</h5>
               <!--<p>In order to build a rewarding employee experience, you need to understand what matters most to your people.</p> -->
            </div>
            <div class="form-content">
                <h4>Login</h4>
                <form method="post" action="">
                    <input class="form-control" type="email" name="user" placeholder="E-mail Address" required>
                    <input class="form-control" type="password" name="passwd" placeholder="Password" required>
                    <div class="form-button">
                        <button id="submit" type="submit">Login</button>
                    </div>
                    <?php if (isset($_SESSION['msg'])) { ?>
                        <p class="error-msg">
                            <?= $_SESSION['msg']; ?>
                        </p>
                    <?php } ?>
                </form>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>
