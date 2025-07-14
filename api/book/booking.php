<?php

header("Content-Type: application/json");

require_once "../../include/init.php";

$car = $_POST['car'] ?? null;
$rprice = $_POST['rprice'] ?? null;
$pnum = $_POST['pnum'] ?? null;
$email = $_POST['email'] ?? null;
$pickup_place = $_POST['pickup_place'] ?? null;
$dropoff_place = $_POST['dropoff_place'] ?? null;
$pickup_time = $_POST['pickup_time'] ?? null;
$pickup_date = $_POST['pickup_date'] ?? null;
$dropoff_date = $_POST['dropoff_date'] ?? null;
$dropoff_time = $_POST['dropoff_time'] ?? null;

$q = "INSERT INTO `booking`(`car_id`, `price`, `num`, `email`, `pickup_place`, `dropoff_place`, `pickup_date`, `pickup_time`, `dropoff_date`, `dropoff_time`) VALUES (?,?,?,?,?,?,?,?,?,?)";
$param = [$car,$rprice,$pnum,$email,$pickup_place,$dropoff_place,$pickup_date,$pickup_time,$dropoff_date,$dropoff_time];

$stmt = $conn->prepare($q);
$booked = $stmt->execute($param);

if($booked){
    echo json_encode(['success' => true, "message" => "Car Booked Successfully"]);
}else{
    echo json_encode(['success' => false, "message" => "Car Not Booked"]);
}
?>