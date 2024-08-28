<?php
	include_once("../include/include.php");
	$registration_fee_international=array(

						"International Delegate - IEEE member",
						"International Delegate - Non member",
						"International Student - IEEE member",
						"International Student - Non member"
						);
	function currency($from_Currency,$to_Currency,$amount) {
				$amount = urlencode($amount);
				//$amount = 1;
					$from_Currency = urlencode($from_Currency);
					$to_Currency = urlencode($to_Currency);
					$get = file_get_contents("https://www.google.com/finance/converter?a=$amount&from=$from_Currency&to=$to_Currency");

					$get = explode("<span class=bld>",$get);
					$get = explode("</span>",$get[1]);  
					$converted_amount = preg_replace("/[^0-9\.]/", null, $get[0]);
				  return number_format($converted_amount, 2, '.', '');
					 //return round($converted_amount,2);

			}
	if(isset($_POST['mode']) && $_POST['mode']=="login"){
		$strsql="select * from UT_15 where utRegId='".$_POST['txtUTID']."' and mailId='".$_POST['txtEmail']."'";
		
		$rss1=exec_query($strsql);
		if(is_array($rss1) && count($rss1)>0){
			$_SESSION['UTID']=$rss1[0]['utRegId'];
			$_SESSION['mailId']=$rss1[0]['mailId'];
			$_SESSION['startTime']=time();
			$_SESSION['expireTime']=time()+(5*60);
			echo "Success";die;
		} else {
			echo "Please check your UT15 Registration ID or Mail ID are given properly.";die;
		}
	}
	if(isset($_POST['mode']) && $_POST['mode']=="check_details"){
		$where='';
		if(isset($_POST['mem_id']) && $_POST['mem_id']!=''){
			$where.=" and memberId='".$_POST['mem_id']."'";
		}
		if(isset($_POST['mem_mail']) && $_POST['mem_mail']!=''){
			$where.=" or memberMailId='".$_POST['mem_mail']."'";
		}
		if($_POST['page']=="register") {
			if(isset($_POST['email']) && $_POST['email']!=''){
				$where.=" or mailId='".$_POST['email']."'";
			}
			$strsql="select * from UT_15 where 1=1 and ".$where;
		} else if($_POST['page']=="paper") {
			$strsql="select * from UT_15 where 1=1 and ".$where;
		}
		
		$rss1=exec_query($strsql);
		if(count($rss1)>0){
			if($_POST['page']=="register") {
				echo "Given Mail-Id/IEEE Member ID/IEEE Member Mail-Id is already Registered.";
			} else 
			if($_POST['page']=="paper") {
				echo "Given IEEE Member ID/IEEE Member Mail-Id is already Registered.";
			}
		} else {
			echo "ok";
		}
		die;
	}


	if(isset($_GET['mode']) && $_GET['mode']=="logout"){
		unset($_SESSION['UTID']);
		unset($_SESSION['mailId']);
		echo "<script>window.location.href='../index.php';</script>";die;
	}
	if(isset($_POST['mode']) && $_POST['mode']=="abstract"){
		
		$absType=(isset($_POST['type']))?$_POST['type']:'';
		$utId=(isset($_POST['utId']))?$_POST['utId']:'';
		$utRegId=(isset($_POST['utRegId']))?$_POST['utRegId']:'';
		$abstract_file='';
		
		
		if($absType=="view" && ($_POST['abstract_val']=="" || $_POST['abstract_val']=="Edit") && $_POST['abstract_hidden']!=''){
			$abstract_file=$_POST['abstract_hidden'];
		} else if(isset($_FILES['abstract_file']) ){
			$temp = explode(".", $_FILES["abstract_file"]["name"]);
			$allowedExts = array("pdf","doc","docx","rtf");
			$extension = end($temp);
			if( in_array($extension, $allowedExts)){
				
				if (!file_exists("../upload/abstract/" . $utRegId ."_".$_FILES["abstract_file"]["name"])) {
					$abstract_file=$utRegId ."_".$_FILES["abstract_file"]["name"];
				} else {
					$abstract_file=$utRegId ."_".time()."_".$_FILES["abstract_file"]["name"];
				}
				if($abstract_file!=''){
					chmod("../upload/abstract", 777);
					move_uploaded_file($_FILES["abstract_file"]["tmp_name"], "../upload/abstract/" . $abstract_file);
				}
				if (!file_exists("../upload/abstract/" . $abstract_file)) {
					echo "File Not Uploaded due to some Problem.";die;
				} 
			} else {
				echo "Uploaded File Should be in the PDF/DOC/DOCX Format.";die;
			}
		}
		$txtTitle=(isset($_POST["txtAbsTitle"]))?$_POST["txtAbsTitle"]:'';
		$txtDesp=(isset($_POST["txtAbsDesp"]))?$_POST["txtAbsDesp"]:'';
		$any_author_Abs=(isset($_POST["any_author_Abs"]))?$_POST["any_author_Abs"]:'';
		$txtNoCoAuthor=(isset($_POST["txtAbsNoCoAuthor"]) && $_POST["txtAbsNoCoAuthor"]!='')?$_POST["txtAbsNoCoAuthor"]:'0';
		$txtCoAuthorName='';
		if($any_author_Abs=="yes"){
			if(isset($_POST["txtAbsCoAuthorName"]) && is_array($_POST["txtAbsCoAuthorName"])){
				$txtCoAuthorName=implode("||",$_POST["txtAbsCoAuthorName"]);
			} else if(isset($_POST["txtAbsCoAuthorName"])) {
				$txtCoAuthorName=$_POST["txtAbsCoAuthorName"];
			}
		} else {
			$txtNoCoAuthor='0';
			$txtCoAuthorName='';
		}
		$dateofsub=date("Y-m-d H:i:s",time());
		
		$abs_update="update UT15_Abstract_Upload set delFlag='Y' where utId='".$utId."'";
		$abs_sql=mysql_query($abs_update)or die("Error: ".mysql_error());
		
		$strsql="insert into UT15_Abstract_Upload (utId,utAbstractName,utAbstractPath,utAbstractDescription,utCoAuthorCount,utCoAuthorName,utAbstractDOS,delFlag) 
				values('".$utId."','".$txtTitle."','".$abstract_file."','".$txtDesp."',".$txtNoCoAuthor.",'".$txtCoAuthorName."','".$dateofsub."','N')";
				
		$rs=mysql_query($strsql)or die("Error:".mysql_error());
		if($absType=="view"){
			echo "Abstract Updated Successfully.";die;
		} else {
			echo "Abstract Uploaded Successfully.";die;
		}
	}

	if(isset($_POST['mode']) && $_POST['mode']=="paper"){
		/*echo "<pre>";
		print_r($_POST);
		print_r($_FILES);
		echo "</pre>";*/

		$absType=(isset($_POST['type']))?$_POST['type']:'';
		$utId=(isset($_POST['utId']))?$_POST['utId']:'';
		$utRegId=(isset($_POST['utRegId']))?$_POST['utRegId']:'';
		$paper_file='';
		if($absType=="view" && ($_POST['paper_val']=="" || $_POST['paper_val']=="Edit") && $_POST['paper_hidden']!=''){
			$paper_file=$_POST['paper_hidden'];
		} else if(isset($_FILES['paper_file']) ){
			$temp = explode(".", $_FILES["paper_file"]["name"]);
			$allowedExts = array("pdf","doc","docx","rtf");
			$extension = end($temp);
			if( in_array($extension, $allowedExts)){
				
				if (!file_exists("../upload/paper/" . $utRegId ."_".$_FILES["paper_file"]["name"])) {
					$paper_file=$utRegId ."_".$_FILES["paper_file"]["name"];
				} else {
					$paper_file=$utRegId ."_".time()."_".$_FILES["paper_file"]["name"];
				}
//echo $paper_file;
				if($paper_file!=''){
					chmod("../upload/paper", 777);
					move_uploaded_file($_FILES["paper_file"]["tmp_name"], "../upload/paper/" . $paper_file);
				}
				if (!file_exists("../upload/paper/" . $paper_file)) {
					echo "Paper File Not Uploaded due to some Problem.";die;
				} 
			} else {
				echo "Uploaded Paper File Should be in the PDF/DOC/DOCX Format.";die;
			}
		}
		if($absType=="view" && ($_POST['copy_val']=="" || $_POST['copy_val']=="Edit") && $_POST['copy_hidden']!=''){
			$copy_file=$_POST['copy_hidden'];
		} else if(isset($_FILES['copy_file']) ){
			$temp = explode(".", $_FILES["copy_file"]["name"]);
			$allowedExts = array("pdf","doc","docx","rtf",'jpg','png');
			$extension = end($temp);
			if( in_array($extension, $allowedExts)){
				
				if (!file_exists("../upload/copy/" . $utRegId ."_".$_FILES["copy_file"]["name"])) {
					$copy_file=$utRegId ."_".$_FILES["copy_file"]["name"];
				} else {
					$copy_file=$utRegId ."_".time()."_".$_FILES["copy_file"]["name"];
				}
				if($copy_file!=''){
					chmod("../upload/copy", 777);
					move_uploaded_file($_FILES["copy_file"]["tmp_name"], "../upload/copy/" . $copy_file);
				}
				if (!file_exists("../upload/copy/" . $copy_file)) {
					echo "IEEE Copyright File Not Uploaded due to some Problem.";die;
				} 
			} else {
				echo "Uploaded IEEE Copyright File Should be in the PDF/DOC/DOCX Format.";die;
			}
		}
		$txtTitle=(isset($_POST["txtPaperTitle"]))?$_POST["txtPaperTitle"]:'';
		$dateofsub=date("Y-m-d H:i:s",time());
		$paper_update="update UT15_Abstract_Upload set utCopy='".$copy_file."', utPaperDOS='".$dateofsub."' where utId='".$utId."' and delFlag='N'";
		

		$paper_sql=mysql_query($paper_update)or die("Error: ".mysql_error());
		if($absType=="view"){
			echo "Paper Updated Successfully.";die;
		} else {
			echo "Paper Uploaded Successfully.";die;
		}
	}
if(isset($_POST['mode']) && $_POST['mode']=="paper_paper"){
		/*echo "<pre>";
		print_r($_POST);
		print_r($_FILES);
		echo "</pre>";*/

		$absType=(isset($_POST['type']))?$_POST['type']:'';
		$utId=(isset($_POST['utId']))?$_POST['utId']:'';
		$utRegId=(isset($_POST['utRegId']))?$_POST['utRegId']:'';
		$paper_file='';
		if($absType=="view" && ($_POST['paper_val']=="" || $_POST['paper_val']=="Edit") && $_POST['paper_hidden']!=''){
			$paper_file=$_POST['paper_hidden'];
		} else if(isset($_FILES['paper_file']) ){
			$temp = explode(".", $_FILES["paper_file"]["name"]);
			$allowedExts = array("pdf","doc","docx","rtf");
			$extension = end($temp);
			if( in_array($extension, $allowedExts)){
				
				if (!file_exists("../upload/paper/" . $utRegId ."_".$_FILES["paper_file"]["name"])) {
					$paper_file=$utRegId ."_".$_FILES["paper_file"]["name"];
				} else {
					$paper_file=$utRegId ."_".time()."_".$_FILES["paper_file"]["name"];
				}
//echo $paper_file;
				if($paper_file!=''){
					chmod("../upload/paper", 777);
					move_uploaded_file($_FILES["paper_file"]["tmp_name"], "../upload/paper/" . $paper_file);
				}
				if (!file_exists("../upload/paper/" . $paper_file)) {
					echo "Paper File Not Uploaded due to some Problem.";die;
				} 
			} else {
				echo "Uploaded Paper File Should be in the PDF/DOC/DOCX Format.";die;
			}
		}
		if($absType=="view" && ($_POST['copy_val']=="" || $_POST['copy_val']=="Edit") && $_POST['copy_hidden']!=''){
			$copy_file=$_POST['copy_hidden'];
		} else if(isset($_FILES['copy_file']) ){
			$temp = explode(".", $_FILES["copy_file"]["name"]);
			$allowedExts = array("pdf","doc","docx","rtf",'jpg','png');
			$extension = end($temp);
			if( in_array($extension, $allowedExts)){
				
				if (!file_exists("../upload/copy/" . $utRegId ."_".$_FILES["copy_file"]["name"])) {
					$copy_file=$utRegId ."_".$_FILES["copy_file"]["name"];
				} else {
					$copy_file=$utRegId ."_".time()."_".$_FILES["copy_file"]["name"];
				}
				if($copy_file!=''){
					chmod("../upload/copy", 777);
					move_uploaded_file($_FILES["copy_file"]["tmp_name"], "../upload/copy/" . $copy_file);
				}
				if (!file_exists("../upload/copy/" . $copy_file)) {
					echo "IEEE Copyright File Not Uploaded due to some Problem.";die;
				} 
			} else {
				echo "Uploaded IEEE Copyright File Should be in the PDF/DOC/DOCX Format.";die;
			}
		}
		$txtTitle=(isset($_POST["txtPaperTitle"]))?$_POST["txtPaperTitle"]:'';
		$dateofsub=date("Y-m-d H:i:s",time());
		$paper_update="update UT15_Abstract_Upload set utPaperName='".$txtTitle."' , utPaperPath='".$paper_file."', utCopy='".$copy_file."', utPaperDOS='".$dateofsub."' where utId='".$utId."' and delFlag='N'";
		

		$paper_sql=mysql_query($paper_update)or die("Error: ".mysql_error());
		if($absType=="view"){
			echo "Paper Updated Successfully.";die;
		} else {
			echo "Paper Uploaded Successfully.";die;
		}
	}
	/*if(isset($_POST['mode']) && $_POST['mode']=="trans"){
		$absType=(isset($_POST['type']))?$_POST['type']:'';
		$utId=(isset($_POST['utId']))?$_POST['utId']:'';
		$utRegId=(isset($_POST['utRegId']))?$_POST['utRegId']:'';
		$utFee=(isset($_POST['fee']))?str_replace(",", "", $_POST['fee']):'';
		$txtBankName=(isset($_POST['txtBankName']))?$_POST['txtBankName']:'';
		$txtBranchName=(isset($_POST['txtBranchName']))?$_POST['txtBranchName']:'';
		$txtDOT=(isset($_POST['txtDOT']))?$_POST['txtDOT']:'';
		$arrdot=explode("-",$txtDOT);
		$dot=$arrdot[2]."-".$arrdot[1]."-".$arrdot[0];
		$selMOT=(isset($_POST['selMOT']))?$_POST['selMOT']:'';
		$txtTransRef=(isset($_POST['txtTransRef']))?$_POST['txtTransRef']:'';
		$dateofsub=date("Y-m-d H:i:s",time());
		
		$abs_update="update UT15_Transaction set utDelFlag='Y' where utId='".$utId."'";
		$abs_sql=mysql_query($abs_update)or die("Error: ".mysql_error());
		
		$strsql="insert into UT15_Transaction (utId,utPaidAmount,utPmntProductMode,utBankCode,utBankRefNumber,utPmntTrnNumber,utPaidDate,utTrnStatus,utDelFlag) 
				values('".$utId."','".$utFee."','".$selMOT."','".$txtBankName."','".$txtBranchName."','".$txtTransRef."','".$dot."','Verification Under Process.','N')";
		$rs=mysql_query($strsql)or die("Error:".mysql_error());
		echo "Transaction Successfully.";die;
	}*/
	if(isset($_POST['mode']) && $_POST['mode']=="trans"){
		$absType=(isset($_POST['type']))?$_POST['type']:'';
		$utId=(isset($_POST['utId']))?$_POST['utId']:'';
		$utRegId=(isset($_POST['utRegId']))?$_POST['utRegId']:'';
		$utFee=(isset($_POST['fee']))?str_replace(",", "", $_POST['fee']):'';
		$txtBankName=(isset($_POST['txtBankName']))?$_POST['txtBankName']:'';
		$txtBranchName=(isset($_POST['txtBranchName']))?$_POST['txtBranchName']:'';
		$txtDOT=(isset($_POST['txtDOT']))?$_POST['txtDOT']:'';
		$arrdot=explode("-",$txtDOT);
		$dot=$arrdot[2]."-".$arrdot[1]."-".$arrdot[0];
		$selMOT=(isset($_POST['selMOT']))?$_POST['selMOT']:'';
		$txtTransRef=(isset($_POST['txtTransRef']))?$_POST['txtTransRef']:'';
		$dateofsub=date("Y-m-d H:i:s",time());
		if(isset($_POST['member_id']) || isset($_POST['memberType']) || isset($_POST['memberMailId'])) {
			$member_id=(isset($_POST['member_id']))?$_POST['member_id']:'';
			$memberType=(isset($_POST['memberType']))?$_POST['memberType']:'';
			$memberMailId=(isset($_POST['memberMailId']))?$_POST['memberMailId']:'';
			$ieee_update="update UT_15 set memberId='".$member_id."', memberType='".$memberType."', memberMailId='".$memberMailId."' where utId='".$utId."'";
			$ieee_sql=mysql_query($ieee_update)or die("Error: ".mysql_error());
		}
		$utFeeInr=$utFee;
		
		if($utFeeInr=='75' || $utFeeInr=='100' || $utFeeInr=='300' || $utFeeInr=='400'){
			 $utFeeInr= currency("USD","INR",$utFee);
		}

		$abs_update="update UT15_Transaction set utDelFlag='Y' where utId='".$utId."'";
		$abs_sql=mysql_query($abs_update)or die("Error: ".mysql_error());
		
		$strsql="insert into UT15_Transaction (utId,utMode,utPaidAmount,utInrAmount,utPmntProductMode,utBankCode,utBankRefNumber,utPmntTrnNumber,utPaidDate,utTrnStatus,utSendDate,utDelFlag) 
				values('".$utId."','offline','".$utFee."','".$utFeeInr."','".$selMOT."','".$txtBankName."','".$txtBranchName."','".$txtTransRef."','".$dot."','Verification Under Proces.','".$dateofsub."','N')";
		$rs=mysql_query($strsql)or die("Error:".mysql_error());
		echo "Transaction Successfully.";
		die;
	}
	if(isset($_GET['mode']) && $_GET['mode']=="online_return"){
		
		$serialize_post= serialize ($_POST);
		//print_r($_POST);die;
		$absType=(isset($_POST['type']))?$_POST['type']:'';
		$utId=(isset($_POST['udf1']))?$_POST['udf1']:'';
		$utRegId=(isset($_POST['utRegId']))?$_POST['utRegId']:'';
		$utFee=(isset($_POST['amount']))?str_replace(",", "", $_POST['amount']):'';
		$txtBankName=(isset($_POST['bank_ref_num']))?$_POST['bank_ref_num']:'';
		$txtBranchName=(isset($_POST['bankcode']))?$_POST['bankcode']:'';
		$txtDOT=(isset($_POST['addedon']))?$_POST['addedon']:'';
		$arrdot=explode("-",$txtDOT);
		$dot=$arrdot[2]."-".$arrdot[1]."-".$arrdot[0];
		$selMOT=(isset($_POST['selMOT']))?$_POST['selMOT']:'';
		$txtTransRef=(isset($_POST['txnid']))?$_POST['txnid']:'';
		$status=(isset($_POST['status']))?$_POST['status']:'';
		$dateofsub=date("Y-m-d H:i:s",time());
		if($status=="success"){
		 $strsql="update UT15_Transaction set utMode='online', utBankCode='".$txtBranchName."', utBankRefNumber='".$txtBankName."' , utBankRefNumber='".$txtBankName."' , utBankRefNumber='".$txtBankName."' , utBankRefNumber='".$txtBankName."',utPaidDate='".$txtDOT."', utTrnStatus='".$status."', utReceiveData='".$serialize_post."' , utReceiveDate='".$dateofsub."', utDelFlag='N' where utId= '".$utId."' and utPmntTrnNumber='".$txtTransRef."'";
		$rs=mysql_query($strsql)or die("Error:".mysql_error());
		echo "<script>alert('Transaction Successfully.');window.location='../paper.php?type=transaction&mode=view';</script>";
		echo "Transaction Successfully.";//die;
		} else {
		  $strsql="update UT15_Transaction set utMode='online', utTrnStatus='".$status."', utReceiveData='".$serialize_post."' , utReceiveDate='".$dateofsub."', utDelFlag='N' where utId= '".$utId."' and utPmntTrnNumber='".$txtTransRef."'";
		  $rs=mysql_query($strsql)or die("Error:".mysql_error());
		  echo "<script>alert('Transaction Failed.');window.location='../paper.php?type=transaction&mode=view';</script>";
		  echo "Transaction Failed.";//die;
		}		
	}
?>