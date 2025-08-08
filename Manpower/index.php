<div style="text-align: center;">
  <a href="adhar.html">AAdhar Verification</a>
</div>

<a href="adhar.html">AAdhar Verification </a>
<?php
@session_start();
require_once("db_config.php");

if (isset($_SESSION['name'])) {
    header("location: dashboard.php");
}

if (isset($_POST['form-type']) && $_POST['form-type'] == 'customer') {
    $name = $_POST['name'];
    $contactNo = $_POST['contact_no'];
    $aadharNo = $_POST['aadhar_no'];
    $email = $_POST['email'];
    $address = $_POST['address'];
    $password = $_POST['password'];
    $worker = $conn->query("INSERT INTO `customers` (`name`, `contact_no`, `aadhar_no`, `email`, `address`, `password`, is_active) VALUES ('".$name."', '".$contactNo."', '".$aadharNo."', '".$email."', '".$address."', '".$password."', 1)");
?>
<script> 
   window.location.assign("login.php");
  </script> 
<?php
} else if (isset($_POST['form-type']) && $_POST['form-type'] == 'worker') {
    $name = $_POST['name'];
    $iqama_number = $_POST['iqama_number'];
    $local_number = $_POST['local_number'];
    $whatsapp_number = $_POST['whatsapp_number'];
    $photo = explode('.', $_FILES['photo']['name']);
    $photo_extention = end($photo);
    $photo_name = $name.'.'.$photo_extention;
    move_uploaded_file($_FILES['photo']['tmp_name'],'assets/uploads/worker_photos/'.$photo_name);
   
  
    $iqama_photo = explode('.', $_FILES['iqama_photo']['name']);
    $iqama_photo_extention = end($iqama_photo);
    $iqama_photo_name = $iqama_number.'.'.$iqama_photo_extention;
    move_uploaded_file($_FILES['iqama_photo']['tmp_name'],'assets/uploads/iqama_photos/'.$iqama_photo_name);
  
    $current_address = $_POST['current_address'];
    $working_place = $_POST['working_place'];
    $daily_salary = $_POST['salary'];
    $ot_rate = $_POST['ot_rate'];
    $passport_number = $_POST['passport_number'];
    $current_address = $_POST['current_address'];
    $email = $_POST['email'];
    $password = $_POST['password'];
  
  $worker = $conn->query("INSERT INTO `worker`(`name`, `iqama_number`, `local_number`, `whatsapp_number`, `photo`, `iqama_photo`, `current_address`, `working_place`, `daily_basic_salary`, `ot_rate`, `passport_number`, `email`, `password`, `status`) VALUES ('$name','$iqama_number','$local_number','$whatsapp_number','$photo_name','$iqama_photo_name','$current_address',' $working_place','$daily_salary','$ot_rate','$passport_number','$email','$password','active')");
  
   ?>
   <script> 
    window.location.assign("login.php");
   </script> 
  
  <?php }
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

        .form-holder .tab {
            float: left;
            margin: 10px 20px 20px 0;
            background-color: lightgrey;
            border: none;
            color: #000;
            padding: 15px 32px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 18px;
        }
        .form-holder .tab.selected {
            background-color: lightblue;
            color: #000;
        }
        .hide{
            display: none;
        }
        .form-body { height: auto; margin: 200px 0;}
    </style>
</head>
<body>
    <div class="form-body">
        <div class="form-holder">
            <h4>Register</h4>
            <div class="tabs">
                <a href="?customer_type=customer">
                    <div onclick="showForm('customer')" class="tab customer <?= (isset($_GET['customer_type']) && $_GET['customer_type'] == 'customer') ? 'selected' : ''?>">Customer</div>
                </a>
                <a href="?customer_type=worker">
                    <div onclick="showForm('worker')" class="tab worker <?= (isset($_GET['customer_type']) && $_GET['customer_type'] == 'worker') ? 'selected' : ''?>">Worker</div>
                </a>
            </div>
            <div id="customer-form-container" class="hide">
                <form name="customer-form" id="customer-form" method="post" action="">
                    <input class="form-control" type="text" name="name" placeholder="Full Name" required>
                    <input class="form-control" type="text" name="contact_no" placeholder="Contact Number" required>
                    <input class="form-control" type="text" name="aadhar_no" placeholder="Aadhar Number" required>
                    <input class="form-control" type="address" name="address" placeholder="Address" required>
                    <input class="form-control" type="email" name="email" placeholder="E-mail Address" required>
                    <input class="form-control" type="password" name="password" placeholder="Password" required>
                    <input class="form-control" type="hidden" name="form-type" value="customer">
                    <div class="form-button">
                        <button type="submit" name="register">Register</button>
                    </div>
                    <?php if (isset($_SESSION['msg'])) { ?>
                        <p class="error-msg">
                            <?= $_SESSION['msg']; ?>
                        </p>
                    <?php } ?>
                </form>
            </div>
            <div id="worker-form-container" class="hide">
                <form name="worker-form" id="worker-form" method="post" action="" enctype="multipart/form-data">
                    <input type="text" class="form-control" name="name" id="name" placeholder="Enter Name" required>
                    <input type="text" class="form-control" name="iqama_number" id="iqama_number" placeholder="Iqama Number" required>
                    <input type="text" class="form-control" name="local_number" id="local_number" placeholder=" Local Number" required>
                    <input type="text" class="form-control" name="whatsapp_number" id="whatsapp_number" placeholder="WhatssApp Number" required>
                    <label for="Photo">Photo</label><input type="file" class="" name="photo" id="photo">
                    <label for="Iqama Photo">Iqama Photo</label><input type="file" class="" name="iqama_photo" id="iqama_photo">
                    <input type="text" class="form-control" name="current_address" id="current_address" placeholder=" Current Address" required>
                    <input type="text" class="form-control" name="working_place" id="working_place" placeholder=" Working Place" required>
                    <input type="text" class="form-control" name="salary" id="salary" placeholder="Daily Basic Salary" required>
                    <input type="text" class="form-control" name="ot_rate" id="ot_rate" placeholder="Over Time Rate" required>
                    <input type="text" class="form-control" name="passport_number" id="passport_number" placeholder="Passport Number" required>
                    <input type="text" class="form-control" name="email" id="email" placeholder="Enter Email" required>
                    <input class="form-control" type="password" name="password" placeholder="Password" required>
                    <input class="form-control" type="hidden" name="form-type" value="worker"> 
                    <div class="form-button">
                        <button type="submit" name="register">Register</button>
                    </div>
                    <?php if (isset($_SESSION['msg'])) { ?>
                        <p class="error-msg">
                            <?= $_SESSION['msg']; ?>
                        </p>
                    <?php } ?>
                </form>
            </div>
            <p class="text-center mt-3">Already have an account? <a href="login.php">Login</a></p>
        </div>
    </div>
    
    <script>
        function showForm(formType) {
            console.log(formType + "-form-container");
            var formEle = document.getElementById(formType + "-form-container");
            formEle.classList.remove("hide");
        }
        <?php if (isset($_GET['customer_type']) && $_GET['customer_type'] == 'customer') {
             echo "showForm('customer');";
            }
         else if (isset($_GET['customer_type']) && $_GET['customer_type'] == 'worker') {
            echo "showForm('worker');";
         }?>
    </script>
</body>
</html>
