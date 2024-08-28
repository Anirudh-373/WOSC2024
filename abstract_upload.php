
<?php 
	include_once("include/include.php");
	if($_SESSION['UTID']=='' || $_SESSION['mailId']==''){
		echo "<script>window.location.href='abstract_login.php';</script>";die;
	}
	$sUTID='';
	$sEmail='';
	$sTitle='';
	$sNoCoAuther='';
	$sCoAuther='';
	
	if(isset($_POST) && isset($_POST['AbstractFrm']) && $_POST['AbstractFrm']=="Submit"){
		mysql_connect("localhost","root",$db_psw) or die("could not connect");
		mysql_select_db("web_niotsrvr");
		$txtUTID=(isset($_SESSION['UTID']))?$_SESSION['UTID']:'';
		
		$txtEmail=(isset($_SESSION['mailId']))?$_SESSION['mailId']:'';
		$strsql="select utId from UT_15 where utRegId='".$txtUTID."' and mailId='".$txtEmail."'";
		$rss1=exec_query($strsql);
		$UTID=$rss1[0]['utId'];
		$txtTitle=(isset($_POST["txtTitle"]))?$_POST["txtTitle"]:'';
		$txtDesp=(isset($_POST["txtDesp"]))?$_POST["txtDesp"]:'';
		$txtNoCoAuthor=(isset($_POST["txtNoCoAuthor"]))?$_POST["txtNoCoAuthor"]:'';
		$txtCoAuthorName=(isset($_POST["txtCoAuthorName"]))?$_POST["txtCoAuthorName"]:'';
		if(isset($_POST["txtCoAuthorName"]) && is_array($_POST["txtCoAuthorName"])){
			$txtCoAuthorName=implode("||",$_POST["txtCoAuthorName"]);
		} else {
			$txtCoAuthorName=$_POST["txtCoAuthorName"];
		}
		if(isset($_FILES['abstract_file'])){
			$abstract_file='';
			if (!file_exists("upload/" . $txtUTID ."-".$_FILES["abstract_file"]["name"])) {
				$abstract_file=$txtUTID ."_".$_FILES["abstract_file"]["name"];
			} else {
				$abstract_file=$txtUTID ."_".time()."_".$_FILES["abstract_file"]["name"];
			}
			if($abstract_file!=''){
				move_uploaded_file($_FILES["abstract_file"]["tmp_name"],
				"upload/abstract/" . $abstract_file);
			}
		}
		$dateofsub=date("Y-m-d H:i:s",time());
		$strsql="insert into UT15_Abstract_Upload (utId,utAbstractName,utAbstractPath,utAbstractDescription,utCoAuthorCount,utCoAuthorName,utAbstractDOS,delFlag) 
					values('".$UTID."','".$txtTitle."','".$abstract_file."','".$txtDesp."',".$txtNoCoAuthor.",'".$txtCoAuthorName."','".$dateofsub."','N')";
		
		$rs=mysql_query($strsql)or die("Invalid Query11".mysql_error());
	}
	
	




include_once("header.php"); 


?>
<script>
	$(document).ready(function(){
		$("#current_auther_count").val($(".txtCoAuthorName").length);
		$('#add_more_auther').click(function(){
			var auther_count=$("#txtNoCoAuthor").val();
			if(auther_count!='' && auther_count>0){
				var curr_count=$(".txtCoAuthorName").length;
				if(auther_count>curr_count){
					var add_class='';
					
					$("#submit_row").addClass("alt");
					if(curr_count%2==0){
						add_class='class="alt"';
						$("#submit_row").removeClass("alt");
					}
					curr_count++;
					var append_code='<tr '+add_class+' id="auther_row_'+i+'"><td width="50%">Co-Authors '+curr_count+' Name<font color="red">*</font></td><td width="50%"><input name="txtCoAuthorName[]" class="txtCoAuthorName" type="text" value=""/><a href="#" class="remove_auther" for="'+i+'">Remove</a></td></tr>';
					//$("#abstract_form_tbl").append( append_code );
					$('#abstract_form_tbl tr:last').before(append_code)
				} else {
					alert("You can't add more fields.");
				}
			} else {
				alert("No. of Co-Authors Must be greater than 0 to perform this action.");
			}
			return false;
		});
		$(".remove_auther").live("click",function(){
			var remove_id=$(this).attr("for");
			var remove_row="auther_row_"+remove_id;
			$("#"+remove_row).remove();
			var curr_count_2=$(".txtCoAuthorName").length;
			var j=1;
			var replace;
			$(".txtCoAuthorName").each(function(){
				replace='Co-Authors '+j+' Name<font color="red">*</font>'
				if(j%2==1){
					$(this).parent().parent().addClass("alt");
					$(this).parent().parent().find("td:first-child").html(replace);
				}  else {
					$(this).parent().parent().removeClass("alt");
					$(this).parent().parent().find("td:first-child").html(replace);
				}
				j++;
			});
			$("#submit_row").addClass("alt");
			if(curr_count_2%2==1){
				$("#submit_row").removeClass("alt");
			}
			return false;
		});
		$(".submit").click(function(){
			var msg="";
			if($("#txtTitle").val()==''){
				msg+="Abstract Title.\n";
			}
			if($("#abstract_file").val()==''){
				msg+="Abstract.\n";
			}
			if($("#txtDesp").val()==''){
				msg+="Description.\n";
			}
			if($("#txtNoCoAuthor").val()==''){
				msg+="No. of Co-Authors.\n";
			} else if(!$.isNumeric($("#txtNoCoAuthor").val())){
				msg+="No. of Co-Authors must be Numeric. \n";
			} else {
				var curr_count_1=$(".txtCoAuthorName").length;
				var auther_count_1=$("#txtNoCoAuthor").val();
				if(curr_count_1==auther_count_1){
					var i=1;
					$(".txtCoAuthorName").each(function(){
						if($(this).val()==''){
							msg+="Enter Co-Author "+i+" Name. \n";
						} else {
							if(/^[a-zA-Z-. ]*$/.test($(this).val()) == false) {
								msg+="Co-Author "+i+" Name must have only characters. \n";
							}
						}
						i++;
					});
				} else if(curr_count_1<auther_count_1){
					msg+="Enter "+ ( auther_count_1 - curr_count_1)+" more Co-Author Row. \n";
				} else if(curr_count_1>auther_count_1){
					msg+="Remove "+ ( curr_count_1 - auther_count_1 )+" Co-Author Row. \n";
				}
			}
			if(msg==''){
				return true;
				document.regis.action="abstract_upload.php";
				document.regis.method="post";
				document.regis.submit();
			} else {
				alert(msg);
				return false;
			}
			
		});
	});
</script>
<div id="columnA">
	<h2>Abstract Submission</h2>
	<?php if(isset($_SESSION['UTID']) &&$_SESSION['UTID']!='' &&isset($_SESSION['mailId']) &&  $_SESSION['mailId']!=''){ ?>
		<div style="text-align:right;font-weight:bold;"><a href="ajax/ajax.php?mode=logout">Log Out</a></div>
	<?php } ?>
	<div id="abstract_form">
		<form id="regis" name="regis" enctype="multipart/form-data" method="post">
			<input type="hidden" name="hdDelegateMode" value="<? echo $sDelegateMode;?>"/>
			<input type="hidden" name="hdMailIdDuplication" value="<? echo $sMailIdSel;?>"/>
			<input type="hidden" name="current_auther_count" id="current_auther_count" value="0"/>
			<div class="datagrid" style="width:650px;">
				<table id="abstract_form_tbl">
					<thead>
					<tr>
						<th align="center" colspan="2">Abstract Submission</th>
					</tr>
					</thead>
					<tbody>
					<tr>
						<td width="50%">UT ID<font color="red">*</font></td>
						<td width="50%"><input name="txtUTID" type="text" disabled value="<?php echo $_SESSION['UTID']; ?>"/></td>
					</tr>
					<tr class="alt">
						<td width="50%">Mail ID<font color="red">*</font></td>
						<td width="50%"><input name="txtEmail" type="text" disabled value="<?php echo  $_SESSION['mailId']; ?>"/></td>
					</tr>
					<tr>
						<td width="50%">Abstract Title<font color="red">*</font></td>
						<td width="50%"><input name="txtTitle" type="text" id="txtTitle" value="<?php echo $sTitle; ?>"/></td>
					</tr>
					<tr class="alt">
						<td width="50%">Abstract<font color="red">*</font></td>
						<td width="50%"><input type="file" name="abstract_file" id="abstract_file"></td>
					</tr>
					<tr>
						<td width="50%">Description<font color="red"></font></td>
						<td width="50%"><textarea name="txtDesp" id="txtDesp" ></textarea></td>
					</tr>
					<tr class="alt">
						<td width="50%">No. of Co-Authors<font color="red">*</font></td>
						<td width="50%"><input name="txtNoCoAuthor" id="txtNoCoAuthor" type="text" value="<?php echo $sNoCoAuther; ?>"/></td>
					</tr>
					<tr id="Authors_Names">
						<td width="50%">Co-Authors Names<font color="red"></font></td>
						<td width="50%"><a id="add_more_auther">Add More</a></td>
					</tr>	
					<tr id="submit_row" class="alt">
						<td width="100%" colspan='2' style="text-align:right;padding-right:30px;"><button name="AbstractFrm" type="submit" class="frm_btn submit" value="Submit">Submit</button></td>
					</tr>					
					</tbody>
				</table>
			</div>
		</form>
	</div>
	
</div>
<?php include_once("side_menu.php"); ?>
<?php include_once("footer.php"); ?>
