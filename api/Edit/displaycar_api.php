<?php

header("Content-Type: application/json");

require_once "../../include/init.php";

$q = "SELECT * FROM `car`";


$stmt = $conn->prepare($q);
$stmt->execute();

$car = $stmt->fetchAll(PDO::FETCH_ASSOC);

if($car != null){
    echo json_encode(['success' => true, 'car' => $car]);
}else{
    echo json_encode(['success' => false, "message" => "Car Not Displayed"]);

}
?>