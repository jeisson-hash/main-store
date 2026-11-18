<?php

session_start();
if (!isset($_SESSION['user_id'])){
    header('refresh:0;url=signin.html');
    exit();
}

include(__DIR__ . "/settings/database.php");

// Get information from the form
$user_id = $_POST['userID'];
$first_name = $_POST['firstname'];
$last_name = $_POST['lastname'];
$email = $_POST['email'];
$mobile_phone = $_POST['mobile_phone'];
$status = $_POST['status'];


$sql_update_user = "
    UPDATE users
    SET
        firstname = $1,
        lastname = $2,
        email = $3,
        mobile_phone = $4,
        status = $5
    WHERE id = $6
";


$res = pg_query_params($local_conn, $sql_update_user, [
    $first_name,
    $last_name,
    $email,
    $mobile_phone,
    $status,
    $user_id
]);

if ($res) {
    header("Location: list_users.php");
    exit;
} else {
    echo "Error updating user information";
}