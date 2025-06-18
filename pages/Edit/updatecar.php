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
            <li class="breadcrumb-item"><a href="../../index.php">Home</a></li>
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
    <input type="number" name="uprice" id="uprice" placeholder="Enter The Price" value="<?= $ucar['price']?>">
    <input type="number" name="ureview" id="ureview" placeholder="Enter The Review" value="<?= $ucar['review']?>">
    <input type="number" name="uspace" id="uspace" placeholder="Enter The Seating Space" value="<?= $ucar['space']?>">
    <input type="text" name="ugas" id="ugas" placeholder="Enter The Gas Name" value="<?= $ucar['gas']?>">
    <input type="number" name="uyear" id="uyear" placeholder="Enter The Year" value="<?= $ucar['year']?>">
    <div id="emsg" style="color: red;size: 6px;"></div>
    <br><input type="button" value="Update" onclick="update_car()">

</form>

<script>

    function update_car(){

        let ucname = document.getElementById('ucname').value;
        let uprice = document.getElementById('uprice').value;
        let ureview = document.getElementById('ureview').value;
        let uspace = document.getElementById('uspace').value;
        let ugas = document.getElementById('ugas').value;
        let uyear = document.getElementById('uyear').value;

        let ogname = <?= json_encode($ucar['name'])?>;
        let ogprice = <?= json_encode($ucar['price'])?>;
        let ogreview = <?= json_encode($ucar['review'])?>;
        let ogspace = <?= json_encode($ucar['space'])?>;
        let oggas = <?= json_encode($ucar['gas'])?>;
        let ogyear = <?= json_encode($ucar['year'])?>;
        

        document.getElementById('emsg').innerHTML = "";

        if(ucname != "" && ucname != null && uprice != "" && uprice != null && ureview != "" && ureview != null && uspace != "" && uspace != null && ugas != "" && ugas != null && uyear != "" && uyear != null){

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
                if(ogname == data.ucname && ogprice == data.uprice && ogreview == data.ureview && ogspace == data.uspace && oggas == data.ugas && ogyear == data.uyear){
                    document.getElementById('emsg').innerHTML = "<br>Oops! Their Is No Change..";
                    return false;
                }
                else if(response.success != true){
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
        else{
            document.getElementById('emsg').innerHTML = "<br>Null Fields Are Not Allowed";
            return false;
        }

        

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