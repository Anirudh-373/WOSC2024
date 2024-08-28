function validateForm() {
    // console.log("Hello");
    var email = document.getElementById("email").value;
    var password = document.getElementById("password").value;

    if (!email || !password) {
        alert("Both email and password are required");
        return false;
    }

    return true;
}

$(document).ready(function() {
    $('#loginForm').submit(function(e) {
        e.preventDefault();

        if (validateForm()) {
            $.ajax({
                type: 'POST',
                url: 'api/login-api.php',
                data: $(this).serialize(),
                success: function(response) {
                    console.log(response);
                    var json_data = JSON.parse(response);
                    // console.log(json_data);
                    document.getElementById("alert_msg").innerHTML = json_data.msg;
                    $('#errorText').text("["+json_data.msg_code+"] "+json_data.msg);
                    if(json_data.status===1){
                        window.location.href = 'submission_new.php';
                    }
                },
                error: function() {
                    $('#errorText').text('An error occurred while processing your request.');
                }
            });
        }
    });
});
