<?php
    header("Content-Type: application/json");

    require_once "../../include/init.php";

    $cname = $_POST['cname'] ?? null;
    $price = $_POST['price'] ?? null;
    $review = $_POST['review'] ?? null;
    $space = $_POST['space'] ?? null;
    $gas = $_POST['gas'] ?? null;
    $year = $_POST['year'] ?? null;

    $q = "INSERT INTO `car`(`name`, `price`, `review`, `space`, `gas`, `year`) VALUES (?,?,?,?,?,?)";
    $param = [$cname,$price,$review,$space,$gas,$year];

    $stmt = $conn->prepare($q);
    $car = $stmt->execute($param);

    if($car > 0){
        echo json_encode(['success' => true, "message" => "Car Added Successfully"]);
    }else{
        echo json_encode(['success' => false, "message" => "Car Not Added"]);

    }

?>