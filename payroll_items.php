<?php include('db_connect.php') ?>

<div class="container-fluid ">
    <div class="col-lg-12">
        <div class="card p-4" id="hello">
            <div class="card-header">
                <button class="btn btn-success btn-sm btn-block col-md-2 float-right" type="button" id="print_btn">
                    <span class="fa fa-print"></span> Print
                </button>
            </div>
            <hr>
            <h1 style="font-family: Times New Roman , Times, serif; font-size: 50px; font-weight: bold"
                class=" text-center align-middle">
                General Payroll
            </h1>
            <h3 style="font-family: Times New Roman , Times, serif" , class=" text-center align-middle">
                Easter Visayas State University
            </h3>
            <h5 style="font-family: Times New Roman , Times, serif" , class=" text-center align-middle">
                Carigara - Campus
            </h5>
            <div class="table-responsive">
                <table class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th rowspan="3" class="text-center align-middle">No.</th>
                            <th rowspan="3" class="text-center align-middle">Name</th>
                            <th rowspan="3" class="text-center align-middle">Position</th>
                            <th rowspan="3" class="text-center align-middle">Employee No.</th>
                            <th rowspan="3" class="text-center align-middle">Monthly Salary</th>
                            <th rowspan="3" class="text-center align-middle">PERA</th>
                            <th rowspan="3" class="text-center align-middle">Gross Amount Earned
                            </th>
                            <th colspan="18" class="text-center align-middle">Deductions</th>
                            <th rowspan="3" class="text-center align-middle">Total Deduction</th>
                            <th rowspan="3" class="text-center align-middle">Net Salary</th>
                            <th rowspan="3" class="text-center align-middle">Net Received for <?php $currentDate = date('F');
                                                                                                echo $currentDate;  ?>
                                (1-15)</th>
                            <th rowspan="3" class="text-center align-middle">Signature of Employee
                            </th>
                            <th rowspan="3" class="text-center align-middle">Net Received for <?php $currentDate = date('F');
                                                                                                echo $currentDate;  ?>
                                (16-31)</th>
                            <th rowspan="3" class="text-center align-middle">Signature of Employee
                            </th>
                            <th rowspan="3" class="text-center align-middle">Action</th>
                        </tr>
                        <tr>
                            <th colspan="3" class="text-center align-middle">PAGIBIG</th>
                            <th colspan="2" class="text-center align-middle">GSIS</th>
                            <th rowspan="2" class="text-center align-middle">SIF</th>
                            <th colspan="2" class="text-center align-middle">PhilHealth</th>
                            <th rowspan="2" class="text-center align-middle">Withholding Tax</th>
                            <th rowspan="2" class="text-center align-middle">PRG</th>
                            <th rowspan="2" class="text-center align-middle">CNL</th>
                            <th rowspan="2" class="text-center align-middle">EML</th>
                            <th rowspan="2" class="text-center align-middle">MPL</th>
                            <th rowspan="2" class="text-center align-middle">GFAL</th>
                            <th rowspan="2" class="text-center align-middle">CPL</th>
                            <th rowspan="2" class="text-center align-middle">HELP</th>
                            <th rowspan="2" class="text-center align-middle">CFI</th>
                            <th rowspan="2" class="text-center align-middle">CSB</th>
                        </tr>
                        <tr>
                            <th>PS</th>
                            <th>GS</th>
                            <th>MP3</th>
                            <th>PS</th>
                            <th>GS</th>
                            <th>PS</th>
                            <th>GS</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $i = 1;
                        $wages_info = $conn->query("
                                                SELECT 
                                                    w.*, 
                                                    e.* 
                                                FROM wages AS w
                                                INNER JOIN employee AS e ON w.employee_id = e.id
                                            ");
                        while ($row = $wages_info->fetch_assoc()) :
                        ?>
                        <tr>
                            <td class="text-center"><?php echo $i++; ?></td>
                            <td><b><?php echo $row['fullname']; ?></b></td>
                            <td><b><?php echo $row['position']; ?></b></td>
                            <td><b><?php echo $row['employee_id']; ?></b></td>
                            <td><b><?php echo $row['monthly_salary']; ?></b></td>
                            <td><b><?php echo $row['pera']; ?></b></td>
                            <td><b><?php echo $row['gross_amount_earned']; ?></b></td>

                            <!-- PAGIBIG -->
                            <td><b><?php echo $row['pagibig_ps']; ?></b></td>
                            <td><b><?php echo $row['pagibig_gs']; ?></b></td>
                            <td><b><?php echo $row['pagibig_mp3']; ?></b></td>

                            <!-- GSIS -->
                            <td><b><?php echo $row['gsis_ps']; ?></b></td>
                            <td><b><?php echo $row['gsis_gs']; ?></b></td>

                            <!-- SIF -->
                            <td><b><?php echo $row['sif']; ?></b></td>

                            <!-- PhilHealth -->
                            <td><b><?php echo $row['philhealth_ps']; ?></b></td>
                            <td><b><?php echo $row['philhealth_gs']; ?></b></td>

                            <!-- Withholding Tax -->
                            <td><b><?php echo $row['withholding_tax']; ?></b></td>

                            <!-- Other Deductions -->
                            <td><b><?php echo $row['prg']; ?></b></td>
                            <td><b><?php echo $row['cnl']; ?></b></td>
                            <td><b><?php echo $row['eml']; ?></b></td>
                            <td><b><?php echo $row['mpl']; ?></b></td>
                            <td><b><?php echo $row['gfal']; ?></b></td>
                            <td><b><?php echo $row['cpl']; ?></b></td>
                            <td><b><?php echo $row['help']; ?></b></td>
                            <td><b><?php echo $row['cfi']; ?></b></td>
                            <td><b><?php echo $row['csb']; ?></b></td>

                            <!-- Total Deductions and Net Salary -->
                            <td><b><?php echo $row['total_deductions']; ?></b></td>
                            <td><b><?php echo $row['net_salary']; ?></b></td>

                            <!-- Net Received and Employee Signatures -->
                            <td><b><?php echo $row['net_received1']; ?></b></td>
                            <td><b></b></td>
                            <td><b><?php echo $row['net_received2']; ?></b></td>
                            <td><b></b></td>

                            <!-- View Payroll Button -->
                            <td class="text-center">
                                <button class="btn btn-sm btn-outline-primary view_payroll"
                                    data-id="<?php echo $row['id'] ?>" type="button">
                                    <i class="fa fa-eye"></i>
                                </button>
                            </td>
                        </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>





    <script type="text/javascript">
    $(document).ready(function() {
        $('#table').DataTable();
    });
    </script>
    <script type="text/javascript">
    $(document).ready(function() {
        $('#table').DataTable();

        $('#print_btn').click(function() {
            var nw = window.open("print_payroll.php?id=", "_blank", "height=500,width=800")
            setTimeout(function() {
                nw.print()
                setTimeout(function() {
                    nw.close()
                }, 500)
            }, 1000)
        })

        $('.view_payroll').click(function() {
            var id = $(this).attr('data-id');
            var employee_id = $(this).attr('data-employee_id');
            uni_modal("Employee Payslip", "view_payslip.php?id=" + id + "&employee_id=" + employee_id,
                "large")
        });

        $('.remove_payroll').click(function() {
            _conf("Are you sure to delete this payroll?", "remove_payroll", [$(this).attr('data-id')])
        })
    });

    function remove_payroll(id) {
        start_load()
        $.ajax({
            url: 'ajax.php?action=delete_payroll',
            method: "POST",
            data: {
                id: id
            },
            error: err => console.log(err),
            success: function(resp) {
                if (resp == 1) {
                    alert_toast("Employee's data successfully deleted", "success");
                    setTimeout(function() {
                        location.reload();
                    }, 1000)
                }
            }
        })
    }
    </script>