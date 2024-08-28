<?php

session_start();
if(!isset($_SESSION['uts']))
{
	header("location:login.php");
}

include_once('config.php');

$user_id = $_SESSION['id'];
$abs_id = $_GET['abs_id'];

$query = "select wosc24_abstract.id as abstract_id, wosc24_abstract.abstract_title, wr.stitle, wr.fullname, absrev.finaldecision 
from public.wosc24_abstract
 left join wosc24_registration wr on wr.serial_no = wosc24_abstract.registration_id 
 left join wosc24_abstract_review absrev on absrev.abstract_id=wosc24_abstract.id
 where registration_id = $user_id and abstract_id=$abs_id  and wosc24_abstract.status in ('S','D');";

$result=pg_query($conn, $query);

// echo $user_id;

$data = pg_fetch_assoc($result);


?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Certificate</title>
<style>
  body {
    margin: 0;
    padding: 0;
  }
  
  .supercontainer {
    border: 5px solid orange;
padding:0;
margin: 0 auto;
    width: 90%;
  }
  .container {
    width: 100%;
    margin: 0 auto;
    border: 5px solid#117599;
    padding: 10px 50px 10px 50px;
    box-sizing: border-box;
    height:80%;
  }
  
  header {
    text-align: center;
    margin-bottom: 20px;
  }
  
  header img {
    max-width: 200px;
    margin-top: 10px;
    margin-bottom: -10px;

  }
  
  .body-content {
    text-align: center;
    margin-bottom: 50px;
  }
  
  .watermark {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -60%);
    opacity: 0.9;
    z-index: -1;    
    width: 400px;
    height: auto;
  }
  
  footer {
    text-align: center;
    margin-top: 50px;
    padding-top: 20px;
    display: flex;
    justify-content: space-between;
  }
  
  .signature {
    width: 30%;    
    margin-top: 20px;
  }
   
  .middle-area {
    width: 50%;
    border-top: 1px solid #000;
    margin-top: 20px;
  }
  
  .signature img {
    max-width: 300px;
    margin-top: -10px;
    margin-left: -30px;
    margin-bottom: -16px;
  }
.titleone{
font-family:Tw Cen MT;
font-size:1.5em;
color:#117599;
line-height: 1.5em;
font-weight: bold;

}
.titletwo{
font-family:Tw Cen MT;
font-size:1.5em;
color:#0c88b4;
line-height: 1.5em;
font-weight: bold;
}
.titlethree{
font-family:Eras Bold ITC;
font-size:1.5em;
color:#e78d43;
font-style: italic;
font-weight: bold;
line-height: 1.5em;
}
.content{
  font-family: Sylfaen;
  font-size:1.2em;
  text-align: justify;
  letter-spacing: 1.5px;
  line-height: 2em;
  margin-top:20px;
}
.footer-content{
  font-weight: bold;
  font-size: x-large;
  font-family:Tw Cen MT;
  margin: 10px;
}
@media print and (orientation: landscape) {
/* CSS rules for landscape mode go here */
}

</style>
</head>
<body>
<div class="supercontainer">
<div class="container">
  <header>
    <img src="images/certificate-res/header.png" alt="Header Image">
  </header>
  
  <div class="body-content">
    <img src="images/certificate-res/watermark.png" alt="Watermark" class="watermark">
    <div class="titleone">
	World Ocean Science Congress 2024
    </div>
    <div class="titletwo">
	“Sustainable Utilization of Oceans in Blue Economy”
    </div>
    <div class="titlethree">
	Certificate
    </div>
<div class="content">
&emsp;&emsp;&emsp;&emsp;This is to certify that <b><?php echo $data['stitle'].". ".$data['fullname']; ?></b> has participated and presented a paper entitled <b>"<?php echo $data['abstract_title']; ?>"</b> at the <strong>World Ocean Science Congress 2024</strong> on the theme of <strong>“Sustainable Utilization of Oceans in Blue Economy”</strong> jointly organized by NIOT, IIT - Madras, and VIBHA at IIT-Madras Research Park, Chennai held from 27th to 29th February 2024.
</div>
  </div>
  
  <footer>
    <div class="signature">
      <img src="images/certificate-res/niot-dir-sig.jpeg" alt="Signature" width="150px">
      <p class="footer-content">Chairman</p>
      <p class="footer-content">Dr. G. A. Ramadass</p>
      <p class="footer-content">Director - NIOT</p>
    </div>
    <div class="signature footer_img">      
      <img src="images/certificate-res/footer.png" alt="Signature">
    </div>
    <div class="signature">
      <img src="images/certificate-res/IIM-dir-sig.jpeg" alt="Signature" width="150px">
      <p class="footer-content">Co-Chairman</p>
      <p class="footer-content">Prof. S. A. Sannasiraj</p>
      <p class="footer-content">Professor-IIT Madras</p>
      
    </div>
  </footer>
</div>
</div>
<style type="text/css">
@media print {
    #printbtn {
        display :  none;
    }
}
</style>
<center><input id ="printbtn" type="button" value="Print this page" onclick="window.print();" ></center>
<style type="text/css" media="print">
  @page { size: landscape; }
</style>
</body>
</html>
