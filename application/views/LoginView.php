<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login to Portal</title>
    <link rel="stylesheet" type="text/css" href="<?= base_url() . 'assets/vendor/bootstrap/dist/css/bootstrap.min.css' ?>">
    <link rel="stylesheet" type="text/css" href="<?= base_url() . 'assets/vendor/fontawesome/css/all.min.css' ?>">
    <style>
        .logo {
            background-image: url("assets/images/logo.jpg");
            width: 50%;
            height: 50%;
            background-repeat: no-repeat;
            position: absolute;
            margin: 100px;
        }
    </style>
</head>

<body class="logo">
    <div class="container">
        <div class="row">
            <div class="card rounded-0">
                <div class="card-body">
                    <h4 class="card-title">LOGIN</h4>
                    <div class="card-text">
                        <form class="user" method="POST" action="<?= base_url() . 'administrator/auth' ?>">
                            <div class="form-group">
                                <input type="hidden" value="user" name="username">
                                <input type="password" class="form-control form-control-user" name="idpersonal" placeholder="Input Personal ID...">
                            </div>

                            <input type="submit" class="btn btn-primary btn-user btn-block" value="Login">

                            <hr>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="<?= base_url() . 'assets/js/jquery-3.5.1.js' ?>" type="text/javascript"></script>
    <script src="<?= base_url() . 'assets/vendor/bootstrap/dist/js/bootstrap.bundle.min.js' ?>" type="text/javascript"></script>
    <script src="<?= base_url() . 'assets/vendor/bootstrap/dist/js/bootstrap.min.js' ?>" type="text/javascript"></script>
</body>

</html>