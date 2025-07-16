<?php
require '../../include/init.php';
header('Content-Type: application/json');

if (empty($_SESSION['pending_booking'])) {
    echo json_encode(['success' => false, 'message' => 'No pending booking found']);
    exit;
}

$bookingData = $_SESSION['pending_booking'];

// INSERT now
$q = "INSERT INTO `booking`
    (`car_id`, `price`, `num`, `email`, `pickup_place`, `dropoff_place`,
     `pickup_date`, `pickup_time`, `dropoff_date`, `dropoff_time`,
     `renter_name`, `renter_address`, `is_signed`)
    VALUES (?,?,?,?,?,?,?,?,?,?,?,?,1)";

$stmt = $conn->prepare($q);
$ok = $stmt->execute([
    $bookingData['car_id'],
    $bookingData['price'],
    $bookingData['num'],
    $bookingData['email'],
    $bookingData['pickup_place'],
    $bookingData['dropoff_place'],
    $bookingData['pickup_date'],
    $bookingData['pickup_time'],
    $bookingData['dropoff_date'],
    $bookingData['dropoff_time'],
    $bookingData['renter_name'],
    $bookingData['renter_address']
]);

if ($ok) {
    // get inserted id
    $booking_id = $conn->lastInsertId();

    // clear session
    unset($_SESSION['pending_booking']);

    echo json_encode([
        'success' => true,
        'booking_id' => $booking_id
    ]);
} else {
    echo json_encode([
        'success' => false,
        'message' => 'Database insert failed'
    ]);
}