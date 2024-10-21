<style>
/* *{
		outline: 1px solid white;
	} */
#logo {
    width: 50px;
    height: 50px;
}

.nav-cont {
    padding: 0px;
    min-height: 3.5rem;
    background: #900000;
    position: sticky;
    top: 0;
    z-index: 99;
}

.nav-cont a img {
    width: 30px;
    height: 30px;
}
</style>

<nav class="navbar navbar-light nav-cont">
    <div class="container-fluid mt-2 mb-2">
        <div class="col-lg-12">
            <div class="col-md-1 float-left" style="display:flex ; ">

            </div>
            <div class="col-md-2 float-left text-white" style="max-width: fit-content">
                <large>
                    <img src="assets/img/evsu.gif" id="logo">
                    <b>HR Management System</b>
                </large>

            </div>
            <div class="col-md-8 float-right text-white "
                style="display: flex; justify-content: end; height: 50PX; align-items: center;"
                href="ajax.php?action=logout">
                <a id="logout-btn" class="logout">
                    <span class="m-3 "><?php echo $_SESSION['login_name'] ?> </span>
                    <img class="rounded-circle " src="./assets/img/images.jpg">
                </a>
            </div>
        </div>
    </div>

    <script>
    $('.logout').click(function() {
        _conf("Are you sure you want to Logout?", "logout", [$(this).attr('username')])
    })

    function logout($username) {
        start_load()
        $.ajax({
            url: 'ajax.php?action=logout',
            method: 'POST',
            data: {
                username: $username
            },
            success: function(resp) {
                if (resp == 1) {
                    alert_toast("Successfully Logout", 'success')
                    setTimeout(function() {
                        location.reload()
                    }, 1500)

                }
            }
        })
    }
    </script>
</nav>