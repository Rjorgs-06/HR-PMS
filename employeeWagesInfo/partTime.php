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
                <div class="col-md-4">
                    <form action="" id="manage-deductions">
                        <div class="card shadow mb-4" style="height:600px;">
                            <div class="card-header">Employee Deduction Form</div>
                            <div class="card-body" style="overflow-y:scroll;">
                                <input type="hidden" name="id">


                                <div class="form-group">
                                    <label class="control-label">Employee Name</label>
                                    <select class="custom-select browser-default select2 form-control" required
                                        name="employee_id">
                                        <option value="">Please Select Employee</option>
                                        <?php

                                        $dept = $conn->query("SELECT * from employee_parttime order by fullname asc");
                                        while ($row = $dept->fetch_assoc()) :
                                        ?>
                                        <option value="<?php echo $row['id']; ?>"><?php echo $row['fullname']; ?>
                                        </option>
                                        <?php endwhile; ?>
                                    </select>
                                </div>

                                <!-- <div class="form-group">
                                    <label class="control-label">Number of days Worked (REGULAR LOAD)</label>
                                    <input name="days_work" id="days_work" class="form-control" required />
                                </div> -->

                                <div class="form-group">
                                    <label class="control-label">Number of hours Worked (Make-up class)</label>
                                    <input class="form-control" name="hrs_work" id="hrs_work"
                                        onchange="calculateGross()" />
                                </div>

                                <div class="form-group">
                                    <label class="control-label">Rate per hour</label>
                                    <input name="rate_per_hr" id="rate_per_hr" class="form-control"
                                        onchange="calculateGross()" />
                                </div>

                                <div class="form-group">
                                    <label class="control-label">Underpayment</label>
                                    <input name="underpayment" id="underpayment" class="form-control deduction"
                                        onchange="calculateTotal()" />
                                </div>

                                <div class="form-group">
                                    <label class="control-label">Overtime</label>
                                    <input name="overtime" id="overtime" class="form-control"
                                        onchange="calculateGross()" />
                                </div>

                                <!-- <div class="form-group">
                                    <label class="control-label">SSS Contribution</label>
                                    <input name="sss" id="sss" class="form-control deduction"
                                        oninput="calculateTotal()" />
                                </div> -->
                                <div class="form-group">
                                    <label class="control-label">Grand Total Amount</label>
                                    <input name="grand_total" id="grand_total" class="form-control" readonly />
                                </div>

                                <div class="form-group">
                                    <label class="control-label">Total Deduction</label>
                                    <input name="total_deduction" id="total_deduction" class="form-control " readonly />
                                </div>

                                <div class="form-group">
                                    <label class="control-label">Net Amount Due</label>
                                    <input name="net_amount" id="net_amount" class="form-control" readonly />
                                </div>
                            </div>
                            <div class="card-footer">
                                <div class="row">
                                    <div class="col-md-12">
                                        <button class="btn btn-sm btn-primary col-sm-3 offset-md-3"
                                            type="submit">Save</button>
                                        <button class="btn btn-sm btn-default col-sm-3" type="button"
                                            onclick="_reset()">Cancel</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>

                <div class="col-md-8">
                    <div class="card shadow mb-4">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th rowspan="3" class="text-center align-middle">ID</th>
                                            <th rowspan="3" class="text-center align-middle">Name</th>
                                            <th rowspan="3" class="text-center align-middle">Position</th>
                                            <th colspan="5" class="text-center align-middle">Wages</th>
                                            <th rowspan="3" class="text-center align-middle">Total Deduction</th>
                                            <th rowspan="3" class="text-center align-middle">Net Amount Due</th>
                                            <th rowspan="3" class="text-center align-middle">Remarks</th>
                                            <th rowspan="6" class="text-center align-middle">Action</th>
                                        </tr>
                                        <tr>
                                            <!-- <th colspan="1" rowspan="2" class="text-center align-middle">Number of
                                                daysWorked
                                                (REGULAR LOAD)
                                            </th> -->
                                            <th colspan="1" class="text-center align-middle">Number of hours Worked
                                                (Make-up class)
                                            </th>
                                            <th colspan="1" class="text-center align-middle">Rate per hour</th>
                                            <th colspan="1" class="text-center align-middle">Underpayment</th>
                                            <th colspan="1" class="text-center align-middle">Overtime</th>
                                            <th colspan="1" class="text-center align-middle">Grand Total Amount</th>

                                        </tr>

                                    </thead>
                                    <tbody>
                                        <?php
                                        $i = 1;
                                        $wages_info = $conn->query("
                                            SELECT 
        w.*,  
        e.fullname, e.position 
    FROM wages_parttime AS w
    INNER JOIN employee_parttime AS e 
        ON w.employee_id = e.id
                                        ");

                                        while ($row = $wages_info->fetch_assoc()) :
                                            $grand_total = ($row['hrs_work'] * $row['rate_per_hr']);
                                        ?>
                                        <tr>
                                            <td class="text-center"><?php echo $i++; ?></td>
                                            <td><b><?php echo $row['fullname']; ?></b></td>
                                            <td><b><?php echo $row['position']; ?></b></td>
                                            <!-- <td><b><?php echo $row['days_work']; ?></b></td> -->
                                            <td><b><?php echo $row['hrs_work']; ?></b></td>
                                            <td><b><?php echo $row['rate_per_hr']; ?></b></td>
                                            <td><b><?php echo $row['underpayment']; ?></b></td>
                                            <td><b><?php echo $row['overtime']; ?></b></td>
                                            <td><b><?php echo $row['grand_total']; ?></b></td>
                                            <td><b><?php echo $row['total_deduction']; ?></b></td>
                                            <td><b><?php echo $row['net_amount']; ?></b></td>
                                            <td></td>
                                            <td>
                                                <center>
                                                    <button class="btn btn-sm btn-outline-primary edit_employee"
                                                        data-id="<?php echo $row['id'] ?>" type="button">
                                                        <i class="fa fa-edit"></i>
                                                    </button>
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
    var hrs_work = parseFloat(document.getElementById('hrs_work').value) || 0;
    var rate_per_hr = parseFloat(document.getElementById('rate_per_hr').value) || 0;
    var overtime = parseFloat(document.getElementById('overtime').value) || 0;

    var total = hrs_work * rate_per_hr;
    var grand_total = total + overtime;
    document.getElementById('grand_total').value = grand_total.toFixed(2);
    calculateNetSalary();
}

function calculateTotal() {
    var total = 0;
    var inputs = document.getElementsByClassName('deduction');

    for (var i = 0; i < inputs.length; i++) {
        var value = parseFloat(inputs[i].value) || 0;
        total += value;
    }

    document.getElementById('total_deduction').value = total.toFixed(2);
    calculateNetSalary();
}

function calculateNetSalary() {
    var grand_total = parseFloat(document.getElementById('grand_total').value) || 0;
    var total_deduction = parseFloat(document.getElementById('total_deduction').value) || 0;

    var net_salary = grand_total - total_deduction;
    document.getElementById('net_amount').value = net_salary.toFixed(2);
}

$(document).ready(function() {
    $('.select2').select2();

    $('.edit_employee').click(function() {
        var id = $(this).attr('data-id');


        $.ajax({
            url: 'ajax.php?action=get_wages_parttime',
            method: 'POST',
            data: {
                id: id
            },
            success: function(resp) {
                if (resp) {
                    var data = JSON.parse(resp);


                    $('[name="id"]').val(data.id);
                    $('[name="employee_id"]').val(data.employee_id).trigger('change');
                    // $('[name="days_work"]').val(data.days_work);
                    $('[name="hrs_work"]').val(data.hrs_work);
                    $('[name="rate_per_hr"]').val(data.rate_per_hr);
                    $('[name="underpayment"]').val(data.underpayment);
                    $('[name="overtime"]').val(data.overtime);
                    $('[name="sss"]').val(data.sss);
                    $('[name="total_deduction"]').val(data.total_deduction);
                    $('[name="net_amount"]').val(data.net_amount);
                    $('[name="grand_total"]').val(data.grand_total);

                    calculateGross();
                    calculateTotal();
                }
            }
        });
    });


    $('#manage-deductions').submit(function(e) {
        e.preventDefault();
        var formData = new FormData($(this)[0]);

        $.ajax({
            url: 'ajax.php?action=save_wages_parttime',
            data: formData,
            cache: false,
            contentType: false,
            processData: false,
            method: 'POST',
            success: function(resp) {
                if (resp == 1) {
                    alert_toast("Data successfully added ", 'success');
                    setTimeout(function() {
                        location.reload();
                    }, 1500);
                } else if (resp == 2) {
                    alert_toast("Data successfully updated", 'success');
                    setTimeout(function() {
                        location.reload();
                    }, 1500);
                } else if (resp == 3) {
                    alert_toast("Employee already exists ", 'danger');
                }
            }
        });
    });
});
</script>