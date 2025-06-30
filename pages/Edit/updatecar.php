<?php
require '../../include/init.php';

$url = urlof('pages/User/login');
if (!isset($_SESSION['user'])) {
    header("Location: $url");
    exit;
}

$url2 = urlof('pages/Edit/index');
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
            <li class="breadcrumb-item"><a href="../../index">Home</a></li>
            <li class="breadcrumb-item"><a href="#">Pages</a></li>
            <li class="breadcrumb-item active text-primary">Categories</li>
        </ol>
    </div>
</div>
<!-- Header End -->
<br>
<form method="post" enctype="multipart/form-data">

    <input type="hidden" name="id" id="id" value="<?= $ucar['id'] ?>">
    <input type="text" name="ucname" id="ucname" placeholder="Enter The Car Name" value="<?= $ucar['name'] ?>">
    <input type="number" name="uprice" id="uprice" placeholder="Enter The Price" value="<?= $ucar['price'] ?>">
    <input type="number" name="ureview" id="ureview" placeholder="Enter The Review" value="<?= $ucar['review'] ?>">
    <input type="number" name="uspace" id="uspace" placeholder="Enter The Seating Space" value="<?= $ucar['space'] ?>">
    <!-- <input type="text" name="ugas" id="ugas" placeholder="Enter The Gas Name" value="<?= $ucar['gas'] ?>"> -->
    <select name="ugas" id="ugas">
        <option value="Petrol" <?= ($ucar['gas'] === 'Petrol') ? 'selected' : '' ?>>Petrol</option>
        <option value="Diesel" <?= ($ucar['gas'] === 'Diesel') ? 'selected' : '' ?>>Diesel</option>
    </select>
    <input type="number" name="uyear" id="uyear" placeholder="Enter The Year" value="<?= $ucar['year'] ?>">

    <!-- Show current image if available -->
    <?php if (!empty($ucar['ImageFile'])) : ?>
        <label class="namesimg">Current Image:</label>
        <img src="<?= urlof('assets/upload_img/') . $ucar['ImageFile'] ?>" width="100" alt="Image not found" class="mainimage">
        <!-- <img src="<?= urlof('assets/upload_img/') . $ucar['ImageFile'] ?>" width="100" > -->

    <?php endif; ?>

    <!-- Hidden field to keep old image if no new one uploaded -->
    <input type="hidden" name="old_image" value="<?= $ucar['ImageFile'] ?>">

    <label>Upload New Image (optional):</label>
    <input type="file" name="uimg" id="uimg"><br>
    <div id="emsg" style="color: red;size: 6px;"></div>
    <br><input type="button" value="Update" onclick="update_car()">

</form>

<script>
    function update_car() {

        let ucname = document.getElementById('ucname').value;
        let uprice = document.getElementById('uprice').value;
        let ureview = document.getElementById('ureview').value;
        let uspace = document.getElementById('uspace').value;
        let ugas = document.getElementById('ugas').value;
        let uyear = document.getElementById('uyear').value;
        let uimg = document.getElementById('uimg').value;

        let ogname = <?= json_encode($ucar['name']) ?>;
        let ogprice = <?= json_encode($ucar['price']) ?>;
        let ogreview = <?= json_encode($ucar['review']) ?>;
        let ogspace = <?= json_encode($ucar['space']) ?>;
        let oggas = <?= json_encode($ucar['gas']) ?>;
        let ogyear = <?= json_encode($ucar['year']) ?>;
        let ogimg = <?= json_encode($ucar['ImageFile']) ?>;


        document.getElementById('emsg').innerHTML = "";

        if (ucname != "" && ucname != null && uprice != "" && uprice != null && ureview != "" && ureview != null && uspace != "" && uspace != null && ugas != "" && ugas != null && uyear != "" && uyear != null) {


            if(uprice <=0){
                alert("Enter Valid Price");
                $('#uprice').val("");
                return;
            }
            const hasImage = $('#uimg')[0].files.length > 0; // ← true if a new file picked

            // build the body:
            const data = hasImage ?
                (() => { // ------- branch WITH image -------
                    const fd = new FormData();
                    fd.append('id', $('#id').val());
                    fd.append('ucname', $('#ucname').val());
                    fd.append('uprice', $('#uprice').val());
                    fd.append('ureview', $('#ureview').val());
                    fd.append('uspace', $('#uspace').val());
                    fd.append('ugas', $('#ugas').val());
                    fd.append('uyear', $('#uyear').val());
                    fd.append('uimg', $('#uimg')[0].files[0]);
                    return fd;
                })() :
                (() => { // ------- branch WITHOUT image ------
                    const fd = new FormData();
                    fd.append('id', $('#id').val());
                    fd.append('ucname', $('#ucname').val());
                    fd.append('uprice', $('#uprice').val());
                    fd.append('ureview', $('#ureview').val());
                    fd.append('uspace', $('#uspace').val());
                    fd.append('ugas', $('#ugas').val());
                    fd.append('uyear', $('#uyear').val());
                    return fd;
                })();


            $.ajax({
                url: "../../api/Edit/update_car",
                method: "POST",
                data: data,
                processData: false,
                contentType: false,
                dataType:'json',
                success: function(response) {
                    if (!hasImage && ogname == ucname && ogprice == uprice && ogreview == ureview && ogspace == uspace && oggas == ugas && ogyear == uyear) {
                        document.getElementById('emsg').innerHTML = "<br>Oops! Their Is No Change..";
                        return false;
                    } else if (response.success != true) {
                        alert("Something Went Wrong");
                    } else {
                        alert("Car Updated");
                        window.location.href = "./index";
                    }
                },
                error: function(error) {
                    alert("Car Not Updated");
                }
            });
        } else {
            document.getElementById('emsg').innerHTML = "<br>Null Fields Are Not Allowed";
            return false;
        }



    }

    const roleSel = document.getElementById('ugas');

/* list is about to open → hide arrow */
roleSel.addEventListener('mousedown', () => {
  roleSel.classList.add('is-open');
});

/* list just closed *and* the value changed → show arrow */
roleSel.addEventListener('change', () => {
  roleSel.classList.remove('is-open');
});

/* user pressed Esc or clicked elsewhere without changing value → show arrow */
roleSel.addEventListener('blur', () => {
  roleSel.classList.remove('is-open');
});
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