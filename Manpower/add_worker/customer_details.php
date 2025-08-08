<?php
$page = "Dashboard";
require_once("../header.php");
require_once("../sidebar.php");
require_once("../db_config.php");
$id = $_GET['id'];
$informations = $conn->query("SELECT * FROM customers WHERE id = $id");
$worker_data = $informations->fetch_assoc();
?>

<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-md-12 text-right">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="view_customer.php" class="btn btn-sm btn-info">All Customer</a></li>
        </ol>
      </div>

      <div class="col-md-12">
        <div class="text-center">
          <h1><?php echo $worker_data['name'] ?>'s All Informations</h1>
        </div>
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
            <div class="table-responsive">
              <table class="table text-center table-striped table-hover" id="xls">
                <tr>
                  <th>Name:</th>
                  <td><?Php echo $worker_data['name']; ?></td>
                  <th>ID:</th>
                  <td><?php echo $worker_data['id']; ?></td>

                </tr>
                <tr>
                  <th>Contact Number:</th>
                  <td><?php echo $worker_data['contact_no']; ?></td>
                  <th>Aadhar Number:</th>
                  <td><?php echo $worker_data['aadhar_no']; ?></td>

                </tr>
                <tr>
                  <th>Email:</th>
                  <td><?php echo $worker_data['email']; ?></td>
                  <th>Address:</th>
                  <td><?php echo $worker_data['address']; ?></td>
                </tr>

                <tr>
                  <th>Status:</th>
                  <td><?php echo ($worker_data['is_active']) ? 'Active' : 'Deactive'; ?></td>
                  <td>
                  
                  </td>
                </tr>
              </table>
              
            </div>

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

<script>
  function exportTableToExcel(tableID, filename = '') {
    var downloadLink;
    var dataType = 'application/vnd.ms-excel';
    var tableSelect = document.getElementById(tableID);
    var tableHTML = tableSelect.outerHTML.replace(/ /g, '%20');

    // Specify file name
    filename = filename ? filename + '.xls' : 'excel_data.xls';

    // Create download link element
    downloadLink = document.createElement("a");

    document.body.appendChild(downloadLink);

    if (navigator.msSaveOrOpenBlob) {
      var blob = new Blob(['\ufeff', tableHTML], {
        type: dataType
      });
      navigator.msSaveOrOpenBlob(blob, filename);
    } else {
      // Create a link to the file
      downloadLink.href = 'data:' + dataType + ', ' + tableHTML;

      // Setting the file name
      downloadLink.download = filename;

      //triggering the function
      downloadLink.click();
    }
  }
</script>