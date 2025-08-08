<?php
session_start(); // Ensure session starts only once

// Include necessary files
require_once("db_config.php");
require_once("header.php");
require_once("sidebar.php");
?>

<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>Welcome to Our Service Portal</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="index.php">Home</a></li>
        </ol>
      </div>
    </div>
  </div>
</section>

<section class="content">
  <div class="container-fluid">
    <div class="row">
      <!-- Services Section -->
      <div class="col-md-8">
        <div class="card">
          <div class="card-header bg-primary text-white">
            <h3 class="card-title">Our Services</h3>
          </div>
          <div class="card-body">
            <ul>
              <li>Worker Management</li>
              <li>Invoice Processing</li>
              <li>Salary Disbursement</li>
              <li>Advance Salary Requests</li>
              <li>Monthly Report Generation</li>
            </ul>
          </div>
        </div>
      </div>
      
      <!-- Registration Form -->
      <div class="col-md-4">
        <div class="card">
          <div class="card-header bg-success text-white">
            <h3 class="card-title">Register Now</h3>
          </div>
          <div class="card-body">
            <form action="register.php" method="POST">
              <div class="form-group">
                <label for="name">Full Name</label>
                <input type="text" class="form-control" name="name" required>
              </div>
              <div class="form-group">
                <label for="email">Email</label>
                <input type="email" class="form-control" name="email" required>
              </div>
              <div class="form-group">
                <label for="password">Password</label>
                <input type="password" class="form-control" name="password" required>
              </div>
              <button type="submit" class="btn btn-primary">Register</button>
            </form>
          </div>
        </div>
      </div> 
    </div>
  </div>
</section>

<?php require("footer.php"); ?>
