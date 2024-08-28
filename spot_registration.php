<?php include_once("header.php"); ?>
<div id="columnA">
  
    <div class="datagrid" style="width: 750px; background-color: white;">
       
        <form action="">
            <table>
                <thead>
                    <tr>
                        <th align="center" colspan="2">Spot Registration Form</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Title:</td>
                        <td>
                            <select name="sTitle" id="sTitle" required>
                                <option value="">Select</option>
                                <option value="Dr">Dr</option>
                                <option value="Mr">Mr</option>
                                <option value="Mrs">Mrs</option>
                                <option value="Ms">Ms</option>
                                <option value="Prof">Prof</option>
                                <option value="Shri">Shri</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>Fullname:</td>
                        <td><input id="fullname" type="text"></td>
                    </tr>
                    <tr>
                        <td>Full Address with pincode:</td>
                        <td>
                            <textarea name="address" id="address" cols="30" rows="10"></textarea>
                        </td>
                    </tr>
                    <tr>
                        <td>Status:</td>
                        <td>
                            <input type="radio" onclick="calculate_payment();" name="status" value="Student" id="status-student"> Student
                            <input type="radio" onclick="calculate_payment();" name="status" value="Employed" id="status-employed"> Employed
                            <input type="radio" onclick="calculate_payment();" name="status" value="Retired" id="status-retired"> Retired
                            <input type="radio" onclick="calculate_payment();" name="status" value="Other" id="others-specify"> Others
                        </td>
                    </tr>
                    <tr>
                        <td>University/College Name:</td>
                        <td><input id="university" type="text"></td>
                    </tr>
                    <tr>
                        <td>Company Name:</td>
                        <td><input id="company" type="text"></td>
                    </tr>
                    <tr>
                       
                    </tr>
                    <tr>
                        <td>Amount to be Paid (Fee + 18% GST):</td>
                        <td><input type="hidden" id="amount" value="0.0"><b id='amount_to_pay'>₹ 0.00</b></td>
                    </tr>
                    <tr>
                        <td>Transaction Number</td>
                        <td><input id="transaction" type="text"></td>
                    </tr>
                    <tr>
                        <td>Date</td>
                        <td><input id="date" type="date"></td>
                    </tr>
                    <tr>
                        <!--<td colspan=2 style="text-align:center;"><input onclick="register();" style="text-align:center; color: white; background-color: blue; border-radius:5px; padding:5px;" type="button" value="submit" class="submit-button"></td>-->
                    </tr>
                </tbody>
            </table>
        </form>
    </div>
</div>
<script>

    function calculate_payment() {
        var status = document.querySelector('input[name="status"]:checked') !== null ? document.querySelector('input[name="status"]:checked').value : "";
        var amount_to_pay = document.getElementById("amount_to_pay");
        var amount = document.getElementById("amount");
        var fee = 0.0;
        var gst = 18;
        var total_amount = 0.0;
        if(status=="Student") {
            fee = 1000;
        } else {
            fee = 2000;
        }

        total_amount = fee + (fee*gst/100);
        amount_to_pay.innerText = "₹ "+total_amount;
        amount.value = total_amount;
    }
    function validate() {
        var title = document.getElementById('sTitle').value;
        var fullname = document.getElementById('fullname').value;
        var address = document.getElementById('address').value;
        var status = document.querySelector('input[name="status"]:checked') !== null ? document.querySelector('input[name="status"]:checked').value : "";
        var university = document.getElementById('university').value;
        var company = document.getElementById('company').value;
        var transaction = document.getElementById('transaction').value;
        var date = document.getElementById('date').value;


        if(title=="") {
            alert("title is empty");
            return false;
        } else if(fullname=="") {
            alert("fullname is empty");
            return false;
        } else if(address=="") {
            alert("address is empty");
            return false;
        } else if(status=="") {
            alert("status is empty");
            return false;
        } else if(transaction=="") {
            alert("transaction is empty");
            return false;
        } else if(date=="") {
            alert("date is empty");
            return false;
        } 

        if(status=="Student") {
            if(university=="") {
                alert("University Name is required for Student");
                return false;
            }
        } else {
            if(company=="") {
                alert("Company Name is required for Student");
                return false;
            }
        }

        // console.log("hello validate");
        return true;
    }
    function register() {

        var title = document.getElementById('sTitle').value;
        var fullname = document.getElementById('fullname').value;
        var address = document.getElementById('address').value;
        var status = document.querySelector('input[name="status"]:checked') !== null ? document.querySelector('input[name="status"]:checked').value : "";
        var university = document.getElementById('university').value;
        var company = document.getElementById('company').value;
        var transaction = document.getElementById('transaction').value;
        var date = document.getElementById('date').value;
        var amount_to_pay = document.getElementById('amount').value;
        
        var formData = {
            "title": title,
            "fullname": fullname,
            "address": address,
            "status": status,
            "university": university,
            "company": company,
            "transaction_num": transaction,
            "date": date,
            "amount_to_pay": amount_to_pay
        };

        // console.log(formData);

        if(validate()) {
            console.log("hello world");
            $.ajax({
            url: 'api/spot-registration-api.php',
            type: 'POST',
            data: formData,
            // dataType: "json",
            // contentType: 'application/json',
            success: function(response) {
                // console.log("modalresponse=", response);
                var result = JSON.parse(response);
                alert(result.msg);
                location.reload();
            },
            error: function(error) {
                console.log(error)
            }
            });
        } else {
      
            return 0;
        }
        
    }
</script>
<?php include_once("side_menu.php"); ?>
<?php include_once("footer.php"); ?>