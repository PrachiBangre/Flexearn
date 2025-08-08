
<?php
@session_start();
$id = $_SESSION['id'];
$page = "View Worker";
require_once("../header.php");
require_once("../sidebar.php"); 
require_once("../db_config.php");
$work = $conn->query("SELECT * FROM `customers`");

?>


<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="">Customer List</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="add_customer.php" class="btn btn-sm btn-success">Add new</a></li>
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
            <h2 class="card-title">Customers List</h2>
  

            <table class="table table-bordered table-striped text-center">
            <thead>
                <tr>
                    <th>SL</th>
                    <th>Name</th>
                    <th>Contact Number</th>
                    <th>Aadhar Number</th>
                    <th>Email</th>
                    <th>Address</th>
                    <th>Is Active</th>
                       
                    <?php
                     $userRoleTable= $conn->query("SELECT * FROM `user_role` JOIN admin1 ON admin1.id= user_role.adminID WHERE `adminID`= $id");
                       
                     while ($roleRow = $userRoleTable->fetch_assoc()) {
                       if( ($roleRow['add_customer_edit'] || $roleRow['add_customer_delete']) != '0'){ ?>
                        <th scope="col">Action</th>

                    <?php
                       }
                      }
                  ?>
                </tr>
            </thead>
            <tbody>
            <?php $sl=0; while($result = $work->fetch_assoc()){ 
                // echo "<pre>";
                // print_r($result);
                ?>  
                <tr>
                    <td><?php echo ++$sl; ?></td>
                    <td><?php echo $result['name']; ?></td>
                    <td><?php echo $result['contact_no']; ?></td>
                    <td><?php echo $result['aadhar_no']; ?></td>
                    <td><?php echo $result['email']; ?></td>
                    <td><?php echo $result['address']; ?></td>
                    <td><?php echo ($result['is_active']) ? 'Active' : 'Deactive'; ?></td>
                    <td>
                        <a href="customer_details.php?id=<?php echo $result['id'] ?>" class="btn btn-info fas fa-info"></a>
                        
                        


                        
                        <?php 
                        $userRoleTable= $conn->query("SELECT * FROM `user_role` JOIN admin1 ON admin1.id= user_role.adminID WHERE `adminID`= $id");
                       
                        while ($roleRow = $userRoleTable->fetch_assoc()) {
                          
                            
if ($roleRow['add_customer_edit']== '1') {  ?>
  <a href="customer_update.php?id=<?php echo $result['id'] ?>" class="btn btn-success fas fa-edit"></a>
<?php 
}

if($roleRow['add_customer_delete']== '1'){ ?>
   <a href="customer_delete.php?id=<?php echo $result['id'] ?>" class="btn btn-danger fas fa-trash-alt"></a>

<?php 
}
                         }
                      

                    
                    ?>
                    </td>
                </tr>

                <?php } ?>
            </tbody>

            </table>
          
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