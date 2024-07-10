<?php
session_start();
include_once 'db_config.php';

$loginName = $_POST['loginName'];
$loginEmail = $_POST['loginEmail'];

$response = '';

if (!empty($loginName) && !empty($loginEmail)) {
    $stmt = $conn->prepare("SELECT * FROM user WHERE name=? AND email=?");
    $stmt->bind_param("ss", $loginName, $loginEmail);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        $user = $result->fetch_assoc();
        $_SESSION['user'] = $user;
        $response = 'success';
    } else {
        $response = 'error';
    }

    $stmt->close();
}

$conn->close();

echo $response;
?>
