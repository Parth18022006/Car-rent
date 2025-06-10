<?php

header("Content-Type: application/json");

require_once "../../include/init.php";

$id = $_POST['id'] ?? null;

$q = "DELETE FROM `car` WHERE `id` = ?";
$param = [$id];

$stmt = $conn->prepare($q);
$cars = $stmt->execute($param);

if($cars > 0){
    echo json_encode(['success' => true, "message" => "Car Deleted"]);
}else{
    echo json_encode(['success' => true, "message" => "Car Not Deleted"]);
}
?>