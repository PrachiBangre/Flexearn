<?php
$page = "Dashboard";
require_once("../header.php");
require_once("../sidebar.php"); 
require_once("../db_config.php");
$id=$_GET['id'];
 $update = $conn->query("SELECT * FROM `customers` WHERE id=$id");
 $result=$update->fetch_assoc();
 

 if(isset($_POST['submit'])){
    $name = $_POST['name'];
    $contactNo = $_POST['contact_no'];
    $aadharNo = $_POST['aadhar_no'];
    $email = $_POST['email'];
    $address = $_POST['address'];
    $isActive = $_POST['is_active'];
    $password = $_POST['password'];
    $worker = $conn->query("UPDATE `customers` SET `name` = '".$name."', `contact_no` = '".$contactNo."', `aadhar_no` = '".$aadharNo."', `email` = '".$email."', `password` = '".$password."', `address` = '".$address."', `is_active` = '".$isActive."' WHERE `customers`.`id` = '".$id."'");

     ?>

        <script> 
      window.location.assign("view_customer.php");
     </script> 
         
 <?php } ?>  



<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>Edit Customer</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="#">Edit Customer</a></li>
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


          <form action="" method="post" enctype="multipart/form-data">
            <div id="new">
                <div class="row">
                  <div class="col-6">
                    <div class="form-group">
                      <label for="Name">Name</label>
                      <input type="text" class="form-control" name="name" id="name" placeholder="Enter Worker Name" value="<?php echo $result['name']; ?>">
                    </div>
                  </div>
                  <div class="col-6">
                    <div class="form-group">
                      <label for="Iqama numbe">Contact number</label>
                      <input type="text" class="form-control" name="contact_no" id="contact_no" placeholder="Contact Number" value="<?php echo $result['contact_no']; ?>">
                    </div>
                  </div>
                  <div class="col-6">
                    <div class="form-group">
                      <label for="Local number">Aadhar number</label>
                      <input type="text" class="form-control" name="aadhar_no" id="aadhar_no" placeholder="Aadhar Number" value="<?php echo $result['aadhar_no']; ?>">
                    </div>
                  </div>
                  <div class="col-6">
                    <div class="form-group">
                      <label for="WhatsApp number">Email</label>
                      <input type="text" class="form-control" name="email" id="email" placeholder="Email"  value="<?php echo $result['email']; ?>">
                    </div>
                  </div>

                  <div class="col-6">
                    <div class="form-group">
                      <label for="Address">Address</label>
                      <input type="text" class="form-control" name="address" id="address" placeholder="Address" value="<?php echo $result['address']; ?>">
                    </div>
                  </div>
                  <div class="col-6">
                    <div class="form-group">
                      <label for="Password">Password</label>
                      <input type="password" class="form-control" name="password" id="password" placeholder="Password" value="<?php echo $result['password']; ?>">
                    </div>
                  </div>
                  <div class="col-6">
                    <div class="form-group">
                    <label for="status">Select Status:</label><br>
                    <input type="radio" name="is_active" value="1" <?php if($result['is_active']==1){echo "checked";} ?> ><span>Active</span> |
                    <input type="radio" name="is_active" value="0" <?php if($result['is_active']!=1){echo "checked";} ?>><span>Inactive</span>
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