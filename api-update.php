<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST'); // Change to POST to match your AJAX call
header('Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With');

$data = json_decode(file_get_contents("php://input"), true);

// Validate that required fields are present
if (!isset($data['user_id'], $data['full_name'], $data['email'], $data['address'], $data['phone'], $data['password'])) {
    echo json_encode(['message' => 'Invalid input', 'status' => false]);
    exit();
}

$id = $data['user_id']; // Change from 'id' to 'user_id' to match the sent data
$full_name = $data['full_name'];
$email = $data['email'];
$password = $data['password']; // Consider hashing passwords before saving
$address = $data['address'];
$phone = $data['phone'];

include "db.php";

// Use prepared statements to prevent SQL injection
$stmt = $conn->prepare("UPDATE `users_data` SET `address`=?, `email`=?, `password`=?, `phone`=?, `full_name`=? WHERE id = ?");
$stmt->bind_param("sssssi", $address, $email, $password, $phone, $full_name, $id); // Bind parameters

if ($stmt->execute()) {
    echo json_encode(['message' => 'User Record Updated.', 'status' => true]);
} else {
    echo json_encode(['message' => 'User Record Not Updated.', 'status' => false]);
}

$stmt->close();
$conn->close();
?>
