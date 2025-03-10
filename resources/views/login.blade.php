
<!DOCTYPE html>
<html>
<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>TotalSale | Login</title>

    <link href="assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/font-awesome/css/font-awesome.css" rel="stylesheet">
    <link href="assets/css/animate.css" rel="stylesheet">
    <link href="assets/css/style.css" rel="stylesheet">

</head>

<body class="gray-bg">

    <div class="middle-box text-center loginscreen animated fadeInDown">
        <div>
            <div>

                <h1 class="logo-name">TS+</h1>

            </div>
            <h3>Bem-vindo ao TotalSale</h3>
            <p> </p>
            <p>Login</p>
            <form class="m-t" role="form" action="{{route('login')}}" method="post">
                @csrf
                <div class="form-group">
                    <input type="text" class="form-control" placeholder="Usuário" name="user" maxlength="8" required>
                </div>
                <div class="form-group">
                    <input type="password" class="form-control" placeholder="Senha" name="password" maxlength="8" required>
                </div>
                <button type="submit" class="btn btn-primary block full-width m-b">Entra</button>
                <p>@if (session()->has('error_login'))
                    {{session()->get('error_login')}}
                @endif</p>
                <!-- <a href="#"><small>Forgot password?</small></a>
                <p class="text-muted text-center"><small>Do not have an account?</small></p>
                <a class="btn btn-sm btn-white btn-block" href="register.html">Create an account</a> -->
            </form>
            <!-- <p class="m-t"> <small>Inspinia we app framework base on Bootstrap 3 &copy; 2014</small> </p> -->
        </div>
    </div>

    <!-- Mainly scripts -->
    <script src="assets/js/jquery-2.1.1.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>

</body>


<!-- Mirrored from webapplayers.com/inspinia_admin-v2.3/login.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 01 Sep 2015 13:12:22 GMT -->
</html>
