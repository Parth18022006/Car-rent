<?php
require '../../include/init.php';
// include pathof('include/header.php');
?>
<!DOCTYPE html>
<html lang="en">
    
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Registration page</title>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Lexend&display=swap" rel="stylesheet" />
    <link href="<?= urlof('assets/css/rstyle.css'); ?>" rel="stylesheet">

</head>

<body>


    <form method="POST">
        <h2>Admin Registration Form</h2>
        <div>
            <input type="email" id="email" name="email" placeholder="Enter the E-mail" />
            <small id="emsg2" style="color: red; text-align:center ;"></small>
        </div>

        <div>
            <input type="password" id="password" name="password" placeholder="Enter The Password" />
            <small id="emsg1" style="color: red; text-align:center ;"></small>
        </div>

        <div>
            <input type="password" id="confirmPassword" name="confirmPassword" placeholder="Enter The Confirm Password" />
            <small id="emsg3" style="color: red; text-align:center ;"></small>
        </div>
        <div>
            <select id="role" name="role">
                <option value="Admin">Admin</option>
                <option value="Customer">Customer</option>
            </select>
        </div>

        <small id="emsg" style="color: red; text-align:center ;"></small>
        <input type="button" value="Register" onclick="insertRecord()" />

    </form>

    <script>
        function insertRecord() {

            let mail = document.getElementById('email').value;
            let password = document.getElementById('password').value;
            let cpassword = document.getElementById('confirmPassword').value;
            let role = document.getElementById('role').value;

            document.getElementById('emsg').innerHTML = "";
            document.getElementById('emsg1').innerHTML = "";
            document.getElementById('emsg2').innerHTML = "";
            document.getElementById('emsg3').innerHTML = "";

            let pmail = /^[a-zA-Z0-9]+@[a-z]+\.[a-z]{2,}$/;
            let vpass = /^[A-z0-9]{6,18}$/;

            if (mail != "" && mail != null && password != "" && password != null && cpassword != "" && cpassword != null && role != "" && role != null) {
                if (pmail.test(mail)) {
                    if (vpass.test(password)) {
                        if (password == cpassword) {
                            
                            let data = {
                                email:$('#email').val(),
                                password:$('#password').val(),
                                role:$('#role').val()
                            }

                            $.ajax({
                                url:"../api/register_api",
                                method:"POST",
                                data:data,
                                success:function(response){
                                    alert(role + "" + "Registered Successfully");
                                    window.location.href = "../../index.php";
                                },
                                error:function(error){
                                    alert(role + "" + "Not Registered");
                                }
                            })
                        } else {
                            document.getElementById('emsg3').innerHTML = "Password Mismatched";
                            return false;
                        }
                    } else {
                        document.getElementById('emsg1').innerHTML = "Password Pattern Not Matched";
                        return false;
                    }
                } else {
                    document.getElementById('emsg2').innerHTML = "Email Pattern Not Matched";
                    return false;
                }
            } else {
                document.getElementById('emsg').innerHTML = "Null Fields Not Allowed";
                return false;
            }
        }
    </script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>


</body>

</html>