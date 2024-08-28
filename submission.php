<?php include_once "header.php"; ?>
<?php include_once "side_menu.php"; ?>
<div id="columnA">
    <h2></h2>
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

            .clear-button {
                background-color: #2980b9;
                color: white;
                border: none;
                border-radius: 3px;
                /*margin-left: 200px;*/
                max-width: 200px;
                padding: 10px;
                cursor: pointer;
                font-size: 16px;
                transition: background-color 0.3s;
            }

            /* Style the tab */
            .tab {
                overflow: hidden;
                border: 1px solid #ccc;
                background-color: #f1f1f1;
            }

            /* Style the buttons inside the tab */
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

            /* Change background color of buttons on hover */
            .tab button:hover {
                background-color: #ddd;
            }

            /* Create an active/current tablink class */
            .tab button.active {
                background-color: #ccc;
            }

            /* Style the tab content */
            .tabcontent {
                display: none;
                padding: 6px 12px;
                border: 1px solid #ccc;
                border-top: none;
            }

            /* The Modal (background) */
            .modal {
                display: none; /* Hidden by default */
                position: fixed; /* Stay in place */
                z-index: 1; /* Sit on top */
                /*padding-top: 100px; !* Location of the box *!*/
                left: 0;
                top: 0;
                width: 100%; /* Full width */
                height: 100%; /* Full height */
                overflow: auto; /* Enable scroll if needed */
                background-color: rgb(0,0,0); /* Fallback color */
                background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
            }

            /* Modal Content */
            .modal-content {
                /*background-color: #fefefe;*/
                margin: auto;
                /*padding: 20px;*/
                /*border: 1px solid #888;*/
                width: 60%;
            }

            /* The Close Button */
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
                cursor:pointer;
            }

        </style>
    <div class="tab">
        <button id="tab1" class="tablinks" onclick="openCity(event, 'London')">Personal Details</button>
        <button id="tab2" class="tablinks" onclick="openCity(event, 'Paris')" disabled>Abstract Submission</button>
        <button id="tab3" class="tablinks" onclick="openCity(event, 'Tokyo')" style="display: none" disabled>Travel Support</button>
    </div>

    <div id="myModal" class="modal"></td>
    <!-- The Modal -->
    <div class="modal-content">

<!--        popup content-->
        <div class="datagrid" style="width: 750px; background-color: white;">

            <form id="regis2" name="regis" enctype="multipart/form-data" method="post">
                <table>
                    <thead>
                    <tr>
                        <th colspan="2" align="center">Abstract Submission</th>
                        <th><span class="close">&times;</span></th>
                    </tr>
                    </thead>
                    <tbody>

                    <tr>

                        <td>Select Subtheme <font color="red">*</font> </td>
                        <td>
                            <select name="subtheme_title" id="subtheme_title" style="width: 60%;" required>
                                <option value="select">Select</option>
                                <option value="subtheme1" >Fisheries with a special focus on offshore cage
                                    culture technology and policy.</option>
                                <option value="subtheme2">Tourism: Development of Tourism in coastal states
                                    and islands and policy.</option>
                                <option value="subtheme3">Ocean services: what is existing and what is required?</option>
                                <option value="subtheme4">Ocean Observations and Modelling.</option>
                                <option value="subtheme5">Harvesting of mineral and other resources from coastal waters, possibilities for mining, EIA requirements etc.</option>
                                <option value="subtheme6">Ocean Summit: Interactions with neighboring countries. (Hybrid)</option>
                                <option value="subtheme7">Policy requirements for sustainable utilization of ocean.</option>
                                <option value="subtheme8">Ocean technologies for sustainable development.</option>
                                <option value="subtheme9">Coastal protection and restoration of coasts.</option>
                                <option value="subtheme10">Marine biodiversity and ocean ecosystem.</option>
                            </select>
                        </td>
                    </tr>
                    <tr class="alt">
                        <td>Title of the Abstract <font color="red">*</font> </td>
                        <td><input type="text" id="abstract_title" name="abstract_title" maxlength="75" size="35"></td>
                    </tr>
                    <tr>
                        <td>Author's Name <font color="red">*</font> </td>
                        <td><input type="text" id="author_name" name="author_name" maxlength="75" size="35"></td>
                    </tr>
                    <tr class="alt">
                        <td>Author's Affiliation <font color="red">*</font> </td>
                        <td><input type="text" id="author_affiliation" name="author_affiliation" size="35" </td>
                    </tr>
                    <tr>
                        <td>Author's Mail ID <font color="red">*</font> </td>
                        <td><input type="text" id="author_mail" name="author_mail" size="35" maxlength="75"> </td>
                    </tr>
                    <tr class="alt">
                        <td>
                            Please Enter the details of the Co-Authors (if any)
                            <p>Enter the details of each Co-Authors separated by a Semi-Colon <b>(;)</b></p>
                            <p>Example: CoAuthor1,Affiliation <b>;</b> CoAuthor2,Affiliation <b>;</b> ...... <b>;</b> CoAuthor-N,Affiliation</p>
                        </td>
                        <td><textarea name="coauthor_details" id="coauthor_details" rows="8" cols="50" maxlength="150"></textarea></td>
                    </tr>
                    <tr>
                        <td>Abstract (Max word limit : 300) <font color="red">*</font> </td>
                        <td>
                            <textarea name="abstract_text" id="abstract_text" rows="5" cols="50" maxlength="300" required spellcheck="false"></textarea><br>
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
                <button type="submit" class="submit-button">Save as Draft</button>
                <button type="submit" class="submit-button">Submit</button>

            </form>
        </div>
    </div>

    </div>

    <div id="London" class="tabcontent">
        <div class="datagrid" style="width: 750px">
            <form id="regis1" name="regis" enctype="multipart/form-data" method="post">
            <table>
                <thead>
                <tr>
                    <th colspan="2" align="center">Personal Details</th>
                </tr>
                </thead>
                <tbody>
                <tr id="personal">
                    <td>Are you a Student or a Professional? <font color="red">*</font> </td>
                    <td>
                        <label>
                            <input type="radio" name="user_type" value="Student" id="student_radio" required>Student
                            <input type="radio" name="user_type" value="Professional" id="professional_radio" required>Professional
                        </label>
                    </td>
                </tr>
                <tr class="alt" id="university-college_name" style="display:none;">
                    <td>University/College Name: <font color="red">*</font> </td>
                    <td>
                        <label for="university-college_name">
                            <input type="text" name="university-college_name" size="35" maxlength="75" id="university-college_name">
                        </label>
                    </td>
                </tr>
                <tr id="year_of_study" style="display:none;">
                    <td>Year of Study <font color="red">*</font> </td>
                    <td>
                        <label for="year_of_study">
                            <input type="text" maxlength="3" size="35" id="year_of_study" name="year_of_study">
                        </label>
                    </td>
                </tr>
                <tr class="alt" id="specialization_student" style="display:none;">
                    <td>Specialization <font color="red">*</font> </td>
                    <td>
                        <label for="specialization_student">
                            <input type="text" maxlength="75" size="35" id="specialization_student" name="specialization_student">
                        </label>
                    </td>
                </tr>
                <tr id="company_name" style="display:none;" class="alt">
                    <td>Company Name <font color="red">*</font> </td>
                    <td>
                        <label for="company_name">
                            <input type="text" maxlength="75" size="35" id="company_name" name="company_name">
                        </label>
                    </td>
                </tr>
                <tr id="designation" style="display:none;">
                    <td>Designation <font color="red">*</font> </td>
                    <td>
                        <label for="designation">
                            <input type="text" id="designation" size="35" maxlength="75" name="designation">
                        </label>
                    </td>
                </tr>
                <tr class="alt" id="specialization_professional" style="display:none;">
                    <td>Specialization <font color="red">*</font> </td>
                    <td>
                        <label for="specialization_professional">
                            <input type="text" id="specialization_professional" name="specialization_professional" maxlength="75" size="35">
                        </label>
                    </td>
                </tr>

                <tr>
                    <td>Mode of Participation <font color="red">*</font> </td>
                    <td>
                            <label>
                            <input type="radio" name="user_type2" value="Oral Presentation" id="oral_radio" required>Oral Presentation
                            <input type="radio" name="user_type2" value="Poster Presentation" id="poster_radio" required>Poster Presentation
                            <input type="radio" name="user_type2" value="Delegate" id="delegate_radio" required>Delegate
                        </label>
                    </td>
                </tr>
                <tr class="alt">
                    <td>Do you need Travel Support ? <font color="red">*</font> </td>
                    <td>
                        <label>
                            <input type="radio" name="yesno" value="yes" id="travel-yes"> Yes
                            <input type="radio" name="yesno" value="no" id="travel-no"> No
                        </label>
                    </td>
                    <script>
                        document.getElementById("travel-yes").addEventListener("click",function (){
                            document.getElementById("tab3").style.display = "block";
                            document.getElementById("btnNextTab2").style.display = "table-row";
                        });
                        document.getElementById("travel-no").addEventListener("click",function (){
                            document.getElementById("tab3").style.display = "none";
                            document.getElementById("btnNextTab2").style.display = "none";

                        });
                    </script>
                </tr>
                <tr>
                    <td>Do you want to submit more than one abstract? <font color="red">*</font> </td>
                    <td>
                        <label>
                            <input type="radio" name="yesnoabs" value="yes" id="abs-yes"> Yes
                            <input type="radio" name="yesnoabs" value="no" id="abs-no"> No
                        </label>
                    </td>
                </tr>
                <tr id="abs_number" style="display: none" class="alt">
                    <td>Enter the number of Abstracts: <font color="red">*</font> </td>
                    <td><input type="text" oninput="setLim(10)" id="abs_num" name="abs_num" min="1" value="1" maxlength="2" size="35"> </td>
                    <script>
                        function setLim(lim) {
                            var abs_num = document.getElementById("abs_num");
                            if(abs_num.value > lim) {
                                alert("Limit only upto 10");
                                abs_num.value = 1;
                            }
                        }
                    </script>
                </tr>
                <script>
                    document.getElementById("abs-yes").addEventListener("click",function (){
                       document.getElementById("abs_number").style.display = "table-row";
                    });
                    document.getElementById("abs-no").addEventListener("click",function (){
                       document.getElementById("abs_number").style.display = "none";
                    });
                </script>

                <script>
                    function updateAbstractColumns() {
                        var numAbstracts = parseInt(document.getElementById("abs_num").value);
                        var tableBody = document.querySelector("#Paris .datagrid tbody");
                        tableBody.innerHTML = '';

                        console.log("numabs=", numAbstracts);

                        for (var i = 1; i <= numAbstracts; i++) {
                            var newRow = document.createElement("tr");
                            newRow.innerHTML = `
                                <td>Abstract ${i}:</td>
                                <td><u onclick="openModal()" style="color: #0404d4;">Add</u></td>
                            `;
                            tableBody.appendChild(newRow);
                        }
                    }

                    document.getElementById("abs-yes").addEventListener("click", function () {
                        document.getElementById("abs_number").style.display = "table-row";
                        document.getElementById("tab2").disabled = false;
                       // document.getElementById("tab3").style.display = "block";
                        //updateAbstractColumns();
                    });

                    document.getElementById("abs-no").addEventListener("click", function () {
                        document.getElementById("abs_number").style.display = "none";
                        document.getElementById("tab2").disabled = false;
                        //document.getElementById("tab3").style.display = "none";
                        document.querySelector("#Paris .datagrid tbody").innerHTML = '';  // Clear existing rows
                    });

                    //document.getElementById("abs_num").addEventListener("input", updateAbstractColumns);
                </script>
                <tr></tr>
                </tbody>
            </table>
        </div>
<!--        <button type="button" onclick="goToTab2()">next</button>-->
        <button type="reset" class="clear-button" id="clear-button">Clear</button>
        <button type="button" class="submit-button" onclick="goToTab2()">Next</button>
        </form>
    </div>

    <div id="Paris" class="tabcontent">
<!--        <button id="myBtn">Open Modal</button>-->
        <div class="datagrid" style="width: 750px">
        <table>
            <thead>
            <tr>
                <th>S.no.</th>
                <th>Submission Status</th>
            </tr>
            </thead>
            <tbody>

            </tbody>
        </table>
        </div>

        <div class="datagrid" style="width: 750px">
            <table>
                <thead>
                    <tr>
                        <th>Sno</th>
                        <th>Subtheme Name</th>
                        <th>Abstract Name</th>
                        <th>Author Details</th>
                        <th>Abstract Detailed View</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>

                </tbody>
            </table>
        </div>

        <button onclick="goToTab1()" class="clear-button" id="clear-button">Back</button>
        <button type="submit" id="btnNextTab2" class="submit-button" onclick="goToTab3()">Next</button>


    </div>



    <div id="Tokyo" class="tabcontent">

        <div class="datagrid" style="width: 750px">
            <form id="regis" name="regis" enctype="multipart/form-data" method="post">
                <table>
                    <thead>
                        <tr>
                            <th colspan="2" align="center">Travel Support</th>
                        </tr>
                    </thead>
                    <tbody>
                    <tr id="travel-support-details">
                        <td>Status <font color="red">*</font> </td>
                        <td>
                            <label>
                                <input type="radio" name="status" value="Student"> Student
                            </label><br>
                            <label>
                                <input type="radio" name="status" value="Employed"> Employed
                            </label><br>
                            <label>
                                <input type="radio" name="status" value="Retired"> Retired
                            </label><br>
                            <label>
                                <input type="radio" name="status" value="Other"> Others (Specify):
                                <input type="text" name="other-status" id="other-status">
                            </label>
                        </td>
                    </tr>
                    <tr class="alt" id="abstract-details">
                        <td>Submitted Abstract? <font color="red">*</font> </td>
                        <td>
                            <label>
                                <input type="radio" name="abstract" value="yes" id="abstract-yes"> Yes
                                <input type="radio" name="abstract" value="no" id="abstract-no"> No
                            </label>
                        </td>
                    </tr>
                    <tr id="abstract-id">
                        <td>Abstract ID <font color="red">*</font> </td>
                        <td>
                            <input type="text" name="abstract-id" id="abstract-id" size="35" maxlength="25">
                        </td>
                    </tr>
                    <tr id="nearest-railway-station" class="alt">
                        <td>Nearest Railway Station <font color="red">*</font> <br><font color="a7166d">(Nearest to the Associated Organization Only)</font></td>
                        <td><input type="text" size="35" maxlength="75" name="nearest-railway-station" id="nearest-railway-station"> </td>
                    </tr>
                    <tr id="nearest-airport">
                        <td>Nearest Airport <font color="red">*</font> <br><font color="a7166d">(Nearest to the Associated Organization Only)</font></td>
                        <td><input type="text" size="35" maxlength="75" name="nearest-airport" id="nearest-airport"> </td>
                    </tr>
                    <tr id="arrival-date-time" class="alt">
                        <td>Date of Arrival with Time <font color="red">*</font> </td>
                        <td><input type="datetime-local" max='2024-12-31T00:00' /></td>
                    </tr>
                    <tr id="departure-date-time" >
                        <td>Date of Departure with Time <font color="red">*</font> </td>
                        <td><input type="datetime-local" max='2024-12-31T00:00' /></td>
                    </tr>
                    </tbody>
                </table>

        </div>

        <button onclick="goToTab2()">back</button>
        <button type="reset" class="clear-button" id="clear-button">Clear</button>

        </form>
    </div>

    <script>


        // text count
        $('#abstract_text').keyup(function() {

            var characterCount = $(this).val().length,
                current = $('#current'),
                maximum = $('#maximum'),
                theCount = $('#the-count');

            current.text(characterCount);
        });

        goToTab1();

        function goToTab1() {

            initContent();
            document.getElementById("London").style.display = "block";
            document.getElementById("tab1").className += " active";

        }

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
            document.getElementById("Paris").style.display = "block";
            document.getElementById("tab2").className += " active";
            document.getElementById("tab2").disabled = false;
            updateAbstractColumns();
        }

        function  goToTab3() {
            initContent();
            document.getElementById("Tokyo").style.display = "block";
            document.getElementById("tab3").className += " active";
            document.getElementById("tab3").disabled = false;

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
        }

        // Get the modal
        let modal = document.getElementById("myModal");

        // Get the button that opens the modal
        // let btn = document.getElementById("myBtn");

        // Get the <span> element that closes the modal
        let span = document.getElementsByClassName("close")[0];
        console.log("span=", span.innerHTML);

        // When the user clicks the button, open the modal
        // btn.onclick = function() {
        //     modal.style.display = "block";
        //     $('body').css("overflow", "hidden");
        // }

        function openModal() {
            modal.style.display = "block";
            $('body').css("overflow", "hidden");
        }

        // When the user clicks on <span> (x), close the modal
        span.onclick = function() {
            modal.style.display = "none";
            $('body').css("overflow", "auto");
            console.log("inside close button click event");
        }

        // When the user clicks anywhere outside of the modal, close it
        window.onclick = function(event) {
            if (event.target === modal) {
                modal.style.display = "none";
                $('body').css("overflow", "auto");
            }
        }
    </script>

    <script>
        document.getElementById("student_radio").addEventListener("click", function (){
            document.getElementById("university-college_name").style.display = "table-row";
            document.getElementById("year_of_study").style.display = "table-row";
            document.getElementById("specialization_student").style.display = "table-row";

            document.getElementById("company_name").style.display = "none";
            document.getElementById("designation").style.display = "none";
            document.getElementById("specialization_professional").style.display = "none";
        });

        document.getElementById("professional_radio").addEventListener("click",function (){
            document.getElementById("company_name").style.display = "table-row";
            document.getElementById("designation").style.display = "table-row";
            document.getElementById("specialization_professional").style.display = "table-row";

            document.getElementById("university-college_name").style.display = "none";
            document.getElementById("year_of_study").style.display = "none";
            document.getElementById("specialization_student").style.display = "none";
        });

        document.getElementById("clear-button").addEventListener("click",function (){


        });

        function logReset(event) {
            document.getElementById("abs_number").style.display = "none";
            document.getElementById("tab2").disabled = true;
            document.getElementById("tab3").style.display = "none";
            document.getElementById("university-college_name").style.display = "none";
            document.getElementById("year_of_study").style.display = "none";
            document.getElementById("specialization_student").style.display = "none";
            document.getElementById("company_name").style.display = "none";
            document.getElementById("designation").style.display = "none";
            document.getElementById("specialization_professional").style.display = "none";
        }
        const form = document.getElementById("regis1");

        form.addEventListener("reset", logReset);
    </script>
</div>
<?php include_once "footer.php"; ?>