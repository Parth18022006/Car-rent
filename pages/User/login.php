<?php
require '../../include/init.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?= urlof('assets/css/login.css'); ?>">
</head>

<body>
    <form method="post">
        <h2>Login form</h2>
        <input type="email" name="mail" id="mail" placeholder="Enter The E-Mail">
        <small id="emsg1" style="color: red; text-align:center ;"></small>

        <input type="password" name="pass" id="pass" placeholder="Enter The Password">
        <small id="emsg2" style="color: red; text-align:center ;"></small>
        <small id="emsg" style="color: red; text-align:center ;"></small>
        <input type="button" value="Login" onclick="login()">
        <p>
            Have you Registered?
            <a href="./register">Register</a>
        </p>
    </form>

    <script>
        function login() {

            let mail = document.getElementById('mail').value;
            let pass = document.getElementById('pass').value;


            document.getElementById('emsg').innerHTML = "";
            document.getElementById('emsg1').innerHTML = "";
            document.getElementById('emsg2').innerHTML = "";

            let vmail = /^[a-zA-Z0-9]+@[a-z]+\.[a-z]{2,}$/;
            let vpass = /^[A-z0-9]{6,18}$/;

            if (mail != "" && mail != null && pass != "" && pass != null) {
                if (vmail.test(mail)) {
                    if (vpass.test(pass)) {
                        let data = {
                            mail: $('#mail').val(),
                            pass: $('#pass').val()
                        }



                        $.ajax({
                            url: "../../api/user/login",
                            method: "POST",
                            data: data,
                            success: function(response) {
                                if (response.success) {
                                    alert("Login Successfully");
                                    $('#mail').val("");
                                    $('#pass').val("");
                                    window.location.href = "../../index"
                                } else {
                                    if (response.reason === "mail") {
                                        document.getElementById('emsg1').innerHTML = "Incorrect E-mail";
                                    } else if (response.reason === "pass") {
                                        document.getElementById('emsg2').innerHTML = "Incorrect Password";
                                    }
                                }
                            },
                            error: function(error) {
                                alert("Not LoggedIn");
                                window.location.href = "./login";
                            }
                        });

                    } else {
                        document.getElementById('emsg2').innerHTML = "Password Pattern Not Matched";
                        return false;
                    }
                } else {
                    document.getElementById('emsg1').innerHTML = "Email Pattern Not Matched";
                    return false;
                }
            } else {
                document.getElementById('emsg').innerHTML = "Null Field Not Allowed";
                return false;
            }
        }
    </script>
</body>

</html>