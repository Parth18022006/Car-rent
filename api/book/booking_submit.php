<?php

header("Content-Type: application/json");

require_once "../../include/init.php";
$data = [
    'car_id'        => $_POST['car'] ?? null,
    'price'         => $_POST['rprice'] ?? null,
    'num'           => $_POST['pnum'] ?? null,
    'email'         => $_POST['email'] ?? null,
    'renter_name'   => $_POST['renter_name'] ?? null,
    'renter_address'=> $_POST['renter_address'] ?? null,
    'pickup_place'  => $_POST['pickup_place'] ?? null,
    'dropoff_place' => $_POST['dropoff_place'] ?? null,
    'pickup_date'   => $_POST['pickup_date'] ?? null,
    'pickup_time'   => $_POST['pickup_time'] ?? null,
    'dropoff_date'  => $_POST['dropoff_date'] ?? null,
    'dropoff_time'  => $_POST['dropoff_time'] ?? null
];

// ✅ store in session instead of DB
$_SESSION['pending_booking'] = $data;

echo json_encode([
    "success" => true,
    // no booking_id yet because not inserted
    "message" => "Proceed to agreement"
]);
exit;
?>