<style>
/* Resetting default styles and adding some radius */
* {
    margin-top: 0;
}

/* Setting background color for font-awesome icons */
.fa {
    background: #900000;
}

/* Changing the default font color for nav items */
.nav-item {
    color: #00ff00;
    /* Set your desired font color */
    text-decoration: none;
    /* Removes underline from links */
}

/* Change color of icons inside nav items */
.nav-item i {
    color: #fff;
    /* Ensures icons are white */
}

/* Hover effect for nav items */
.nav-item:hover,
.nav-item.active {
    background-color: #900000;
    color: #fffafa;
}

/* Styling for the collapsed menu items */
.collapse-item {
    color: #fff;
    display: block;
    padding-block: 10px;
    /* Ensures text is horizontally centered */
}


.collapse-item:hover {
    color: #fffafa;
    background-color: #700000;
    border-radius: 2px;
}

.bg-dark {
    background-color: #343a40 !important;
}

.bg-danger {
    background-color: #dc3545 !important;
}

/* Active nav item link styling */
.nav-item.active {
    background-color: #700000 !important;
    color: #fff;
}
</style>


<?php

include('db_connect.php');

$user_role = isset($_SESSION['login_type']) ? $_SESSION['login_type'] : 'guest';
$user_name = isset($_SESSION['login_name']) ? $_SESSION['login_name'] : '';



if (!empty($user_name)) {

    $user_name_escaped = $conn->real_escape_string($user_name);


    $employee_type_query = "
        SELECT 'partTime' AS type, id, fullname FROM employee_parttime WHERE fullname = '$user_name_escaped'
        UNION
        SELECT 'regular' AS type, id, fullname FROM employee_regular WHERE fullname = '$user_name_escaped'
        UNION
        SELECT 'cos' AS type, id, fullname FROM employee_cos WHERE fullname = '$user_name_escaped'
    ";

    $result = $conn->query($employee_type_query);
    $employee_type = "";
    if ($result) {

        if ($result->num_rows > 0) {

            while ($employee = $result->fetch_assoc()) {

                $employee_type = $employee['type'];
            }
        }
    }
}
?>





<nav id="sidebar" class="mx-lt-5 bg-dark">
    <!-- Home Item -->
    <a href="admin.php?page=home" class="nav-item nav-home">
        <span class="icon-field"><i class="fa fa-home"></i></span> Home
    </a>

    <?php if ($user_role == 'employee') : ?>



    <a class="nav-item" href="admin.php?page=generalPayroll/<?php echo $employee_type ?>">
        <i class="fa fa-columns"></i> <span class="ml-1">Employee Info</span>
    </a>


    <?php else : ?>

    <?php
        $page = isset($_GET['page']) ? $_GET['page'] : '';
        $isInGeneralPayroll = strpos($page, 'generalPayroll') !== false;
        ?>

    <!-- General Payroll Dropdown -->
    <a class="nav-item" href="#" data-toggle="collapse" data-target="#collapseGeneralPayroll"
        aria-expanded="<?php echo $isInGeneralPayroll ? 'true' : 'false'; ?>" aria-controls="collapseGeneralPayroll">
        <i class="fa fa-columns"></i>
        <span class="ml-1">General Payroll</span>
    </a>
    <!-- Dropdown Items -->
    <div id="collapseGeneralPayroll" class="collapse  <?php echo $isInGeneralPayroll ? 'show' : ''; ?>"
        aria-labelledby="headingGeneralPayroll" data-parent="#sidebar">
        <div class="collapse-inner rounded">
            <a class="collapse-item <?php echo ($page == 'generalPayroll/regular') ? 'nav-item active' : ''; ?>" href="
                admin.php?page=generalPayroll/regular">
                <i class="fa fa-user-tie"></i> <span class="ml-1">Regular</span>
            </a>
            <a class="collapse-item <?php echo ($page == 'generalPayroll/partTime') ? 'nav-item active' : ''; ?>"
                href="admin.php?page=generalPayroll/partTime">
                <i class="fa fa-columns"></i> <span class="ml-1">Part-time</span>
            </a>
            <a class="collapse-item <?php echo ($page == 'generalPayroll/cos') ? 'nav-item active' : ''; ?>"
                href="admin.php?page=generalPayroll/cos">
                <i class="fa fa-money-bill-wave"></i> <span class="ml-1">COS</span>
            </a>

        </div>
    </div>

    <?php
        $page = isset($_GET['page']) ? $_GET['page'] : '';
        $isEmployeeListPage = strpos($page, 'employeeList') !== false;
        ?>

    <!-- Employee List Dropdown -->
    <a class="nav-item" href="#" data-toggle="collapse" data-target="#collapseEmployeeList"
        aria-expanded="<?php echo $isEmployeeListPage ? 'true' : 'false'; ?>" aria-controls="collapseEmployeeList">
        <i class="fa fa-user-tie"></i>
        <span class="ml-1">Employee List</span>
    </a>

    <!-- Dropdown Items -->
    <div id="collapseEmployeeList" class="collapse  <?php echo $isEmployeeListPage ? 'show' : ''; ?>"
        aria-labelledby="headingEmployeeList" data-parent="#sidebar">
        <div class="collapse-inner">
            <a class="collapse-item text-white <?php echo ($page == 'employeeList/regular') ? 'nav-item active' : ''; ?>"
                href="admin.php?page=employeeList/regular">
                <i class="fa fa-user-tie"></i> <span class="ml-1">Regular</span>
            </a>
            <a class="collapse-item text-white <?php echo ($page == 'employeeList/partTime') ? 'nav-item active' : ''; ?>"
                href="admin.php?page=employeeList/partTime">
                <i class="fa fa-columns"></i> <span class="ml-1">Part-time</span>
            </a>
            <a class="collapse-item text-white <?php echo ($page == 'employeeList/cos') ? 'nav-item active' : ''; ?>"
                href="admin.php?page=employeeList/cos">
                <i class="fa fa-money-bill-wave"></i> <span class="ml-1">COS</span>
            </a>
        </div>
    </div>

    <?php
        $page = isset($_GET['page']) ? $_GET['page'] : '';
        $isEmployeeWagesInfo = strpos($page, 'employeeWagesInfo') !== false;
        ?>

    <!-- Employee Deduction Dropdown -->
    <a class="nav-item " href="#" data-toggle="collapse" data-target="#collapseEmployeeDeduction"
        aria-expanded="<?php echo $isEmployeeWagesInfo ? 'true' : 'false'; ?>"
        aria-controls="collapseEmployeeDeduction">
        <i class="fa fa-money-bill-wave"></i>
        <span class="ml-1">Employee Deduction</span>
    </a>
    <!-- Dropdown Items -->
    <div id="collapseEmployeeDeduction" class="collapse  <?php echo $isEmployeeWagesInfo ? 'show' : ''; ?>"
        aria-labelledby="headingEmployeeDeduction" data-parent="#sidebar">
        <div class="collapse-inner rounded">
            <a class="collapse-item <?php echo ($page == 'employeeWagesInfo/regular') ? 'nav-item active' : ''; ?>"
                href="admin.php?page=employeeWagesInfo/regular">
                <i class="fa fa-user-tie"></i> <span class="ml-1">Regular</span>
            </a>
            <a class="collapse-item text-white <?php echo ($page == 'employeeWagesInfo/partTime') ? 'nav-item active' : ''; ?>"
                href="admin.php?page=employeeWagesInfo/partTime">
                <i class="fa fa-columns"></i> <span class="ml-1">Part-time</span>
            </a>
            <a class="collapse-item  <?php echo ($page == 'employeeWagesInfo/cos') ? 'nav-item active' : ''; ?>" href="
                admin.php?page=employeeWagesInfo/cos">
                <i class="fa fa-money-bill-wave"></i> <span class="ml-1">COS</span>
            </a>
        </div>
    </div>




    <!-- Other Nav Items -->


    <a href="admin.php?page=users" class="nav-item nav-users">
        <span class="icon-field"><i class="fa fa-users"></i></span> Users
    </a>

    <!-- Check for additional admin options -->
    <?php if ($_SESSION['login_username'] == 1): ?>
    <!-- Add more admin-specific links here -->
    <?php endif; ?>

    <?php endif; ?>
</nav>

<script>
$(document).ready(function() {
    // Get the page parameter from PHP and escape special characters
    var pageParam = '<?php echo isset($_GET['page']) ? $_GET['page'] : '' ?>';
    var escapedPageParam = pageParam.replace(/\//g, '\\/'); // Escape forward slashes

    // Add the 'active' class based on the current page
    $('.nav-' + escapedPageParam).addClass('active');
});
</script>