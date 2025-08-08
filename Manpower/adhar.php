<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $aadharNumber = $_POST['aadharNumber'];
    
    // Basic Aadhar number validation
    if (!preg_match('/^[0-9]{12}$/', $aadharNumber)) {
        echo json_encode(['status' => 'error', 'message' => 'Invalid Aadhar number']);
        exit;
    }
    
    // Simulate verification (replace with actual verification logic)
    $isValid = rand(0, 1) == 1; // Random success or failure
    if ($isValid) {
        echo json_encode(['status' => 'success', 'message' => 'Aadhar number verified successfully!']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Aadhar number verification failed.']);
    }
}
?>
