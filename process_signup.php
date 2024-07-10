<?php
include_once 'db_config.php';

$name = $_POST['name'];
$email = $_POST['email'];
$gender = $_POST['gender'];
$phone = $_POST['phone'];
$createdAt = $_POST['createdAt'];

$valid = true; 
$response = [];

if (empty($name)) {
    $response['nameErr'] = "Name is required";
    $valid = false;
}

if (empty($email)) {
    $response['emailErr'] = "Email is required";
    $valid = false;
} else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $response['emailErr'] = "Invalid email format";
    $valid = false;
}

if (empty($gender)) {
    $response['genderErr'] = "Gender is required";
    $valid = false;
}

if (empty($phone)) {
    $response['phoneErr'] = "Phone number is required";
    $valid = false;
} else if (!preg_match("/^\d{10}$/", $phone)) {
    $response['phoneErr'] = "Invalid phone number format (10 digits)";
    $valid = false;
}

if (empty($createdAt)) {
    $response['createdAtErr'] = "Created at date is required";
    $valid = false;
}

if ($valid) {
    $sql = "INSERT INTO user (name, email, gender, phone, created_at)
            VALUES ('$name', '$email', '$gender', '$phone', '$createdAt')";

    if ($conn->query($sql) === TRUE) {
        $response['success'] = true;
    } else {
        $response['error'] = "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();

echo json_encode($response);
?>
