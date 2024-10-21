<style>
* {
    margin-top: 0;
    border-radius: 10px;
    border: 5px solid 161616;
    margin: 3px;
}

.fa {
    background: #900000;
}

a.nav-item:hover,
.nav-item.active {
    background-color: #000000ad;
    color: #fffafa;
    background-color: #900000;
}
</style>
<nav id="sidebar" class='mx-lt-5 bg-dark'>



    <a href="user.php?page=home" class="nav-item nav-home"><span class='icon-field'><i class="fa fa-home"></i></span>
        Home</a>
    <!-- <a href="user.php?page=userattendance" class="nav-item nav-attendance"><span class='icon-field'><i class="fa fa-th-list"></i></span> Attendance</a> -->
    <a href="user.php?page=userpayroll" class="nav-item nav-payroll"><span class='icon-field'><i
                class="fa fa-columns"></i></span> General Payroll</a>

    <!-- <a href="user.php?page=allowances" class="nav-item nav-allowances"><span class='icon-field'><i class="fa fa-list"></i></span> Allowance List</a> -->
    <!-- <a href="user.php?page=deductions" class="nav-item nav-deductions"><span class='icon-field'><i class="fa fa-money-bill-wave"></i></span> Deduction List</a> -->

    <!-- <a href="user.php?page=userdepartment" class="nav-item nav-department"><span class='icon-field'><i class="fa fa-columns"></i></span> Department List</a>
				<a href="user.php?page=userposition" class="nav-item nav-position"><span class='icon-field'><i class="fa fa-user-tie"></i></span> Position List</a>
				<a href="user.php?page=users" class="nav-item nav-users"><span class='icon-field'><i class="fa fa-users"></i></span> Users</a> -->
    <?php if ($_SESSION['username'] == 1): ?>

    <?php endif; ?>
    </div>

</nav>

<script>
$('.nav-<?php echo isset($_GET['page']) ? $_GET['page'] : '' ?>').addClass('active')
</script>