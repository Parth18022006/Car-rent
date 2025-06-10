<?php

header("Content-Type: application/json");

require_once "../../include/init.php";

$id = $_POST['id'] ?? null;
$ucname = $_POST['ucname'] ?? null;
$uprice = $_POST['uprice'] ?? null;
$ureview = $_POST['ureview'] ?? null;
$uspace = $_POST['uspace'] ?? null;
$ugas = $_POST['ugas'] ?? null;
$uyear = $_POST['uyear'] ?? null;

if($id and $ucname and $uprice and $ureview and $uspace and $ugas and $uyear){
    $q = "UPDATE `car` SET `name`= ?,`price`= ?,`review`= ?,`space`= ?,`gas`= ?,`year`= ? WHERE `id`= ?";
    $param = [$ucname,$uprice,$ureview,$uspace,$ugas,$uyear,$id];

    $stmt = $conn->prepare($q);
    $row = $stmt->execute($param);
    if($row > 0 ){
        echo json_encode(['success' => true, 'message' => "Data Updated"]);
    }else{
        echo json_encode(['success' => false, 'message' => "Data Not Updated"]);
    }
}else{
        echo json_encode(['success' => false, 'message' => "User Not Found"]);

}
?>