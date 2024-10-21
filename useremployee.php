<?php include('db_connect.php') ?>
			<div class="new"> 
				<div class="card">
					<div class="card-header">
						<span><b>Employee List</b></span>
						
					</div>
					<div class="card-body">
						<table id="table" class="table table-bordered table-striped">
							<thead>
								<tr>
									<th>Employee No</th>
									<th>Fullname</th>
									<!-- <th>Middlename</th>
									<th>Lastname</th> -->
									<th>Department</th>
									<th>Position</th>
								</tr>
							</thead>
							<tbody>
								<?php
									$d_arr[0] = "Unset";
									$p_arr[0] = "Unset";
									$dept = $conn->query("SELECT * from department order by name asc");
										while($row=$dept->fetch_assoc()):
											$d_arr[$row['id']] = $row['name'];
										endwhile;
										$pos = $conn->query("SELECT * from position order by name asc");
										while($row=$pos->fetch_assoc()):
											$p_arr[$row['id']] = $row['name'];
										 endwhile;
									$employee_qry=$conn->query("SELECT * FROM `employee`") or die(mysqli_error());
									while($row=$employee_qry->fetch_array()){
								?>
								<tr>
									<td><?php echo $row['employee_no']?></td>
									<td><?php echo $row['fullname']?></td>
									<!-- <td><?php echo $row['middlename']?></td>
									<td><?php echo $row['lastname']?></td> -->
									<td><?php echo $d_arr[$row['department_id']]?></td>
									<td><?php echo $p_arr[$row['position_id']]?></td>
								</tr>
								<?php
									}
								?>
							</tbody>
						</table>
					</div>
				</div>
			</div>

	<style>
			.row{
				display:flex;
				flex-wrap:nowrap;
			}	
			.card{
				background: #d1d3e0;
				
			}
			.new{
				padding:10px;
				/* width:100%;
				height:100%; */
				/* background: black; */
				background-size:cover;
			}
			td, tr{
				background-color: #fafafa;
				vertical-align: middle !important;
			}
	</style>
					
		
		
	<script type="text/javascript">
		$(document).ready(function(){
			$('#table').DataTable();
		});
	</script>
	<script type="text/javascript">
		$(document).ready(function(){

			

			
			$('.edit_employee').click(function(){
				var $id=$(this).attr('data-id');
				uni_modal("Edit Employee","manage_employee.php?id="+$id)
				
			});
			$('.view_employee').click(function(){
				var $id=$(this).attr('data-id');
				uni_modal("Employee Details","view_employee.php?id="+$id,"mid-large")
				
			});
			$('#new_emp_btn').click(function(){
				uni_modal("New Employee","manage_employee.php")
			})
			$('.remove_employee').click(function(){
				_conf("Are you sure to delete this employee?","remove_employee",[$(this).attr('data-id')])
			})
		});
		function remove_employee(id){
			start_load()
			$.ajax({
				url:'ajax.php?action=delete_employee',
				method:"POST",
				data:{id:id},
				error:err=>console.log(err),
				success:function(resp){
						if(resp == 1){
							alert_toast("Employee's data successfully deleted","success");
								setTimeout(function(){
								location.reload();

							},1000)
						}
					}
			})
		}
	</script>
