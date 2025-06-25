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
$oldimage = $_POST['old_image'] ?? '';
$newimg = null;
if(isset($_FILES['uimg']) && $_FILES['uimg']['error'] === UPLOAD_ERR_OK){
    $time = time();
    $newimg= "$time-" . $_FILES['uimg']['name'];
    $newimgtemp = $_FILES['uimg']['tmp_name'];
    $path = pathof("assets/upload_img/$newimg");
    move_uploaded_file($newimgtemp,$path);
}

if($newimg){
        $q ="UPDATE `car` SET `name`= ?,`price`= ?,`review`= ?,`space`= ?,`gas`= ?,`year`= ?,`ImageFile`= ? WHERE `id` = ?"; 
        $param = [$ucname,$uprice,$ureview,$uspace,$ugas,$uyear,$newimg,$id];
}else{
        $q = "UPDATE `car` SET `name`= ?,`price`= ?,`review`= ?,`space`= ?,`gas`= ?,`year`= ? WHERE `id`= ?";
        $param = [$ucname,$uprice,$ureview,$uspace,$ugas,$uyear,$id];
}

        $stmt = $conn->prepare($q);
        $row = $stmt->execute($param);

        if($row > 0){
            echo json_encode(['success' => true, 'message' => "Data Updated"]);
        }else{
            echo json_encode(['success' => false, 'message' => "Data Not Updated"]);
        }
?>