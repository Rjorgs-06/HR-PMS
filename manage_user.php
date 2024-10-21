<?php
include('db_connect.php');
if (isset($_GET['id'])) {
    $user = $conn->query("SELECT * FROM users where id =" . $_GET['id']);
    foreach ($user->fetch_array() as $k => $v) {
        $meta[$k] = $v;
    }
}
?>
<div class="container-fluid">

    <form action="" id="manage-user">
        <input type="hidden" name="id" value="<?php echo isset($meta['id']) ? $meta['id'] : '' ?>">
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" name="name" id="name" class="form-control"
                value="<?php echo isset($meta['name']) ? $meta['name'] : '' ?>" required>
        </div>
        <div class="form-group">
            <label for="username">Username</label>
            <input type="text" name="username" id="username" class="form-control"
                value="<?php echo isset($meta['username']) ? $meta['username'] : '' ?>" required>
        </div>
        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" name="password" id="password" class="form-control"
                value="<?php echo isset($meta['password']) ? $meta['password'] : '' ?>" required>
        </div>
        <div class="form-group">
            <label for="type">User Type</label>
            <select name="type" id="type" class="custom-select">
                <option value="Admin" <?php echo isset($meta['type']) && $meta['type'] == 1 ? 'selected' : '' ?>>Admin
                </option>
                <option value="Employee" <?php echo isset($meta['type']) && $meta['type'] == 2 ? 'selected' : '' ?>>
                    Employee</option>
            </select>

        </div>
    </form>
</div>
<script>
    $('#manage-user').submit(function(e) {
        e.preventDefault();
        let name = $('#name').val().trim();
        let username = $('#username').val().trim();
        let password = $('#password').val().trim();

        if (!name || !username || !password) {
            alert_toast('Please fill in all required fields.', 'danger');
            return false;
        }
        start_load()
        $.ajax({
            url: 'ajax.php?action=save_user',
            method: 'POST',
            data: $(this).serialize(),
            success: function(resp) {
                if (resp == 1) {
                    alert_toast('User successfully saved', 'success');
                    setTimeout(function() {
                        location.reload();
                    }, 1500);
                } else {
                    alert_toast('Error saving user', 'danger');
                }
                end_load();
            }
        })
    })
</script>