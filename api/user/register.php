<?php

header("Content-Type: application/json");

require_once "../../include/init.php";

$email = $_POST['email'] ?? null;
$password = $_POST['password'] ?? null;

$q = "INSERT INTO `user`(`email`, `password`) VALUES (?,?)";
$param = [$email,$password];

$stmt = $conn->prepare($q);
$user = $stmt->execute($param);

if($user > 0){
    echo json_encode(['success' => true, 'message' => "User Registered"]);
}else{
    echo json_encode(['success' => false, 'message' => "User Not Registered"]);
}
?>