<?php
require '../../include/init.php';

$url = urlof('pages/User/login.php');
if (!isset($_SESSION['user'])) {
    header("Location: $url");
    exit;
}

$url2 = urlof('pages/Edit/index.php');
if (!isset($_GET['id'])) {
    header("Location: $url2");
}

$id = $_GET['id'] ?? null;

$q = "SELECT * FROM `car` WHERE `id` = ?";
$param = [$id];

$stmt = $conn->prepare($q);
$stmt->execute($param);

$ucar = $stmt->fetch(PDO::FETCH_ASSOC);

include pathof('include/header.php');
include pathof('include/nav.php');
?>


<!-- Header Start -->
<div class="container-fluid bg-breadcrumb">
    <div class="container text-center py-5" style="max-width: 900px;">
        <h4 class="text-white display-4 mb-4 wow fadeInDown" data-wow-delay="0.1s">Update car</h4>
        <ol class="breadcrumb d-flex justify-content-center mb-0 wow fadeInDown" data-wow-delay="0.3s">
            <li class="breadcrumb-item"><a href="index.html">Home</a></li>
            <li class="breadcrumb-item"><a href="#">Pages</a></li>
            <li class="breadcrumb-item active text-primary">Categories</li>
        </ol>
    </div>
</div>
<!-- Header End -->
<br>
<form method="post">

    <input type="hidden" name="id" id="id" value="<?= $ucar['id']?>">
    <input type="text" name="ucname" id="ucname" placeholder="Enter The Car Name" value="<?= $ucar['name']?>">
    <br><br><input type="number" name="uprice" id="uprice" placeholder="Enter The Price" value="<?= $ucar['price']?>">
    <br><br><input type="number" name="ureview" id="ureview" placeholder="Enter The Review" value="<?= $ucar['review']?>">
    <br><br><input type="number" name="uspace" id="uspace" placeholder="Enter The Seating Space" value="<?= $ucar['space']?>">
    <br><br><input type="text" name="ugas" id="ugas" placeholder="Enter The Gas Name" value="<?= $ucar['gas']?>">
    <br><br><input type="number" name="uyear" id="uyear" placeholder="Enter The Year" value="<?= $ucar['year']?>">
    <br><br><input type="button" value="Update" onclick="update_car()">

</form>

<script>

    function update_car(){

        let data = {
            id:$('#id').val(),
            ucname: $('#ucname').val(),
            uprice: $('#uprice').val(),
            ureview: $('#ureview').val(),
            uspace: $('#uspace').val(),
            ugas: $('#ugas').val(),
            uyear: $('#uyear').val()
        }

        $.ajax({
            url:"../../api/Edit/update_car.php",
            method:"POST",
            data:data,
            success:function(response){
                if(response.success != true){
                    alert("Something Went Wrong");
                }else{
                    alert("Car Updated");
                    window.location.href = "./index.php";
                }
            },
            error:function(error){
                alert("Car Not Updated");
            }
        });

    }
</script>

<?php
include pathof('include/footer.php');
?>




<!-- Back to Top -->
<a href="#" class="btn btn-secondary btn-lg-square rounded-circle back-to-top"><i class="fa fa-arrow-up"></i></a>

<?php
include pathof('include/script.php');
include pathof('include/closing tag.php');
?>