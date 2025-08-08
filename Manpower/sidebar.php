 <?php
    @session_start();
    $serverName = 'http://'.$_SERVER['SERVER_NAME'].'/man_power';
    
    if (!isset($_SESSION['name'])) {
        header("location: $serverName/index.php");
    }
    require_once("db_config.php");
    
?>
 <!-- Main Sidebar Container -->
 <aside class="main-sidebar bg-success pt-14  elevation-4">
   <!-- Brand Logo -->
   <a href="" class="brand-link">
     <img src="<?= $serverName; ?>/assets/images/AdminLTELogo.png"
       alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
     <span class="brand-text font-weight-light">FlexEarn</span>
   </a>

   <div class="bb-2"></div>
   <!-- Sidebar -->
   <div class="sidebar">
     <div class="user-panel mt-3  d-flex">

       <div class="info text-white">
         Welcome, <?= $_SESSION['name']; ?>
       </div>
     </div>

     <div class="bb-2"></div>

     <!-- Sidebar Menu -->
     <nav class="mt-2">
       <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

       <li class="nav-item">
           <a href="http://localhost/Manpower/dashboard.php" class="nav-link">
             <i class="far fa-circle nav-icon"></i>
             <p>Dashboard</p>
           </a>
         </li>
         <?php
         $id = $_SESSION['id'];
         if ($_SESSION['status'] =='active') {
            $userRoleTable = $conn->query("SELECT * FROM `user_role` JOIN admin1 ON admin1.id= user_role.adminID WHERE `adminID`= $id");
            $roleRow = $userRoleTable->fetch_assoc();
            ?>
            <?php
           if ($_SESSION['type'] == 'admin' && ($roleRow['sectors_edit'] == '1'  || $roleRow['sectors_delete'] == '1')) {
               ?>
         <!--  sectors -->
         <li class="nav-item">
           <a href="http://localhost/Manpower/sectors/sectors.php" class="nav-link">
             <i class="far fa-circle nav-icon"></i>
             <p>Sectors</p>
           </a>
         </li>
         <?php
           } 


           if ($_SESSION['type'] == 'admin' && ($roleRow['sites_edit'] == '1'  || $roleRow['sites_delete'] == '1')) {
               ?>
         <!--  sites -->
         <li class="nav-item">
           <a href="http://localhost/Manpower/sites/sites.php" class="nav-link">
             <i class="far fa-circle nav-icon"></i>
             <p>Sites</p>
           </a>
         </li>
         <?php
           } 

           if ($_SESSION['type'] == 'admin' && ($roleRow['month_edit'] == '1'  || $roleRow['month_delete'] == '1')) { ?>

         <!--  Months -->
         <li class="nav-item">
           <a href="http://localhost/Manpower/month/month.php" class="nav-link">
             <i class="far fa-circle nav-icon"></i>
             <p>Months</p>
           </a>
         </li>

         <?php } ?>


        <?php  if ($_SESSION['type'] == 'admin' && ($roleRow['add_worker_edit'] == '1'  || $roleRow['add_worker_delete'] == '1')) { ?>
         <!--  Worker Add -->
         <li class="nav-item">
           <a href="http://localhost/Manpower/add_worker/add_worker.php" class="nav-link">
             <i class="far fa-circle nav-icon"></i>
             <p>Worker Add</p>
           </a>
         </li>
         <?php } ?>
         <?php  if ($_SESSION['type'] == 'admin' && ($roleRow['add_customer_edit'] == '1'  || $roleRow['add_customer_delete'] == '1')) { ?>
         <!--  Customer Add -->
         <li class="nav-item">
           <a href="http://localhost/Manpower/add_worker/add_customer.php" class="nav-link">
             <i class="far fa-circle nav-icon"></i>
             <p>Customer Add</p>
           </a>
         </li>
         <?php } ?>

         <?php  if ($_SESSION['type'] == 'customer' || ($_SESSION['type'] == 'admin' && ($roleRow['worker_assign_edit'] == '1'  || $roleRow['worker_assign_delete'] == '1'))) { ?>
         <!--  Worker Assign -->
         <li class="nav-item">
           <a href="http://localhost/Manpower/worker_assign/worker_assign.php" class="nav-link">
             <i class="far fa-circle nav-icon"></i>
             <p>Worker Assign</p>
           </a>
         </li>
         <?php  } ?>

         <?php  if ($_SESSION['type'] == 'admin' && ($roleRow['advance_edit'] == '1'  || $roleRow['advance_delete'] == '1')) { ?>         
         <!--  Advance -->
         <li class="nav-item">
           <a href="http://localhost/Manpower/advance/advance.php" class="nav-link">
             <i class="far fa-circle nav-icon"></i>
             <p>Advance</p>
           </a>
         </li>
         <?php } ?>
        
         <?php  if ($_SESSION['type'] == 'customer' || ($_SESSION['type'] == 'worker' || ($_SESSION['type'] == 'admin' && ($roleRow['worker_attendance_edit'] == '1'  || $roleRow['worker_attendance_delete'] == '1')))) { ?>
         <!--  Worker Attendance -->
         <li class="nav-item">
           <a href="http://localhost/Manpower/worker_attendance/worker_attendance.php" class="nav-link">
             <i class="far fa-circle nav-icon"></i>
             <p>Worker Attendance</p>
           </a>
         </li>
         <?php } ?>

         <?php  if ($_SESSION['type'] == 'admin' && ($roleRow['invoice_edit'] == '1'  || $roleRow['invoice_delete'] == '1')) { ?>
         <!--  Invoice -->
         <li class="nav-item">
           <a href="http://localhost/Manpower/invoice/invoice.php" class="nav-link">
             <i class="far fa-circle nav-icon"></i>
             <p>Invoice</p>
           </a>
         </li>
         <?php } ?>

         <?php  if ($_SESSION['type'] == 'customer' || ($_SESSION['type'] == 'worker' || ($_SESSION['type'] == 'admin' && ($roleRow['payments_edit'] == '1'  || $roleRow['payments_delete'] == '1')))) { ?>
          <!--  Payments -->
          <li class="nav-item">
           <a href="http://localhost/Manpower/payments/payments.php" class="nav-link">
             <i class="far fa-circle nav-icon"></i>
             <p>Payments</p>
           </a>
         </li>
         <?php } ?>

         <?php  if ($_SESSION['type'] == 'admin' && ($roleRow['user_role_edit'] == '1'  || $roleRow['user_role_delete'] == '1')) { ?>
          <!--  Payments -->
          <li class="nav-item">
           <a href="http://localhost/Manpower/user_lists/user_role.php" class="nav-link">
             <i class="far fa-circle nav-icon"></i>
             <p>Manage Roles</p>
           </a>
         </li>
         <?php } ?>
         
         <?php  if ($_SESSION['type'] == 'admin' && ($roleRow['modules_edit'] == '1'  || $roleRow['modules_delete'] == '1')) { ?>
         <!--  Modules
         <li class="nav-item">
           <a href="http://localhost/man_power_agent/modules/modules.php" class="nav-link">
             <i class="far fa-circle nav-icon"></i>
             <p>Modules</p>
           </a>
         </li>-->
         <?php } ?>

         <?php  if ($_SESSION['type'] == 'admin' && ($roleRow['user_lists_edit'] == '1'  || $roleRow['user_lists_delete'] == '1')) { ?>
          <!--  User Lists 
          <li class="nav-item">
           <a href="http://localhost/man_power_agent/user_lists/user_lists.php" class="nav-link">
             <i class="far fa-circle nav-icon"></i>
             <p>User Lists</p>
           </a>
         </li>-->
         <?php  } ?>
            <?php
            } else {
              header("location: inactive_user.php");
            }
            ?>
            </ul>
     </nav>
     <!-- /.sidebar-menu -->
   </div>
   <!-- /.sidebar -->
 </aside>