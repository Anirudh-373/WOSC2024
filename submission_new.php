<?php 
session_start();
if(!isset($_SESSION['uts']))
{
	header("location:login.php");
}

include_once "header.php";

include_once('config.php');

$registration_id = $_SESSION['id'];
$participant_status = $_SESSION['participant_status'];
$accommodation = $_SESSION['accommodation'];
$ecop = $_SESSION['ecop'];
$mode_of_participation = $_SESSION['mode_of_participation'];
$registered_category = "";
$registration_fee = "0.0";
$delegate_fee = "2000.0";
if($_SESSION['participant_status']=='Student') {
    $registration_fee = 1000;
    //$registered_category = "Student";
    $registered_category = $participant_status;
} else {
    $registration_fee = 2000;
    $registered_category = $participant_status;
}

$submission_date=strtotime("2024-01-31"); 
$cur_date = strtotime(date("Y-m-d"));



//echo "regid=".$registration_id;
//print_r($_SESSION);

$reg="select wosc24_abstract.id as abstract_id, wosc24_abstract.abstract_title, wosc24_abstract.author_name, 
wosc24_abstract.author_affiliation, wosc24_abstract.author_email, wosc24_abstract.coauthor_details, 
wosc24_abstract.abstract_text, wosc24_abstract.status, wosc24_abstract.registration_id, abstract_id_map.abstract_num,
wosc24_subtheme_type.name, absrev.remarks as remarks, absrev.reviewdesp as description, absrev.finaldecision 
from public.wosc24_abstract
 join abstract_id_map on abstract_id_map.abstract_submission_id = wosc24_abstract.id
 join wosc24_subtheme_type on wosc24_subtheme_type.id = wosc24_abstract.subtheme_id
 left join wosc24_abstract_review absrev on absrev.abstract_id=wosc24_abstract.id
 where registration_id = $registration_id  and wosc24_abstract.status in ('S','D')";

$result=pg_query($conn, $reg);

$query = "select travel_support, mode_of_participation from public.wosc24_registration where serial_no=$registration_id";
$travel_result = pg_query($conn, $query);
$travel_support = pg_fetch_assoc($travel_result);

   
$travel_query = "select * from wosc24_travel_support as wts
left join abstract_id_map as absm on absm.abstract_submission_id = wts.abstract_id
where registration_id=$registration_id";
$travel_details = pg_query($conn, $travel_query);

$query = "select wa.*,absid.abstract_num from public.wosc24_abstract as wa
join abstract_id_map as absid on absid.abstract_submission_id=wa.id
join wosc24_abstract_review as war on war.abstract_id=wa.id 
where war.reviewdesp not in ('Rejected') and wa.registration_id=$registration_id and wa.status='S'";
$eligible_abs_for_payment = pg_query($conn, $query);


$query ="select sum(amount) as totalamount from wosc24_payment where registration_id=$registration_id and status = 'Paid' and delFlag='N'";
$result1 = pg_query($conn, $query);
$amount_paid=pg_fetch_assoc($result1);

$query = "";
// query for certificate page
if($_SESSION['mode_of_participation']=='Delegate') {
    // $query = "select * from wosc24_payment wp where registration_id=$registration_id and status='Paid'";
    $query = "select * from wosc24_registration wr
    left join wosc24_payment wp on wp.registration_id = wr.serial_no
    where wr.serial_no=$registration_id and (wp.status = 'Paid' 
    or (wr.company_name ilike '%niot%' or wr.company_name ilike '%national institute of ocean technology%' 
        or wr.serial_no in (182, 163, 211, 265, 174, 528, 195, 205, 207, 217, 101, 275, 208)))
    order by wr.serial_no;";
} else {
    // $query = "select wa.*,absid.abstract_num from public.wosc24_abstract as wa
    // join abstract_id_map as absid on absid.abstract_submission_id=wa.id
    // join wosc24_abstract_review as war on war.abstract_id=wa.id 
    // where war.reviewdesp not in ('Rejected') and wa.registration_id=$registration_id and wa.status='S'";
    $query = "select wa.*,absid.abstract_num, war.finaldecision from public.wosc24_abstract as wa 
    join abstract_id_map as absid on absid.abstract_submission_id=wa.id 
    join wosc24_abstract_review as war on war.abstract_id=wa.id 
    left join wosc24_registration wr on wr.serial_no=wa.registration_id 
    left join wosc24_payment wp on wp.registration_id=wa.registration_id
    where wr.serial_no=$registration_id and 
    ( 
        (war.finaldecision not ilike '%rejected%' and wa.status='S') 
        and (wp.status = 'Paid' 
                 or (wr.company_name ilike '%niot%' 
                 or wr.company_name ilike '%national institute of ocean technology%' 
                 or wr.serial_no in (182, 163, 211, 265, 174, 528, 195, 205, 207, 217, 101, 275, 208)
                )
            )
    )";
}

// echo $query;


$certificate_result=pg_query($conn, $query);


$query ="select * from wosc24_payment where registration_id=$registration_id and delFlag='N'";
// $query = "select * from wosc24_registration wr
// left join wosc24_payment wp on wp.registration_id=wr.serial_no
// where wr.serial_no=$registration_id and 
// ( (wr.company_name ilike '%niot%' or wr.company_name ilike '%national institute of ocean technology%' 
// 			or wr.serial_no in (182, 163, 211, 265, 174, 528, 195, 205, 207, 217, 101, 275, 208)))";
$Payment = pg_query($conn, $query);
$temp=[];
$pay_list=array();
$payment = array();
$payremarks=array();
while($row = pg_fetch_assoc($Payment)) { 
    $temp = explode(',', $row['abstract_id']);
    $pay_list = array_merge($pay_list, $temp);
    for($i=0; $i<count($temp); $i++) {
        $payment[$temp[$i]] = $row['status'];
        $payremarks[$temp[$i]] = $row['remarks'];
    }
    
}

$query = "select * from wosc24_registration wr
left join wosc24_payment wp on wp.registration_id=wr.serial_no
where wr.serial_no=$registration_id and 
( (wr.company_name ilike '%niot%' or wr.company_name ilike '%national institute of ocean technology%' 
			or wr.serial_no in (182, 163, 211, 265, 174, 528, 195, 205, 207, 217, 101, 275, 208)))";

$cert_valid_result = pg_query($conn, $query);
$temp1 = [];
$cert_valid_arr = array();
while($row = pg_fetch_assoc($cert_valid_result)) { 
    $temp1 = explode(',', $row['serial_no']);
    for($i=0; $i<count($temp); $i++) {
        $cert_valid_arr[$temp1[$i]] = $row['status'];
    }
}

$query = "select * from wosc24_payment wp
          left join wosc24_registration wr on wr.serial_no=wp.registration_id
          left join registration_id_map rim on rim.registration_id=wp.registration_id
          where wp.status='Paid' and wp.registration_id=$registration_id";

$result=pg_query($conn, $query);

$data = pg_fetch_assoc($result);
// echo $data['abstract_id'];
$receiptflag=1;
if ($data['registration_num']=="")
{
    $receiptflag=0;
}

 ?>
<?php /*include_once "side_menu.php"; */?>

<!-- <link rel="stylesheet" href="css/style.css"> -->


<script>
function arrange_abs_para(abs_id) {
    var max_chars = 250;
    var td_elem = document.getElementById("abs-" + abs_id);
    var paragraph = td_elem.innerText;
    td_elem.innerText = "";
    var read_more = "Read More";
    let result = "";
    if (paragraph.length > max_chars) {
        sec1 = paragraph.slice(0, max_chars - 10);
        sec2 = paragraph.slice(max_chars - 10, max_chars - 5);
        sec3 = paragraph.slice(max_chars - 5, max_chars);

        const para = document.createElement("p");
        const span1 = document.createElement("span");
        const span2 = document.createElement("span");
        const atag = document.createElement("a");

        para.style.fontFamily = "Times New Roman";
        para.style.fontSize = "11pt";

        span1.style.opacity = "0.5";
        span2.style.opacity = "0.1";
        // atag.href= '#';
        atag.setAttribute("onclick", "read_more('" + abs_id + "')");
        atag.innerText = "Read More";
        atag.style.fontSize = "12px";
        atag.style.textDecoration = "underline";
        atag.style.cursor = "pointer";

        const node1 = document.createTextNode(sec1);
        const node2 = document.createTextNode(sec2);
        const node3 = document.createTextNode(sec3);
        const dotdotdot = document.createTextNode("...");
        span1.appendChild(node2);
        span2.appendChild(node3);

        para.appendChild(node1);
        para.appendChild(span1);
        para.appendChild(span2);
        para.appendChild(dotdotdot);
        para.appendChild(atag);

        td_elem.appendChild(para);
    }
}
</script>
<!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/habibmhamadi/multi-select-tag@2.0.1/dist/css/multi-select-tag.css"> -->
<link rel="stylesheet" href="css/multi-select-tag.css">

<style>
.logoutbtn {
    float: right;
    display: flex;
    background-color: #f3c9c9;
    border: 1px solid #a4a4ad;
    padding: 5px;
}

.logoutbtn:hover {
    background-color: #f1a0a0;
    cursor: pointer;
    /* animation: bubble 0.1s ease-out; */
    /* color: white; */
}

/* 
    @keyframes bubble {
  0% {
    transform: scale(1);
  }
  50% {
    transform: scale(1.03);
  }
  100% {
    transform: scale(1);
  } */
/* } */

.offmode,
.onmode {
    display: none;
}



#myModal_1 {
    display: none;
    position: fixed;
    z-index: 1;
    padding-top: 20px;
    padding-bottom: 20px;
    left: 30%;

    top: 10%;
    width: 30%;
    height: 60%;
    overflow: auto;
    background-color: rgb(0, 0, 0);
    background-color: rgba(0, 0, 0, 0.7);
    /* background-color:white; */
}

#myModal_2 {
    display: none;
    position: fixed;
    z-index: 1;
    padding-top: 20px;
    padding-bottom: 20px;
    left: 30%;

    top: 10%;
    width: 30%;
    height: 40%;
    overflow: auto;
    background-color: rgb(0, 0, 0);
    background-color: rgba(0, 0, 0, 0.8);
    /* background-color:white; */
}

/* Styles for the modal content */
#myModal_1 img {
    margin: auto;
    display: block;
    max-width: 100%;
    max-height: 80%;

}

#myModal_2 div {
    margin: auto;
    padding: 40px;
    color: white;

}

.close1 {
    color: white;
    position: absolute;
    top: 15px;
    right: 15px;
    font-size: 20px;
    font-weight: bold;
    cursor: pointer;
}

.close2 {
    color: white;
    position: absolute;
    top: 15px;
    right: 15px;
    font-size: 20px;
    font-weight: bold;
    cursor: pointer;
}

.loader {
    border: 5px solid #f3f3f3;
    border-radius: 50%;
    border-top: 5px solid #3498db;
    width: 10px;
    height: 10px;
    -webkit-animation: spin 2s linear infinite;
    /* Safari */
    animation: spin 2s linear infinite;
}

.loader1 {
    border: 5px solid #f3f3f3;
    border-radius: 50%;
    border-top: 5px solid #3498db;
    width: 10px;
    height: 10px;
    -webkit-animation: spin 2s linear infinite;
    /* Safari */
    animation: spin 2s linear infinite;
}

/* Safari */
@-webkit-keyframes spin {
    0% {
        -webkit-transform: rotate(0deg);
    }

    100% {
        -webkit-transform: rotate(360deg);
    }
}

@keyframes spin {
    0% {
        transform: rotate(0deg);
    }

    100% {
        transform: rotate(360deg);
    }
}


.tooltip {
    position: relative;
    display: inline-block;
    border-bottom: 1px dotted black;
}

.tooltip .tooltiptext {
    visibility: hidden;
    width: 220px;
    background-color: #000000e6;
    color: #fff;
    text-align: center;
    border-radius: 6px;
    padding: 5px 0;

    /* Position the tooltip */
    position: absolute;
    z-index: 1;
}

.tooltip:hover .tooltiptext {
    visibility: visible;
}
</style>

<div id="">

    <a href="logout.php">
        <button class="logoutbtn" type="button">
            <img src="imgs/logout.png" width="15px">
            Log out
        </button>
    </a>
    <h2 style="font-size: 15px; border-left: none;">Welcome! <span
            style="color: green"><?php echo $_SESSION['fullname']; ?></span> | Registration no: <span
            style="color: green"><?php echo $_SESSION['registration_num']; ?></span></h2>

    <style>
    .submit-button {
        background-color: #2980b9;
        color: white;
        border: none;
        border-radius: 3px;
        max-width: 200px;
        padding: 10px;
        cursor: pointer;
        font-size: 16px;
        transition: background-color 0.3s;
        margin-bottom: 10px;
    }

    #content {
        width: 90%;
        margin: 0px auto;
        padding: 20px 0px 20px 0px;
    }

    .clear-button {
        background-color: #2980b9;
        color: white;
        border: none;
        border-radius: 3px;
        max-width: 200px;
        padding: 10px;
        cursor: pointer;
        font-size: 16px;
        transition: background-color 0.3s;
    }

    .tab {
        overflow: hidden;
        border: 1px solid #ccc;
        background-color: #f1f1f1;
    }

    .tab button {
        background-color: inherit;
        float: left;
        border: none;
        outline: none;
        cursor: pointer;
        padding: 14px 16px;
        transition: 0.3s;
        font-size: 17px;
    }

    .tab button:hover {
        background-color: #ddd;
    }

    .tab button.active {
        background-color: #ccc;
    }

    .tabcontent {
        display: none;
        padding: 6px 12px;
        border: 1px solid #ccc;
        border-top: none;
    }

    .modal {
        display: none;
        position: fixed;
        z-index: 1;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        overflow: auto;
        background-color: rgb(0, 0, 0);
        background-color: rgba(0, 0, 0, 0.4);
    }


    .modal-content {
        margin: auto;
        width: 60%;
    }

    .close {
        color: #aaaaaa;
        float: right;
        font-size: 28px;
        font-weight: bold;


    }

    .close:hover,
    .close:focus {
        color: #000;
        text-decoration: none;
        cursor: pointer;
    }

    u {
        cursor: pointer;
    }
    </style>

    <?php
    include_once('config.php');
   
    //echo "session=";
    //print_r($_SESSION);
   
    // fetching the subtheme_type data
    $sql = "SELECT * from wosc24_subtheme_type";

   $ret = pg_query($conn, $sql);
   if(!$ret) {
      echo pg_last_error($conn);
      exit;
   } 
//    echo "date=".date("Y-m-d h:i:s A")."<br>";

   // inserting of abstract
  // if(isset($_POST)) {
  //  echo "data=".$_POST['draft'];
  //  echo "data=".$_POST['submit'];
  // }

?>

    <div class="tab">
        <?php if($travel_support['mode_of_participation']!='Delegate' ) { ?>
        <button id="tab2" class="tablinks" onclick="openCity(event, 'sub-tab1')">Abstract Submission</button>

        <?php }?>
        <?php if($travel_support['travel_support']=='yes') { ?>
        <button id="tab3" class="tablinks" onclick="openCity(event, 'sub-tab2')">Travel Support</button>
        <?php } ?>

        <button id="tab4" class="tablinks" onclick="openCity(event, 'sub-tab3')">Payment</button>

        <button id="tab5" class="tablinks" onclick="openCity(event, 'sub-tab4')">E-Certificate</button>
        <button id="tab6" class="tablinks" onclick="openCity(event, 'sub-tab6')">E-Receipt</button>

        <!--  -->

    </div>

    <p id="wish"></p>

    <!-- uncomment it when its done -->
    <?php if (!($submission_date < $cur_date)) { ?>
    <div id="myModal" class="modal">
        <!-- The Modal -->
        <div class="modal-content">

            <!--        popup content-->
            <div class="datagrid" style="width: 750px; background-color: white;">

                <form id="regis2" name="regis" method="post">
                    <table>
                        <thead>

                            <tr>
                                <th colspan="2" align="center">Abstract Submission</th>
                                <th><span class="close">&times;</span></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Select Subtheme <font color="red">*</font>
                                </td>
                                <td>
                                    <select name="subtheme_title" id="subtheme_title" style="width: 60%;" required>
                                        <option value="select">Select</option>
                                        <?php while($row = pg_fetch_array($ret)) { ?>
                                        <option value="<?php echo $row['id']; ?>"><?php echo $row['name']; ?></option>
                                        <?php } ?>
                                        <!-- <option value="subtheme2">Tourism: Development of Tourism in coastal states
                                            and islands and policy.</option>
                                        <option value="subtheme3">Ocean services: what is existing and what is required?</option>
                                        <option value="subtheme4">Ocean Observations and Modelling.</option>
                                        <option value="subtheme5">Harvesting of mineral and other resources from coastal waters, possibilities for mining, EIA requirements etc.</option>
                                        <option value="subtheme6">Ocean Summit: Interactions with neighboring countries. (Hybrid)</option>
                                        <option value="subtheme7">Policy requirements for sustainable utilization of ocean.</option>
                                        <option value="subtheme8">Ocean technologies for sustainable development.</option>
                                        <option value="subtheme9">Coastal protection and restoration of coasts.</option>
                                        <option value="subtheme10">Marine biodiversity and ocean ecosystem.</option> -->
                                    </select>
                                </td>
                            </tr>
                            <tr class="alt">
                                <td>Title of the Abstract <font color="red">*</font>
                                </td>
                                <td><input type="text" id="abstract_title" name="abstract_title" maxlength="1000"
                                        size="35"></td>
                            </tr>
                            <tr>
                                <td>Author's Name <font color="red">*</font>
                                </td>
                                <td><input type="text" id="author_name" name="author_name" maxlength="1000" size="35">
                                </td>
                            </tr>
                            <tr class="alt">
                                <td>Author's Affiliation <font color="red">*</font>
                                </td>
                                <td><input type="text" id="author_affiliation" name="author_affiliation" size="35" </td>
                            </tr>
                            <tr>
                                <td>Author's Mail ID <font color="red">*</font>
                                </td>
                                <td><input type="text" id="author_mail" name="author_mail" size="35" maxlength="100">
                                </td>
                            </tr>
                            <tr class="alt">
                                <td width="50%">
                                    Please Enter the details of the Co-Authors (if any)<br>
                                </td>
                                <td><textarea name="coauthor_details" id="coauthor_details" rows="8" cols="50"
                                        maxlength="1000"></textarea>
                                    <br>Enter the details of each Co-Authors separated by a Semi-Colon <b>(;)</b><br>
                                    Ex: CoAuthor1,Affiliation <b>;</b> CoAuthor2,Affiliation <b>;</b> ...... <b>;</b>
                                    CoAuthor-N,Affiliation
                                </td>
                            </tr>
                            <tr>
                                <td>Abstract (Max word limit : 300) <font color="red">*</font>
                                </td>
                                <td>
                                    <textarea onkeyup="countWords()" name="abstract_text" id="abstract_text" rows="10"
                                        cols="50" required spellcheck="false"></textarea><br>
                                    <div id="the-count" style="text-align: right; margin-right: 60px">
                                        <span id="current">0</span>
                                        <span id="maximum">/ 300</span>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td></td>
                            </tr>
                        </tbody>
                    </table>

                    <button type="reset" class="clear-button" id="clear-button" style="margin-left: 10px">Clear</button>
                    <button id="saveDraft" type="button" onclick="save_abstract('D');" name="draft"
                        class="submit-button">Save as Draft</button>
                    <button id="submitAbs" type="button" onclick="save_abstract('S')" name="submit"
                        class="submit-button">Submit</button>

                </form>
            </div>
        </div>

    </div>
    <?php } ?>

    <!-- Travel Support Modal -->
    <!-- <div id="travelSupportModal" class="modal">
            <div class="modal-content">
                <div class="datagrid" style="width: 750px; background-color: white;">
					<form id="regis3" name="regis3" enctype="multipart/form-data" method="post">
						<table>
							<thead>
							<tr>
								<th colspan="2" align="center">Travel Support</th>
								<th><span class="close">&times;</span></th>
							</tr>
							</thead>
							<tbody>
							<tr id="abstract-details">
								<td>Submitted Abstract? <font color="red">*</font> </td>
								<td>
									<label>
										<input type="radio" name="abstract" value="yes" id="abstract-yes"> Yes
										<input type="radio" name="abstract" value="no" id="abstract-no"> No
									</label>
								</td>
							</tr>
							<tr id="abstract-id" style="display: none" class="alt">
								<td>Abstract ID <font color="red">*</font> </td>
								<td>
									<input type="text" name="abstract-id" id="abstract-id" size="35" maxlength="25">
								</td>
							</tr>
							<script>
								document.getElementById("abstract-yes").addEventListener("click",function (){
								   document.getElementById("abstract-id").style.display = "table-row";
								});
								document.getElementById("abstract-no").addEventListener("click",function (){
									document.getElementById("abstract-id").style.display = "none";
								});
							</script>
							<tr id="nearest-railway-station">
								<td>Nearest Railway Station <font color="red">*</font> <br><font color="a7166d">(Nearest to the Associated Organization Only)</font></td>
								<td><input type="text" size="35" maxlength="75" name="nearest-railway-station" id="nearest-railway-station"> </td>
							</tr>
							<tr id="nearest-airport" class="alt">
								<td>Nearest Airport <br><font color="a7166d">(Nearest to the Associated Organization Only)</font></td>
								<td><input type="text" size="35" maxlength="75" name="nearest-airport" id="nearest-airport"> </td>
							</tr>
							<tr id="arrival-date-time">
								<td>Date of Arrival with Time</td>
								<td><input type="datetime-local" max='2024-12-31T00:00' /></td>
							</tr>
							<tr id="departure-date-time" class="alt">
								<td>Date of Departure with Time <font color="red">*</font> </td>
								<td><input type="datetime-local" max='2024-12-31T00:00' /></td>
							</tr>
							</tbody>
						</table>
				
						
						<button type="reset" class="clear-button" id="clear-button" style="margin-left: 10px; margin-top: 10px;">Clear</button>
						<button type="submit" class="submit-button">Submit</button>
					</form>
				</div>
			</div>
		</div> -->


    <div id="sub-tab1" class="tabcontent">
        <?php if (!($submission_date < $cur_date)) { ?>
        <div class="datagrid" style="width: 90%">
            <table>
                <tbody>
                    <tr>
                        <td width="50%">Click on Add to Submit Abstract</td>
                        <td width="50%"><u onclick="openModal()">Add</u></td>
                    </tr>
                </tbody>
            </table>
        </div>
        <?php } ?>

        <div class="datagrid" style="width: 100%">
            <table>
                <thead>
                    <tr>
                        <th>Abstract ID</th>
                        <th>Subtheme Name</th>
                        <th>Abstract Name</th>
                        <th>Author Name</th>
                        <th style="width: 500px;">Abstract Detailed View</th>
                        <th>Status</th>
                        <th>Action taken</th>
                        <th>Remarks by reviewer</th>
                    </tr>
                </thead>
                <tbody id="abs_records">
                    <?php
                    $abs_id_list = array();
					while($row = pg_fetch_assoc($result)) { 
                        // array_push($abs_id_list, $row['abstract_num']); 
                        $abs_id_list[$row['abstract_num']] = $row['abstract_text']; 
                        // print_r($abs_id_list);
                        // echo "abslist=".$abs_id_list[$row['abstract_num']];
                    ?>
                    <tr>
                        <td style="padding-left:5px;"><?php echo $row['abstract_num']; ?></td>
                        <td style="padding-left:5px;"><?php echo $row['name']; ?></td>
                        <td style="padding-left:5px;"><?php echo $row['abstract_title']; ?></td>
                        <td style="padding-left:5px;"><?php echo $row['author_name']; ?></td>
                        <td style="padding-left:5px;" id="abs-<?php echo $row['abstract_num']; ?>">
                            <?php echo $row['abstract_text']; ?></td>
                        <td style="padding-left:5px;"><?php 
                        $status = "";
                        if($row['description']!==NULL){
                            if($row['description']!=='Rejected') {
                                $status="<span style='color:green;font-weight:bold;'>Accepted</span>";
                            }else{
                                $status="<span style='color:red;font-weight:bold;'>Rejected</span>";
                            }
                        }
                        else{
                            if($row['status']=='S') { 
                                $status= "Sumbitted"; 
                            } else { 
                                $abs_id = $row['abstract_id'];
                                //print_r($row);
                                $status= "<span style='text-decoration: underline; color: blue; cursor: pointer;'onclick='openUpdateModal($abs_id);'>Edit</span>";
                            } 
                        }

                        echo $status;
						
						?></td>
                        <!-- <td style="padding-left:5px;">
                            <?php if($row['description']=='Rejected')echo "<span style='color:red;font-weight:bold;'>".$row['description']."</span>"; elseif($row['description']!==NULL) echo "Accepted for <span style='color:green;font-weight:bold;'>".$row['description']."</span>";?>
                        </td> -->
                        <td><?php echo "<b style='color: blue;'>".$row['finaldecision']."</b>";?></td>
                        <td style="padding-left:5px;"><?php echo $row['remarks']; ?></td>

                    </tr>
                    <?php
                    echo "<script>arrange_abs_para('".$row['abstract_num']."');</script>";
                    }
                    
                    ?>
                </tbody>
            </table>
        </div>

        <?php if($travel_support['travel_support']=='yes') { ?>
        <button type="submit" id="btnNextTab2" class="submit-button" onclick="goToTab3()">Next</button>
        <?php } ?>

    </div>

    <!-- this Section need to remove later -->
    <div id="sub-tab2" class="tabcontent">
        <div class="datagrid" style="width: 750px">
            <form id="regis3" name="regis3" enctype="multipart/form-data" method="post">
                <table>
                    <thead>
                        <tr>
                            <th colspan="2" align="center">Travel Support</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr id="abstract-details">
                            <td>Submitted Abstract? <font color="red">*</font>
                            </td>
                            <td>
                                <label>
                                    <input type="radio" name="abstract_details" value="yes" id="abstract-yes"> Yes
                                    <input type="radio" name="abstract_details" value="no" id="abstract-no"> No
                                </label>
                            </td>
                        </tr>

                        <tr id="abstract-id" style="display: none">
                            <td>Abstract ID</td>
                            <td id="abs_id_cell">
                                <select name="abs_id" id="abs_id" multiple>
                                </select>
                            </td>
                        </tr>



                        <script>
                        document.getElementById("abstract-yes").addEventListener("click", function() {
                            document.getElementById("abstract-id").style.display = "table-row";
                        });
                        document.getElementById("abstract-no").addEventListener("click", function() {
                            document.getElementById("abstract-id").style.display = "none";
                        });
                        </script>
                        <tr class="alt">
                            <td>Nearest Railway Stations <font color="red">*</font> <br>
                                <font color="a7166d">(Nearest to the Associated Organization Only)</font>
                            </td>
                            <td><input type="text" size="35" maxlength="75" name="near_railway_st"
                                    id="nearest-railway-station"> </td>
                        </tr>
                        <tr>
                            <td>Nearest Airport
                                <!--<font color="red">*</font>--> <br>
                                <font color="a7166d">(Nearest to the Associated Organization Only)</font>
                            </td>
                            <td><input type="text" size="35" maxlength="75" name="near_air" id="nearest-airport"> </td>
                        </tr>
                        <tr id="departure-date-time" class="alt">
                            <td>Date of Departure with Time <font color="red">*</font>
                            </td>
                            <td><input name="dt_depart" id="datetime_departure" type="datetime-local"
                                    max='2024-12-31T00:00' /></td>
                        </tr>
                        <tr id="arrival-date-time">
                            <td>Date of Arrival with Time
                                <!--<font color="red">*</font>-->
                            </td>
                            <td><input name="dt_arrival" id="datetime_arrival" type="datetime-local"
                                    max='2024-12-31T00:00' /></td>
                        </tr>
                        <?php
                        
                            if($_SESSION['participant_status']=='Student') {
                                
                        ?>
                        <tr id="">
                            <td> Bonafide Certificate / Valid College ID<font color="red">*</font> <br>
                                <font color="a7166d">(In Pdf only)</font>
                            </td>
                            <td>
                                <label>
                                    <input type="file" id="fileInput" name="fileInput">
                                </label>
                            </td>
                        </tr>
                        <?php  } ?>



                    </tbody>
                </table>

        </div>

        <div style="width: 100%; text-align: center;">
            <button onclick="goToTab2()" class="clear-button">Back</button>
            <button type="reset" class="clear-button" id="clear-button">Clear</button>
            <button type="button" onclick="save_travel_support()" class="submit-button">Submit</button>
        </div>

        </form>




        <hr style="border: 1px dashed;">

        <div class="datagrid" style="width: 90%;">
            <h2 style="text-align: center;">Opted Travel support List</h2>
            <table>
                <thead>
                    <tr>
                        <th>Sr. no</th>
                        <th>Travel opted for Abstract ID</th>
                        <th>Nearest Railway Station</th>
                        <th>Nearest Airport</th>
                        <th>Departure Date-Time</th>
                        <th>Arrival Date-Time</th>
                        <?php if($registered_category=="Student") { ?><th>Document</th><?php } ?>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 0;
                    while($row = pg_fetch_assoc($travel_details)) { 
                        $i=$i+1;
                        
                ?>
                    <tr>
                        <td><?php echo $i; ?></td>
                        <td><?php if($row['submitted_abstract']=='yes') echo $row['abstract_num']; else echo "N/A"; ?>
                        </td>
                        <td><?php echo $row['nearest_railway_station']; ?></td>
                        <td><?php echo $row['nearest_airport']; ?></td>
                        <td><?php echo date('d-m-Y h:i:s A', strtotime($row['departure_date_time'])); ?></td>
                        <td><?php echo date('d-m-Y h:i:s A', strtotime($row['arrival_date_time'])); ?></td>
                        <?php if($registered_category=="Student") { ?><td>
                            <?php echo "<a href='".$row['file_url']."'>View</a>"; ?></td><?php } ?>
                        <td><a href="#" onclick="delete_ts_row(<?php echo $row['t_id']; ?>)">Delete</a></td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>

    <div id="sub-tab3" class="tabcontent">
        <h3 style="color:red;text-align:center"><b>Note</b>:-1. Please ensure that you are paying the Overall Amount,
            which includes GST !</h3>
        <h3 style="color:red;text-align:center"> 2. After the payment has been completed successfully, kindly provide
            the correct transaction details for the verification process !</h3>
        <h3 style="color:red;text-align:center"> 3. If you are making the payment through the QR Code/UPI then kindly
            enter UTR Number and for internet banking kindly enter the transaction number !</h3>
        <div class="datagrid" style="width: 75%; background-color: white;">

            <form id="myForm">
                <table>
                    <tr>
                        <th colspan="10">Personal Details</th>
                    </tr>
                    <tr>
                        <td>Name:</td>
                        <td colspan="10"><b><?php echo $_SESSION['fullname'] ?></b></td>
                    </tr>
                    <tr>
                        <td>Registration Category:</td>
                        <td colspan="10"><b><?php echo $registered_category; ?></b></td>
                    </tr>
                    <tr style="background: #626fd1;">
                        <td colspan=10></td>
                    </tr>
                    <tr>
                        <td>Accommodation Required?</td>
                        <td colspan="10">
                            <input type="radio" name="acc_radio" value="yes" id="acc_yes"
                                onClick='set_radio(<?php echo $registration_id?>, "ACC", "acc_loader")'><label
                                for="acc_yes">Yes</label>
                            &nbsp; &nbsp;<input type="radio" name="acc_radio" value="no" id="acc_no"
                                onClick='set_radio(<?php echo $registration_id?>, "ACC", "acc_loader")'><label
                                for="acc_no">No</label>
                            &nbsp; &nbsp;<div style="display: none;" id="acc_loader" class="loader"></div>
                        </td>
                    </tr>

                    <tr>
                        <td>
                            Do you belongs to ECOP?&nbsp;
                            <div class="tooltip">
                                <img src="imgs/info-circle.png" width="15px">
                                <span class="tooltiptext">An ECOP is a person that self identifies as being early in
                                    their carrer, within ten years or less of professional experience any field related
                                    to the ocean.</span>
                            </div>
                        </td>
                        <td colspan="10">
                            <input type="radio" name="ecop_radio" value="yes" id="ecop_yes"
                                onClick='set_radio(<?php echo $registration_id?>, "ECOP", "ecop_loader")'><label
                                for="ecop_yes">Yes</label>
                            &nbsp; &nbsp;<input type="radio" name="ecop_radio" value="no" id="ecop_no"
                                onClick='set_radio(<?php echo $registration_id?>, "ECOP", "ecop_loader")'><label
                                for="ecop_no">No</label>
                            &nbsp; &nbsp;<div style="display: none;" id="ecop_loader" class="loader1"></div>
                        </td>
                    </tr>




                    <tr style="background: #626fd1;">
                        <td colspan=10></td>
                    </tr>

                    <tr>

                        <th colspan="4">Abstract Number</th>
                        <th>Fee</th>
                        <th>Status</th>
                        <th>Remarks</th>
                    </tr>
                    <?php
                $abs_id_paylist=array();
                while($row = pg_fetch_assoc($eligible_abs_for_payment)){
                 array_push($abs_id_paylist,$row['id']);
                 $status="Not Paid";
                 $disabled="";
                 $color="red";
                 $remarks="";
                //  if(array_search($row['id'],$pay_list)===false) {
                    
                //     $status=  "Not Paid";
                //     $disabled=""; 
                //     $color="red";
                // } else { 
                //     $status= "Verification Under Process";
                //     $disabled="disabled";
                //     $color="green";
                // }

                if($payment[$row['id']]=="Paid") {
                    $status = "Paid";
                    $disabled = "disabled";
                    $color = "green";
                    $remarks = $payremarks[$row['id']];
                } else if($payment[$row['id']]=="Not Paid") {
                    $status = "Not Paid";
                    $disabled = "";
                    $color = "red";
                    $remarks = $payremarks[$row['id']];
                } else if($payment[$row['id']]=="Pending") {
                    $status = "<i>Payment Verification Under Process</i>";
                    $disabled = "disabled";
                    $color = "blue";
                    $remarks = $payremarks[$row['id']];
                }

                ?>
                    <tr>
                        <td colspan=4><input type="checkbox" name="absProd" onchange="calculate_amount();"
                                id="<?php echo $row['id']; ?>" <?php echo $disabled; ?>>
                            &nbsp;&nbsp;&nbsp;&nbsp;<span
                                style="color:green;font-weight:bold;"><?php echo $row['abstract_num']; ?></span></td>
                        <td style="font-weight:bold;">&#8377;&nbsp;<?php echo $registration_fee?></td>

                        <td style="font-weight:bold;color:<?php echo $color;?>;">&nbsp;<?php echo $status;?></td>
                        <td>&nbsp;<?php echo $remarks;?></td>
                    </tr>
                    <?php 
                } ?>

                    <?php
                if($_SESSION['mode_of_participation']=='Delegate') { 

                    $status="Not Paid";
                    $disabled="";
                    $color="red";
                    $remarks="";
                 
                    if($payment["Delegate"]=="Paid") {
                        $status = "Paid";
                        $disabled = "disabled";
                        $color = "green";
                        $remarks = $payremarks[$row['id']];
                    } else if($payment["Delegate"]=="Not Paid") {
                        $status = "Not Paid";
                        $disabled = "";
                        $color = "red";
                        $remarks = $payremarks[$row['id']];
                    } else if($payment["Delegate"]=="Pending") {
                        $status = "<i>Payment Verification Under Process</i>";
                        $disabled = "disabled";
                        $color = "blue";
                        $remarks = $payremarks[$row['id']];
                    }
                
                ?>

                    <tr>
                        <td colspan=4><input type="checkbox" name="absProd" onchange="calculate_amount();" id="Delegate"
                                <?php echo $disabled; ?>>
                            &nbsp;&nbsp;&nbsp;&nbsp;<span style="color:green;font-weight:bold;">Delegate Fee</span></td>
                        <td style="font-weight:bold;">&#8377;&nbsp;<?php echo $registration_fee; ?></td>

                        <td style="font-weight:bold;color:<?php echo $color;?>;">&nbsp;<?php echo $status;?></td>
                        <td>&nbsp;<?php echo $remarks;?></td>
                    </tr>

                    <?php } ?>

                    <?php if(empty($abs_id_paylist) && $_SESSION['mode_of_participation']!=='Delegate') { ?>
                    <tr>
                        <td colspan="10" style="text-align: center;">&lt;No Abstracts are eligible for payment&gt;</td>
                    </tr>
                    <?php } ?>

                    <tr>
                        <td colspan="4" style="text-align:center;font-weight:bold;color:#00008B;">Total Amount (A):</td>
                        <td colspan="4" id="total_amt1" style="color:blue;font-weight:bold;">&#8377; 0.0</td>
                    </tr>
                    <tr>
                        <td colspan="4" style="text-align:center;font-weight:bold;color:blue;">Total GST (18%) (B):</td>
                        <td colspan="4" id="total_amt2" style="color:blue;font-weight:bold;">&#8377; 0.0</td>
                    </tr>
                    <tr>
                        <td colspan="4" style="text-align:center;font-weight:bold;color:#cc0000;">Overall Amount to Pay
                            (A+B)</td>
                        <td colspan="4" id="total_amt" style="color:blue;font-weight:bold;">&#8377; 0.0</td>
                    </tr>
                    <tr>
                        <td colspan="4" style="text-align:center;font-weight:bold;color:#f113ab;">Total Amount Paid</td>
                        <td colspan="4" id="total_amt_paid" style="color:#f113ab;font-weight:bold;">
                            &#8377;
                            <?php if(isset($amount_paid['totalamount']))echo $amount_paid['totalamount']; else echo "0.0";?>
                        </td>
                    </tr>


                    <tr style="background: #626fd1;">
                        <td colspan=10></td>
                    </tr>

                    <tr>
                        <td>Payment Mode</td>
                        <td colspan="10"><input type="radio" name="pay_mode" id="" value="Online"
                                onclick="change_mode();">Online
                        </td>
                        <!-- <td colspan="10"><input type="radio" name="pay_mode" id="" value="Gateway" 
                                onclick="change_mode();">Payment Gateway</td>-->

                    </tr>

                    <tr class="offmode" style="background: #626fd1;">
                        <td colspan=10></td>
                    </tr>
                    <tr class="offmode">
                        <th colspan="10">Payment Details</th>
                    </tr>
                    <tr class="offmode">
                        <td>Payment Method:</td>
                        <td><input type="radio" name="pay_method" id="qr_mode" value="QR" onclick="openModal_1()">
                            &nbsp;<b>QR
                                Scanner</b></td>
                        <!-- <td><input type="radio" name="pay_mode" id="dd_mode"> &nbsp;<b>DD</b></td> -->
                        <!-- <td><input type="radio" name="pay_mode" id="chk_mode"> &nbsp;<b>Cheque</b></td> -->
                        <td colspan="10"><input type="radio" name="pay_method" id="ib_mode" value="IB"
                                onclick="openModal_2()">
                            &nbsp;<b>Internet
                                Banking</b>
                        </td>
                    </tr>
                    <!-- <tr class="offmode">
                    <td>Name of Bank:</td>
                    <td colspan="5"><b><input type="text" placeholder="e.g. Canara Bank"></b></td>
                </tr> 
                <tr class="offmode">
                    <td>Account Number:</td>
                    <td colspan="5"><b><input type="text" placeholder="e.g. 125966666"></b></td>
                </tr>
                <tr class="offmode">
                    <td>Bank Branch:</td>
                    <td colspan="5"><b><input type="text" placeholder="e.g. NIOT Chennai"></b></td>
                </tr> 
                <tr class="offmode">
                    <td>UTRN NO(if using QR Scanner):</td>
                    <td colspan="5"><b><input type="text" placeholder="e.g. 123678999976"></b></td>
                </tr>-->

                    <tr class="offmode">
                        <td>Transaction Number/UTRNo/UPI Ref Id<br><b style="color:red;font-size:10.5px;">(If QR Scanner
                                is used provide UTRNo/UPI Ref Id) </b></td>
                        <td colspan="5"><b><input type="text" id="transno" placeholder="e.g. 786762346"></b></td>
                    </tr>
                    <tr class="offmode">
                        <td>Paid Fee Amount:</td>
                        <td colspan="5"><b><input type="text" id="amount" readonly></b></td>
                    </tr>
                    <tr class="offmode">
                        <td>Fee Paid On:</td>
                        <td colspan="5"><b><input type="datetime-local" id="dateField"></b></td>
                    </tr>
                    <tr style="background: #626fd1;">
                        <td colspan=10></td>
                    </tr>
                </table>
            </form>
        </div>


        <center><button type="button" class="submit-button offmode" style="display:none;"
                onclick="save_payment();this.disabled='disabled'">Submit</button></center>

        <center><button type="button" class="submit-button onmode" style="display:none;">Proceed to Pay</button>
        </center>



    </div>

    <div id="myModal_1">
        <span class="close1" onclick="closeModal()">&times;</span>
        <img src="imgs/wosc24_QR code.jpg" alt="My Image">
    </div>

    <div id="myModal_2">
        <span class="close2" onclick="closeModal1()">&times;</span>
        <div>
            <table border="1">
                <tr>
                    <td>Name of the Bank:</td>
                    <td>CANARA BANK</td>
                </tr>
                <tr>
                    <td>Account Branch:</td>
                    <td>CHENNAI PALLIKARANAI NIOT</td>
                </tr>
                <tr>
                    <td>Account No.:</td>
                    <td>110153546187</td>
                </tr>
                <tr>
                    <td>IFSC</td>
                    <td>CNRB0002874</td>
                </tr>
            </table>
        </div>
    </div>

    <div id="sub-tab4" class="tabcontent">
        <div class="datagrid" style="width: 75%; background-color: white;">
            <p style="color: red">Note: Certificate page is compatible for desktop only.</p>
            <table>
                <tr>
                    <th>Sr. No.</th>
                    <th>Abstract Number</th>
                    <th>Abstract Name</th>
                    <th>Action</th>
                </tr>
                <?php 
                    $i = 0;
                    while($row = pg_fetch_assoc($certificate_result)) {  
                        // print_r($row); 
                        
                            if($_SESSION['mode_of_participation']=='Delegate') { ?>
                <tr>
                    <td><?php echo ++$i; ?></td>
                    <td>N/A</td>
                    <td>N/A</td>
                    <td><a href="certificate.php" target="_blank">View / Download (Participation Certification)</a></td>
                </tr>
                <?php } else { 
                                if($payment[$row[$registration_id]]=="Paid" or $payment[$row[$registration_id]]=="") { ?>
                <tr>
                    <td><?php echo ++$i; ?></td>
                    <td><?php echo $row['abstract_num']; ?></td>
                    <td><?php echo $row['abstract_title']; ?></td>
                    <td><a href="cert2.php?abs_id=<?php echo $row['id'] ?>" target="_blank">View / Download</a></td>
                </tr>
                <?php     }
                            }
                    } 
                ?>
            </table>
        </div>
    </div>


    <!-- E- Recipt-->

    <div id="sub-tab6" class="tabcontent">
        <div class="datagrid" style="width: 75%; background-color: white;">

            <table>
                <tr>
                    <th colspan="2">E- Receipt</th>

                </tr>
                <?php if($receiptflag==1) { ?>
                    <tr>
                        <td>Receipt</td>

                        <td><a href="receipt.php">View/Download</a></td>

                    </tr>
                <?php } else { ?>
                    <td colsapan="2"><center>No Transaction Found</center></td>
                <?php } ?>

            </table>
        </div>
    </div>


    <script>
    <?php if($travel_support['mode_of_participation']!='Delegate') { ?>
    goToTab2();
    <?php } else if($travel_support['travel_support']=='yes') { ?>
    goToTab3();
    <?php } else { echo "document.getElementById('wish').innerHTML = ''"; } ?>
    // addOnAbsRecord();

    // Global Variables
    var multiSelect = null;

    function initContent() {
        var i, tabcontent, tablinks;
        tabcontent = document.getElementsByClassName("tabcontent");

        for (i = 0; i < tabcontent.length; i++) {
            tabcontent[i].style.display = "none";
        }
        tablinks = document.getElementsByClassName("tablinks");
        for (i = 0; i < tablinks.length; i++) {
            tablinks[i].className = tablinks[i].className.replace(" active", "");
        }
    }

    function goToTab2() {

        initContent();
        document.getElementById("sub-tab1").style.display = "block";
        document.getElementById("tab2").className += " active";
        document.getElementById("tab2").disabled = false;
    }

    function goToTab3() {
        initContent();
        document.getElementById("sub-tab2").style.display = "block";
        document.getElementById("tab3").className += " active";
        document.getElementById("tab3").disabled = false;
        fetchAbstracts();
    }


    function goToTab4() {
        initContent();
        document.getElementById("sub-tab3").style.display = "block";
        document.getElementById("tab4").className += " active";
        document.getElementById("tab4").disabled = false;
    }

    function setAccomRadio() {
        var acc_val = '<?php echo $accommodation; ?>';
        var ecop = '<?php echo $ecop; ?>';

        var radioButtons = document.getElementsByName("acc_radio");
        var radioButtons2 = document.getElementsByName("ecop_radio");
        for (var i = 0; i < radioButtons.length; i++) {
            // Check if the value matches the desired value
            if (radioButtons[i].value === acc_val) {
                radioButtons[i].checked = true;
            }
        }

        for (var i = 0; i < radioButtons2.length; i++) {
            // Check if the value matches the desired value
            if (radioButtons2[i].value === ecop) {
                radioButtons2[i].checked = true;
            }
        }
    }

    function openCity(evt, cityName) {
        var i, tabcontent, tablinks;
        tabcontent = document.getElementsByClassName("tabcontent");
        for (i = 0; i < tabcontent.length; i++) {
            tabcontent[i].style.display = "none";
        }
        tablinks = document.getElementsByClassName("tablinks");
        for (i = 0; i < tablinks.length; i++) {
            tablinks[i].className = tablinks[i].className.replace(" active", "");
        }
        document.getElementById(cityName).style.display = "block";
        evt.currentTarget.className += " active";

        fetchAbstracts();
        setAccomRadio();

    }

    let modal = document.getElementById("myModal");
    let span = document.getElementsByClassName("close")[0];

    // let travelSupportModal = document.getElementById("travelSupportModal");
    // let tsm_span = document.getElementsByClassName("close")[1];
    // uncomment it when its done
    <?php if (!($submission_date < $cur_date)) { ?>

    function openModal() {
        var modal = document.getElementById("myModal");
        modal.style.display = "block";
        $('body').css("overflow", "hidden");
    }

    span.onclick = function() {
        modal.style.display = "none";
        document.getElementById("regis2").reset();
        $('body').css("overflow", "auto");
    }
    <?php } ?>

    function openTSMModal() {
        var travelSupportModal = document.getElementById("travelSupportModal");
        travelSupportModal.style.display = "block";
        $('body').css("overflow", "hidden");
    }

    function openUpdateModal(id) {
        var modal = document.getElementById("myModal");
        modal.style.display = "block";
        $('body').css("overflow", "hidden");
        console.log("id=", id);

        $.ajax({
            url: 'api/get-abstract-api.php',
            type: 'POST',
            data: {
                "abs_id": id
            },
            // dataType: "json",
            // contentType: 'application/json',
            success: function(response) {
                console.log("modalresponse=", response);
                var result = JSON.parse(response);
                fillModalForm(result);

            },
            error: function(error) {
                console.log(error)
            }
        });
    }

    function fillModalForm(data) {
        document.getElementById("subtheme_title").value = data.subtheme_id;
        document.getElementById("abstract_title").value = data.abstract_title;
        document.getElementById("author_name").value = data.author_name;
        document.getElementById("author_affiliation").value = data.author_affiliation;
        document.getElementById("author_mail").value = data.author_email;
        document.getElementById("coauthor_details").value = data.coauthor_details;
        document.getElementById("abstract_text").value = data.abstract_text.replace('\"', /&quot;/g).replace('\'',
            /&quot;/g);

        var saveDraftBtn = document.getElementById("saveDraft");
        var submitAbs = document.getElementById("submitAbs");

        saveDraftBtn.setAttribute("onclick", "update_abstract('D', " + data.id + ")");
        submitAbs.setAttribute("onclick", "update_abstract('S', " + data.id + ")");
    }

    function update_abstract(status, abs_id) {
        var subtheme_e = document.getElementById("subtheme_title");
        if (subtheme_e.selectedIndex == -1 || subtheme_e.selectedIndex == 0) {
            alert("subtheme name is required");
            return;
        }

        // console.log("selected index", subtheme_e.selectedIndex);
        var subtheme_name = subtheme_e.options[subtheme_e.selectedIndex].text;
        // console.log("subtheme name=", subtheme_name);
        var subtheme_id = document.getElementById("subtheme_title").value;
        var abstract_title = document.getElementById("abstract_title").value;
        var author_name = document.getElementById("author_name").value;
        var author_affiliation = document.getElementById("author_affiliation").value;
        var author_email = document.getElementById("author_mail").value;
        var coauthor_details = document.getElementById("coauthor_details").value;
        var abstract_text = document.getElementById("abstract_text").value;
        var status = status;
        var formData = {
            abstract_id: abs_id,
            subtheme_name: subtheme_name,
            subtheme_id: subtheme_id,
            abstract_title: abstract_title,
            author_name: author_name,
            author_affiliation: author_affiliation,
            author_email: author_email,
            coauthor_details: coauthor_details,
            abstract_text: abstract_text,
            status: status,
            registration_id: <?php echo $_SESSION['id']; ?>
        };

        console.log("formdata=", formData);

        $.ajax({
            url: 'api/update-abstract-api.php',
            type: 'POST',
            data: formData,
            // dataType: "json",
            // contentType: 'application/json',
            success: function(response) {
                console.log("response=", response);
                var result = JSON.parse(response);
                alert("Response: " + result.msg);
                modal.style.display = "none";
                $('body').css("overflow", "auto");
                document.getElementById("regis2").reset();
                location.reload();

                //addOnAbsRecord(formData, result.abs_id);
            },
            error: function(error) {
                console.log(error)
            }
        });
    }




    // tsm_span.onclick = function() {
    // travelSupportModal.style.display = "none";
    // $('body').css("overflow", "auto");
    // }

    window.onclick = function(event) {
        if (event.target === modal) {
            modal.style.display = "none";
            document.getElementById("regis2").reset();
            $('body').css("overflow", "auto");
        }

        // if (event.target === travelSupportModal) {
        // travelSupportModal.style.display = "none";
        // $('body').css("overflow", "auto");
        // }


    }


    function logReset(event) {
        document.getElementById("abs_number").style.display = "none";
        document.getElementById("tab2").disabled = true;
        document.getElementById("abstract-id").style.display = "none";
    }
    // const form = document.getElementById("regis1");
    const form2 = document.getElementById("regis2");
    const form3 = document.getElementById("regis3");

    // form.addEventListener("reset", logReset);
    <?php if (!($submission_date < $cur_date)) { ?>
    form2.addEventListener("reset", logReset);
    <?php } ?>
    form3.addEventListener("reset", logReset);



    function addOnAbsRecord(formData, abs_num) {
        console.log("inside addonabs record=", formData, abs_num);
        var table = document.getElementById("abs_records");

        console.log("tablerow=", table.rows);
        var rowCount = table.rows.length;
        var row = table.insertRow(rowCount);
        var abs_id = row.insertCell(0);
        var subtheme_name = row.insertCell(1);
        var abs_name = row.insertCell(2);
        var author_name = row.insertCell(3);
        var abs_content = row.insertCell(4);
        var status = row.insertCell(5);

        abs_id.innerHTML = abs_num;
        subtheme_name.innerHTML = formData['subtheme_name'];
        abs_name.innerHTML = formData['abstract_title'];
        author_name.innerHTML = formData['author_name'];
        abs_content.innerHTML = formData['abstract_text'];
        var a = "";
        if (formData['status'] == 'D') {
            a = "<a href='#'>Edit</a>";
        } else {
            a = "<i>Submitted</i>";
        }
        status.innerHTML = a;
        status.style.align = "center";
        // console.log("rowlen=", table.rows.length);
    }



    function save_abstract(status) {
        var subtheme_e = document.getElementById("subtheme_title");
        if (subtheme_e.selectedIndex == -1 || subtheme_e.selectedIndex == 0) {
            alert("subtheme name is required");
            return;
        }

        // console.log("selected index", subtheme_e.selectedIndex);
        var subtheme_name = subtheme_e.options[subtheme_e.selectedIndex].text;
        // console.log("subtheme name=", subtheme_name);
        var subtheme_id = document.getElementById("subtheme_title").value;
        var abstract_title = document.getElementById("abstract_title").value;
        var author_name = document.getElementById("author_name").value;
        var author_affiliation = document.getElementById("author_affiliation").value;
        var author_email = document.getElementById("author_mail").value;
        var coauthor_details = document.getElementById("coauthor_details").value;
        var abstract_text = document.getElementById("abstract_text").value;
        var status = status;
        var formData = {
            subtheme_name: subtheme_name,
            subtheme_id: subtheme_id,
            abstract_title: abstract_title,
            author_name: author_name,
            author_affiliation: author_affiliation,
            author_email: author_email,
            coauthor_details: coauthor_details,
            abstract_text: abstract_text,
            status: status,
            registration_id: <?php echo $_SESSION['id']; ?>
        };

        //console.log("formdata=", formData);

        $.ajax({
            url: 'api/submit-abstract-api.php',
            type: 'POST',
            data: formData,
            // dataType: "json",
            // contentType: 'application/json',
            success: function(response) {
                var result = JSON.parse(response);
                alert("Response: " + result.msg);
                modal.style.display = "none";
                $('body').css("overflow", "auto");
                document.getElementById("regis2").reset();
                location.reload();
                //addOnAbsRecord(formData, result.abs_id);
            },
            error: function(error) {
                console.log(error)
            }
        });
    }


    function save_travel_support() {
        // var submitted_abs = document.querySelector('input[name="abstract_details"]').checked;
        var submitted_abs = $('input[name="abstract_details"]:checked').val();
        console.log(submitted_abs);
        // return;
        var abs_id = document.getElementById("abs_id");
        var nearest_railway_st = document.getElementById("nearest-railway-station").value;
        var nearest_airport = document.getElementById("nearest-airport").value;
        var datetime_arrival = document.getElementById("datetime_arrival").value;
        var datetime_departure = document.getElementById("datetime_departure").value;
        var registration_id = <?php echo $_SESSION['id']; ?>

        console.log("abschild=", abs_id);
        var selectedValues = Array.from(document.getElementById('abs_id').selectedOptions).map(option => option
            .value);

        if (selectedValues.length > 0) {
            for (var i = 0; i < selectedValues.length; i++) {

                // var formData = {
                //     sub_abs: submitted_abs,
                //     abs_id: selectedValues[i],
                //     near_railway_st: nearest_railway_st,
                //     near_air: nearest_airport,
                //     dt_arrival: datetime_arrival,
                //     dt_depart: datetime_departure,
                //     registration_id: registration_id,
                //     fileInput: fileInput
                // };

                var formData = new FormData();
                if (submitted_abs == undefined) {
                    alert("Please select 'Submitted Abstract': yes/no\n this field is required*");
                    return;
                }

                <?php if($participant_status=='Student') {?>

                var fileInput = document.getElementById('fileInput');

                // Check if no file is selected
                if (!fileInput.files || fileInput.files.length === 0) {
                    alert("Please upload the file.");
                    return false;
                }

                <?php } ?>
                formData.append('sub_abs', submitted_abs);
                formData.append('abs_id', selectedValues[i]);
                formData.append('near_railway_st', nearest_railway_st);
                formData.append('near_air', nearest_airport);
                formData.append('dt_arrival', datetime_arrival);
                formData.append('dt_depart', datetime_departure);
                formData.append('registration_id', registration_id);


                if ($('#fileInput').length !== 0) {
                    jQuery.each(jQuery('#fileInput')[0].files, function(i, file) {
                        formData.append('files[]', file);

                    });
                }

                console.log("formdata=", formData);

                <?php if($participant_status=='Student') {?>

                var fileInput = document.getElementById('fileInput');

                // Check if no file is selected
                if (!fileInput.files || fileInput.files.length === 0) {
                    alert("Please upload the file.");
                    return false;
                }

                <?php } ?>


                $.ajax({
                    url: 'api/add-travel-api.php',
                    type: 'POST',
                    contentType: false,
                    processData: false,
                    data: formData,
                    success: function(response) {
                        console.log("response=", response);
                        var result = JSON.parse(response);
                        alert("Response: " + result.msg);
                        document.getElementById("regis3").reset();
                        location.reload();
                    },
                    error: function(error) {
                        console.log(error);
                    }
                });
            }
        } else {

            var formData = new FormData();
            if (submitted_abs == undefined) {
                alert("Please select 'Submitted Abstract': yes/no\n this field is required*");
                return;
            }

            <?php if($participant_status=='Student') {?>

            var fileInput = document.getElementById('fileInput');

            // Check if no file is selected
            if (!fileInput.files || fileInput.files.length === 0) {
                alert("Please upload the file.");
                return false;
            }

            <?php } ?>

            // var fileInput = document.getElementById('fileInput');
            // var file = fileInput.files[0];

            // if (!file) {
            //     alert('Please select a file to upload.');
            //     return;
            // }

            formData.append('sub_abs', submitted_abs);
            formData.append('abs_id', 0);
            formData.append('near_railway_st', nearest_railway_st);
            formData.append('near_air', nearest_airport);
            formData.append('dt_arrival', datetime_arrival);
            formData.append('dt_depart', datetime_departure);
            formData.append('registration_id', registration_id);

            if ($('#fileInput').length !== 0) {
                jQuery.each(jQuery('#fileInput')[0].files, function(i, file) {
                    formData.append('files[]', file);
                });
            } else {
                console.log("else part");
            }





            $.ajax({
                url: 'api/add-travel-api.php',
                type: 'POST',
                contentType: false,
                processData: false,
                data: formData,
                success: function(response) {
                    console.log("response=", response);
                    var result = JSON.parse(response);
                    alert("Response: " + result.msg);
                    document.getElementById("regis3").reset();
                    location.reload();
                },
                error: function(error) {
                    console.log(error);
                }
            });
        }
    }



    var charLen = 0;

    function countWords() {

        // Get the input text value 
        var abs_text_elem = document.getElementById("abstract_text")
        var text = abs_text_elem.value;


        // Initialize the word counter 
        var numWords = 0;
        var maxWord = 300;

        // Loop through the text 
        // and count spaces in it 
        for (var i = 0; i < text.length; i++) {
            var currentCharacter = text[i];

            // Check if the character is a space 
            if (currentCharacter == " ") {
                numWords += 1;
            }

        }

        // Add 1 to make the count equal to 
        // the number of words 
        // (count of words = count of spaces + 1) 
        numWords += 1;



        if (numWords <= maxWord) {
            charLen = text.length;
            console.log("numWords, charlen, maxword:", numWords, charLen, maxWord);
        }

        if (numWords > maxWord) {
            // console.log("text length=", abs_text_elem.value);
            abs_text_elem.value = abs_text_elem.value.slice(0, charLen);
            numWords = 300;
        }

        // Display it as output 
        document.getElementById("current")
            .innerHTML = numWords;
    }

    function read_more(abs_id) {
        var text = <?php echo json_encode($abs_id_list); ?>;
        var td_elem = document.getElementById("abs-" + abs_id);

        td_elem.remo

        const para = document.createElement("p");
        var node = document.createTextNode(text[abs_id]);
        const atag = document.createElement("a");

        para.style.fontFamily = "Times New Roman";
        para.style.fontSize = "11pt";
        atag.setAttribute("onclick", "read_less('" + abs_id + "')");
        atag.innerText = "Read Less";
        atag.style.fontSize = "12px";
        atag.style.textDecoration = "underline";
        atag.style.cursor = "pointer";

        td_elem.innerText = "";
        para.appendChild(node);
        para.appendChild(atag);

        td_elem.appendChild(para);

    }

    function read_less(abs_id) {
        var text = <?php echo json_encode($abs_id_list); ?>;
        var max_chars = 250;
        var td_elem = document.getElementById("abs-" + abs_id);
        var paragraph = text[abs_id];
        td_elem.innerText = "";

        var read_more = "Read More";
        let result = "";
        if (paragraph.length > max_chars) {
            sec1 = paragraph.slice(0, max_chars - 10);
            sec2 = paragraph.slice(max_chars - 10, max_chars - 5);
            sec3 = paragraph.slice(max_chars - 5, max_chars);

            const para = document.createElement("p");
            const span1 = document.createElement("span");
            const span2 = document.createElement("span");
            const atag = document.createElement("a");

            para.style.fontFamily = "Times New Roman";
            para.style.fontSize = "11pt";

            span1.style.opacity = "0.5";
            span2.style.opacity = "0.1";
            // atag.href= '#';
            atag.setAttribute("onclick", "read_more('" + abs_id + "')");
            atag.innerText = "Read More";
            atag.style.fontSize = "12px";
            atag.style.textDecoration = "underline";
            atag.style.cursor = "pointer";

            const node1 = document.createTextNode(sec1);
            const node2 = document.createTextNode(sec2);
            const node3 = document.createTextNode(sec3);
            const dotdotdot = document.createTextNode("...");
            span1.appendChild(node2);
            span2.appendChild(node3);

            para.appendChild(node1);
            para.appendChild(span1);
            para.appendChild(span2);
            para.appendChild(dotdotdot);
            para.appendChild(atag);

            td_elem.appendChild(para);
        }
    }



    function fetchAbstracts() {

        var reg_id = <?php echo $_SESSION['id']; ?>;

        $.ajax({
            type: "POST",
            url: "api/get-abstracts-by-regid-api.php",
            data: {
                "registration_id": reg_id
            },
            success: function(response) {
                var result = JSON.parse(response);
                var abs_container = document.getElementById("abs_id");

                abs_container.innerText = "";

                for (var i = 0; i < result.data.length; i++) {
                    row = result.data[i];
                    var opt = document.createElement('option');
                    opt.value = row.id;
                    opt.innerHTML = row.abstract_num;
                    abs_container.appendChild(opt);
                }

                var td_cell = document.getElementById('abs_id_cell');
                var childrens = td_cell.childNodes;

                for (var i = 0; i < childrens.length; i++) {
                    if (i != 1 && i != 0 && i != childrens.length - 1) {
                        td_cell.removeChild(childrens[i]);
                    }
                }

                multiSelect = new MultiSelectTag('abs_id'); // id

            }
        });
    }

    function delete_ts_row(t_id) {
        $.ajax({
            url: 'api/delete-travel-api.php',
            type: 'POST',
            data: {
                "t_id": t_id
            },
            success: function(response) {
                var result = JSON.parse(response);
                alert("Response: " + result.msg);
                location.reload();
                goToTab3();
            },
            error: function(error) {
                console.log(error)
            }
        });
    }

    function check_abs_count()

    {
        var abs_arr = <?php echo json_encode($abs_id_paylist);?>;
        var count = 0;
        var mop = '<?php echo $mode_of_participation; ?>';

        if (mop != 'Delegate') {
            console.log("abs_array=", abs_arr);
            for (var i = 0; i < abs_arr.length; i++) {
                var checkbox = document.getElementById(abs_arr[i]);

                if (checkbox.checked) {
                    count += 1;
                }
            }
        } else {
            var checkbox = document.getElementById(mop);
            if (checkbox.checked) {
                count += 1;
            }
        }

        return count;
    }


    // payment section
    function calculate_amount() {
        change_mode();
        var abs_arr = <?php echo json_encode($abs_id_paylist);?>;
        var total_amt = 0.0;
        var total_amt1 = 0.0;
        var total_amt2 = 0.0;
        var gst_per = 18;
        var reg_fee = <?php echo $registration_fee?>;
        var mop = '<?php echo $mode_of_participation; ?>';
        // var trans_amt=10.0;
        //var reg_fee_with_gst=reg_fee+(reg_fee*gst_per)/100+trans_amt;
        var reg_fee = reg_fee;
        var reg_fee_gst = (reg_fee * gst_per) / 100;
        var reg_fee_with_gst = reg_fee + (reg_fee * gst_per) / 100;

        var total_amt_el = document.getElementById('total_amt');
        var total_amt_el1 = document.getElementById('total_amt1');
        var total_amt_el2 = document.getElementById('total_amt2');




        //console.log(total_amt_el);

        console.log("abs_array=", abs_arr);
        for (var i = 0; i < abs_arr.length; i++) {
            var checkbox = document.getElementById(abs_arr[i]);

            if (checkbox.checked) {
                total_amt += reg_fee_with_gst;
                total_amt1 += reg_fee;
                total_amt2 += reg_fee_gst;
            }
        }

        if (mop == 'Delegate') {
            var checkbox = document.getElementById(mop);

            if (checkbox.checked) {
                total_amt += reg_fee_with_gst;
                total_amt1 += reg_fee;
                total_amt2 += reg_fee_gst;
            }
        }

        // console.log("tatao_amt=", total_amt);
        total_amt_el.innerText = "₹ " + total_amt.toFixed(2);
        total_amt_el1.innerText = "₹ " + total_amt1.toFixed(2);
        total_amt_el2.innerText = "₹ " + total_amt2.toFixed(2);

        var resultField1 = document.getElementById("amount");
        // Check if both result input fields are found
        if (resultField1) {
            // Set the value of both result input fields
            resultField1.value = total_amt;

        }


    }


    function change_mode() {
        const radioButtons = document.getElementsByName('pay_mode');
        const off_element = document.querySelectorAll('.offmode');
        var mop = '<?php echo $mode_of_participation; ?>';

        var flag = 1;
        if (check_abs_count() == 0) {
            flag = 0;
        }
        console.log('off_element', off_element);
        // Loop through radio buttons to find the selected one
        if (flag == 1) {
            for (const radioButton of radioButtons) {
                console.log("method=", radioButton.value);

                if (radioButton.checked) {
                    if (radioButton.value == "Gateway") {
                        off_element.forEach(element => {
                            element.style.display = 'none'; // Example: change text color to red
                            document.getElementsByClassName('onmode')[0].style.display = "table-row";
                            console.log("if mode");
                        });
                    } else {

                        off_element.forEach(element => {
                            element.style.display = 'table-row'; // Example: change text color to red
                            document.getElementsByClassName('onmode')[0].style.display = "none";

                            console.log("else mode=" + check_abs_count());
                        });
                    }
                    break; // Exit the loop once the selected radio button is found
                }
            }
        } else {
            for (const radioButton of radioButtons) {
                if (radioButton.checked && (radioButton.value == 'Online' || radioButton.value == 'Gateway')) {
                    radioButton.checked = false;
                    off_element.forEach(element => {
                        element.style.display = 'none'; // Example: change text color to red

                    });
                }

            }

            if (mop != "Delegate")
                alert("Please select atleast one Abstract No. to proceed for Payment");
            else
                alert("Please select the Delegate Fee checkbox to proceed for Payment");
        }
    }

    function openModal_1() {
        var modal_1 = document.getElementById("myModal_1");
        modal_1.style.display = "block";
    }

    function closeModal() {
        var modal_1 = document.getElementById("myModal_1");
        modal_1.style.display = "none";
    }

    function openModal_2() {
        var modal_2 = document.getElementById("myModal_2");
        modal_2.style.display = "block";
    }

    function closeModal1() {
        var modal_2 = document.getElementById("myModal_2");
        modal_2.style.display = "none";
    }

    // // Close the modal if the user clicks outside the image
    window.onclick = function(event) {
        var modal_1 = document.getElementById("myModal_1");
        if (event.target == modal_1) {
            modal_1.style.display = "none";
        }
    }


    function validate(value, name) {
        console.log("valuename=", value, name)
        if (value.length == 0) {
            alert(name + " field is required");
            console.log("valuename2=", value, name)
            return false;
        }
        return true;
    }


    function save_payment() {

        var abs_arr = <?php echo json_encode($abs_id_paylist);?>;
        // var abs_id = document.getElementById("abs_id").value;
        var transno = document.getElementById("transno").value;
        var amount = document.getElementById("amount").value;
        var dateField = document.getElementById("dateField").value;
        var registration_id = <?php echo $_SESSION['id']; ?>;
        var payment_mode = document.querySelector('input[name="pay_mode"]:checked') !== null ? document.querySelector(
            'input[name="pay_mode"]:checked').value : "";
        var payment_method = document.querySelector('input[name="pay_method"]:checked') !== null ? document
            .querySelector('input[name="pay_method"]:checked').value : "";

        var mop = '<?php echo $mode_of_participation; ?>';


        // console.log("datefield=", dateField.length, !validate(dateField,"Amount Paid On"));
        if (!validate(payment_mode, "Payment Mode")) {
            return 0;
        };
        if (!validate(payment_method, "Payment Method")) {
            return 0;
        };
        if (!validate(transno, "Transaction Number/UTRNo/UPI Ref Id")) {
            return 0;
        };
        if (!validate(amount, "Please select atleast one abstract to proceed. Paid Amount")) {
            return 0;
        };
        if (amount <= 0) {
            alert("Please select atleast one abstract to proceed. Paid Amount field is required");
            return 0;
        }
        if (!validate(dateField, "Amount Paid On")) {
            return 0;
        };

        console.log("amount=" + amount <= 0);

        var selected_abs_id = "";

        if (mop != "Delegate") {
            for (var i = 0; i < abs_arr.length; i++) {
                var checkbox = document.getElementById(abs_arr[i]);

                if (checkbox.checked) {
                    selected_abs_id += abs_arr[i] + ",";
                }
            }
        } else {
            var checkbox = document.getElementById(mop);

            if (checkbox.checked) {
                selected_abs_id += mop + ",";
            }
        }

        selected_abs_id = selected_abs_id.substr(0, selected_abs_id.length - 1);
        console.log("Abstract=", selected_abs_id);
        console.log("Trans=", transno);
        console.log("Amount=", amount);
        console.log("DateField=", dateField);
        console.log("RegistrationId=", registration_id);
        console.log("paydata=", payment_method, payment_mode);

        var delayInMilliseconds = 2000; //1 second

        // setTimeout(function() {
        //     //your code to be executed after 1 second
        $.ajax({
            type: "POST",
            url: "api/payment-api.php",
            data: {
                abs_id: selected_abs_id,
                transno: transno,
                amount: amount,
                dateField: dateField,
                registration_id: registration_id,
                payment_mode: payment_mode,
                payment_method: payment_method
            },
            success: function(response) {
                var json_data = JSON.parse(response);
                alert(json_data.msg); // You can handle the response from the server here
                // $('#myForm')[0].reset();
                location.reload();
            }
        });
        // }, delayInMilliseconds);


    }


    function set_radio(registration_id, req_type, loader_id) {

        if (req_type == "ACC") {
            var data = document.querySelector('input[name="acc_radio"]:checked') !== null ? document.querySelector(
                'input[name="acc_radio"]:checked').value : "";
            makeAjaxRequest(registration_id, "api/accommodation_08022024-api.php", data, loader_id, req_type);
        } else if (req_type == "ECOP") {
            var data = document.querySelector('input[name="ecop_radio"]:checked') !== null ? document.querySelector(
                'input[name="ecop_radio"]:checked').value : "";
            makeAjaxRequest(registration_id, "api/accommodation_08022024-api.php", data, loader_id, req_type);
        }
    }

    function makeAjaxRequest(registration_id, api_url, data, loader_id, req_type) {
        var loader = document.getElementById(loader_id);
        loader.style.display = "block";

        $.ajax({
            type: "POST",
            url: api_url,
            data: {
                registration_id: registration_id,
                data: data,
                req_type: req_type
            },
            success: function(response) {
                var json_data = JSON.parse(response);
                console.log("jsondata=", json_data);
                loader.style.display = "none";
                alert(json_data.msg); // You can handle the response from the server here
                // $('#myForm')[0].reset();
                location.reload();
            }
        });
    }
    </script>






    <!-- <script src="js/style.js"></script> -->
    <script src="https://cdn.jsdelivr.net/gh/habibmhamadi/multi-select-tag@2.0.1/dist/js/multi-select-tag.js"></script>



    <div style="height: 200px;"></div>

    <?php include_once "footer.php"; ?>