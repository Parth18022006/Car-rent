<?php
require '../../include/init.php';
header('Content-Type: application/json');

// Read JSON
$data = json_decode(file_get_contents('php://input'), true);
$booking_id = $data['booking_id'] ?? null;

if(!$booking_id){
    echo json_encode(['success'=>false,'message'=>'Missing booking id']);
    exit;
}

// ✅ prevent duplicates
$q = "SELECT is_signed FROM booking WHERE id = ?";
$stmt = $conn->prepare($q);
$stmt->execute([$booking_id]);
$row = $stmt->fetch(PDO::FETCH_ASSOC);
if(!$row){
    echo json_encode(['success'=>false,'message'=>'Booking not found']);
    exit;
}
if((int)$row['is_signed'] === 1){
    echo json_encode(['success'=>false,'message'=>'Already signed']);
    exit;
}

// ✅ mark as signed
$update = $conn->prepare("UPDATE booking SET is_signed = 1 WHERE id = ?");
$update->execute([$booking_id]);

echo json_encode(['success'=>true]);
