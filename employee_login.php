<!-- <html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <?php include('./header.php'); ?>

</head>
<style>
body {
    width: 100%;

    background: url(assets/img/AdminSide.jpg);
    background-color: rgba(40, 40, 40, 0.90);
    background-blend-mode: multiply;
    background-repeat: no-repeat;
    background-size: cover;
}

main {
    width: 100%;
    min-height: 100svh;

    display: flex;
    justify-content: center;
    align-items: center;
}

#employee-login {
    width: 600px;
    margin: auto;

}

.password-container {
    position: relative !important;
}

.eye-icon {
    position: absolute !important;
    top: 10;
    right: 10;
    cursor: pointer;
}
</style>

<?php

$host = "localhost";
$user = "root";
$password = "";
$db = "payrollproj";

session_start();


$data = mysqli_connect($host, $user, $password, $db);

if ($data === false) {
    die("connection error");
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];
    $type = $_POST["type"];

    $sql = "SELECT * from users where username='" . $username . "' AND password='" . $password . "' ";

    $result = mysqli_query($data, $sql);
    $row = mysqli_fetch_array($result);



    if ($row["type"] == "employee" and $type == $row['type']) {
        $_SESSION["username"] = $username;
        header("location:user.php");
    } else {
        $error_msg = "Username or password incorrect.";
    }
}


?>

<body>
    <main id="main">


        <div id="employee-login">
            <div class="card col-md-8 mx-auto">
                <div class="card-body">
                    <?php if (!empty($error_msg)) : ?>
                    <div class="alert alert-danger"><?php echo $error_msg; ?></div>
                    <?php endif; ?>

                    <form action="#" method="POST">
                        <input type="hidden" value="employee" name="type">
                        <div class="form-group">
                            <label for="username" class="control-label">Username</label>
                            <input type="text" id="username" name="username" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="password" class="control-label">Password</label>
                            <div class="password-container">
                                <input type="password" id="password" name="password" class="form-control">
                                <i class="fa fa-eye eye-icon" onclick="toggleVisibility()"></i>

                            </div>
                        </div>
                        <br>

                        <center><button class="btn-sm btn-block btn-wave col-md-4 btn-primary"
                                id="employee-login-form">Login</button></center>
                    </form>
                </div>
            </div>
        </div>

    </main>
</body>
<script>
$('#employee-login-form').submit(function(e) {
    e.preventDefault()
    $('#employee-login-form button[type="Employee"]').attr('disabled', true).html('Logging in...');
    if ($(this).find('.alert-danger').length > 0)
        $(this).find('.alert-danger').remove();
    $.ajax({
        url: 'ajax.php?action=login',
        method: 'POST',
        data: $(this).serialize(),
        error: err => {
            console.log(err)
            $('#employee-login-form button[type="button"]').removeAttr('disabled').html('Login');

        },
        success: function(resp) {
            console.log(resp)
            if (resp == 1) {
                location.href = 'index.php?page=home';
            } else if (resp == 2) {
                location.href = 'voting.php';
            } else {
                $('#employee-login-form').prepend(
                    '<div class="alert alert-danger">Username or password is incorrect.</div>')
                $('#employee-login-form button[type="button"]').removeAttr('disabled').html(
                'Login');
            }
        }
    })
})

function toggleVisibility() {
    var passwordField = $('#password');
    var fieldType = passwordField.attr('type');

    if (fieldType === 'password') {
        passwordField.attr('type', 'text');
        $('.eye-icon').removeClass('fa-eye').addClass('fa-eye-slash');
    } else {
        passwordField.attr('type', 'password');
        $('.eye-icon').removeClass('fa-eye-slash').addClass('fa-eye');
    }
}
</script>

</html> -->