<Center>
<H1> <b>Workers Feedback display System</b></h1>
<h3> <b>The Rate Has Rating (1 to 5)</b></h3>

<?php
require_once("db_config.php");
// Fetch feedbacks with worker names
$feedbacks = $conn->query("
    SELECT worker_feedback1.*, worker.name AS worker_name 
    FROM worker_feedback1 
    JOIN worker ON worker.id = worker_feedback1.worker_id 
    ORDER BY feedback_date DESC
");

// Display feedbacks
echo "<h4>Recent Feedbacks</h4>";

if ($feedbacks->num_rows > 0) {
    while ($f = $feedbacks->fetch_assoc()) {
        echo "<div class='card p-2 mb-2'>
                <strong>Worker:</strong> {$f['worker_name']}<br>
                <strong>Rating:</strong> {$f['rating']}<br>
                <strong>Feedback:</strong> {$f['feedback']}<br>
                <small><em>On: {$f['feedback_date']}</em></small>
              </div>";
    }
} else {
    echo "<p>No feedback available yet.</p>";
}
?>
