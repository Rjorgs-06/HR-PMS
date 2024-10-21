<?php
ob_start();
$action = $_GET['action'];
include 'admin_class.php';
$crud = new Action();

if ($action == 'login') {
	$login = $crud->login();
	if ($login)
		echo $login;
}
if ($action == 'login2') {
	$login = $crud->login2();
	if ($login)
		echo $login;
}

if ($action == 'save_user') {
	$save = $crud->save_user();
	if ($save)
		echo $save;
}
if ($action == 'signup') {
	$save = $crud->signup();
	if ($save)
		echo $save;
}
if ($action == "save_settings") {
	$save = $crud->save_settings();
	if ($save)
		echo $save;
}
if ($action == "save_employee") {
	$save = $crud->save_employee();
	if ($save)
		echo $save;
}

if ($action == "save_parttime") {
	$save = $crud->save_parttime();
	if ($save)
		echo $save;
}

if ($action == "save_cos") {
	$save = $crud->save_cos();
	if ($save)
		echo $save;
}

if ($action == "delete_employee") {
	$save = $crud->delete_employee();
	if ($save)
		echo $save;
}
if ($action == "save_wages") {
	$save = $crud->save_wages();
	if ($save)
		echo $save;
}
if ($action == "save_wages_parttime") {
	$save = $crud->save_wages_parttime();
	if ($save)
		echo $save;
}


if ($action == "save_wages_cos") {
	$save = $crud->save_wages_cos();
	if ($save)
		echo $save;
}

if ($action == "get_wages_parttime") {
	$save = $crud->get_wages_parttime();
	if ($save)
		echo $save;
}

if ($action == "get_wage") {
	$save = $crud->get_wage();
	if ($save)
		echo $save;
}

if ($action == "get_wages_cos") {
	$save = $crud->get_wages_cos();
	if ($save)
		echo $save;
}

if ($action == "delete_deductions") {
	$save = $crud->delete_deductions();
	if ($save)
		echo $save;
}
if ($action == "save_employee_deduction") {
	$save = $crud->save_employee_deduction();
	if ($save)
		echo $save;
}
if ($action == "delete_employee_deduction") {
	$save = $crud->delete_employee_deduction();
	if ($save)
		echo $save;
}

if ($action == "save_employee_attendance") {
	$save = $crud->save_employee_attendance();
	if ($save)
		echo $save;
}
if ($action == "delete_employee_attendance") {
	$save = $crud->delete_employee_attendance();
	if ($save)
		echo $save;
}
if ($action == "delete_employee_attendance_single") {
	$save = $crud->delete_employee_attendance_single();
	if ($save)
		echo $save;
}
if ($action == "save_payroll") {
	$save = $crud->save_payroll();
	if ($save)
		echo $save;
}
if ($action == "delete_payroll") {
	$save = $crud->delete_payroll();
	if ($save)
		echo $save;
}
if ($action == "calculate_payroll") {
	$save = $crud->calculate_payroll();
	if ($save)
		echo $save;
}