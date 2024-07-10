<?php
include_once 'db_config.php';

$response = array('status' => 'error', 'message' => 'An error occurred');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = sanitizeInput($_POST['id']);
    $name = sanitizeInput($_POST['name']);
    $email = sanitizeInput($_POST['email']);
    $gender = sanitizeInput($_POST['gender']);
    $phone = sanitizeInput($_POST['phone']);
    $createdAt = sanitizeInput($_POST['createdAt']);

    // Validate data...
    // Assuming validation passed...

    $stmt = $conn->prepare("UPDATE user SET name=?, email=?, gender=?, phone=?, created_at=? WHERE id=?");
    $stmt->bind_param("sssssi", $name, $email, $gender, $phone, $createdAt, $id);

    if ($stmt->execute()) {
        $response['status'] = 'success';
        $response['message'] = 'User updated successfully';
    } else {
        $response['message'] = 'Failed to update user';
    }

    $stmt->close();
    $conn->close();
}

echo json_encode($response);

function sanitizeInput($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
?>
