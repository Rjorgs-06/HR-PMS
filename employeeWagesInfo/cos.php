<?php include('db_connect.php'); ?>
<style>
.card-header,
.control-label {
    color: black;
}

.row {
    display: flex;
    flex-wrap: nowrap;
}

.new {
    padding: 10px;
    width: 100%;
    height: 100%;
    background: #d1d3e0;
    background-size: cover;
}

td,
tr {
    background-color: #fafafa;
    vertical-align: middle !important;
}

td p {
    margin: unset;
}

img {
    max-width: 100px;
    max-height: 150px;
}
</style>

<div class="container-fluid">
    <div class="col-lg-12">
        <div class="new">
            <div class="row">
                <!-- Wage Form START -->
                <div class="col-md-4">
                    <form action="" id="manage-deductions">
                        <div class="card shadow mb-4" style="height:600px;">
                            <div class="card-header">Employee Deduction Form</div>
                            <div class="card-body" style="overflow-y:scroll;">
                                <input type="hidden" name="id">


                                <!-- Employee Name -->
                                <div class="form-group">
                                    <label class="control-label">Employee Name</label>
                                    <select class="custom-select browser-default select2 form-control"
                                        name="employee_id" required>
                                        <option value="">Please Select Employee</option>
                                        <?php
                                        $dept = $conn->query("SELECT * FROM employee_cos ORDER BY fullname ASC");
                                        while ($row = $dept->fetch_assoc()) :
                                        ?>
                                        <option value="<?php echo $row['id']; ?>"><?php echo $row['fullname']; ?>
                                        </option>
                                        <?php endwhile; ?>
                                    </select>
                                </div>

                                <!-- Number of Days Worked -->
                                <div class="form-group">
                                    <label class="control-label">Number of Days Worked</label>
                                    <input class="form-control" name="days_work" id="days_work"
                                        onchange="calculateGross()" required />
                                </div>

                                <!-- Rate per Hour -->
                                <div class="form-group">
                                    <label class="control-label">Rate per Hour</label>
                                    <input class="form-control" name="rate_per_hour" id="rate_per_hour"
                                        onchange="calculateGross()" required />
                                </div>

                                <!-- Tardiness -->
                                <div class="form-group">
                                    <label class="control-label">Tardiness</label>
                                    <input class="form-control" name="tardiness" id="tardiness"
                                        onchange="calculateGross()" />
                                </div>

                                <!-- Overtime -->
                                <div class="form-group">
                                    <label class="control-label">Overtime</label>
                                    <input class="form-control" name="overtime" id="overtime"
                                        onchange="calculateGross()" />
                                </div>

                                <!-- Undertime -->
                                <div class="form-group">
                                    <label class="control-label">Undertime</label>
                                    <input class="form-control" name="undertime" id="undertime"
                                        onchange="calculateGross()" />
                                </div>

                                <!-- Grand Total Amount -->
                                <div class="form-group">
                                    <label class="control-label">Grand Total Amount</label>
                                    <input name="grand_total" id="grand_total" class="form-control" readonly />
                                </div>

                                <!-- SSS Contribution -->
                                <div class="form-group">
                                    <label class="control-label">SSS Contribution</label>
                                    <input name="sss" id="sss" class="form-control" oninput="calculateTotal()" />
                                </div>

                                <!-- Total Deduction -->
                                <div class="form-group">
                                    <label class="control-label">Total Deduction</label>
                                    <input name="total_deduction" id="total_deduction" class="form-control" readonly />
                                </div>

                                <!-- Net Amount Due -->
                                <div class="form-group">
                                    <label class="control-label">Net Amount Due</label>
                                    <input name="net_amount" id="net_amount" class="form-control" readonly />
                                </div>
                            </div>
                            <div class="card-footer">
                                <div class="row">
                                    <div class="col-md-12">
                                        <button class="btn btn-sm btn-primary col-sm-3 offset-md-3">Save</button>
                                        <button class="btn btn-sm btn-default col-sm-3" type="button"
                                            onclick="_reset()">Cancel</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <!-- Wage Form FINISH -->

                <!-- Table Panel -->
                <div class="col-md-8">
                    <div class="card shadow mb-4">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th rowspan="3" class="text-center align-middle">No</th>
                                            <th rowspan="3" class="text-center align-middle">Name</th>
                                            <th rowspan="3" class="text-center align-middle">Position</th>
                                            <th colspan="6" class="text-center align-middle">WAGES</th>

                                            <th rowspan="3" class="text-center align-middle">SSS Contribution</th>
                                            <th rowspan="3" class="text-center align-middle">Total Deduction</th>
                                            <th rowspan="3" class="text-center align-middle">Net Amount Due</th>
                                            <th rowspan="3" class="text-center align-middle">Remarks</th>
                                            <th rowspan="3" class="text-center align-middle">Action</th>
                                        </tr>

                                        <tr>
                                            <th colspan="1" rowspan="2" class="text-center align-middle">Number of Days
                                                Worked</th>
                                            <th colspan="1" class="text-center align-middle">Rate per Hour</th>
                                            <th colspan="1" class="text-center align-middle">Tardiness</th>
                                            <th colspan="1" class="text-center align-middle">Overtime</th>
                                            <th colspan="1" class="text-center align-middle">Undertime</th>
                                            <th colspan="1" class="text-center align-middle">Grand Total Amount</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $i = 1;
                                        $wages_info = $conn->query("
                            SELECT 
                                w.*, 
                                e.fullname, 
                                e.position 
                            FROM wages_cos AS w 
                            INNER JOIN employee_cos AS e ON w.employee_id = e.id
                        ");
                                        while ($row = $wages_info->fetch_assoc()) :
                                        ?>
                                        <tr>
                                            <td class="text-center"><?php echo $i++; ?></td>
                                            <td><?php echo $row['fullname']; ?></td>
                                            <td><?php echo $row['position']; ?></td>
                                            <td><?php echo $row['days_work']; ?></td>
                                            <td><?php echo $row['rate_per_hour']; ?></td>
                                            <td><?php echo $row['tardiness']; ?></td>
                                            <td><?php echo $row['overtime']; ?></td>
                                            <td><?php echo $row['undertime']; ?></td>
                                            <td><?php echo $row['grand_total']; ?></td>
                                            <td><?php echo $row['sss']; ?></td>
                                            <td><?php echo $row['total_deduction']; ?></td>
                                            <td><?php echo $row['net_amount']; ?></td>
                                            <td></td>

                                            <td>
                                                <center>
                                                    <button class="btn btn-sm btn-outline-primary edit-deductions"
                                                        data-id="<?php echo $row['id'] ?>" type="button"><i
                                                            class="fa fa-edit"></i></button>
                                                </center>
                                            </td>
                                        </tr>
                                        <?php endwhile; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Table Panel -->
            </div>
        </div>
    </div>
</div>

<script>
function _reset() {
    $('[name="id"]').val('');
    $('#manage-deductions').get(0).reset();
    $('.select2').val('').trigger('change');
}

function calculateGross() {
    var days_work = parseFloat(document.getElementById('days_work').value) || 0;
    var rate_per_hour = parseFloat(document.getElementById('rate_per_hour').value) || 0;
    var overtime = parseFloat(document.getElementById('overtime').value) || 0;

    var total = days_work * rate_per_hour;
    var grand_total = total + overtime;

    document.getElementById('grand_total').value = grand_total.toFixed(2);

    calculateTotal(); // Proceed to next calculation if necessary
}

function calculateTotal() {
    var sss = parseFloat(document.getElementById('sss').value) || 0;
    var undertime = parseFloat(document.getElementById('undertime').value) || 0;

    var total = sss + undertime;

    document.getElementById('total_deduction').value = total.toFixed(2);
    calculateNetSalary();
}

function calculateNetSalary() {
    var grand_total = parseFloat(document.getElementById('grand_total').value) || 0;
    var total_deduction = parseFloat(document.getElementById('total_deduction').value) || 0;

    var net_amount = grand_total - total_deduction;
    document.getElementById('net_amount').value = net_amount.toFixed(2);
}

$(document).ready(function() {
    $('.select2').select2();

    $('.edit-deductions').click(function() {
        const id = $(this).data('id');


        $.ajax({
            url: 'ajax.php?action=get_wages_cos',
            method: 'GET',
            data: {
                id: id
            },
            dataType: 'json',
            success: function(resp) {
                if (resp) {

                    $('[name="id"]').val(resp.id);
                    $('[name="employee_id"]').val(resp.employee_id).trigger('change');
                    $('[name="days_work"]').val(resp.days_work);
                    $('[name="rate_per_hour"]').val(resp.rate_per_hour);
                    $('[name="tardiness"]').val(resp.tardiness);
                    $('[name="overtime"]').val(resp.overtime);
                    $('[name="undertime"]').val(resp.undertime);
                    $('[name="grand_total"]').val(resp.grand_total);
                    $('[name="sss"]').val(resp.sss);
                    $('[name="total_deduction"]').val(resp.total_deduction);
                    $('[name="net_amount"]').val(resp.net_amount);


                    $('html, body').animate({
                        scrollTop: $("#manage-deductions").offset().top
                    }, 500);
                }
            }
        });
    });


    $('#manage-deductions').submit(function(e) {
        e.preventDefault();

        // Validate Employee Name selection
        var employeeId = $('[name="employee_id"]').val();
        if (!employeeId) {
            alert_toast("Please select an employee.", 'danger'); // Use toast notification
            return; // Exit the function if validation fails
        } else {
            var formData = new FormData($(this)[0]);

            $.ajax({
                url: 'ajax.php?action=save_wages_cos',
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                method: 'POST',
                type: 'POST',
                success: function(resp) {
                    if (resp == 1) {
                        alert_toast("Data successfully added", 'success');
                        setTimeout(function() {
                            location.reload();
                        }, 1500);
                    } else if (resp == 2) {
                        alert_toast("Data successfully updated", 'success');
                        setTimeout(function() {
                            location.reload();
                        }, 1500);
                    } else if (resp == 3) {
                        alert_toast("Employee already exists", 'danger');
                    }
                }
            });
        }
    });
});
</script>