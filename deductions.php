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

/* .card {
        background: #d1d3e0;
    } */

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
    <div class=" col-lg-12">
        <div class="new">
            <div class="row">
                <!-- wage form START -->
                <div class="col-md-4">
                    <form action="" id="manage-deductions">
                        <div class="card shadow mb-4" style="height:600px;">
                            <div class=" card-header">Employee Wages Form</div>
                            <div class="card-body " style="overflow-y:scroll;">
                                <input type="hidden" name="id">
                                <input type="hidden" name="net_received1" id="net_received1">
                                <input type="hidden" name="net_received2" id="net_received2">
                                <!-- Employee Name -->
                                <div class=" form-group">
                                    <label class="control-label">Employee Name</label>
                                    <select class="custom-select browser-default select2 form-control"
                                        name="employee_id">
                                        <option value="">Please Select Employee</option>
                                        <?php
                                        $dept = $conn->query("SELECT * from employee order by fullname asc");
                                        while ($row = $dept->fetch_assoc()) :
                                        ?>
                                        <option value="<?php echo $row['id']; ?>"><?php echo $row['fullname']; ?>
                                        </option>
                                        <?php endwhile; ?>
                                    </select>
                                </div>

                                <!-- Monthly Salary -->
                                <div class="form-group">
                                    <label class="control-label">Monthly Salary</label>
                                    <!-- <input name="monthly_salary" id="monthly_salary" class="form-control"
                                        required /> -->
                                    <input class="form-control" name="monthly_salary" id="monthly_salary"
                                        onchange="calculateGross()" />
                                </div>

                                <!-- PERA -->
                                <div class="form-group">
                                    <label class="control-label">PERA</label>
                                    <!-- <input name="pera" id="pera" class="form-control" required /> -->
                                    <input class="form-control" name="pera" id="pera" onchange="calculateGross()" />
                                </div>

                                <!-- Gross Amount Earned (Disabled) -->
                                <div class="form-group">
                                    <label class="control-label">Gross Amount Earned</label>
                                    <input name="gross_amount_earned" id="gross_amount_earned" class="form-control"
                                        readonly />
                                </div>

                                <!-- Deductions -->
                                <div class="form-group">
                                    <label class="control-label">PAGIBIG - PS</label>
                                    <input name="pagibig_ps" id="pagibig_ps" class="form-control deduction" readonly />
                                </div>

                                <div class="form-group">
                                    <label class="control-label">PAGIBIG - GS</label>
                                    <input name="pagibig_gs" id="pagibig_gs" class="form-control deduction" readonly />
                                </div>

                                <div class="form-group">
                                    <label class="control-label">PAGIBIG - MP3</label>
                                    <input name="pagibig_mp3" class="form-control deduction"
                                        oninput="calculateTotal()" />
                                </div>

                                <div class="form-group">
                                    <label class="control-label">GSIS - PS</label>
                                    <input name="gsis_ps" id="gsis_ps" class="form-control deduction" readonly />
                                </div>

                                <div class="form-group">
                                    <label class="control-label">GSIS - GS</label>
                                    <input name="gsis_gs" id="gsis_gs" class="form-control deduction" readonly />
                                </div>

                                <div class="form-group">
                                    <label class="control-label">SIF</label>
                                    <input name="sif" class="form-control deduction" oninput="calculateTotal()" />
                                </div>

                                <div class="form-group">
                                    <label class="control-label">PhilHealth - PS</label>
                                    <input name="philhealth_ps" id="philhealth_ps" class="form-control deduction"
                                        readonly />
                                </div>

                                <div class="form-group">
                                    <label class="control-label">PhilHealth - GS</label>
                                    <input name="philhealth_gs" id="philhealth_gs" class="form-control deduction"
                                        readonly />
                                </div>

                                <div class="form-group">
                                    <label class="control-label">Withholding Tax</label>
                                    <input name="withholding_tax" class="form-control deduction"
                                        oninput="calculateTotal()" />
                                </div>

                                <div class="form-group">
                                    <label class="control-label">PRG</label>
                                    <input name="prg" class="form-control deduction" oninput="calculateTotal()" />
                                </div>

                                <div class="form-group">
                                    <label class="control-label">CNL</label>
                                    <input name="cnl" class="form-control deduction" oninput="calculateTotal()" />
                                </div>

                                <div class="form-group">
                                    <label class="control-label">EML</label>
                                    <input name="eml" class="form-control deduction" oninput="calculateTotal()" />
                                </div>

                                <div class="form-group">
                                    <label class="control-label">MPL</label>
                                    <input name="mpl" class="form-control deduction" oninput="calculateTotal()" />
                                </div>

                                <div class="form-group">
                                    <label class="control-label">GFAL</label>
                                    <input name="gfal" class="form-control deduction" oninput="calculateTotal()" />
                                </div>

                                <div class="form-group">
                                    <label class="control-label">CPL</label>
                                    <input name="cpl" class="form-control deduction" oninput="calculateTotal()" />
                                </div>

                                <div class="form-group">
                                    <label class="control-label">HELP</label>
                                    <input name="help" class="form-control deduction" oninput="calculateTotal()" />
                                </div>

                                <div class="form-group">
                                    <label class="control-label">CFI</label>
                                    <input name="cfi" class="form-control deduction" oninput="calculateTotal()" />
                                </div>

                                <div class="form-group">
                                    <label class="control-label">CSB</label>
                                    <input name="csb" class="form-control deduction" oninput="calculateTotal()" />
                                </div>

                                <!-- Total Deduction -->
                                <div class="form-group">
                                    <label class="control-label">Total Deduction</label>
                                    <input name="total_deduction" id="total_deduction" class="form-control" readonly />
                                </div>

                                <!-- Net Salary -->
                                <div class="form-group">
                                    <label class="control-label">Net Salary</label>
                                    <input name="net_salary" id="net_salary" class="form-control" readonly />
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


                <!-- wage form FINISH -->

                <!-- Table Panel -->
                <div class="col-md-8">
                    <div class="card shadow mb-4">
                        <div class="card-body">
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
                                            <th rowspan="3" class="text-center align-middle">Net Received for July
                                                (1-15)</th>
                                            <th rowspan="3" class="text-center align-middle">Signature of Employee
                                            </th>
                                            <th rowspan="3" class="text-center align-middle">Net Received for July
                                                (16-31)</th>
                                            <th rowspan="3" class="text-center align-middle">Signature of Employee
                                            </th>
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

                                            </th>
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
                                            <!-- <td class="text-center">
                                    <button class="btn btn-sm btn-outline-primary view_payroll"
                                        data-id="<?php echo $row['id'] ?>" type="button">
                                        <i class="fa fa-eye"></i>
                                    </button>
                                </td> -->
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
    $(' [name="id" ]').val('');
    $('#manage-deductions').get(0).reset();
    $('.select2').val('').trigger('change');
}

function calculateGross() {
    var monthly_salary = parseFloat(document.getElementById('monthly_salary').value) || 0;
    var pera = parseFloat(document.getElementById('pera').value) || 0;
    var gross = monthly_salary + pera;

    document.getElementById('gross_amount_earned').value = gross.toFixed(2);

    var ps_percentage = 0.09;
    var gs_percentage = 0.12;
    var phil_percentage = 0.025;
    var pagibig_ps = monthly_salary * ps_percentage;
    var gsis_ps = monthly_salary * ps_percentage;
    var pagibig_gs = monthly_salary * gs_percentage;
    var gsis_gs = monthly_salary * gs_percentage;
    var phil_ps = monthly_salary * phil_percentage;
    var phil_gs = monthly_salary * phil_percentage;

    document.getElementById('pagibig_ps').value = pagibig_ps.toFixed(2);
    document.getElementById('gsis_ps').value = gsis_ps.toFixed(2);
    document.getElementById('pagibig_gs').value = pagibig_gs.toFixed(2);
    document.getElementById('gsis_gs').value = gsis_gs.toFixed(2);
    document.getElementById('philhealth_ps').value = phil_ps.toFixed(2);
    document.getElementById('philhealth_gs').value = phil_gs.toFixed(2);

    calculateTotal();
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
    var gross = parseFloat(document.getElementById('gross_amount_earned').value) || 0;
    var total_deduction = parseFloat(document.getElementById('total_deduction').value) || 0;

    var net_salary = gross - total_deduction;
    document.getElementById('net_salary').value = net_salary.toFixed(2);

    // Set net_received1 and net_received2 to half of the net_salary
    var half_net_salary = net_salary / 2;

    document.getElementById('net_received1').value = half_net_salary.toFixed(2);
    document.getElementById('net_received2').value = half_net_salary.toFixed(2);
}

$(document).ready(function() {
    $('.select2').select2();
    $('#manage-deductions').submit(function(e) {
        e.preventDefault();
        var formData = new FormData($(this)[0]);

        // // Debugging: Log the form data to the console
        // for (var pair of formData.entries()) {
        //     console.log(pair[0] + ', ' + pair[1]);
        // }

        $.ajax({
            url: 'ajax.php?action=save_wages',
            data: formData,
            cache: false,
            contentType: false,
            processData: false,
            method: 'POST',
            type: 'POST',
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
    // $('.edit_deductions').click(function() {
    //         var
    //             form = $('#manage-deductions');
    //         form.get(0).reset();
    //         form.find(
    //             " [name='id' ] ").val($(this).attr('data-id'));
    //         form.find(" [name = 'employee_id']
    //             ").val($(this).attr('data-employee_id')).trigger('change'); form.find(" [
    //                 name = 'no_of_hours'
    //             ]
    //             ").val($(this).attr('data-no_of_hours')); form.find(" [name = 'rate_per_hour']
    //             ").val($(this).attr('data-rate_per_hour')); form.find(" [name = 'undertime']
    //             ").val($(this).attr('data-undertime')); form.find(" [name = 'overtime']
    //             ").val($(this).attr('data-overtime')); }); $('.delete_deductions').click(function() { _conf("
    //             Are you sure to delete this employee wages information ? ", "
    //             delete_deductions " , [$(this)
    //             .attr('data-id')]);
    // });
});

function delete_deductions(id) {
    $.ajax({
        url: 'ajax.php?action=delete_deductions',
        method: 'POST',
        data: {
            id: id
        },
        success: function(resp) {
            if (resp == 1) {
                alert_toast(" Data successfully deleted", 'success');
                setTimeout(function() {
                    location.reload();
                }, 1500);
            }
        }
    });
}
</script>