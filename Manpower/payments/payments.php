<?php
$page = "payments";
require_once("../header.php");
require_once("../sidebar.php");
require_once("../db_config.php");

$where = '';
if ($_SESSION['type'] == 'customer') {
  $where = 'where invoiceID in (select invoiceID from invoice_payment where siteID in (select siteID from worker_assign where customer_id = '.$_SESSION['id'].'))';
}
if ($_SESSION['type'] == 'worker') {
  $where = 'where invoiceID in (select invoiceID from invoice_payment where siteID in (select siteID from worker_assign where workerID = '.$_SESSION['id'].'))';
}
$db=$conn->query("SELECT * FROM `payments` $where");

if (isset($_POST['amount'])) {
    $amount=$_POST["amount"];
    $date=$_POST["date"];
    $invoiceID=$_POST["invoiceID"];
  
    $conn->query("INSERT INTO `payments` (`invoiceID`, `amount`, `date`) VALUES ('$invoiceID', '$amount', '$date')"); ?>
<script type="text/javascript">
  window.location.href = "payments.php";
</script>

<?php
}
?>

<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h2> Payments</h2>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="">Home</a></li>
          <li class="breadcrumb-item"><a href="">Payments</a></li>
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
        <?php if ($_SESSION['type'] == 'admin') { ?>
          <div class="card-header text-center ">
            <div class="row">
              <div class="col-md-12">
                <h2>Add Payment</h2>
              </div>
            </div>
          </div>
          <?php } ?>
          <!-- /.card-header -->
          <div class="card-body">
          <?php if ($_SESSION['type'] == 'admin') { ?>
            <form action="" method="post">
              <div class="row">
                <div class="col-4">
                  <div class="form-group">
                    <label for="invoiceID">Invoice No</label>
                    <select class="form-control" name="invoiceID">
                      <option value="">Select Invoice</option>
                      <?php
                 $invoiceTable = $conn->query("SELECT * FROM `invoice` ");

                 while ($invoiceData = $invoiceTable->fetch_assoc()) { ?>
                      <option 
                        value="<?php echo $invoiceData['id']; ?>"
                        >
                        <?php echo $invoiceData['id']; ?>
                      </option>
                      <?php
                }?>
                </select>
                  </div>
                </div>
                <div class="col-4">
                  <div class="form-group">
                    <label for="amount">Amount</label>
                    <input type="text" name="amount" class="form-control" placeholder="Amount">
                  </div>
                </div>
                <div class="col-4">
                  <div class="form-group">
                    <label for="date">Date</label>
                    <input type="date" class="form-control" name="date" id="date">
                  </div>
                </div>
              </div>
              <input type="submit" class="btn btn-block btn-success" value="Submit">
            </form>

            <hr>
            <?php } ?>

            <h2 class="text-center mb-4"> Payments List</h2>
            <table class="table table-bordered">
              <tr>
                <th>Invoice No</th>
                <th>Amount</th>
                <th>Date</th>
                <?php if ($_SESSION['type'] == 'admin') { ?>
                <th>Action</th>
                <?php } ?>
              </tr>
              <tr>
                <?php
            while ($i=$db->fetch_assoc()) {?>

                <td><?php echo $i['invoiceID'] ?>
                </td>
                <td><?php echo $i['amount'] ?>
                </td>
                <td><?php echo $i['date'] ?>
                </td>
                <?php if ($_SESSION['type'] == 'admin') { ?>
                <td>
                  <a href="update_payments.php?id=<?php echo $i['id'] ?>"
                    class="btn btn-xs btn-primary">Edit</a>
                  <a href="delete_payments.php?id=<?php echo $i['id'] ?>"
                    class="btn btn-xs btn-danger">Delete</a>
                </td>
                <?php } ?>
              </tr>

              <?php } ?>
            </table>
          </div>






        </div>
      </div>
      <!-- /.card -->
    </div>
  </div>
  </div><!-- /.container-fluid -->
</section>

<?php require("../footer.php");
