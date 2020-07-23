<?php
session_start();
if (isset($_SESSION['status'])) {
    if ($_SESSION['status'] == "user") {
        header("location:home.php?module=viewproduct");
    } else if ($_SESSION['status'] == "admin") {
        header("location:home.php?module=adminviewproduct");
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>INVOS</title>
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <!------ Include the above in your HEAD tag ---------->

    <script src="https://cdn.jsdelivr.net/jquery.validation/1.15.1/jquery.validate.min.js"></script>
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    <link href="../style/style.css" rel="stylesheet">
</head>

<body>
    <div class="container login-wrap">
        <div class="row">
            <div class="col-md-5 mx-auto">
                <div id="first">
                    <div class="myform form">
                        <div class="logo mb-3">
                            <div class="col-md-12 text-center">
                                <h1>Login Dashboard</h1>
                                <h1>INVOS</h1>
                            </div>
                            <hr class="hr-or">
                        </div>

                        <?php if (isset($_GET['notif'])) { ?>
                            <div class="alert alert-danger" role="alert">
                                Username or password do not match!
                            </div>
                        <?php } ?>

                        <form action="../controller/login.php" method="post" name="login">
                            <div class="form-group">
                                <label>USERNAME</label>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-user fa-lg input-icon"></i></span>
                                    <input type="text" name="username" class="form-control" id="username" aria-describedby="emailHelp" placeholder="Enter username">
                                </div>
                            </div>
                            <div class="form-group">
                                <label>PASSWORD</label>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-lock fa-lg input-icon"></i></span>
                                    <input type="password" name="password" id="password" class="form-control" aria-describedby="emailHelp" placeholder="Enter Password">
                                </div>
                            </div>
                            <div class="col-md-12 text-center ">
                                <button type="submit" class=" btn btn-block mybtn btn-primary tx-tfm">Login</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>

<script>
    $(function() {
        $("form[name='login']").validate({
            rules: {

                username: {
                    required: true,
                },
                password: {
                    required: true,

                }
            },
            messages: {
                username: "Please enter username",

                password: {
                    required: "Please enter password",

                }

            },
            submitHandler: function(form) {
                form.submit();
            }
        });
    });
</script>