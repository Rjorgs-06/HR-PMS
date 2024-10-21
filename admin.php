<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>HRPMS</title>
    <link rel="shortcut icon" href="assets/img/favicon.png">
    <?php
    session_start();
    if (!isset($_SESSION['login_id'])) {
        header('Location:login.php');
        exit();
    }
    include('./header.php');

    ?>
</head>
<style>
    html {
        background: url(assets/img/AdminSide.jpg);
        background-color: rgba(40, 40, 40, 0.90);
        background-blend-mode: multiply;
        background-repeat: no-repeat;
        background-size: cover;
        width: 100%;
        height: 100%;
    }

    body {
        background: #80808045;
    }

    .modal-dialog.large {
        width: 100% !important;
        max-width: unset;
    }

    .modal-dialog.mid-large {
        width: 50% !important;
        max-width: unset;
    }

    div#confirm_modal {
        z-index: 9991;
    }
</style>

<body>
    <div class="toast" id="alert_toast" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="toast-body text-white"></div>
    </div>

    <?php include 'topbar.php'; ?>
    <?php include 'navbar.php'; ?>


    <main id="view-panel">
        <?php
        $page = isset($_GET['page']) ? $_GET['page'] : 'home';
        // Ensure the page includes the correct path
        $include_path = $page . '.php';
        if (file_exists($include_path)) {
            include($include_path);
        } else {
            echo '<p>Page not found.</p>';
        }
        ?>
    </main>
    <div id="preloader"></div>
    <a href="#" class="back-to-top"><i class="icofont-simple-up"></i></a>

    <div class="modal fade" id="confirm_modal" role='dialog'>
        <div class="modal-dialog modal-md" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Confirmation</h5>
                </div>
                <div class="modal-body">
                    <div id="delete_content"></div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" id='confirm' onclick="logout()">Continue</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="uni_modal" role='dialog'>
        <div class="modal-dialog modal-md" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"></h5>
                </div>
                <div class="modal-body"></div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary" id='submit'
                        onclick="$('#uni_modal form').submit()">Save</button>
                    <button type="submit" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                </div>
            </div>
        </div>
    </div>
</body>
<script>
    function logout() {
        var txt = document.getElementById('logout-btn').innerHTML;
        window.location.href = 'index.php';
    }
    window.start_load = function() {
        $('body').prepend('<di id="preloader2"></di>');
    }
    window.end_load = function() {
        $('#preloader2').fadeOut('fast', function() {
            $(this).remove();
        });
    }
    window.uni_modal = function($title = '', $url = '', $size = "", $showFooterButtons = true) {
        start_load();
        $.ajax({
            url: $url,
            error: err => {
                console.log(err);
                alert("An error occurred");
            },
            success: function(resp) {
                if (resp) {
                    $('#uni_modal .modal-title').html($title);
                    $('#uni_modal .modal-body').html(resp);
                    if ($size != '') {
                        $('#uni_modal .modal-dialog').addClass($size);
                    } else {
                        $('#uni_modal .modal-dialog').removeAttr("class").addClass(
                            "modal-dialog modal-md");
                    }
                    if ($showFooterButtons) {
                        $('#uni_modal .modal-footer').show();
                    } else {
                        $('#uni_modal .modal-footer').hide();
                    }

                    $('#uni_modal').modal({
                        show: true,
                        backdrop: 'static',
                        keyboard: false,
                        focus: true
                    });
                    end_load();
                }
            }
        });
    }
    window._conf = function($msg = '', $func = '', $params = []) {
        $('#confirm_modal #confirm').attr('onclick', $func + "(" + $params.join(',') + ")");
        $('#confirm_modal .modal-body').html($msg);
        $('#confirm_modal').modal({
            show: true,
            backdrop: 'static',
            keyboard: false,
            focus: true
        });
    }
    window.alert_toast = function($msg = 'TEST', $bg = 'success') {
        $('#alert_toast').removeClass('bg-success bg-danger bg-info bg-warning');
        $('#alert_toast').addClass('bg-' + $bg);
        $('#alert_toast .toast-body').html($msg);
        $('#alert_toast').toast({
            delay: 3000
        }).toast('show');
    }



    $(document).ready(function() {
        $('#preloader').fadeOut('fast', function() {
            $(this).remove();
        });
    });
    $('.datetimepicker').datetimepicker({
        format: 'Y/m/d H:i',
        startDate: '+3d'
    });
    $('.select2').select2({
        placeholder: "Please select here",
        width: "100%"
    });
</script>

</html>