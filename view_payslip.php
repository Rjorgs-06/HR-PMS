<?php
session_start();
include('db_connect.php');
$id = $_GET['id'];
$payroll = $conn->query("SELECT w.*, e.fullname as ename, e.position FROM wages w 
INNER JOIN employee_regular e ON w.employee_id = e.id WHERE w.employee_id = $id");
$row = $payroll->fetch_assoc();

// Get the current year and month
$currentMonth = date('n');
$currentYear = date('Y');
$monthName = date('F', mktime(0, 0, 0, $currentMonth, 1, $currentYear));
$daysInMonth = cal_days_in_month(CAL_GREGORIAN, $currentMonth, $currentYear);

// Calculate the contributions
$pagibig_premiums = $row['pagibig_ps'];
$philhealth_premiums = $row['philhealth_ps'];
$gsis_premiums = $row['gsis_ps'];


// Total deductions
$total_deductions = $pagibig_premiums + $philhealth_premiums + $gsis_premiums + $row['withholding_tax'] + $row['pagibig_mp3'] + $row['cnl'] + $row['eml'] + $row['prg'] + $row['help'] + $row['csb'] + $row['cfi'] +  $row['mpl'] + $row['gfal'] + $row['cpl'];

// Net received
$net_received = ($row['monthly_salary'] + $row['pera']) - $total_deductions;

$user_role = isset($_SESSION['login_type']) ? $_SESSION['login_type'] : 'guest';



?>



<div class="container  p-2" style="max-width: 1400px; margin: auto;" id="printable-area">
    <div class="row">

        <div class="col-12 payslip-column">
            <div class="payslip border p-2" id="payslip-content" style="max-width: 600px;">


                <div class="row col-lg-12 d-flex justify-content-center align-items-center">
                    <aside class="col-3 d-flex justify-content-center align-items-center h-100">
                        <img src="./assets/img/Evsu-L.png" alt="logo" class="w-75 object-fit-cover">
                    </aside>
                    <div class="text-center col-9">
                        <p class="p-0 m-0">Republic of the Philippines</p>
                        <p class="p-0 m-0">EASTERN VISAYAS STATE UNIVERSITY CARIGARA CAMPUS</p>
                        <p class="p-0 m-0">Carigara, Leyte</p>
                    </div>
                </div>
                <div class="col-md-12 mt-2">
                    <div class="row justify-content-between">
                        <p class="col-6 p-0 m-0">Pay Slip for the Month of</p>
                        <p class="col-6 p-0 m-0">
                            <strong><?php echo strtoupper($monthName) . " 1-" . $daysInMonth . ", " . $currentYear; ?></strong>
                        </p>
                    </div>
                    <div class="row justify-content-between">
                        <p class="col-6 p-0 m-0">NAME</p>
                        <p class="col-6 p-0 m-0"><strong><?php echo strtoupper($row['ename']); ?></strong></p>
                    </div>
                    <div class="row justify-content-between">
                        <p class="col-6 p-0 m-0">RANK</p>
                        <p class="col-6 p-0 m-0"><strong><?php echo $row['position']; ?></strong></p>
                    </div>

                    <div class="row align-items-center">
                        <div class="col-2 p-0 m-0">SALARY</div>
                        <div class="col-6 p-0 m-0">
                            <hr />
                        </div>
                        <div class="col-4 text-left fw-bold">
                            <strong><?php echo number_format($row['monthly_salary'] + $row['pera'], 2); ?></strong>
                        </div>
                    </div>

                    <div class="row mx-4">
                        <p class="col-6 p-0 m-0">BASIC</p>
                        <p class="col-6 p-0 m-0"><?php echo number_format($row['monthly_salary'], 2); ?></p>
                    </div>

                    <div class="row mx-4">
                        <p class="col-6 p-0 m-0">PERA</p>
                        <p class="col-6 p-0 m-0"><?php echo number_format($row['pera'], 2); ?></p>
                    </div>

                    <p class="row text-left p-0 my-0">LESS</p>
                    <div class="row mx-4">
                        <div class="row col-12">
                            <p class="col-8 p-0 m-0">Withholding Tax</p>
                            <p class="col-4 p-0 m-0"><?php echo number_format($row['withholding_tax'], 2); ?></p>
                        </div>
                        <div class="row col-12">
                            <p class="col-8 p-0 m-0">PAG-IBIG - Premiums</p>
                            <p class="col-4 p-0 m-0"><?php echo number_format($pagibig_premiums, 2); ?></p>
                        </div>
                        <div class="row col-12">
                            <p class="col-8 p-0 m-0">PAG-IBIG - MP3</p>
                            <p class="col-4 p-0 m-0"><?php echo number_format($row['pagibig_mp3'], 2); ?></p>
                        </div>
                        <div class="row col-12">
                            <p class="col-8 p-0 m-0">PhilHealth</p>
                            <p class="col-4 p-0 m-0"><?php echo number_format($philhealth_premiums, 2); ?></p>
                        </div>
                        <div class="row col-12">
                            <p class="col-8 p-0 m-0">GSIS - Premiums</p>
                            <p class="col-4 p-0 m-0"><?php echo number_format($gsis_premiums, 2); ?></p>
                        </div>
                        <div class="row col-12">
                            <p class="col-8 p-0 m-0">GSIS - CNL</p>
                            <p class="col-4 p-0 m-0"><?php echo number_format($row['cnl'], 2); ?></p>
                        </div>
                        <div class="row col-12">
                            <p class="col-8 p-0 m-0">GSIS - EML</p>
                            <p class="col-4 p-0 m-0"><?php echo number_format($row['eml'], 2); ?></p>
                        </div>
                        <div class="row col-12">
                            <p class="col-8 p-0 m-0">GSIS - PRG</p>
                            <p class="col-4 p-0 m-0"><?php echo number_format($row['prg'], 2); ?></p>
                        </div>
                        <div class="row col-12">
                            <p class="col-8 p-0 m-0">GSIS - HELP</p>
                            <p class="col-4 p-0 m-0"><?php echo number_format($row['help'], 2); ?></p>
                        </div>
                        <div class="row col-12">
                            <p class="col-8 p-0 m-0">GSIS - MPL</p>
                            <p class="col-4 p-0 m-0"><?php echo number_format($row['mpl'], 2); ?></p>
                        </div>
                        <div class="row col-12">
                            <p class="col-8 p-0 m-0">GSIS - GFAL</p>
                            <p class="col-4 p-0 m-0"><?php echo number_format($row['gfal'], 2); ?></p>
                        </div>
                        <div class="row col-12">
                            <p class="col-8 p-0 m-0">GSIS - CPL</p>
                            <p class="col-4 p-0 m-0"><?php echo number_format($row['cpl'], 2); ?></p>
                        </div>
                        <div class="row col-12">
                            <p class="col-8 p-0 m-0">CSB</p>
                            <p class="col-4 p-0 m-0"><?php echo number_format($row['csb'], 2); ?></p>
                        </div>
                        <div class="row col-12">
                            <p class="col-8 p-0 m-0">CFI</p>
                            <p class="col-4 p-0 m-0"><?php echo number_format($row['cfi'], 2); ?></p>
                        </div>
                    </div>

                    <div class="row align-items-center">
                        <div class="col-5 p-0 m-0">TOTAL DEDUCTION</div>
                        <div class="col-5">
                            <hr />
                        </div>
                        <div class="col-2 text-left fw-bold p-0 m-0">
                            <strong><?php echo number_format($total_deductions, 2); ?></strong>
                        </div>
                    </div>

                    <div class="row align-items-center">
                        <div class="col-5 p-0 m-0">NET RECEIVED</div>
                        <div class="col-5">
                            <hr />
                        </div>
                        <div class="col-2 text-left fw-bold p-0 m-0">
                            <strong><?php echo number_format($net_received, 2); ?></strong>
                        </div>
                    </div>

                    <div class="row mb-2">
                        <p class="text-left p-0 my-0 col-12">Certified true and correct:</p>
                    </div>
                    <p class="text-center p-0 my-0"><strong>LENIE F. LLANETA</strong></p>
                    <p class="text-center p-0 my-0">Admin Aide / Payrollmaker</p>
                </div>
            </div>
        </div>


        <div class="col-6" id="payslip-clone"></div>
    </div>
</div>


<?php if ($user_role == 'employee') : ?>
    <footer class="footer-actions text-center">
        <hr class="divider mt-5">
        <div ss="row actions-btn">
            <div class="col-lg-12 d-flex justify-content-center">
                <button class="btn btn-primary btn-sm" type="button" data-dismiss="modal">Close</button>

            </div>
        </div>
    </footer>
<?php endif; ?>

<?php if ($user_role == 'admin') : ?>
    <footer class="footer-actions">
        <hr class="divider mt-5">
        <div class="row actions-btn">
            <div class="col-lg-12 d-flex justify-content-between">
                <button class="btn btn-primary btn-sm" type="button" data-dismiss="modal">Close</button>
                <button class="btn btn-success btn-sm" type="button" id="payslip_print_btn">
                    <span class="fa fa-print"></span> Print
                </button>
            </div>
        </div>
    </footer>
<?php endif; ?>


<script>
    $(document).ready(function() {
            $('#payslip_print_btn').click(function() {
                    var originalPayslip = $('#payslip-content').clone();


                    $('#payslip-clone').html(originalPayslip);


                    $('.payslip-column').removeClass('col-12').addClass('col-6');


                    var element = document.getElementById('printable-area');

                    var opt = {

                        margin: [0.1, 0.1],
                        filename: 'payslip.pdf',
                        image: {
                            type: 'jpeg',
                            quality: 0.98
                        }

                        ,
                        html2canvas: {
                            scale: 2
                        }

                        ,
                        jsPDF: {
                            unit: 'in',
                            format: 'letter',
                            // format: 'legal',
                            orientation: 'landscape'
                        }
                    }


                    html2pdf().from(element).set(opt).save().then(function() {

                            $('.payslip-column').removeClass('col-6').addClass('col-12');

                            location.reload()
                        }

                    );
                }

            );
        }

    );
</script>