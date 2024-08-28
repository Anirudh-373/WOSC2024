<?php

session_start();
if(!isset($_SESSION['uts']))
{
	header("location:login.php");
}

include_once('config.php');

$user_id = $_SESSION['id'];
// $user_id = 120;


$query = "select * from wosc24_payment wp
          left join wosc24_registration wr on wr.serial_no=wp.registration_id
          left join registration_id_map rim on rim.registration_id=wp.registration_id
          where wp.status='Paid' and wp.registration_id=$user_id";

$result=pg_query($conn, $query);

$data = pg_fetch_assoc($result);
// echo $data['abstract_id'];

if ($data['registration_num']=="")
{
    echo "No Transaction Found";
    die();
}
$abs_id_list="";
$temp = explode(',', $data['abstract_id']);
//    print_r($temp);
for($i=0; $i<count($temp); $i++) {
    $abs_id_list.="WOSC/2024/ABS/".$temp[$i].", ";
    // echo $abs_id_list."<br>";
}

    $abs_id_list=rtrim($abs_id_list, ", ");
// echo $abs_id_list;
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
        padding: 0;
        margin: 0 auto;
        width: 90%;
    }

    .container {
        width: 100%;
        margin: 0 auto;
        border: 5px solid#117599;
        padding: 10px 50px 10px 50px;
        box-sizing: border-box;
        height: 80%;
    }

    header {
        text-align: left;
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
    }

    .titleone {
        font-family: Tw Cen MT;
        font-size: 1.5em;
        color: #117599;
        line-height: 1.5em;
        font-weight: bold;

    }

    .titletwo {
        font-family: Tw Cen MT;
        font-size: 1.5em;
        color: #0c88b4;
        line-height: 1.5em;
        font-weight: bold;
    }

    .titlethree {
        font-family: Eras Bold ITC;
        font-size: 1.5em;
        color: #e78d43;
        font-style: italic;
        font-weight: bold;
        line-height: 1.5em;
    }

    .content {
        font-family: Sylfaen;
        font-size: 1em;
        text-align: left;
        letter-spacing: 1.5px;
        line-height: 1.5em;
        margin-top: 20px;
    }

    .footer-content {
        font-weight: bold;
        font-size: x-large;
        font-family: Tw Cen MT;
        margin: 10px;
    }

    /* @media print and (orientation: landscape) {
        /* CSS rules for landscape mode go here 
    } */
    </style>
</head>

<body>
    <div class="supercontainer">
        <div class="container">
            <header>
              <table cellpadding="10px">
                <tr>
                  <td><img src="images/receipt/niot_logo.jpg" alt="Header Image"></td>
                  <td style="line-height: 1.5em;">NATIONAL INSTITUTE OF OCEAN TECHNOLOGY<br>CHENNAI-600100 INDIA</td>
                </tr>
              </table>
                
                

            </header>

            <div class="body-content">
                
                <div class="titleone">
                    
                </div>
                <div class="titletwo">
                    
                </div>
                <div class="titlethree">
                    Receipt
                </div>
                <div class="content">
                  <table>
                    <tr>
                      <td>Registration ID:</td>
                      <td><?php echo $data['registration_num'] ?></td>

                      <td>Date:</td>
                      <td><?php echo $data['datefield'] ?></td>
                    </tr>
                    <?php if ($data['abstract_id']=='Delegate'){?>
                        <tr>
                      <td>Participant Type:</td>
                      <td>Delegate</td>
                    </tr>
                    
                    <?php } 
                    else {?>
 <tr>
                      <td>Abstract ID:</td>
                      <td><?php echo $abs_id_list; ?></td>
                    </tr>
                    <?php }?>
                   
                    <tr>
                      <td>Received From:</td>
                      <td><strong><?php echo $data['fullname'] ?></strong></td>
                    </tr>
                    <tr>
                      <td>Towards:</td>
                      <td>Being Registration Fee received towards WOSC-2024</td>
                    </tr>
                    <tr>
                      <td>Amount Paid:</td>
                      <td><?php echo $data['amount'] ?></td>
                    </tr>
                  </table>
                     
                </div>
            </div>

            <footer>
                <div class="signature">
                    <img src="images/receipt/fin_sig.jpeg" alt="Signature" width="150px">
                    <p class="footer-content">Authorised Signatory</p>
                    <!-- <p class="footer-content">Dr. G. A. Ramadass</p>
                    <p class="footer-content">Director - NIOT</p> -->
                </div>
                <!-- <div class="signature footer_img">      
      <img src="images/certificate-res/footer.png" alt="Signature">
    </div> -->
                <!-- <div class="signature">
      <img src="images/certificate-res/IIM-dir-sig.jpeg" alt="Signature" width="150px">
      <p class="footer-content">Co-Chairman</p>
      <p class="footer-content">Prof. S. A. Sannasiraj</p>
      <p class="footer-content">Professor-IIT Madras</p>
      
    </div> -->
            </footer>
        </div>
    </div>
    <style type="text/css">
    @media print {
        #printbtn {
            display: none;
        }
    }
    </style>
    <center><input id="printbtn" type="button" value="Print this page" onclick="window.print();"></center>
    <style type="text/css" media="print">
    @page {
        size: landscape;
    }
    </style>
</body>

</html>