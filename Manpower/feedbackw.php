<form method="POST" class="p-4">
  <div class="form-group">
    <label for="worker_name">Select Worker:</label>
    <select name="worker_name" class="form-control" required>
      <option value="">--Select Worker--</option>
      <?php
      $workers = $conn->query("SELECT DISTINCT name FROM worker");
      while ($row = $workers->fetch_assoc()) {
          echo "<option value='{$row['name']}'>{$row['name']}</option>";
      }
      ?>
    </select>
  </div>

  <div class="form-group">
    <label for="customer_id">Customer ID:</label>
    <input type="number" name="customer_id" class="form-control" required>
  </div>

  <div class="form-group">
    <label for="rating">Rating (1 to 5):</label>
    <input type="number" name="rating" class="form-control" min="1" max="5" required>
  </div>

  <div class="form-group">
    <label for="feedback">Feedback:</label>
    <textarea name="feedback" class="form-control" rows="4"></textarea>
  </div>

  <button type="submit" name="submit" class="btn btn-primary">Submit Feedback</button>
</form>

<?php
if (isset($_POST['submit'])) {
    $worker_name = $_POST['worker_name'];
    $customer_id = $_POST['customer_id'];
    $rating = $_POST['rating'];
    $feedback = $_POST['feedback'];

    $stmt = $conn->prepare("INSERT INTO worker_feedback (worker_name, customer_id, rating, feedback) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("siis", $worker_name, $customer_id, $rating, $feedback);

    if ($stmt->execute()) {
        echo "<div class='alert alert-success'>Feedback submitted successfully!</div>";
    } else {
        echo "<div class='alert alert-danger'>Error submitting feedback.</div>";
    }
}
?>
