<?php
session_start();
if($_SESSION['admin']=='admin_fna') {
  $user_type = "Finance & Accounts";
} else if($_SESSION['admin']=='admin_niot') {
  $user_type = "Admin";
}
else if($_SESSION['admin']=='admin') {
  $user_type = "Admin";
} else {
  echo "[403: Permission Denied] Session Expired...";
  die();
  // header("location:admin/login.php"); 
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Certificate</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/0.4.1/html2canvas.min.js"></script>
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
        font-size: 1.2em;
        text-align: justify;
        letter-spacing: 1.5px;
        line-height: 2em;
        margin-top: 20px;
    }

    .footer-content {
        font-weight: bold;
        font-size: x-large;
        font-family: Tw Cen MT;
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
                    �Sustainable Utilization of Oceans in Blue Economy�
                </div>
                <div class="titlethree">
                    Volunteer Certificate
                </div>
                <div class="content">
                    This is to certify that <b><?php echo $_GET['participant_name']; ?></b> was a Volunteer and
                    contributed to the success of
                    World Ocean Science Congress 2024 jointly organized by NIOT, IIT - Madras,
                    and VIBHA at IIT-Madras Research Park, Chennai during 27th to 29th February
                    2024.
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
    /* @media print {
        #printbtn {
            display: none;
        }
    } */
    </style>
    <!-- <center><input id="printbtn" type="button" value="Print this page" onclick="window.print();" style='display: none;'></center> -->
    <style type="text/css" media="print">
    @page {
        size: landscape;
    }
    </style>

    <script>
    // Function to convert HTML to an image
    function convertHtmlToImage() {
        // Get the HTML element to be converted to an image (in this case, the entire body)
        var element = document.body;

        var supercontainer = document.getElementsByClassName('supercontainer');

        console.log('supercontainer=', supercontainer);
        // var printbtn = document.getElementById('printbtn');
        var center = document.createElement('center');
        var printButton = document.createElement('button');
        printButton.textContent = 'Print';
        printButton.style.textAlign = 'center';
        center.innerText(printButton);

        console.log(center);


        // Use html2canvas to capture the element as a canvas
        html2canvas(element, {
            onrendered: function(canvas) {
                // Convert the canvas to a data URL representing a PNG image
                var imgData = canvas.toDataURL('image/png');

                // Create a new image element
                var img = new Image();
                img.src = imgData;
                img.style.paddingTop = '20px';

                // Append the image element to the body (or wherever you want to display/save the image)
                document.body.appendChild(img);
                document.body.appendChild(printButton);

                console.log("inside printButton=", document.body);

                // printbtn.style.display = 'block';
                supercontainer[0].style.display = 'none';
                // supercontainer[0].innerHtml = '';

                printButton.addEventListener('click', function() {
                    // Print the current page
                    // Optionally, you can save the image using the following code
                    var link = document.createElement('a');
                    link.download = '<?php echo $_GET['participant_name']; ?>_certificate.png';
                    link.href = imgData;
                    link.click();
                });



            }
        });
    }

    // Call the function to convert the HTML to an image
    convertHtmlToImage();
    </script>
</body>

</html>