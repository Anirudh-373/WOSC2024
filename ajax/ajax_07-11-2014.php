<?php
	include_once("../include/include.php");
	
	
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
?>