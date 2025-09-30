<?php

header("Content-Type: application/json");

require_once "../../include/init.php";

$mail = $_POST['mail'] ?? null;
$pass = $_POST['pass'] ?? null;

$q= "SELECT * FROM `user` WHERE `email` = ? and `password` = ?";
$param = [$mail,$pass];

$stmt = $conn->prepare($q);
$stmt->execute($param);

$user = $stmt->fetch(PDO::FETCH_ASSOC);

if($user){
    $_SESSION['loggedIn'] = true;
    $_SESSION['user'] = $user['id'];
    $_SESSION['email'] = $user['email'];
    $_SESSION['role'] = $user['role'];
    echo json_encode(['success' => true, 'user' => $user]);
    exit;
}else{

    
    $q2 = "SELECT * FROM `user` WHERE `email` = ?";

    $stmt2 = $conn->prepare($q2);
    $stmt2->execute([$mail]);
    $checkmail = $stmt2->fetch(PDO::FETCH_ASSOC);
    
    
    if (!$checkmail) {
        echo json_encode(['success' => false, 'reason' => 'mail']);
    } else {
        echo json_encode(['success' => false, 'reason' => 'pass']);
    }

}
?>