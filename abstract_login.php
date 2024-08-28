<?php 
include_once("include/include.php");
if(isset($_SESSION['UTID']) && $_SESSION['UTID']!='' && isset($_SESSION['mailId']) && $_SESSION['mailId']!=''){
	echo "<script>window.location.href='paper.php';</script>";die;
}
include_once("header.php"); ?>
<script>
	$(document).ready(function(){
		$('.loginFrm').click(function(){
			var msg="";
			if($("#txtUTID").val()==''){
				msg+='Enter the UT-ID. \n'
			}
			if($("#txtEmail").val()==''){
				msg+='Enter the Email ID. \n'
			}
			if(msg!=''){
				alert(msg);
				return false;
			} else {
				$.ajax({
					url: "ajax/ajax.php",
					type: "POST",
					data:{"mode":"login","txtUTID":$("#txtUTID").val(),"txtEmail":$("#txtEmail").val()},
					success: function(data)
					{
						if(data=="Success"){
							window.location.href="paper.php";
						} else {
							alert(data);
						}
					},
				});
			}
			return false;
		});
		$('.signUp').click(function(){
			window.location.href="online_registration.php";
			return false;
		});
	});
</script>
<div id="columnA">
	<h2>Login</h2>
	<div id="abstract_form">
		<form id="regis" name="regis" enctype="multipart/form-data" method="post">
			<p style="text-align:center;">
				<span style="color:red;">Note:</span> Please complete the <b>registration process</b> to submit your paper. You can use your <b>registered email-id</b> and the <b>UT15 registration ID</b> to Login. <a href="online_registration.php">Click Here</a> to go registration page. 
				<!--Please use your Registered email-id and the UT15 Registration ID to log in.-->
			</p>			
			<div class="datagrid" style="width:400px;">
				<table id="abstract_form_tbl">
					<thead>
					<tr>
						<th align="center" colspan="2">Login</th>
					</tr>
					</thead>
					<tbody>
					<tr>
						<td width="50%">UT ID<font color="red">*</font></td>
						<td width="50%" style="padding:7px 25px;">
							<input name="txtUTID" id="txtUTID" type="text" value=""/><br />
							<div style="margin-top:5px">Eg: UT15-00XX</div>
						</td>
					</tr>
					<tr class="alt">
						<td width="50%">Email ID<font color="red">*</font></td>
						<td width="50%" style="padding:7px 25px;"><input name="txtEmail" id="txtEmail" type="text" value=""/></td>
					</tr>	
					<tr id="submit_row">
						<td width="100%" colspan='2' style="text-align:right;padding-right:30px;">
							<!--<button name="signUp" type="button" class="frm_btn signUp" value="signUp">Sign Up</button>-->
							<button name="loginFrm" type="submit" class="frm_btn loginFrm" value="loginFrm">Login</button>
						</td>
					</tr>					
					</tbody>
				</table>
			</div>
		</form>
	</div>	
</div>


<?php include_once("side_menu.php"); ?>
<?php include_once("footer.php"); ?>