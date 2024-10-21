<?php include('db_connect.php') ?>

<div class="container-fluid ">
    <div class="col-lg-12">

        <br />
        <br />
        <div class="card p-4">
            <!-- <div class="card-header">
				<button class="btn btn-success btn-sm btn-block col-md-2 float-right" type="button" id="print_btn"><span class="fa fa-print"></span> Print</button>
			</div> -->

            <hr>
            <table id="table" class="table table-bordered table-striped ">
                <thead>
                    <tr>
                        <th>Employee ID</th>
                        <th>FullName</th>
                        <!-- <th>Absent</th> -->
                        <!-- <th>Late</th> -->
                        <th>Salary</th>
                        <!-- <th>Total Allowance</th> -->
                        <th>Total Deduction</th>
                        <th>Net</th>
                        <!-- <th>Action</th> -->
                    </tr>
                </thead>
                <tbody>
                    <?php

					$payroll = $conn->query("SELECT DISTINCT p.*,concat(e.fullname) as ename, e.employee_no FROM payroll_items p INNER JOIN employee e ON e.id = p.employee_id");
					while ($row = $payroll->fetch_array()) {
					?>
                    <tr>
                        <!-- <?php var_dump($row['ename']) ?> -->
                        <td><?php echo $row['employee_no'] ?></td>
                        <td><?php echo ucwords($row['ename']) ?></td>
                        <!-- <td><?php echo $row['absent'] ?></td> -->
                        <!-- <td><?php echo $row['late'] ?></td> -->
                        <td><?php echo $row['salary'] ?></td>
                        <!-- <td><?php echo number_format($row['allowance_amount'], 2) ?></td> -->
                        <td><?php echo number_format($row['deduction_amount'], 2) ?></td>
                        <td><?php echo number_format($row['net'], 2) ?></td>
                        <!-- <td>
								<center>
									<button class="btn btn-sm btn-outline-primary view_payroll" data-id="<?php echo $row['id'] ?>" data-employee_id="<?php echo $row['employee_id'] ?>" type="button"><i class="fa fa-eye"></i> View</button>
									<button class="btn btn-sm btn-outline-danger remove_payroll" data-id="<?php echo $row['id'] ?>" type="button"><i class="fa fa-trash"></i></button>
								</center>
							</td> -->
                    </tr>
                    <?php
					}
					?>
                </tbody>
            </table>
        </div>
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
        var nw = window.open("print_payroll.php?id=2", "_blank", "height=500,width=800")
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