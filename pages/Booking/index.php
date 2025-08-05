<?php

require '../../include/init.php';


/* ───── validate booking token ───── */
$tok = $_GET['tok'] ?? $_POST['tok'] ?? '';
$tokens  = $_SESSION['booking_tokens'] ?? [];
$issued  = $tokens[$tok] ?? null;
$maxAge  = 900;                       // 15 min, change if you like

if (!$issued || (time() - $issued) > $maxAge) {
    header('Location: ' . urlof('./index'));   // bad or expired token
    exit;
}

/* optional: one‑use ‑‑ uncomment next line to make token single‑use
   unset($_SESSION['booking_tokens'][$tok]);
*/
$today = date('Y-m-d');

/* optional housekeeping */
foreach ($tokens as $t => $when) {
    if ((time() - $when) > $maxAge) unset($_SESSION['booking_tokens'][$t]);
}


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
<style>
    /* black frame by default */
    #rprice,
    #renter_name,
    #renter_address,
    #booking_date {
        width: 100%;
        height: 56px;
        padding: 12px 15px;
        margin-bottom: 1.25rem;
        background: #fff !important;
        color: #000;
        font-size: 1rem;
        line-height: 1.5;
        border: 1px solid #000 !important;
        /* ← replaces the red */
        border-radius: var(--radius);
        box-shadow: none !important;
    }
</style>
<form action="" method="post">
    <h4>CAR RESERVATION</h4>
    <div class="col-12">
        <input type="hidden" name="tok" value="<?= htmlspecialchars($tok) ?>">

        <select class="form-select custom-select" id="selectcar" name="car">
            <option value="" disabled <?= $selectedCarId ? '' : 'selected'; ?> hidden>
                Select Car
            </option>
            <?php foreach ($row as $r) : ?>
                <option value="<?= $r['id']; ?>" data-price="<?= $r['price']; ?>" <?= ($r['id'] == $selectedCarId) ? 'selected' : ''; ?>>
                    <?= $r['name']; ?>
                </option>
            <?php endforeach; ?>
        </select>

        <input type="text" name="rprice" id="rprice" class="form-control-plaintext mb-3" readonly>
        <input type="number" name="pnum" id="pnum" placeholder="Enter Mobile Number">
        <div style="text-align: center;"><small id="emsg1" style="color: red;"></small></div>
        <input type="text" name="email" id="email" placeholder="Enter Your E-Mail" value="<?= $email ?>" readonly>
        <div style="text-align: center;"><small id="emsg2" style="color: red;"></small></div>
        <input type="text" name="renter_name" id="renter_name" placeholder="Enter Full Name">
        <div style="text-align: center;"><small id="emsg6" style="color:red;"></small></div>
        <textarea name="renter_address" id="renter_address" placeholder="Enter Full Address"></textarea>
        <div style="text-align: center;"><small id="emsg7" style="color:red;"></small></div>

        <label for="">Pick-up:</label>
        <div class="col-12">
            <div class="input-group">
                <select class="form-select" name="pickup_place" id="pickup_place">
                    <option value="" disabled selected hidden>Select Pickup Location</option>
                    <!-- ⭐ METRO CITIES -->
                    <option value="Delhi - Indira Gandhi International Airport">Delhi - Indira Gandhi International Airport (DEL)</option>
                    <option value="Mumbai - Chhatrapati Shivaji Maharaj International Airport">Mumbai - Chhatrapati Shivaji Maharaj International Airport (BOM)</option>
                    <option value="Bengaluru - Kempegowda International Airport">Bengaluru - Kempegowda International Airport (BLR)</option>
                    <option value="Hyderabad - Rajiv Gandhi International Airport">Hyderabad - Rajiv Gandhi International Airport (HYD)</option>
                    <option value="Chennai - Chennai International Airport">Chennai - Chennai International Airport (MAA)</option>
                    <option value="Kolkata - Netaji Subhash Chandra Bose International Airport">Kolkata - Netaji Subhash Chandra Bose International Airport (CCU)</option>
                    <option value="Pune - Pune Airport">Pune - Pune Airport (PNQ)</option>
                    <option value="Ahmedabad - Sardar Vallabhbhai Patel International Airport">Ahmedabad - Sardar Vallabhbhai Patel International Airport (AMD)</option>
                    <!-- ⭐ MAJOR TIER-2 CITIES WITH AIRPORTS -->
                    <option value="Jaipur - Jaipur International Airport">Jaipur - Jaipur International Airport (JAI)</option>
                    <option value="Lucknow - Chaudhary Charan Singh Airport">Lucknow - Chaudhary Charan Singh Airport (LKO)</option>
                    <option value="Goa - Dabolim Airport">Goa - Dabolim Airport (GOI)</option>
                    <option value="Kochi - Cochin International Airport">Kochi - Cochin International Airport (COK)</option>
                    <option value="Thiruvananthapuram - Trivandrum International Airport">Thiruvananthapuram - Trivandrum International Airport (TRV)</option>
                    <option value="Kozhikode - Calicut International Airport">Kozhikode - Calicut International Airport (CCJ)</option>
                    <option value="Nagpur - Dr. Babasaheb Ambedkar International Airport">Nagpur - Dr. Babasaheb Ambedkar International Airport (NAG)</option>
                    <option value="Indore - Devi Ahilya Bai Holkar Airport">Indore - Devi Ahilya Bai Holkar Airport (IDR)</option>
                    <option value="Bhopal - Raja Bhoj Airport">Bhopal - Raja Bhoj Airport (BHO)</option>
                    <option value="Coimbatore - Coimbatore International Airport">Coimbatore - Coimbatore International Airport (CJB)</option>
                    <option value="Visakhapatnam - Visakhapatnam Airport">Visakhapatnam - Visakhapatnam Airport (VTZ)</option>
                    <option value="Vadodara - Vadodara Airport">Vadodara - Vadodara Airport (BDQ)</option>
                    <option value="Rajkot - Rajkot Airport">Rajkot - Rajkot Airport (RAJ)</option>
                    <option value="Surat - Surat International Airport">Surat - Surat International Airport (STV)</option>
                    <option value="Mangalore - Mangalore International Airport">Mangalore - Mangalore International Airport (IXE)</option>
                    <option value="Guwahati - Lokpriya Gopinath Bordoloi International Airport">Guwahati - Lokpriya Gopinath Bordoloi International Airport (GAU)</option>
                    <option value="Patna - Jay Prakash Narayan International Airport">Patna - Jay Prakash Narayan International Airport (PAT)</option>
                    <option value="Ranchi - Birsa Munda Airport">Ranchi - Birsa Munda Airport (IXR)</option>
                    <option value="Bhubaneswar - Biju Patnaik International Airport">Bhubaneswar - Biju Patnaik International Airport (BBI)</option>
                    <option value="Chandigarh - Chandigarh Airport">Chandigarh - Chandigarh Airport (IXC)</option>
                    <option value="Amritsar - Sri Guru Ram Dass Jee International Airport">Amritsar - Sri Guru Ram Dass Jee International Airport (ATQ)</option>
                    <option value="Dehradun - Jolly Grant Airport">Dehradun - Jolly Grant Airport (DED)</option>
                    <option value="Jammu - Jammu Airport">Jammu - Jammu Airport (IXJ)</option>
                    <option value="Srinagar - Sheikh Ul-Alam International Airport">Srinagar - Sheikh Ul-Alam International Airport (SXR)</option>
                    <!-- ⭐ TIER-3 / SMALLER CITIES WITH AIRPORTS -->
                    <option value="Agartala - Maharaja Bir Bikram Airport">Agartala - Maharaja Bir Bikram Airport (IXA)</option>
                    <option value="Port Blair - Veer Savarkar International Airport">Port Blair - Veer Savarkar International Airport (IXZ)</option>
                    <option value="Imphal - Bir Tikendrajit International Airport">Imphal - Bir Tikendrajit International Airport (IMF)</option>
                    <option value="Bagdogra - Bagdogra Airport">Bagdogra - Bagdogra Airport (IXB)</option>
                    <option value="Jodhpur - Jodhpur Airport">Jodhpur - Jodhpur Airport (JDH)</option>
                    <option value="Udaipur - Maharana Pratap Airport">Udaipur - Maharana Pratap Airport (UDR)</option>
                    <option value="Jaisalmer - Jaisalmer Airport">Jaisalmer - Jaisalmer Airport (JSA)</option>
                    <option value="Gaya - Gaya Airport">Gaya - Gaya Airport (GAY)</option>
                    <option value="Kullu - Kullu Manali Airport">Kullu - Kullu Manali Airport (KUU)</option>
                    <option value="Leh - Kushok Bakula Rimpochee Airport">Leh - Kushok Bakula Rimpochee Airport (IXL)</option>
                    <option value="Jabalpur - Jabalpur Airport">Jabalpur - Jabalpur Airport (JLR)</option>
                    <option value="Raipur - Swami Vivekananda Airport">Raipur - Swami Vivekananda Airport (RPR)</option>
                    <!-- ⭐ CITIES WITHOUT AIRPORTS (just city name) -->
                    <option value="Surendranagar">Surendranagar</option>
                    <option value="Bhuj">Bhuj</option>
                    <option value="Morbi">Morbi</option>
                    <option value="Nadiad">Nadiad</option>
                    <option value="Anand">Anand</option>
                    <option value="Junagadh">Junagadh</option>
                    <option value="Jamnagar">Jamnagar</option>
                    <option value="Valsad">Valsad</option>
                    <option value="Vapi">Vapi</option>
                    <option value="Bharuch">Bharuch</option>
                    <option value="Navsari">Navsari</option>
                    <option value="Gandhidham">Gandhidham</option>
                    <option value="Bhavnagar">Bhavnagar</option>
                    <option value="Mehsana">Mehsana</option>
                    <option value="Amreli">Amreli</option>
                    <option value="Palanpur">Palanpur</option>
                    <option value="Godhra">Godhra</option>
                    <option value="Veraval">Veraval</option>
                    <option value="Bardoli">Bardoli</option>
                    <option value="Gandhinagar">Gandhinagar</option>
                </select>
            </div>
            <div style="text-align: center;"><small id="emsg3" style="color: red;"></small></div>
        </div>
        <label for="">Drop-off:</label>
        <div class="col-12">
            <div class="input-group">
                <select class="form-select" name="dropoff_place" id="dropoff_place">
                    <option value="" disabled selected hidden>Select Pickup Location</option>
                    <!-- ⭐ METRO CITIES -->
                    <option value="Delhi - Indira Gandhi International Airport">Delhi - Indira Gandhi International Airport (DEL)</option>
                    <option value="Mumbai - Chhatrapati Shivaji Maharaj International Airport">Mumbai - Chhatrapati Shivaji Maharaj International Airport (BOM)</option>
                    <option value="Bengaluru - Kempegowda International Airport">Bengaluru - Kempegowda International Airport (BLR)</option>
                    <option value="Hyderabad - Rajiv Gandhi International Airport">Hyderabad - Rajiv Gandhi International Airport (HYD)</option>
                    <option value="Chennai - Chennai International Airport">Chennai - Chennai International Airport (MAA)</option>
                    <option value="Kolkata - Netaji Subhash Chandra Bose International Airport">Kolkata - Netaji Subhash Chandra Bose International Airport (CCU)</option>
                    <option value="Pune - Pune Airport">Pune - Pune Airport (PNQ)</option>
                    <option value="Ahmedabad - Sardar Vallabhbhai Patel International Airport">Ahmedabad - Sardar Vallabhbhai Patel International Airport (AMD)</option>
                    <!-- ⭐ MAJOR TIER-2 CITIES WITH AIRPORTS -->
                    <option value="Jaipur - Jaipur International Airport">Jaipur - Jaipur International Airport (JAI)</option>
                    <option value="Lucknow - Chaudhary Charan Singh Airport">Lucknow - Chaudhary Charan Singh Airport (LKO)</option>
                    <option value="Goa - Dabolim Airport">Goa - Dabolim Airport (GOI)</option>
                    <option value="Kochi - Cochin International Airport">Kochi - Cochin International Airport (COK)</option>
                    <option value="Thiruvananthapuram - Trivandrum International Airport">Thiruvananthapuram - Trivandrum International Airport (TRV)</option>
                    <option value="Kozhikode - Calicut International Airport">Kozhikode - Calicut International Airport (CCJ)</option>
                    <option value="Nagpur - Dr. Babasaheb Ambedkar International Airport">Nagpur - Dr. Babasaheb Ambedkar International Airport (NAG)</option>
                    <option value="Indore - Devi Ahilya Bai Holkar Airport">Indore - Devi Ahilya Bai Holkar Airport (IDR)</option>
                    <option value="Bhopal - Raja Bhoj Airport">Bhopal - Raja Bhoj Airport (BHO)</option>
                    <option value="Coimbatore - Coimbatore International Airport">Coimbatore - Coimbatore International Airport (CJB)</option>
                    <option value="Visakhapatnam - Visakhapatnam Airport">Visakhapatnam - Visakhapatnam Airport (VTZ)</option>
                    <option value="Vadodara - Vadodara Airport">Vadodara - Vadodara Airport (BDQ)</option>
                    <option value="Rajkot - Rajkot Airport">Rajkot - Rajkot Airport (RAJ)</option>
                    <option value="Surat - Surat International Airport">Surat - Surat International Airport (STV)</option>
                    <option value="Mangalore - Mangalore International Airport">Mangalore - Mangalore International Airport (IXE)</option>
                    <option value="Guwahati - Lokpriya Gopinath Bordoloi International Airport">Guwahati - Lokpriya Gopinath Bordoloi International Airport (GAU)</option>
                    <option value="Patna - Jay Prakash Narayan International Airport">Patna - Jay Prakash Narayan International Airport (PAT)</option>
                    <option value="Ranchi - Birsa Munda Airport">Ranchi - Birsa Munda Airport (IXR)</option>
                    <option value="Bhubaneswar - Biju Patnaik International Airport">Bhubaneswar - Biju Patnaik International Airport (BBI)</option>
                    <option value="Chandigarh - Chandigarh Airport">Chandigarh - Chandigarh Airport (IXC)</option>
                    <option value="Amritsar - Sri Guru Ram Dass Jee International Airport">Amritsar - Sri Guru Ram Dass Jee International Airport (ATQ)</option>
                    <option value="Dehradun - Jolly Grant Airport">Dehradun - Jolly Grant Airport (DED)</option>
                    <option value="Jammu - Jammu Airport">Jammu - Jammu Airport (IXJ)</option>
                    <option value="Srinagar - Sheikh Ul-Alam International Airport">Srinagar - Sheikh Ul-Alam International Airport (SXR)</option>
                    <!-- ⭐ TIER-3 / SMALLER CITIES WITH AIRPORTS -->
                    <option value="Agartala - Maharaja Bir Bikram Airport">Agartala - Maharaja Bir Bikram Airport (IXA)</option>
                    <option value="Port Blair - Veer Savarkar International Airport">Port Blair - Veer Savarkar International Airport (IXZ)</option>
                    <option value="Imphal - Bir Tikendrajit International Airport">Imphal - Bir Tikendrajit International Airport (IMF)</option>
                    <option value="Bagdogra - Bagdogra Airport">Bagdogra - Bagdogra Airport (IXB)</option>
                    <option value="Jodhpur - Jodhpur Airport">Jodhpur - Jodhpur Airport (JDH)</option>
                    <option value="Udaipur - Maharana Pratap Airport">Udaipur - Maharana Pratap Airport (UDR)</option>
                    <option value="Jaisalmer - Jaisalmer Airport">Jaisalmer - Jaisalmer Airport (JSA)</option>
                    <option value="Gaya - Gaya Airport">Gaya - Gaya Airport (GAY)</option>
                    <option value="Kullu - Kullu Manali Airport">Kullu - Kullu Manali Airport (KUU)</option>
                    <option value="Leh - Kushok Bakula Rimpochee Airport">Leh - Kushok Bakula Rimpochee Airport (IXL)</option>
                    <option value="Jabalpur - Jabalpur Airport">Jabalpur - Jabalpur Airport (JLR)</option>
                    <option value="Raipur - Swami Vivekananda Airport">Raipur - Swami Vivekananda Airport (RPR)</option>
                    <!-- ⭐ CITIES WITHOUT AIRPORTS (just city name) -->
                    <option value="Surendranagar">Surendranagar</option>
                    <option value="Bhuj">Bhuj</option>
                    <option value="Morbi">Morbi</option>
                    <option value="Nadiad">Nadiad</option>
                    <option value="Anand">Anand</option>
                    <option value="Junagadh">Junagadh</option>
                    <option value="Jamnagar">Jamnagar</option>
                    <option value="Valsad">Valsad</option>
                    <option value="Vapi">Vapi</option>
                    <option value="Bharuch">Bharuch</option>
                    <option value="Navsari">Navsari</option>
                    <option value="Gandhidham">Gandhidham</option>
                    <option value="Bhavnagar">Bhavnagar</option>
                    <option value="Mehsana">Mehsana</option>
                    <option value="Amreli">Amreli</option>
                    <option value="Palanpur">Palanpur</option>
                    <option value="Godhra">Godhra</option>
                    <option value="Veraval">Veraval</option>
                    <option value="Bardoli">Bardoli</option>
                    <option value="Gandhinagar">Gandhinagar</option>
                </select>
            </div>
            <div style="text-align: center;"><small id="emsg4" style="color: red;"></small></div>
        </div>
        <label for="">Pick-up:</label>
        <div class="col-12">
            <div class="input-group">
                <input class="form-control" type="date" id="pickup_date" name="pickup_date">
                <select class="form-select ms-3" placeholder="Default select example" id="pickup_time" name="pickup_time">
                    <option value="" disabled selected hidden>Select Time</option>
                    <option value="12:00AM">12:00AM</option>
                    <option value="1:00AM">1:00AM</option>
                    <option value="2:00AM">2:00AM</option>
                    <option value="3:00AM">3:00AM</option>
                    <option value="4:00AM">4:00AM</option>
                    <option value="5:00AM">5:00AM</option>
                    <option value="6:00AM">6:00AM</option>
                    <option value="7:00AM">7:00AM</option>
                </select>
            </div>
        </div>
        <label for="">Drop-off:</label>
        <div class="col-12">
            <div class="input-group">
                <input class="form-control" type="date" id="dropoff_date" name="dropoff_date">
                <select class="form-select ms-3" placeholder="Default select example" id="dropoff_time" name="dropoff_time">
                    <option value="" disabled selected hidden>Select Time</option>
                    <option value="12:00AM">12:00AM</option>
                    <option value="1:00AM">1:00AM</option>
                    <option value="2:00AM">2:00AM</option>
                    <option value="3:00AM">3:00AM</option>
                    <option value="4:00AM">4:00AM</option>
                    <option value="5:00AM">5:00AM</option>
                    <option value="6:00AM">6:00AM</option>
                    <option value="7:00AM">7:00AM</option>
                </select>
            </div>
            <div class="col-12 mb-3 mt-3"><input type="date" id="booking_date" name="booking_date" value="<?= $today ?>" readonly class="form-control" style="background:#e9ecef; cursor:not-allowed;"></div>
        </div>
        <small id="emsg5" style="color: red; text-align: center; display: block;"></small>
        <div style="text-align: center;"><small id="emsg0" style="color: red;"></small></div>
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
    document.querySelector('form').addEventListener('submit', function(e) {
        e.preventDefault();
        let vcar = document.getElementById('selectcar').value;
        let vrprice = document.getElementById('rprice').value;
        let vpnum = document.getElementById('pnum').value;
        let vemail = document.getElementById('email').value;
        let renterName = document.getElementById('renter_name').value;
        let renterAddress = document.getElementById('renter_address').value;
        let vpick_up = document.getElementById('pickup_place').value;
        let vdrop_off = document.getElementById('dropoff_place').value;
        let vpickupd = document.getElementById('pickup_date').value;
        let vpickupt = document.getElementById('pickup_time').value;
        let vdropofd = document.getElementById('dropoff_date').value;
        let vdropoft = document.getElementById('dropoff_time').value;

        document.getElementById('emsg0').innerHTML = "";
        document.getElementById('emsg1').innerHTML = "";
        document.getElementById('emsg2').innerHTML = "";
        document.getElementById('emsg3').innerHTML = "";
        document.getElementById('emsg4').innerHTML = "";
        document.getElementById('emsg6').innerHTML = "";
        document.getElementById('emsg7').innerHTML = "";


        let vnum = /^(\+\d{1,3}[- ]?)?\d{10}$/;
        let vmail = /^[a-zA-Z0-9]+@[a-z]+\.[a-z]{2,}$/;
        let vpickup = /^[a-zA-Z0-9\s,.-]{5,}$/;;
        let vdropoff = /^[a-zA-Z0-9\s,.-]{5,}$/;;
        let fname = /^[A-Za-z]+(?: [A-Za-z]+)+$/;
        let address = /^[A-Za-z0-9\s,.'\-/#]{5,100}$/;

        if (vcar != "" && vcar != null && vrprice != "" && vrprice != null && vpnum != "" && vpnum != null && vemail != "" && vemail != null && vpick_up != "" && vpick_up != null && vdrop_off != "" && vdrop_off != null && vpickupd != "" && vpickupd != null && vpickupt != "" && vpickupt != null && vdropofd != "" && vdropofd != null && vdropoft != "" && vdropoft != null && renterName != "" && renterName != null && renterAddress != "" && renterAddress != null) {
            if (vnum.test(vpnum)) {
                if (vmail.test(vemail)) {
                    if (vpickup.test(vpick_up)) {
                        if (vdropoff.test(vdrop_off)) {
                            if (fname.test(renterName)) {
                                if (address.test(renterAddress)) {
                                    if (!validateDropoffTime()) {
                                        return false; // Block submission
                                    }
                                    let data = {
                                        car: $('#selectcar').val(),
                                        rprice: $('#rprice').val(),
                                        pnum: $('#pnum').val(),
                                        email: $('#email').val(),
                                        renter_name: $('#renter_name').val(),
                                        renter_address: $('#renter_address').val(),
                                        pickup_place: $('#pickup_place').val(),
                                        dropoff_place: $('#dropoff_place').val(),
                                        pickup_date: $('#pickup_date').val(),
                                        pickup_time: $('#pickup_time').val(),
                                        dropoff_date: $('#dropoff_date').val(),
                                        dropoff_time: $('#dropoff_time').val(),
                                        booking_date: $('#booking_date').val()
                                    }

                                    $.ajax({
                                        url: "../../api/book/booking_submit",
                                        method: "POST",
                                        data: data,
                                        success: function(response) {
                                            window.location.href = "./agreement?booking_id=" + response.booking_id;
                                        },
                                        error: function(error) {
                                            alert("Not Booked");
                                            window.location.href = "./index";
                                        }
                                    })
                                    return false;
                                } else {
                                    document.getElementById('emsg7').innerHTML = "Enter a proper address";
                                    scrollToFirstError();
                                    return false;
                                }
                            } else {
                                document.getElementById('emsg6').innerHTML = "Name is too short";
                                scrollToFirstError();
                                return false;
                            }
                        } else {
                            document.getElementById('emsg4').innerHTML = "Please enter a valid dropoff location.";
                            scrollToFirstError();
                            return false;
                        }
                    } else {
                        document.getElementById('emsg3').innerHTML = "Please enter a valid pickup location.";
                        scrollToFirstError();
                        return false;
                    }
                } else {
                    document.getElementById('emsg2').innerHTML = "Email Pattern Not Matched";
                    scrollToFirstError();
                    return false;
                }
            } else {
                document.getElementById('emsg1').innerHTML = "Mobile Pattern Not Matched";
                scrollToFirstError();
                return false;
            }
        } else {
            document.getElementById('emsg0').innerHTML = "Null Fields Not Allowed";
            scrollToFirstError();
            return false;
        }
    });
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

    const pickup_place = document.getElementById('pickup_place');

    /* list is about to open → hide arrow */
    pickup_place.addEventListener('mousedown', () => {
        pickup_place.classList.add('is-open');
    });

    /* list just closed *and* the value changed → show arrow */
    pickup_place.addEventListener('change', () => {
        pickup_place.classList.remove('is-open');
    });

    /* user pressed Esc or clicked elsewhere without changing value → show arrow */
    pickup_place.addEventListener('blur', () => {
        pickup_place.classList.remove('is-open');
    });

    const dropoff_place = document.getElementById('dropoff_place');

    /* list is about to open → hide arrow */
    dropoff_place.addEventListener('mousedown', () => {
        dropoff_place.classList.add('is-open');
    });

    /* list just closed *and* the value changed → show arrow */
    dropoff_place.addEventListener('change', () => {
        dropoff_place.classList.remove('is-open');
    });

    /* user pressed Esc or clicked elsewhere without changing value → show arrow */
    dropoff_place.addEventListener('blur', () => {
        dropoff_place.classList.remove('is-open');
    });

    const pickup_time = document.getElementById('pickup_time');

    /* list is about to open → hide arrow */
    pickup_time.addEventListener('mousedown', () => {
        pickup_time.classList.add('is-open');
    });

    /* list just closed *and* the value changed → show arrow */
    pickup_time.addEventListener('change', () => {
        pickup_time.classList.remove('is-open');
    });

    /* user pressed Esc or clicked elsewhere without changing value → show arrow */
    pickup_time.addEventListener('blur', () => {
        pickup_time.classList.remove('is-open');
    });

    const dropoff_time = document.getElementById('dropoff_time');

    /* list is about to open → hide arrow */
    dropoff_time.addEventListener('mousedown', () => {
        dropoff_time.classList.add('is-open');
    });

    /* list just closed *and* the value changed → show arrow */
    dropoff_time.addEventListener('change', () => {
        dropoff_time.classList.remove('is-open');
    });

    /* user pressed Esc or clicked elsewhere without changing value → show arrow */
    dropoff_time.addEventListener('blur', () => {
        dropoff_time.classList.remove('is-open');
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
    const rprice = document.getElementById('rprice');

    function syncPriceWithCar() {
        const opt = selectcar.options[selectcar.selectedIndex];
        const price = opt ? opt.dataset.price : '';
        rprice.value = price ? '₹' + price : '';
    }


    /* run once on page‑load (after any URL pre‑select) */
    syncPriceWithCar();

    /* keep price updated whenever user picks a different car */
    selectcar.addEventListener('change', syncPriceWithCar);


    const pickupDate = document.getElementById('pickup_date');
const dropoffDate = document.getElementById('dropoff_date');

// 🟡 Prevent past dates in calendar
pickupDate.min = new Date().toISOString().split('T')[0];

pickupDate.addEventListener('change', function() {
    const selectedDate = this.value;
    dropoffDate.min = selectedDate;

    // Optional: If dropoff date is already set and is before pickup date, clear it
    if (dropoffDate.value && dropoffDate.value < selectedDate) {
        dropoffDate.value = '';
    }
});


    const pickupTime = document.getElementById('pickup_time');
    const dropoffTime = document.getElementById('dropoff_time');
    const emsg5 = document.getElementById("emsg5");


    function validateDropoffTime() {
        const pickupTime = document.getElementById('pickup_time');
        const dropoffTime = document.getElementById('dropoff_time');
        const pickupDate = document.getElementById('pickup_date');
        const dropoffDate = document.getElementById('dropoff_date');

        const pickupDateVal = pickupDate.value;
        const dropoffDateVal = dropoffDate.value;
        const pickupTimeVal = pickupTime.value;
        const dropoffTimeVal = dropoffTime.value;

        emsg5.textContent = "";

        if (pickupDateVal && dropoffDateVal && pickupDateVal === dropoffDateVal) {
            const times = {
                "12:00AM": 0,
                "1:00AM": 1,
                "2:00AM": 2,
                "3:00AM": 3,
                "4:00AM": 4,
                "5:00AM": 5,
                "6:00AM": 6,
                "7:00AM": 7
            };

            const pickVal = times[pickupTimeVal];
            const dropVal = times[dropoffTimeVal];

            if (dropVal <= pickVal) {
                emsg5.textContent = "Drop-off time must be after pickup time when date is same.";
                return false;
            }
        }

        return true;
    }


    pickupTime.addEventListener('change', validateDropoffTime);
    dropoffTime.addEventListener('change', validateDropoffTime);
    pickupDate.addEventListener('change', validateDropoffTime);
    dropoffDate.addEventListener('change', validateDropoffTime);

    function scrollToFirstError() {
        const errorElements = document.querySelectorAll('[id^="emsg"]');
        for (const el of errorElements) {
            if (el.textContent.trim() !== '') {
                el.scrollIntoView({
                    behavior: 'smooth',
                    block: 'center'
                });
                el.style.animation = "shake 0.4s ease"; // Optional shake effect
                return;
            }
        }
    }
</script>
<?php
include pathof('./include/script.php');
include pathof('./include/closing tag.php');
?>