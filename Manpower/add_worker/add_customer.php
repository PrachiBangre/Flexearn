<?php
$page = "Dashboard";
require_once("../header.php");
require_once("../sidebar.php");
require_once("../db_config.php");

if(isset($_POST['submit'])){
  $name = $_POST['name'];
  $contactNo = $_POST['contact_no'];
  $aadharNo = $_POST['aadhar_no'];
  $email = $_POST['email'];
  $address = $_POST['address'];
  $password = $_POST['password'];
  $worker = $conn->query("INSERT INTO `customers` (`name`, `contact_no`, `aadhar_no`, `email`, `address`, `password`) VALUES ('".$name."', '".$contactNo."', '".$aadharNo."', '".$email."', '".$address."', '".$password."')");

 ?>
<script> 
 //window.location.assign("view_customer.php");
</script> 

<?php } ?>


<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-md-10">
        <h1 style="text-align: center; color:green;margin-left: 17%;">Add Customer</h1>
      </div>
      <div class="col-md-2">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="view_customer.php" class="btn btn-sm btn-success">All Customers</a></li>
        </ol>
      </div>
    </div>
  </div><!-- /.container-fluid -->
</section>
<section class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header">
            <!-- <h2 class="card-title text-center">code goes here</h2> -->

            <form action="" method="post" enctype="multipart/form-data">
            <div id="new">
                <div class="row">
                  <div class="col-6">
                    <div class="form-group">
                      <label for="Name">Name</label>
                      <input type="text" class="form-control" name="name" id="name" placeholder="Enter Customer Name" required>
                    </div>
                  </div>
                  <div class="col-6">
                    <div class="form-group">
                      <label for="contact_no">Contact number</label>
                      <input type="text" class="form-control" name="contact_no" id="contact_no" placeholder="Contact Number" required>
                    </div>
                  </div>
                  <div class="col-6">
                    <div class="form-group">
                      <label for="aadhar_no">Aadhar number</label>
                      <input type="text" class="form-control" name="aadhar_no" id="aadhar_no" placeholder="Aadhar Number" required>
                    </div>
                  </div>
                  <div class="col-6">
                    <div class="form-group">
                      <label for="email">Email</label>
                      <input type="text" class="form-control" name="email" id="email" placeholder="Email" required>
                    </div>
                  </div>

                  <div class="col-6">
                    <div class="form-group">
                      <label for="address">Address</label>
                      <input type="text" class="form-control" name="address" id="address" placeholder="Address" required>
                    </div>
                  </div>

                  <div class="col-6">
                    <div class="form-group">
                      <label for="address">Password</label>
                      <input type="password" class="form-control" name="password" id="password" placeholder="Password" required>
                    </div>
                  </div>

                </div>
                <hr style="border: 1px solid #ccc;">
              </div>
              <input type="submit" name="submit" value="Submit" class="btn btn-block btn-success"></input>

            </form>
          </div>
          <!-- /.card-header -->
          <div class="card-body">

          </div>
        </div>
        <!-- /.card -->
      </div>
    </div>
  </div><!-- /.container-fluid -->
</section>
<?php require("../footer.php"); ?>