<?php
include_once 'db_config.php';

$response = array('status' => 'error', 'message' => 'An error occurred');

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['id'])) {
    $id = intval($_POST['id']);

    // Ensure the ID is valid
    if ($id > 0) {
        $stmt = $conn->prepare("DELETE FROM user WHERE id = ?");
        $stmt->bind_param("i", $id);

        if ($stmt->execute()) {
            $response['status'] = 'success';
            $response['message'] = 'User deleted successfully';
        } else {
            $response['message'] = 'Failed to delete user';
        }

        $stmt->close();
    } else {
        $response['message'] = 'Invalid user ID';
    }
} else {
    $response['message'] = 'Invalid request';
}

$conn->close();
echo json_encode($response);
?>
