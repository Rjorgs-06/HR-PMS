<?php include('db_connect.php');

$user_role = isset($_SESSION['login_type']) ? $_SESSION['login_type'] : 'guest';
$user_name = isset($_SESSION['login_name']) ? $_SESSION['login_name'] : '';


?>


<div class="container-fluid">
    <div class="col-lg-12">
        <div class="card p-4" id="hello">
            <div class="card-header">
                <button class="btn btn-success btn-sm btn-block col-md-2 float-right" type="button" id="export_excel">
                    <span class="fa fa-print"></span> Export Excel
                </button>
            </div>
            <hr>
            <div>
                <div class="d-flex justify-content-center align-items-center " style="width: 100%;">
                    <img src="./assets/img/Evsu-L.png" alt="" style="height: 90px; width: 90px;" class="mx-4">


                    <div>
                        <h1 class="text-center align-middle"
                            style="font-family: Times New Roman, serif; font-size: 50px; font-weight: bold;">
                            Part-Time Employee Payroll
                        </h1>
                        <h3 class="text-center align-middle" style="font-family: Times New Roman, serif;">
                            Eastern Visayas State University
                        </h3>
                        <h5 class="text-center align-middle" style="font-family: Times New Roman, serif;">
                            Carigara - Campus
                        </h5>
                    </div>
                    <img src="./assets/img/BP.png" alt="" style="height: 100px; width: 100px;" class="mx-4">
                </div>
            </div>

            <div class="table-responsive" style="max-height: 350px; overflow-y: auto;">


                <table class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th rowspan="2" class="text-center align-middle">No.</th>
                            <th rowspan="2" class="text-center align-middle">Name</th>
                            <th rowspan="2" class="text-center align-middle">Position</th>
                            <th colspan="5" class="text-center align-middle">Wages</th>
                            <th rowspan="2" class="text-center align-middle">Total Deduction</th>
                            <th rowspan="2" class="text-center align-middle">Net Amount Due</th>
                            <th rowspan="2" class="text-center align-middle">Remarks</th>
                        </tr>
                        <tr>
                            <th colspan="1" class="text-center align-middle">Number of Hours Worked</th>
                            <th colspan="1" class="text-center align-middle">Rate per Hour</th>
                            <th colspan="1" class="text-center align-middle">Underpayment</th>
                            <th colspan="1" class="text-center align-middle">Overtime</th>
                            <th colspan="1" class="text-center align-middle">Grand Total Amount</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $i = 1;

                        if ($user_role == 'employee') {
                            $user_name_escaped = $conn->real_escape_string($user_name);
                            $query = "SELECT w.*, w.employee_id as emp_id, e.* 
                                  FROM wages_parttime AS w 
                                  INNER JOIN employee_parttime AS e ON w.employee_id = e.id 
                                  WHERE e.fullname = '$user_name_escaped'";
                        } else {

                            $query = "SELECT w.*, w.employee_id as emp_id, e.* 
                                  FROM wages_parttime AS w 
                                  INNER JOIN employee_parttime AS e ON w.employee_id = e.id";
                        }

                        $wages_info = $conn->query($query);
                        while ($row = $wages_info->fetch_assoc()) :
                        ?>
                            <tr>
                                <td class="text-center"><?php echo $i++; ?></td>
                                <td><?php echo $row['fullname']; ?></td>
                                <td><?php echo $row['position']; ?></td>
                                <td><?php echo $row['hrs_work']; ?></td>
                                <td><?php echo $row['rate_per_hr']; ?></td>
                                <td><?php echo $row['underpayment']; ?></td>
                                <td><?php echo $row['overtime']; ?></td>
                                <td><?php echo $row['grand_total']; ?></td>
                                <td><?php echo $row['total_deduction']; ?></td>
                                <td><?php echo $row['net_amount']; ?></td>
                                <td></td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>

            </div>
        </div>
    </div>

    <script type="text/javascript">
        $('#export_excel').click(function() {
            let table = document.querySelector("table");
            let clonedTable = table.cloneNode(true);

            // Remove any rowspan or colspan attributes from the cloned table headers
            $(clonedTable).find('th').each(function() {
                $(this).removeAttr('rowspan');
                $(this).removeAttr('colspan');
            });

            let workbook = XLSX.utils.table_to_book(clonedTable, {
                sheet: "Sheet1"
            });
            XLSX.writeFile(workbook, "payroll_data.xlsx");
        });
    </script>