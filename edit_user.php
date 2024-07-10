<?php
include_once 'db_config.php';

$response = array();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $gender = $_POST['gender'];
    $phone = $_POST['phone'];

    // SQL query to update user details
    $sql = "UPDATE user SET name = ?, email = ?, gender = ?, phone = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssi", $name, $email, $gender, $phone, $id);

    if ($stmt->execute()) {
        $response['status'] = 'success';
        $response['message'] = 'User details updated successfully.';
    } else {
        $response['status'] = 'error';
        $response['message'] = 'Failed to update user details.';
    }

    $stmt->close();
} else {
    $response['status'] = 'error';
    $response['message'] = 'Invalid request.';
}

$conn->close();
echo json_encode($response);
?>
