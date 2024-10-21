<html>

<head>
    <title>HRPMS</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="assets/img/favicon.png">
    <!-- Bootstrap -->
    <link href="https://apps.evsu.edu.ph/assets/css/bootstrap.min.css" rel="stylesheet">
    <!-- end of bootstrap -->
    <?php include('./header.php'); ?>

</head>

<style type="text/css">
@import url('https://fonts.googleapis.com/css2?family=Anton&display=swap');

body {
    background-image: url('assets/img/bg.jpg') !important;
    background-size: cover !important;
    background-attachment: fixed !important;
    position: relative !important;
    background-repeat: no-repeat !important;
    padding: 0px !important;
}

body:after {
    content: '';
    position: fixed;
    background-color: rgba(255, 255, 255, 0.8);
    width: 100%;
    height: 100vh;
    top: 0px;
    bottom: 0px;
    left: 0px;
    right: 0px;
    z-index: 1;
}

a {
    color: #d30707;
}

a:hover,
a:focus {
    text-decoration: none;
}

.my-form-container {
    background-color: #fff;
    float: left;
    width: 100%;
    position: relative;
    padding: 60px 50px 60px 20px;
}

.my-form-container .my-form-inner-container {
    position: relative;
    z-index: 2;
}

.my-form-container:before {
    content: '';
    position: absolute;
    display: inline-block;
    width: 130%;
    transform: skew(-10deg);
    -webkit-transform: skew(-10deg);
    -moz-transform: skew(-10deg);
    top: -2px;
    left: -60px;
    bottom: -2px;
    background-color: #fff;
    z-index: 1;
}

.my-form-container h2 {
    color: #d30707;
    font-family: 'Anton', 'Arial Black', sans-serif;
    font-size: 50px;
    letter-spacing: 20px;
    font-weight: bold;
}

.logo-container {
    padding: 20px 30px;
    background-color: rgba(0, 0, 0, 0.2);
}

.logo-container .img-logo {
    height: auto;
    width: auto;
    max-height: 70px;
    max-width: 100%;
}

.flex-container {
    display: flex;
    min-height: 100vh;
    justify-content: center;
    align-items: center;
    position: relative;
    z-index: 3;
    width: 100%;
}

.flex-container .row-inner-container {
    box-shadow: 0px -1px 29px -2px rgba(0, 0, 0, 0.2);
    -webkit-box-shadow: 0px -1px 29px -2px rgba(0, 0, 0, 0.2);
    -moz-box-shadow: 0px -1px 29px -2px rgba(0, 0, 0, 0.2);
    overflow: hidden;
}

.my-form-row {
    background-color: rgba(0, 0, 0, 1);
    background-image: url('assets/img/try.avif') !important;
    background-size: 70% 100% !important;
    background-position: -100px bottom !important;
    position: relative !important;
    background-repeat: no-repeat !important;
}

.my-form-container .btn-primary {
    color: #fff;
    background-color: #d30707;
    border-color: #d30707;
}

.my-form-container .btn-primary:hover,
.my-form-container .btn-primary:focus {
    background-color: #b70707 !important;
    border-color: #b70707 !important;
}

.my-col {
    padding-left: 0px;
    padding-right: 0px;
}

.show-password {
    position: relative;
}

.eye-icon {
    position: absolute !important;
    top: 10;
    right: 7;
    cursor: pointer;
}

/*/ Custom, iPhone Retina / */
@media only screen and (min-width : 320px),
(max-width: 320px) {
    .flex-container {
        padding: 10px;
        display: block;
    }

    .my-form-container {
        padding: 30px 20px 30px 20px;
    }

    .my-form-row {
        background-size: 150% auto !important;
        background-position: left top !important;
    }

    .my-form-container h2 {
        font-size: 40px;
    }

    .logo-container {
        padding: 15px 15px;
        margin-bottom: 70px;
    }

    .logo-container .img-logo {
        max-height: 50px;
        max-width: 100%;
    }
}

/* / Extra Small Devices, Phones / */
@media only screen and (min-width : 480px) {}

/* / Small Devices, Tablets /*/
@media only screen and (min-width : 768px) {
    .my-form-container h2 {
        font-size: 50px;
    }

    .logo-container {
        padding: 20px 15px;
        margin-bottom: 100px;
    }

    .logo-container .img-logo {
        max-height: 70px;
        max-width: 100%;
    }

    .my-form-row {
        background-size: 100% auto !important;
        background-position: left top !important;
    }
}

/*/ Medium Devices, Desktops /*/
@media only screen and (min-width : 992px) {
    .flex-container {
        padding: 0px;
        display: flex;
    }

    .my-form-container {
        padding: 60px 50px 60px 20px;
    }

    .my-form-row {
        background-size: 70% 100% !important;
        background-position: -100px bottom !important;
    }

    .logo-container {
        padding: 20px 30px;
        margin-bottom: 0px;
    }

    .logo-container .img-logo {
        max-height: 70px;
        max-width: 100%;
    }

}

/*/ Large Devices, Wide Screens /*/
@media only screen and (min-width : 1200px) {}
</style>


<?php

$host = "localhost";
$user = "root";
$password = "";
$db = "payrollproj";



$data = mysqli_connect($host, $user, $password, $db);

if ($data === false) {
    die("connection error");
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];
    // $type = $_POST["type"];

    $sql = "SELECT * from users where username='" . $username . "' AND password='" . $password . "'";

    $result = mysqli_query($data, $sql);
    $row = mysqli_fetch_array($result);



    if ($row["type"] == "admin" and $type == $row['type']) {
        $_SESSION["username"] = $username;
        header("location:admin.php");
    } else {
        $error_msg = "Username or password incorrect.";
    }
}

?>

<body>
    <main id="main">

        <div class="flex-container" id="admin-login">
            <div class="container">
                <div class="row row-inner-container">
                    <?php if (!empty($error_msg)) : ?>
                    <div class="alert alert-danger"><?php echo $error_msg; ?></div>
                    <?php endif; ?>

                    <div class="col-md-12">
                        <div class="row my-form-row">
                            <div class="col-md-6 my-col">
                                <div class="logo-container">
                                    <img class="img-logo"
                                        src="https://apps.evsu.edu.ph/assets/img/images/logo-v3.png?v=1">
                                </div>
                            </div>
                            <div class="col-md-6 my-col" id="formvisible">
                                <div class="my-form-container">

                                    <div class="my-form-inner-container">
                                        <div class="panel-header">
                                            <h2 class="text-center">
                                                HR-PMS
                                            </h2>
                                        </div>
                                        <div class="panel-body">
                                            <div class="row" style="display:flex; justify-content:center;">

                                                <div class="col-xs-12">
                                                    <h3 style="font-weight: bold;">Sign In</h3>
                                                    <form action="#" id="admin-login-form" method="post"
                                                        class="login_validator bv-form" novalidate="novalidate">

                                                        <div class="form-group">
                                                            <label for="username" class="sr-only">
                                                                Username </label>
                                                            <input required="" value="" type="text"
                                                                autocomplete="username"
                                                                class="form-control  form-control-lg input-lg"
                                                                id="username" name="username" placeholder="Username"
                                                                data-bv-field="username">
                                                        </div>

                                                        <div class="form-group show-password">
                                                            <label for="password" class="sr-only">Password</label>
                                                            <input required="" type="password"
                                                                autocomplete="current-password"
                                                                class="form-control form-control-lg input-lg"
                                                                id="password" name="password" placeholder="Password">
                                                            <i class="fa fa-eye eye-icon mt-2"
                                                                onclick="handleToggleShow()"></i>
                                                        </div>

                                                        <div class="mb-3">
                                                            <label for="type" class="form-label">Select Role</label>
                                                            <select name="type" class="form-select custom-select"
                                                                id="type" required>
                                                                <option value="admin">Admin</option>
                                                                <option value="employee" id="btnFormEmployee">
                                                                    Employee
                                                                </option>
                                                            </select>
                                                        </div>

                                                        <div class=" form-group">

                                                            <button class="btn btn-primary btn-block btn-lg"
                                                                type="submit">Login</button>
                                                        </div>

                                                        <div class="clearfix"></div>

                                                        <p class="text-center">By using this service, you agree to
                                                            uphold our <a href="cvalues.html" target="_blank">EVSU
                                                                Mission, Vision & Core Values</a>
                                                        </p>

                                                    </form>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </main>


</body>

<script>
function handleToggleShow() {
    var passwordField = $('#password');
    console.log(passwordField)
    var fieldType = passwordField.attr('type');
    console.log(fieldType)
    if (fieldType === 'password') {
        passwordField.attr('type', 'text');
        $('.eye-icon').removeClass('fa-eye').addClass('fa-eye-slash');
    } else {
        passwordField.attr('type', 'password');
        $('.eye-icon').removeClass('fa-eye-slash').addClass('fa-eye');
    }
}

var adminForm = document.getElementById('admin-login');
var optionForm = document.getElementById('btnFormEmployee');

optionForm.addEventListener('click', () => {
    adminForm.style.display = 'block';
})



$('#admin-login-form').submit(function(e) {
    e.preventDefault()
    $('#admin-login-form button[type="Employee"]').attr('disabled', true).html('Logging in...');
    if ($(this).find('.alert-danger').length > 0)
        $(this).find('.alert-danger').remove();
    $.ajax({
        url: 'ajax.php?action=login',
        method: 'POST',
        data: $(this).serialize(),
        error: err => {
            console.log(err)
            $('#admin-login-form button[type="button"]').removeAttr('disabled').html('Login');

        },
        success: function(resp) {
            console.log(resp)
            if (resp == 1) {
                location.href = 'admin.php?page=home';
            } else if (resp == 2) {
                // location.href = 'voting.php';
            } else {
                $('#admin-login-form').prepend(
                    '<div class="alert alert-danger">Username or password is incorrect.</div>')
                $('#admin-login-form button[type="button"]').removeAttr('disabled').html('Login');
            }
        }
    })
})
</script>


</html>