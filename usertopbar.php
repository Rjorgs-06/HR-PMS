<style>

</style>

<nav class="navbar navbar-light " style="padding:0;min-height:3.5rem;background: #900000;position:static;">
  <div class="container-fluid mt-2 mb-2">
  	<div class="col-lg-12">
  		<div class="col-md-1 float-left" style="display:flex ; ">
  		
  		</div>
      <div class="col-md-4 float-left text-white">
        <large><b>Employee | HR Management System</b></large>
      </div>
	  	<div class="col-md-2 float-right text-white" href="ajax.php?action=logout">
	  		<a id="logout-btn" class="logout"><?php echo $_SESSION['username'] ?> <i class="fa fa-power-off"></i></a>
	    </div>
    </div>
  </div>
  
<script>
$('.logout').click(function(){
		_conf("Are you sure you want to Logout?","logout",[$(this).attr('username')])
	})

  // function logout($username){
	// 	start_load()
	// 	$.ajax({
	// 		url:'ajax.php?action=logout',
	// 		method:'POST',
	// 		data:{username:$username},
	// 		success:function(resp){
	// 			if(resp==1){
	// 				alert_toast("Successfully Logout",'success')
	// 				setTimeout(function(){
	// 					location.reload()
	// 				},1500)

	// 			}
	// 		}
	// 	})
	// }
</script>
</nav>