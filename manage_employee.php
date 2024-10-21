<?php
include('db_connect.php');

// Initialize variables
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;
$type = isset($_GET['type']) ? $_GET['type'] : '';

$table = '';
if ($type == 'regular') {
    $table = 'employee_regular';
} elseif ($type == 'parttime') {
    $table = 'employee_parttime';
} elseif ($type == 'cos') {
    $table = 'employee_cos';
}

$meta = array();

if ($id && $table) {
    // Query the appropriate table
    $query = $conn->query("SELECT * FROM $table WHERE id = $id");

    // Fetch the employee data
    if ($query) {
        $user = $query->fetch_assoc();
        $meta = $user;
    }
}

$usersQuery = $conn->query("
    SELECT u.id, u.name
    FROM users u
    LEFT JOIN employee_regular er ON u.name = er.fullname
    LEFT JOIN employee_parttime ep ON u.name = ep.fullname
    LEFT JOIN employee_cos ec ON u.name = ec.fullname
    WHERE er.fullname IS NULL
    AND ep.fullname IS NULL
    AND ec.fullname IS NULL
    AND u.type = 'employee'
");


?>

<!-- HTML Form -->
<div class="container-fluid">
    <form action="" id="manage-employee">
        <input type="hidden" name="id" value="<?php echo isset($meta['id']) ? $meta['id'] : ''; ?>">
        <input type="hidden" name="employee_type" value="<?php echo isset($type) ? $type : ''; ?>">

        <div class="form-group">
            <label for="name">Full Name</label>

            <?php if (empty($id)) { ?>

                <select class="form-control" id="fullname" name="fullname" required>
                    <?php while ($row = $usersQuery->fetch_assoc()): ?>
                        <option value="<?php echo $row['name']; ?>"
                            <?php echo (isset($meta['name']) && $meta['name'] == $row['name']) ? 'selected' : ''; ?>>
                            <?php echo $row['name']; ?>
                        </option>
                    <?php endwhile; ?>
                </select>
            <?php } else { ?>

                <input type="text" class="form-control" id="fullname" name="fullname"
                    value="<?php echo isset($meta['fullname']) ? $meta['fullname'] : ''; ?>" required readonly>
            <?php } ?>
        </div>

        <div class="form-group">
            <label for="position">Position</label>
            <input type="text" class="form-control" id="position" name="position"
                value="<?php echo isset($meta['position']) ? $meta['position'] : ''; ?>" required>
        </div>

        <?php if ($type == 'regular') { ?>
            <div class="form-group">
                <label for="employee_id">Employee ID</label>
                <input type="text" name="employee_id" id="employee_id" class="form-control"
                    value="<?php echo isset($meta['employee_id']) ? $meta['employee_id'] : ''; ?>" required>
            </div>
        <?php } elseif ($type == 'parttime') { ?>
            <div class="form-group">
                <label for="category">Category</label>
                <select name="category" id="category" class="form-control" required>
                    <option value="">Select Category</option>
                    <option value="MASTER"
                        <?php echo (isset($meta['category']) && $meta['category'] == 'MASTER') ? 'selected' : ''; ?>>MASTER
                    </option>
                    <option value="NONMASTER"
                        <?php echo (isset($meta['category']) && $meta['category'] == 'NONMASTER') ? 'selected' : ''; ?>>
                        NONMASTER</option>
                    <option value="DOCTOR"
                        <?php echo (isset($meta['category']) && $meta['category'] == 'DOCTOR') ? 'selected' : ''; ?>>DOCTOR
                    </option>
                </select>
            </div>
        <?php } ?>

    </form>
</div>

<script>
    $(document).ready(function() {
        $('#manage-employee').submit(function(e) {
            var employeeType = "<?php echo $type; ?>";
            var linkUrl = '';

            if (employeeType == "regular") {
                linkUrl = 'ajax.php?action=save_employee';
            } else if (employeeType == "parttime") {
                linkUrl = 'ajax.php?action=save_parttime';
            } else if (employeeType == "cos") {
                linkUrl = 'ajax.php?action=save_cos';
            }

            e.preventDefault();
            $.ajax({
                url: linkUrl,
                type: 'POST',
                data: $(this).serialize(),
                success: function(response) {
                    if (response == 1) {
                        alert_toast("Employee's data successfully saved", "success");
                        setTimeout(function() {
                            location.reload();
                        }, 1500);
                    } else if (response == 3) {
                        alert_toast("Employee name already exists!", "danger");
                    } else {
                        alert("An error occurred while saving employee data");
                    }
                }
            });
        });
    });
</script>