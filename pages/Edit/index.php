<?php
require '../../include/init.php';

$url = urlof('pages/User/login');
if (!isset($_SESSION['user'])) {
    header("Location: $url");
    exit;
}

include pathof('include/header.php');
include pathof('include/nav.php');
?>


<!-- Header Start -->
<div class="container-fluid bg-breadcrumb">
    <div class="container text-center py-5" style="max-width: 900px;">
        <h4 class="text-white display-4 mb-4 wow fadeInDown" data-wow-delay="0.1s">Adding car</h4>
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

    <input type="text" name="cname" id="cname" placeholder="Enter The Car Name">
    <input type="number" name="price" id="price" placeholder="Enter The Price">
    <input type="number" name="review" id="review" placeholder="Enter The Review">
    <input type="number" name="space" id="space" placeholder="Enter The Seating Space">
    <select name="gas" id="gas">
    <option value="" disabled selected hidden>Select Fuel</option>
        <option value="Petrol">Petrol</option>
        <option value="Diesel">Diesel</option>
    </select>
    <input type="number" name="year" id="year" placeholder="Enter The Model Year">
    <input type="file" name="img" id="img">
    <div id="emsg" style="color: red;size: 6px;"></div>
    <br><input type="button" value="Insert" onclick="insert_car()">


</form>
<br>
<table class="table table-bordered">
    <thead>
        <tr>
            <th scope="col">Name</th>
            <th scope="col">Price</th>
            <th scope="col">Review</th>
            <th scope="col">Seating space</th>
            <th scope="col">Gas</th>
            <th scope="col">Model Year</th>
            <th scope="col">Update</th>
            <th scope="col">Delete</th>
        </tr>
    </thead>
    <tbody id="tbody"></tbody>
</table>

<script>
    $(displaycar());

    function insert_car() {

        let cname = document.getElementById('cname').value;
        let price = document.getElementById('price').value;
        let review = document.getElementById('review').value;
        let space = document.getElementById('space').value;
        let gas = document.getElementById('gas').value;
        let year = document.getElementById('year').value;
        let img = document.getElementById('img').value;

        document.getElementById('emsg').innerHTML = "";


        if(cname != "" && cname != null && price != "" && price != null && review != "" && review != null && space != "" && space != null && gas != "" && gas != null && year != "" && year != null && img != "" && img !=null){


            if(price <=0){
                alert("Enter Valid Price");
                $('#price').val("");
                return;
            }

        let data = new FormData();
            data.append('cname', $('#cname').val());
            data.append('price', $('#price').val());
            data.append('review', $('#review').val());
            data.append('space', $('#space').val());
            data.append('gas', $('#gas').val());
            data.append('year', $('#year').val());
            data.append('img',$('#img')[0].files[0]);


        $.ajax({
            url: "../../api/Edit/insertcar_api",
            method: "POST",
            data: data,
            processData: false,
            contentType: false,
            success: function(response) {
                alert("Car Added Successfully");
                $(displaycar());
            $('#cname').val("");
            $('#price').val("");
            $('#review').val("");
            $('#space').val("");
            $('#gas').val("");
            $('#year').val("");
            $('#img').val("");
            },
            error: function(error) {
                alert("Car Not Added");
            }

        });
        }
        else{
            document.getElementById('emsg').innerHTML = "<br>Null Fields Are Not Allowed"
        }

        
    }

    function displaycar() {

        $.ajax({
            url: "../../api/Edit/displaycar_api",
            method: "POST",
            success: function(response) {
                let record = "";

                if (response.car && response.car.length > 0) {
                    for (let i = 0; i < response.car.length; i++) {

                        record += `
                        <tr>
                            <td scope="col">${response.car[i].name}</td>
                            <td scope="col">${response.car[i].price}</td>
                            <td scope="col">${response.car[i].review}</td>
                            <td scope="col">${response.car[i].space}</td>
                            <td scope="col">${response.car[i].gas}</td>
                            <td scope="col">${response.car[i].year}</td>
                            <td scope="col"> <a href="./updatecar?id=${response.car[i].id}">Update</a></td>
                            <td scope="col"> <a href="" onclick="deletecar(${response.car[i].id})">Delete</a></td>
                        </tr>
                        `
                    }
                } else {
                    record += `<tr><td colspan = "8" style="text-align:center ;">No records</td></tr>`
                }
                $("#tbody").html(record);
            },
            error: function(error) {
                alert("Car Not Displayed");
            },
        });

    }

    function deletecar(id){
        let text = "Sure?You want to delete"
        if(confirm(text) == true){
            $.ajax({
            url: "../../api/Edit/deletecar",
            method: "POST",
            data: {
                id: id
            },
            success: function(response) {
                displaycar();
            },
            error: function(error) {
                alert("Car Not Deleted");
            }
        });
        }else{
            window.location.href = "./index";
        }
        
    }

    const roleSel = document.getElementById('gas');

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

<br>
<?php
include pathof('include/footer.php');
?>




<!-- Back to Top -->
<a href="#" class="btn btn-secondary btn-lg-square rounded-circle back-to-top"><i class="fa fa-arrow-up"></i></a>

<?php
include pathof('include/script.php');
include pathof('include/closing tag.php');
?>