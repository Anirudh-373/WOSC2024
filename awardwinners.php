<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" href="imgs/wosc.ico">
    <style>
        .accordion {
            margin: auto;
        }
        .accordion input {
            display: none;
        }
        .box {
            position: relative;
            padding: auto;
            background: white;
            height: 64px;
            transition: all .15s ease-in-out;
        }
        .box::before {
            content: '';
            position: absolute;
            display: block;
            top: 0;
            bottom: 0;
            left: 0;
            right: 0;
            pointer-events: none;
            box-shadow: 0 -1px 0 #e5e5e5,0 0 2px rgba(0,0,0,.12),0 2px 4px rgba(0,0,0,.24);
        }
        header.box {
            background: #084466;
            z-index: 100;
            cursor: initial;
            box-shadow: 0 -1px 0 #e5e5e5,0 0 2px -2px rgba(0,0,0,.12),0 2px 4px -4px rgba(0,0,0,.24);
        }
        header .box-title {
            margin: 0;
            font-weight: normal;
            font-size: 16pt;
            color: white;
            cursor: initial;
            text-align: center;
        }
        .box-title {
            width: calc(100% - 40px);
            height: 64px;
            line-height: 64px;
            padding: 0 20px;
            display: inline-block;
            cursor: pointer;
            -webkit-touch-callout: none;-webkit-user-select: none;-khtml-user-select: none;-moz-user-select: none;-ms-user-select: none;user-select: none;
        }
        .box-content {
            width: calc(100% - 40px);
            padding: 30px 20px;
            font-size: 11pt;
            color: rgba(0,0,0,.54);
            display: none;
        }
        .box-close {
            position: absolute;
            height: 64px;
            width: 100%;
            top: 0;
            left: 0;
            cursor: pointer;
            display: none;
        }
        input:checked + .box {
            height: auto;
            margin: 16px 0;
            box-shadow: 0 0 6px rgba(0,0,0,.16),0 6px 12px rgba(0,0,0,.32);
        }
        input:checked + .box .box-title {
            border-bottom: 1px solid rgba(0,0,0,.18);
        }
        input:checked + .box .box-content,
        input:checked + .box .box-close {
            display: inline-block;
        }
        .arrows section .box-title {
            padding-left: 44px;
            width: calc(100% - 64px);
        }
        .arrows section .box-title:before {
            position: absolute;
            display: block;
           /* content: '\203a';*/
            font-size: 18pt;
            left: 20px;
            top: -2px;
            transition: transform .15s ease-in-out;
            color: rgba(0,0,0,.54);
        }
        input:checked + section.box .box-title:before {
            transform: rotate(90deg);
        }
table {
        width: 100%;
        border-collapse: collapse;
    }
    
    th, td {
        border: 1px solid black;
        padding: 8px;
        text-align: left;
    }
    th {
       
        text-align: center;
        font-weight:bold;
    }

    
    th {
        background-color: #18aad9;
        color:white;
    }
    </style>
</head>
<body>

<?php include_once("header.php"); ?>
<div id="columnA">
    <!-- <h2>Focal Theme: Sustainable Utilization of Oceans in Blue Economy</h2> -->
    <div class="columnA">
       
        <nav class="accordion arrows">
            <header class="box">
                <label for="acc-close" class="box-title">Award Winners</label>
            </header>
            </nav>
            <br>
  <table>
    <tr>
        <th>Name of the Theme</th>
        <th>Name of the Winners</th>
        <th>Name of the Institute</th>
    </tr>
    <tr>
        <td>Fisheries with a special focus on offshore cage culture technology and policy.</td>
        <td>Mr. Nishan Raja R</td>
        <td>Madras University</td>
    </tr>
    <tr>
        <td>Tourism: Development of Tourism in coastal states and islands and policy.</td>
        <td>Dr. Surisetty V V Arun Kumar</td>
        <td>Space Applications Centre (ISRO)Ahmedabad</td>
    </tr>
    
    <tr>
    <td rowspan="3">Ocean services: existing and required.</td>
     <td>Dr. Dhanya M Lal</td>
     <td>INCOIS</td>
    </tr>
    <tr>
        <td>Dr. Sanjiba Kumar Baliarsingh</td>
        <td>INCOIS</td>
    </tr>
    <tr>
        <td>Mr. Sriram Anthoor</td>
        <td>Cochin University of Science and Technology</td>
    </tr>
    <tr>
        <td rowspan="6">Ocean observations, processes and modelling.</td>
        <td>Ms. Divya David T</td>
        <td>NCPOR, Vasco da Gama</td>
    </tr>
    <tr>
        <td>Mr. B Kesavakumar</td>
        <td>NIOT, Chennai</td>
    </tr>
    <tr>
        <td>Ms. Imsangla Imchen</td>
        <td>NIO, Dona Paula</td>
    </tr>
    <tr>
        <td>Ms. Niharika Panigrahi</td>
        <td>CSIR-NIO, Goa</td>
    </tr>
    <tr>
        <td>Mr. Adith VB</td>
        <td>CSIR-NIO</td>
    </tr>
    <tr>
        <td>Mr. Kondeti Vijay Pakash</td>
        <td>IIT Madras</td>
    </tr>
    <tr>
        <td rowspan="1">Harnessing of marine mineral and other resources: Exploration and EIA perspectives.</td>
        <td>Mr. Sajesh P V</td>
        <td>GSI, Mangaluru</td>
    </tr>
    <tr>
        <td rowspan="1">Underwater Domain Awareness.</td>
        <td>Mr. Romit Rajendra Kaware</td>
        <td>MRC, Pune</td>
    </tr>
    <tr>
        <td rowspan="1">Policy requirements for sustainable utilization of ocean.</td>
        <td>Dr. Sabu M</td>
        <td>CMFRI, Kochi</td>
    </tr>
    <tr>
        <td rowspan="2">Ocean technologies for sustainable development.</td>
        <td>Mr. Nitharsan.K</td>
        <td>Bharathidasan university,Trichy</td>
    </tr>
    <tr>
        <td>Ms. Vijaya Lakshmi Thiagarajan</td>
        <td>IIT Madras</td>
    </tr>
    <tr>
        <td rowspan="2">Coastal protection and restoration of coasts.</td>
        <td>Mr. Chintam Venkateswarlu</td>
        <td>Dept of Meteorology and Oceanography Andhra University</td>
    </tr>
    <tr>
        <td>Ms. Aparna Panda</td>
        <td>National Institute of Technology Karnataka</td>
    </tr>
    <tr>
        <td rowspan="5">Marine biodiversity and ocean ecosystem.</td>
        <td>Mr. Ankush Kadu</td>
        <td>IIT Madras</td>
    </tr>
    <tr>
        <td>Ms. Aditi Sharma</td>
        <td>CSIR-NIO, RC Visakhapatnam</td>
    </tr>
    <tr>
        <td>Ms. Kirthiga SS</td>
        <td>KUFOS, Kochi</td>
    </tr>
    <tr>
        <td>Ms. Mayukhmita Ghose</td>
        <td>CSIR-NIO, Dona Paula</td>
    </tr>
    <tr>
        <td>Ms. N.S Heera</td>
        <td>Pondicherry University</td>
    </tr>
</table>

    </div>
</div>
<?php include_once("side_menu.php"); ?>
<?php include_once("footer.php"); ?>
</body>
</html>