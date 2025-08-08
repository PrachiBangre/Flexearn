<center>
<h2> Feed Back system</h2>
<?php
require_once("db_config.php");

if (isset($_POST['submit'])) {
    $worker_id = $_POST['worker_id'];
    $customer_id = $_POST['customer_id'];
    $rating = $_POST['rating'];
    $feedback = $_POST['feedback'];

    $stmt = $conn->prepare("INSERT INTO worker_feedback1 (worker_id, customer_id, rating, feedback) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("iiis", $worker_id, $customer_id, $rating, $feedback);

    if ($stmt->execute()) {
        echo "<div class='alert alert-success text-center'>Feedback submitted successfully!</div>";
    } else {
        echo "<div class='alert alert-danger text-center'>Error submitting feedback.</div>";
    }
}
?>

<form method="POST" class="p-4">
  <div class="form-group"><p></p>
    <label for="worker_id">Select Worker:</label><p></p>
    <select name="worker_id" class="form-control" required><p></p>
      <option value="">--Select--</option><p></p>
      <?php
      $workers = $conn->query("SELECT id, name FROM worker");
      while ($row = $workers->fetch_assoc()) {
          echo "<option value='{$row['id']}'>{$row['name']}</option>";
      }
      ?>
    </select>
  </div>

  <div class="form-group">
    <label for="customer_id">Customer ID:</label><p></p>
    <input type="number" name="customer_id" class="form-control" required><p></p>
  </div>

  <div class="form-group">
    <label for="rating">Rating (1 to 5):</label><p></p>
    <input type="number" name="rating" class="form-control" min="1" max="5" required><p></p>
  </div>

  <div class="form-group">
    <label for="feedback">Feedback:</label><p></p>
    <textarea name="feedback" class="form-control" rows="4"></textarea><p></p>
  </div>
<p></p>
  <button type="submit" name="submit" class="btn btn-primary">Submit Feedback</button>
</form>
