<?php include_once("header.php"); ?>
<div id="columnA">
	<h2>Online Registration</h2>
	<div>
		<?php 
			if(time()<=$close_date){
				include_once("regModule/registration.php");
			} else { 
			echo "<div style='text-align:center;margin-top:25px;font-weight:bold;font-size:24px;color:red;'>Registration has been Closed.</div>";
			}
		?>
	</div>
	
</div>
<?php include_once("side_menu.php"); ?>
<?php include_once("footer.php"); ?>
