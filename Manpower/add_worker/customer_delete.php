<?php 
require_once("../header.php");
require_once("../sidebar.php");
require_once("../db_config.php");
$id = $_GET['id'];
$delete = $conn->query("DELETE FROM `customers` WHERE id=$id");
?>
<script>
    window.location.assign("view_customer.php");
</script>