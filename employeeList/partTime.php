<?php
include('db_connect.php');
$currentMonth = date('F');
?>
<div class="new">
    <div class="card">
        <div class="card-header">
            <span><b>Part-Time list</b></span>
            <button class="btn btn-primary btn-sm btn-block col-md-3 float-right" type="button" id="new_emp_btn"><span
                    class="fa fa-plus"></span> Add Employee</button>
        </div>
        <div class="card-body">
            <table id="table" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>Fullname</th>
                        <th>Position</th>
                        <th>Category</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $d_arr[0] = "Unset";
                    $p_arr[0] = "Unset";
                    $employee_qry = $conn->query("SELECT * FROM employee_parttime");
                    while ($row = $employee_qry->fetch_array()) {
                    ?>
                    <tr>
                        <td><?php echo $row['fullname']; ?></td>
                        <td><?php echo $row['position']; ?></td>
                        <td><?php echo $row['category']; ?></td>

                        <td>
                            <center>
                                <button class="btn btn-sm btn-outline-primary edit_employee"
                                    data-id="<?php echo $row['id'] ?>" type="button"><i class="fa fa-edit"></i></button>
                                <!-- <button class="btn btn-sm btn-outline-danger remove_employee"
                                        data-id="<?php echo $row['id'] ?>" type="button"><i
                                            class="fa fa-trash"></i></button> -->
                            </center>
                        </td>
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
<style>
.row {
    display: flex;
    flex-wrap: nowrap;
}

.card {
    background: #d1d3e0;

}

td {
    background-color: #fafafa;

}

td,
th {
    vertical-align: middle !important;
}
</style>

<!-- JavaScript Functionality -->
<script type="text/javascript">
$(document).ready(function() {
    $('#table').DataTable();

    // Edit employee
    $('.edit_employee').click(function() {
        var id = $(this).attr('data-id');
        uni_modal("Edit Employee", "manage_employee.php?id=" + id + "&type=parttime");
    });

    // New employee
    $('#new_emp_btn').click(function() {
        uni_modal("New Employee", "manage_employee.php?type=parttime");
    });

    // Remove employee
    $('.remove_employee').click(function() {
        var id = $(this).attr('data-id');
        _conf("Are you sure to delete this employee?", "remove_employee", [id]);
    });
});

// Remove employee function
function remove_employee(id) {
    start_load();
    $.ajax({
        url: 'ajax.php?action=delete_employee',
        method: 'POST',
        data: {
            id: id
        },
        error: function(err) {
            console.log(err);
        },
        success: function(resp) {
            if (resp == 1) {
                alert_toast("Employee's data successfully deleted", "success");
                setTimeout(function() {
                    location.reload();
                }, 1000);
            }
        }
    });
}
</script>