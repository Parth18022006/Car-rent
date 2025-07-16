<?php
require '../../include/init.php';

$booking = $_SESSION['pending_booking'] ?? null;
if (!$booking) {
    // no pending booking, redirect
    header("Location: ../../index");
    exit;
}

$q = "SELECT name AS car_name, price AS car_price, gas, year FROM car WHERE id = ?";

$param = [$booking['car_id']];

$stmt = $conn->prepare($q);
$stmt->execute($param);

$car = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$car) {
    echo "<p>Car details not found.</p>";
    exit;
}

// merge car info into booking array
$booking = array_merge($booking, $car);


include pathof('include/header.php');
include pathof('include/nav.php');

?>
<style>
    .agreement-content {
        background: #fff;
        padding: 2rem;
        border-radius: 10px;
        box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
        font-size: 1rem;
        line-height: 1.6;
    }

    .agreement-content h4 {
        margin-top: 1.5rem;
        font-weight: 600;
    }

    .agreement-content ul {
        padding-left: 1.2rem;
    }

    #statusMsg {
        font-size: 1rem;
        color: #28a745;
    }

    #signBtn:disabled {
        opacity: 0.7;
        cursor: not-allowed;
    }

    .page-fadeout {
        opacity: 0;
        transition: opacity 0.8s ease;
        /* smooth fade */
    }
</style>
<div class="container py-5 d-flex justify-content-center">
    <div class="agreement-content" style="max-width: 700px; width: 100%;">
        <h2 class="mb-4 text-danger" style="color:#ff0000;">Rental Agreement</h2>

        <!-- Parties -->
        <h4>1. Parties to Agreement</h4>
        <p><strong>Owner:</strong> Car-rent</p>
        <p><strong>Renter:</strong> <?= htmlspecialchars($booking['renter_name']) ?></p>

        <!-- Renter Details -->
        <h4>2. Renter Details</h4>
        <p><strong>Name:</strong> <?= htmlspecialchars($booking['renter_name']) ?></p>
        <p><strong>Email:</strong> <?= htmlspecialchars($booking['email']) ?></p>
        <p><strong>Phone:</strong> <?= htmlspecialchars($booking['num']) ?></p>
        <p><strong>Address:</strong> <?= htmlspecialchars($booking['renter_address']) ?></p>

        <!-- Vehicle Details -->
        <h4>3. Vehicle Details</h4>
        <p><strong>Car:</strong> <?= htmlspecialchars($booking['car_name']) ?></p>
        <p><strong>Price:</strong> $<?= htmlspecialchars($booking['car_price']) ?></p>
        <p><strong>Fuel:</strong> <?= htmlspecialchars($booking['gas']) ?></p>
        <p><strong>Year:</strong> <?= htmlspecialchars($booking['year']) ?></p>

        <!-- Pickup/Dropoff -->
        <h4>4. Pickup & Dropoff</h4>
        <p><strong>Pickup Place:</strong> <?= htmlspecialchars($booking['pickup_place']) ?></p>
        <p><strong>Pickup Date:</strong> <?= htmlspecialchars($booking['pickup_date']) ?></p>
        <p><strong>Pickup Time:</strong> <?= htmlspecialchars($booking['pickup_time']) ?></p>
        <p><strong>Dropoff Place:</strong> <?= htmlspecialchars($booking['dropoff_place']) ?></p>
        <p><strong>Dropoff Date:</strong> <?= htmlspecialchars($booking['dropoff_date']) ?></p>
        <p><strong>Dropoff Time:</strong> <?= htmlspecialchars($booking['dropoff_time']) ?></p>

        <!-- Booking Info -->
        <h4>5. Booking Info</h4>
        <p><strong>Booking Date:</strong> <?= htmlspecialchars($booking['booking_date']) ?></p>

        <!-- Charges -->
        <h4>6. Charges & Conditions</h4>
        <ul>
            <li>Extra charges apply if pickup and dropoff are not properly defined.</li>
            <li>If pickup and dropoff are outside the city, renter pays retrieval charges.</li>
            <li>All terms & conditions as listed on our website apply.</li>
            <li>I have read and accept the terms & conditions willingly and agree to pay any charges if any terms & conditions are broken by me.</li>
        </ul>

        <!-- Accept T&C -->
        <div class="form-check my-4">
            <input class="form-check-input" type="checkbox" id="agreeCheck">
            <label class="form-check-label" for="agreeCheck">
                I have read and agree to all terms & conditions.
            </label>
        </div>

        <div class="d-flex justify-content-center my-3">
            <div style="max-width:300px; width:100%; text-align:center;">
                <button class="btn btn-primary btn-lg w-100 py-2" id="signBtn">
                    ✍️ Sign & Submit
                </button>
                <button id="downloadPdfBtn" class="btn btn-success btn-lg w-100 py-2 d-none">
                    📄 Download PDF
                </button>
                <div id="statusMsg" class="mt-3 text-success fw-semibold" style="display:none;"></div>
            </div>
        </div>

    </div>
</div>

<!-- Hidden data for PDF -->
<div id="agreementData"
     data-id="pending"
     data-renter="<?= htmlspecialchars($booking['renter_name']) ?>"
     data-email="<?= htmlspecialchars($booking['email']) ?>"
     data-phone="<?= htmlspecialchars($booking['num']) ?>"
     data-address="<?= htmlspecialchars($booking['renter_address']) ?>"
     data-car="<?= htmlspecialchars($booking['car_name']) ?>"
     data-price="<?= htmlspecialchars($booking['car_price']) ?>"
     data-gas="<?= htmlspecialchars($booking['gas']) ?>"
     data-year="<?= htmlspecialchars($booking['year']) ?>"
     data-pickup-place="<?= htmlspecialchars($booking['pickup_place']) ?>"
     data-pickup-date="<?= htmlspecialchars($booking['pickup_date']) ?>"
     data-pickup-time="<?= htmlspecialchars($booking['pickup_time']) ?>"
     data-dropoff-place="<?= htmlspecialchars($booking['dropoff_place']) ?>"
     data-dropoff-date="<?= htmlspecialchars($booking['dropoff_date']) ?>"
     data-dropoff-time="<?= htmlspecialchars($booking['dropoff_time']) ?>"
     data-booking-date="<?= htmlspecialchars($booking['booking_date']) ?>"
     style="display:none;">
</div>


<?php
include pathof('include/footer.php');
?>

<script>
    if (window.history.replaceState) {
        const newURL = window.location.protocol + "//" + window.location.host + window.location.pathname;
        window.history.replaceState({
            path: newURL
        }, '', newURL);
    }
</script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const signBtn = document.getElementById('signBtn');
        const downloadBtn = document.getElementById('downloadPdfBtn');
        const agreeCheck = document.getElementById('agreeCheck');
        const statusMsg = document.getElementById('statusMsg');

        // SIGN & SUBMIT
        signBtn.addEventListener('click', function(e) {
            e.preventDefault();

            if (!agreeCheck.checked) {
                alert('✅ Please agree to the terms & conditions first.');
                return;
            }

            // disable button while processing
            signBtn.disabled = true;
            signBtn.innerText = '⏳ Signing...';

            fetch('../../api/book/agreement_sign.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({
                        sign: true
                    })
                })
                .then(res => res.json())
                .then(data => {
                    if (data.success) {
                        document.getElementById('agreementData').dataset.id = data.booking_id;
                        // show success message
                        statusMsg.innerText = '✔️ Agreement signed successfully!';
                        statusMsg.style.display = 'block';

                        // swap buttons
                        signBtn.classList.add('d-none');
                        downloadBtn.classList.remove('d-none');
                    } else {
                        alert('Error: ' + (data.message || 'Unable to sign'));
                        signBtn.disabled = false;
                        signBtn.innerText = '✍️ Sign & Submit';
                    }
                })
                .catch(err => {
                    console.error(err);
                    alert('Error signing agreement.');
                    signBtn.disabled = false;
                    signBtn.innerText = '✍️ Sign & Submit';
                });
        });

        // DOWNLOAD PDF
        downloadBtn.addEventListener('click', function(e) {
            e.preventDefault();

            const dataEl = document.getElementById('agreementData');
            const {
                jsPDF
            } = window.jspdf;
            const doc = new jsPDF();

            // PDF Title
            doc.setFont('helvetica', 'bold');
            doc.setFontSize(20);
            doc.text('RENTAL AGREEMENT', 105, 20, {
                align: 'center'
            });
            doc.setLineWidth(0.5);
            doc.line(20, 25, 190, 25);

            doc.setFont('helvetica', 'normal');
            doc.setFontSize(12);
            let y = 35;

            function addHeading(t) {
                doc.setFont('helvetica', 'bold');
                doc.text(t, 20, y);
                y += 8;
                doc.setFont('helvetica', 'normal');
            }

            function addLine(l, v) {
                const split = doc.splitTextToSize(l + ': ' + v, 170);
                doc.text(split, 20, y);
                y += split.length * 7;
            }

            // Build PDF
            addHeading('1. Parties to Agreement');
            addLine('Owner', 'Car-rent');
            addLine('Renter', dataEl.dataset.renter);

            addHeading('2. Renter Details');
            addLine('Name', dataEl.dataset.renter);
            addLine('Email', dataEl.dataset.email);
            addLine('Phone', dataEl.dataset.phone);
            addLine('Address', dataEl.dataset.address);

            addHeading('3. Vehicle Details');
            addLine('Car', dataEl.dataset.car);
            addLine('Price', '$' + dataEl.dataset.price);
            addLine('Fuel', dataEl.dataset.gas);
            addLine('Year', dataEl.dataset.year);

            addHeading('4. Pickup & Dropoff');
            addLine('Pickup Place', dataEl.dataset.pickupPlace);
            addLine('Pickup Date', dataEl.dataset.pickupDate);
            addLine('Pickup Time', dataEl.dataset.pickupTime);

            y += 5;

            // Dropoff details
            addLine('Dropoff Place', dataEl.dataset.dropoffPlace);
            addLine('Dropoff Date', dataEl.dataset.dropoffDate);
            addLine('Dropoff Time', dataEl.dataset.dropoffTime);

            addHeading('5. Booking Info');
            addLine('Booking Date', dataEl.dataset.bookingDate);

            addHeading('6. Charges & Conditions');
            const conditions = [
                '• Extra charges apply if pickup and dropoff are not properly defined.',
                '• If pickup and dropoff are outside the city, renter pays retrieval charges.',
                '• All terms & conditions as listed on our website apply.',
                '• I have read and accept the terms & conditions willingly and agree to pay any charges if any terms & conditions are broken by me.'
            ];
            conditions.forEach(c => {
                const lines = doc.splitTextToSize(c, 170);
                doc.text(lines, 25, y);
                y += lines.length * 7;
            });

            doc.save(`agreement_${dataEl.dataset.id}.pdf`);

            // Add fade-out class
            document.body.classList.add('page-fadeout');

            // Redirect after the fade completes
            setTimeout(() => {
                window.location.href = '../../index';
            }, 800);
        });
    });
</script>

<!-- Back to Top -->
<a href="#" class="btn btn-secondary btn-lg-square rounded-circle back-to-top"><i class="fa fa-arrow-up"></i></a>

<?php
include pathof('include/script.php');
include pathof('include/closing tag.php');
?>