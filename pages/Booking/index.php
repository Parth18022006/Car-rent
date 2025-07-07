<?php

require '../../include/init.php';


$q = "SELECT * FROM `car`";

$stmt = $conn->prepare($q);
$stmt->execute();

$row = $stmt->fetchAll(PDO::FETCH_ASSOC);

$q1 = "SELECT * FROM `user`";

$stmt2 = $conn->prepare($q1);
$stmt2->execute();

$user = $stmt2->fetch(PDO::FETCH_ASSOC);

$email = $_SESSION['email'] ?? null;
$selectedCarId = $_GET['car'] ?? null;

$url = urlof('pages/User/login');
if (!isset($_SESSION['user'])) {
    header("Location: $url");
    exit;
}

include pathof('./include/header.php');
include pathof('./include/nav.php');
?>
<link rel="stylesheet" href="<?= urlof('./assets/css/booking.css'); ?>">
<form action="" method="post">
    <h4>CAR RESERVATION</h4>
    <div class="col-12">
        <select class="form-select custom-select" id="selectcar" placeholder="Default select example" id="selectcar">
            <option value="" disabled <?= $selectedCarId ? '' : 'selected'; ?> hidden>Select Car</option>
            <?php
            if (count($row) > 0) {
                foreach ($row as $r) {
            ?>
                    <option value="<?= $r['id'] ?>" <?= ($r['id'] == $selectedCarId) ? 'selected' : ''; ?>><?= $r['name'] ?></option>
                <?php
                }
            } else {
                ?><option value="">No Records</option>
            <?php
            }
            ?>
        </select>
        <select name="rprice" id="rprice" class="form-select custom-select">
            <option value="" disabled <?= $selectedCarId ? '' : 'selected'; ?> hidden>
                Select Price
            </option>

            <?php if (count($row) > 0) : ?>
                <?php foreach ($row as $r) : ?>
                    <option value="<?= $r['price']; ?>" data-car-id="<?= $r['id']; ?>" <?= ($r['id'] == $selectedCarId) ? 'selected' : ''; ?>>
                        $<?= $r['price']; ?>
                    </option>
                <?php endforeach; ?>
            <?php else : ?>
                <option value="">No Records</option>
            <?php endif; ?>
        </select>

        <input type="number" name="pnum" id="pnum" placeholder="Enter Mobile Number">
        <input type="email" name="email" id="email" placeholder="Enter Your E-Mail" value="<?= $email ?>">
        <div class="col-12">
            <div class="input-group">
                <div class="d-flex align-items-center bg-light text-body rounded-start p-2">
                    <span class="fas fa-map-marker-alt"></span> <span class="ms-1">Pick Up</span>
                </div>
                <input class="form-control" type="text" placeholder="Enter a City or Airport" placeholder="Enter a City or Airport">
            </div>
        </div>
        <div class="col-12">
            <a href="#" class="text-start text-white d-block mb-2">Need a different drop-off location?</a>
            <div class="input-group">
                <div class="d-flex align-items-center bg-light text-body rounded-start p-2">
                    <span class="fas fa-map-marker-alt"></span><span class="ms-1">Drop off</span>
                </div>
                <input class="form-control" type="text" placeholder="Enter a City or Airport" placeholder="Enter a City or Airport">
            </div>
        </div>
        <div class="col-12">
            <div class="input-group">
                <div class="d-flex align-items-center bg-light text-body rounded-start p-2">
                    <span class="fas fa-calendar-alt"></span><span class="ms-1">Pick Up</span>
                </div>
                <input class="form-control" type="date">
                <select class="form-select ms-3" placeholder="Default select example" id="pickupt">
                    <option selected>12:00AM</option>
                    <option value="1">1:00AM</option>
                    <option value="2">2:00AM</option>
                    <option value="3">3:00AM</option>
                    <option value="4">4:00AM</option>
                    <option value="5">5:00AM</option>
                    <option value="6">6:00AM</option>
                    <option value="7">7:00AM</option>
                </select>
            </div>
        </div>
        <div class="col-12">
            <div class="input-group">
                <div class="d-flex align-items-center bg-light text-body rounded-start p-2">
                    <span class="fas fa-calendar-alt"></span><span class="ms-1">Drop off</span>
                </div>
                <input class="form-control" type="date">
                <select class="form-select ms-3" placeholder="Default select example" id="dropoft">
                    <option selected>12:00AM</option>
                    <option value="1">1:00AM</option>
                    <option value="2">2:00AM</option>
                    <option value="3">3:00AM</option>
                    <option value="4">4:00AM</option>
                    <option value="5">5:00AM</option>
                    <option value="6">6:00AM</option>
                    <option value="7">7:00AM</option>
                </select>
            </div>
        </div>
        <div class="col-12">
            <button class="btn btn-light w-100 py-2">Book Now</button>
        </div>
    </div>
</form>
<?php
include pathof('./include/footer.php');
?>

<a href="#" class="btn btn-secondary btn-lg-square rounded-circle back-to-top"><i class="fa fa-arrow-up"></i></a>

<script>
    const selectcar = document.getElementById('selectcar');

    /* list is about to open → hide arrow */
    selectcar.addEventListener('mousedown', () => {
        selectcar.classList.add('is-open');
    });

    /* list just closed *and* the value changed → show arrow */
    selectcar.addEventListener('change', () => {
        selectcar.classList.remove('is-open');
    });

    /* user pressed Esc or clicked elsewhere without changing value → show arrow */
    selectcar.addEventListener('blur', () => {
        selectcar.classList.remove('is-open');
    });

    const pickupt = document.getElementById('pickupt');

    /* list is about to open → hide arrow */
    pickupt.addEventListener('mousedown', () => {
        pickupt.classList.add('is-open');
    });

    /* list just closed *and* the value changed → show arrow */
    pickupt.addEventListener('change', () => {
        pickupt.classList.remove('is-open');
    });

    /* user pressed Esc or clicked elsewhere without changing value → show arrow */
    pickupt.addEventListener('blur', () => {
        pickupt.classList.remove('is-open');
    });

    const dropoft = document.getElementById('dropoft');

    /* list is about to open → hide arrow */
    dropoft.addEventListener('mousedown', () => {
        dropoft.classList.add('is-open');
    });

    /* list just closed *and* the value changed → show arrow */
    dropoft.addEventListener('change', () => {
        dropoft.classList.remove('is-open');
    });

    /* user pressed Esc or clicked elsewhere without changing value → show arrow */
    dropoft.addEventListener('blur', () => {
        dropoft.classList.remove('is-open');
    });

    document.addEventListener('DOMContentLoaded', () => {
        const params = new URLSearchParams(window.location.search);
        const carId = params.get('car'); // "3" or null

        if (carId) {
            /* 1) Pre‑select the dropdown (you already do this server‑side,
                  but this covers a JS‑only variant too) */
            const select = document.getElementById('selectcar');
            if (select) select.value = carId;

            /* 2) Remove ?car=... from the address bar without reloading */
            const cleanUrl = window.location.pathname + window.location.hash;
            history.replaceState(null, '', cleanUrl);
        }
    });
    /* existing code … */

    /* ---------- price synchronisation ---------- */
    const priceSelect = document.getElementById('rprice');

    function syncPriceWithCar() {
        const id = selectcar.value;
        if (!id) return; // no car chosen

        const priceOption =
            priceSelect.querySelector(`option[data-car-id="${id}"]`);

        if (priceOption) priceSelect.value = priceOption.value;
    }

    /* run once on page‑load (after any URL pre‑select) */
    syncPriceWithCar();

    /* keep price updated whenever user picks a different car */
    selectcar.addEventListener('change', syncPriceWithCar);

    const rprice = document.getElementById('rprice');

/* list is about to open → hide arrow */
rprice.addEventListener('mousedown', () => {
    rprice.classList.add('is-open');
});

/* list just closed *and* the value changed → show arrow */
rprice.addEventListener('change', () => {
    rprice.classList.remove('is-open');
});

/* user pressed Esc or clicked elsewhere without changing value → show arrow */
rprice.addEventListener('blur', () => {
    rprice.classList.remove('is-open');
});
</script>
<?php
include pathof('./include/script.php');
include pathof('./include/closing tag.php');
?>