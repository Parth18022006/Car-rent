<?php
require '../../include/init.php';
include pathof('include/header.php');
include pathof('include/nav.php');
?>

<!-- Header Start -->
<div class="container-fluid bg-breadcrumb">
    <div class="container text-center py-5" style="max-width: 900px;">
        <h4 class="text-white display-4 mb-4 wow fadeInDown" data-wow-delay="0.1s">Terms & Conditions</h4>
        <ol class="breadcrumb d-flex justify-content-center mb-0 wow fadeInDown" data-wow-delay="0.3s">
            <li class="breadcrumb-item"><a href="../../index">Home</a></li>
            <li class="breadcrumb-item"><a href="#">Pages</a></li>
            <li class="breadcrumb-item active text-primary">Testimonial</li>
        </ol>
    </div>
</div>
<!-- Header End -->

<!-- Terms & Conditions Start -->
<div class="container py-5">
    <div class="text-center mb-5">
        <!-- <h1 class="display-4 fw-bold text-capitalize">Terms & <span class="text-primary">Conditions</span></h1> -->
        <p class="lead text-muted">Kindly review our policies before using our services.</p>
        <div class="divider mx-auto my-4" style="width: 60px; height: 4px; background-color: var(--clr-primary);"></div>
    </div>

    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div class="accordion" id="termsAccordion">

                <!-- Section 1 -->
                <div class="accordion-item mb-3">
                    <h2 class="accordion-header" id="headingOne">
                        <button class="accordion-button fw-semibold" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                            1. Rental Agreement
                        </button>
                    </h2>
                    <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#termsAccordion">
                        <div class="accordion-body">
                            By renting a vehicle, you agree to all terms set forth herein and in any supporting documentation provided during booking.
                        </div>
                    </div>
                </div>

                <!-- Section 2 -->
                <div class="accordion-item mb-3">
                    <h2 class="accordion-header" id="headingTwo">
                        <button class="accordion-button collapsed fw-semibold" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                            2. Age & License Requirements
                        </button>
                    </h2>
                    <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#termsAccordion">
                        <div class="accordion-body">
                            Renters must be 21+ with a valid driver's license for at least 1 year. International renters must present an International Driving Permit.
                        </div>
                    </div>
                </div>

                <!-- Section 3 -->
                <div class="accordion-item mb-3">
                    <h2 class="accordion-header" id="headingThree">
                        <button class="accordion-button collapsed fw-semibold" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                            3. Booking & Payment
                        </button>
                    </h2>
                    <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#termsAccordion">
                        <div class="accordion-body">
                            All bookings are confirmed with full/partial payment. Add-ons like GPS, child seats, and outstation permits may incur extra charges.
                        </div>
                    </div>
                </div>

                <!-- Section 4 -->
                <div class="accordion-item mb-3">
                    <h2 class="accordion-header" id="headingFour">
                        <button class="accordion-button collapsed fw-semibold" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                            4. Vehicle Condition
                        </button>
                    </h2>
                    <div id="collapseFour" class="accordion-collapse collapse" aria-labelledby="headingFour" data-bs-parent="#termsAccordion">
                        <div class="accordion-body">
                            Vehicles are delivered in clean and roadworthy condition. The customer is responsible for returning the car in the same condition. Any damage, excessive dirt, or loss of vehicle accessories may result in additional charges.
                        </div>
                    </div>
                </div>

                <!-- Section 5 -->
                <div class="accordion-item mb-3">
                    <h2 class="accordion-header" id="headingFive">
                        <button class="accordion-button collapsed fw-semibold" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFive" aria-expanded="false" aria-controls="collapseFive">
                            5. Fuel Policy
                        </button>
                    </h2>
                    <div id="collapseFive" class="accordion-collapse collapse" aria-labelledby="headingFive" data-bs-parent="#termsAccordion">
                        <div class="accordion-body">
                            Vehicles are provided with a full fuel tank and must be returned full. If not, fuel charges will be deducted from the deposit as per current fuel rates.
                        </div>
                    </div>
                </div>

                <!-- Section 6 -->
                <div class="accordion-item mb-3">
                    <h2 class="accordion-header" id="headingSix">
                        <button class="accordion-button collapsed fw-semibold" type="button" data-bs-toggle="collapse" data-bs-target="#collapseSix" aria-expanded="false" aria-controls="collapseSix">
                            6. Insurance & Liability
                        </button>
                    </h2>
                    <div id="collapseSix" class="accordion-collapse collapse" aria-labelledby="headingSix" data-bs-parent="#termsAccordion">
                        <div class="accordion-body">
                            All vehicles are insured with basic third-party liability. The renter is responsible for any damage or theft that is not covered by insurance. Optional full coverage can be availed at an additional cost. </div>
                    </div>
                </div>

                <!-- Section 7 -->
                <div class="accordion-item mb-3">
                    <h2 class="accordion-header" id="headingSeven">
                        <button class="accordion-button collapsed fw-semibold" type="button" data-bs-toggle="collapse" data-bs-target="#collapseSeven" aria-expanded="false" aria-controls="collapseSeven">
                            7. Cancellations & Refunds
                        </button>
                    </h2>
                    <div id="collapseSeven" class="accordion-collapse collapse" aria-labelledby="headingSeven" data-bs-parent="#termsAccordion">
                        <div class="accordion-body">
                            Cancellations made more than 24 hours before the rental start time are eligible for a full refund. No refunds will be provided for cancellations made within 24 hours of the pickup time. </div>
                    </div>
                </div>

                <!-- Section 8 -->
                <div class="accordion-item mb-3">
                    <h2 class="accordion-header" id="headingEight">
                        <button class="accordion-button collapsed fw-semibold" type="button" data-bs-toggle="collapse" data-bs-target="#collapseEight" aria-expanded="false" aria-controls="collapseEight">
                            8. Traffic Violations
                        </button>
                    </h2>
                    <div id="collapseEight" class="accordion-collapse collapse" aria-labelledby="headingEight" data-bs-parent="#termsAccordion">
                        <div class="accordion-body">
                            The renter is responsible for any traffic fines, penalties, or legal violations incurred during the rental period. </div>
                    </div>
                </div>

                <!-- Section 9 -->
                <div class="accordion-item mb-3">
                    <h2 class="accordion-header" id="headingNine">
                        <button class="accordion-button collapsed fw-semibold" type="button" data-bs-toggle="collapse" data-bs-target="#collapseNine" aria-expanded="false" aria-controls="collapseNine">
                            9. Prohibited Uses
                        </button>
                    </h2>
                    <div id="collapseNine" class="accordion-collapse collapse" aria-labelledby="headingNine" data-bs-parent="#termsAccordion">
                        <div class="accordion-body">
                            The rented vehicle must not be used for illegal activities, racing, towing, or driving under the influence of alcohol or drugs. Violation will result in contract termination without refund.
                        </div>
                    </div>
                </div>

                <!-- Section 10 -->
                <div class="accordion-item mb-3">
                    <h2 class="accordion-header" id="headingTen">
                        <button class="accordion-button collapsed fw-semibold" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTen">
                            10. Governing Law
                        </button>
                    </h2>
                    <div id="collapseTen" class="accordion-collapse collapse" aria-labelledby="headingTen" data-bs-parent="#termsAccordion">
                        <div class="accordion-body">
                            These terms follow Indian law. Disputes shall be settled under the jurisdiction of our registered office.
                        </div>
                    </div>
                </div>

                <!-- Section 11 -->
                <div class="accordion-item mb-3">
                    <h2 class="accordion-header" id="headingEleven">
                        <button class="accordion-button collapsed fw-semibold" type="button" data-bs-toggle="collapse" data-bs-target="#collapseEleven" aria-expanded="false" aria-controls="collapseEleven">
                            11. Address Accuracy & Additional Charges
                        </button>
                    </h2>
                    <div id="collapseEleven" class="accordion-collapse collapse" aria-labelledby="headingEleven" data-bs-parent="#termsAccordion">
                        <div class="accordion-body">
                            It is the renter's responsibility to provide accurate and complete pickup and drop-off locations during the booking process. If the address provided is unclear, vague, or incorrect, the renter will bear full responsibility for any delays in pickup or delivery. Additionally, any detours, waiting time, or logistical adjustments caused by incomplete or incorrect addresses may result in additional charges.
                        </div>
                    </div>
                </div>


            </div>
        </div>
    </div>
</div>
<!-- Terms & Conditions End -->


<?php
include pathof('include/footer.php');
?>




<!-- Back to Top -->
<a href="#" class="btn btn-secondary btn-lg-square rounded-circle back-to-top"><i class="fa fa-arrow-up"></i></a>


<?php
include pathof('include/script.php');
include pathof('include/closing tag.php');
?>