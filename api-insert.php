<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With');

$data = json_decode(file_get_contents("php://input"), true);
$full_name = $data['full_name'];
$email = $data['email'];
$password = $data['password'];
$address = $data['address'];
$phone = $data['phone'];

include "db.php";

$sql = "INSERT INTO `users_data`(`address`, `email`, `password`, `role`, `phone`, `full_name`) 
        VALUES ('$address', '$email', '$password', 'user', '$phone', '$full_name')";

if (mysqli_query($conn, $sql)) {
    echo json_encode(array('message' => 'User Record Inserted.', 'status' => true));
} else {
    echo json_encode(array('message' => 'User Record Not Inserted.', 'status' => false));
}

mysqli_close($conn);
?>
