<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: DELETE');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With');

$data = json_decode(file_get_contents("php://input"), true);
$student_id = $data['user_id'];

include "db.php";

$check_sql = "SELECT * FROM users_data WHERE id = $student_id";
$check_result = mysqli_query($conn, $check_sql);

if (mysqli_num_rows($check_result) > 0) {
    $sql = "DELETE FROM users_data WHERE id = $student_id";
    
    if (mysqli_query($conn, $sql)) {
        echo json_encode(array('message' => 'User Record Deleted.', 'status' => true));
    } else {
        echo json_encode(array('message' => 'User Record Not Deleted.', 'status' => false));
    }
} else {
    echo json_encode(array('message' => 'User ID Not Found.', 'status' => false));
}

mysqli_close($conn);
?>
