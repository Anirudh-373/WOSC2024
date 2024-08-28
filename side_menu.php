<div id="columnB">
    <ul class="side_menu">
        <li><a href="index.php">Home</a>
        <li><a href="themes.php">Themes</a></li>
        <li><a href="call_for_abstract.php">Call for Abstract</a></li>
        <li><a href="important_dates.php">Important Dates</a>
        </li>
        <li><a href="registration_fee.php">Registration</a></li>
        <li><a href="org_wc.php">Organizing Committees</a></li>
        <li><a href="associated_events.php">Associated Events</a></li>
        <li><a href="exhibition.php">Exhibition</a>
        </li>
        <!-- <li>
            <a href="documents/Guidelines for Poster Presentations.pdf" target="_blank">Guidelines for Poster Presentation<img src="images/new.gif" width="25" height="15"></a>
        </li> -->
        <li>
            <a href="#">Poster Presentation </a>
            <ul class="sub_side_menu">
                    <li><a href="documents/WOSC2024_Poster_Guidelines.pdf" target='_blank'>Guidelines for Poster Presentation</a></li>
                    <li><a href="documents/WOSC2024_Poster_Template.pdf" target='_blank'>Template for Poster Presentation</a></li>
            </ul>
            <!-- <a href="documents/Guidelines for Poster Presentations.pdf" target="_blank">Guidelines for Poster Presentation<img src="images/new.gif" width="25" height="15"></a> -->
        </li>
        <li>
            <!-- <a href="documents/WOSC_Program_Schedule.pdf" target="_blank">Program Schedule<img src="images/new.gif" width="25" height="15"></a> -->
            <a href="documents/Invitation_Valedictory.jpeg" target="_blank">Valedictory Programme</a>
        </li>
        <li>
            <!-- <a href="documents/WOSC_Program_Schedule.pdf" target="_blank">Program Schedule<img src="images/new.gif" width="25" height="15"></a> -->
            <a href="documents/WOSC24_Inaugural_Function.jpg" target="_blank">WOSC2024 Invitation</a>
        </li>
        <li>
            <!-- <a href="documents/WOSC_Program_Schedule.pdf" target="_blank">Program Schedule<img src="images/new.gif" width="25" height="15"></a> -->
            <a href="program_schedule.php">Program Schedule</a>
        </li>
        <li>
            <!-- <a href="documents/WOSC_Program_Schedule.pdf" target="_blank">Program Schedule<img src="images/new.gif" width="25" height="15"></a> -->
            
            <a href="Lead_Speakers.php" target="_blank">Lead Speakers</a>
        </li>
        <li>
            <a href="documents/Ocean_Summit.pdf" target="_blank">Ocean Summit</a>
        </li>
        <li>
            <a href="#">Other Info</a>
            <ul class="sub_side_menu">
                    <li><a href="accommodate_wc.php">Accomodation</a></li>
                    <li><a href="travel_support.php">Travel Support</a></li>
                    <!--<li><a href="tourism.php">Sightseeing Tours</a></li>-->
                    <li><a href="about_chennai.php">About Chennai</a></li>
            </ul>
        </li>
        <li><a href="venue.php">Venue</a></li>
        <li><a href="contact.php">Contact</a></li>
        <li>
            <a href="#">View Documents</a>
            <ul class="sub_side_menu">
                    <li><a href="documents/WOSC2024_Poster_02.06.2023.pdf" target="_blank" >Poster</a></li>
                    <!-- <li><a href="documents/WOSC2024-brochure.pdf" target="_blank" >First Call </a></li> -->
                    <li><a href="documents/WOSC2024_Brochure_02.06.2023.pdf" target="_blank" >Brochure </a></li>
            </ul>
            <li><a href="mobile_app.php">Android Mobile App</a></li>
			<li><a href="documents/WOSC_2024_FINAL_Version_15.03.2024.pdf">Abstract Volume Report<!--<img src="images/new.gif" width="25" height="15">--></a></li>
          
        </li>

        <li>
            <a href="#">Galleries<img src="images/new.gif" width="25" height="15"></a>
            <ul class="sub_side_menu">
                    <li><a href="Gallareis_day1.php">Day 1 27.02.2024</a></li>
                    <li><a href="Gallareis_day2.php">Day 2 28.02.2024</a></li>
                    <li><a href="Gallareis_day3.php">Day 3 29.02.2024</a></li>
                    <li><a href="awardees.php">Awardees</a></li>
            </ul>
        </li>

        <li><a href="awardwinners.php">Award Winners </a></li>



        <?php 
                $spot_registration_date=strtotime("2024-02-27"); 
                $cur_date = strtotime(date("Y-m-d"));
                if ($spot_registration_date<=$cur_date) { 
                ?>
                    <li><a href="spot_registration.php">Spot Registration</a></li>
          <?php } ?>
    </ul>
   <!-- <div class="brochure"><a  style="color:#000;font-weight:bold;">View Documents</a></div>
    <div class="brochure"><a href="documents/WOSC2024-POSTER.pdf" target="_blank" style="color:#000;font-weight:bold;">Poster</a></div>
    <div class="brochure"><a href="documents/WOSC2024-brochure.pdf" target="_blank" style="color:#000;font-weight:bold;">Brochure</a></div>
    </div>-->
    
    <!-- <div class="visitor_count">
        <div style="margin-bottom:10px;">Visitor Count</div>
            <center>
                <script type="text/javascript" src="//widget.supercounters.com/ssl/hit.js"></script><script type="text/javascript">sc_hit(1677200,4,5);</script><br><noscript><a href="http://www.supercounters.com/">free online counter</a></noscript>
            </center>
    </div> -->
</div>
