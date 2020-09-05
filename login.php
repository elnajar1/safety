<?php 

    include_once $_SERVER['DOCUMENT_ROOT'] . '/safety/includes/config.php'; 
    if ( isset($user_id) ){
        header("location: dashboard.php");
        exit;
    }
    
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Login - Safety</title>
    <link rel="icon" type="image/png" sizes="undefinedxundefined" href="layout/assets/img/logo.png?h=bbdfc6a09095f7548f82c4c476b0b087">
    <link rel="icon" type="image/png" sizes="undefinedxundefined" href="layout/assets/img/logo.png?h=bbdfc6a09095f7548f82c4c476b0b087">
    <link rel="stylesheet" href="layout/assets/bootstrap/css/bootstrap.min.css?h=9a417bd4b51738988dcef9f54383c51c">
    <link rel="manifest" href="/manifest.json?h=1d75ba4b41c973de80eb62f2d7278aa0">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat:400,400i,700,700i,600,600i">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/simple-line-icons/2.4.1/css/simple-line-icons.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.2.0/aos.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/baguettebox.js/1.10.0/baguetteBox.min.css">
    <link rel="stylesheet" href="layout/assets/css/styles.min.css?h=02287c746749489e169956bf12670725">
</head>

<body>
    <nav class="navbar navbar-light navbar-expand-lg fixed-top bg-white clean-navbar">
        <div class="container"><a class="navbar-brand logo" href="index.php"><strong>Safety </strong>| freshweb</a><button data-toggle="collapse" class="navbar-toggler" data-target="#navcol-1"><span class="sr-only">Toggle navigation</span><span class="navbar-toggler-icon"></span></button>
            <div
                class="collapse navbar-collapse" id="navcol-1">
                <ul class="nav navbar-nav ml-auto">
                    <li class="nav-item" role="presentation"><a class="nav-link" href="index.php">الرئيسية</a></li>
                    <li class="nav-item" role="presentation"><a class="nav-link" href="index.php#features">المميزات</a></li>
                    <li class="nav-item" role="presentation"><a class="nav-link" href="login.php">تسجيل الدخول</a></li>
                    <li class="nav-item" role="presentation"><a class="nav-link" href="singup.php">انشاء حساب</a></li>
                </ul>
            </div>
        </div>
    </nav>
    <main class="page login-page">
        <section class="clean-block clean-form dark">
            <div class="container">
                <div class="block-heading">
                    <h2 class="text-info">تسجيل الدخول</h2>
                    <p>ليس لديك حساب ؟ قم بـ&nbsp;<a href="#">انشاء حساب جديد</a></p>
                </div>
                <form class="text-right" method="post" action="login.php">

                    <?php include('includes/login_errors.php'); ?> 

                    <div class="form-group"><label for="email">الايميل</label><input class="form-control item" type="email" id="email" name="email" placeholder="email"></div>
                    <div class="form-group"><label for="password">كلمة المرور</label><input class="form-control" type="password" id="password" name="password" placeholder="password"></div><button class="btn btn-primary btn-block" type="submit" name="login">تسجيل الدخول</button></form>
            </div>
        </section>
    </main>
    <!-- Start: Footer Dark -->
    <footer class="page-footer dark">
        <div class="container">
            <div class="row">
                <div class="col-sm-3">
                    <h5>صفحات الموقع&nbsp;</h5>
                    <ul>
                        <li><a href="index.php">الرئيسية</a></li>
                        <li><a href="singup.php">انشاء حساب</a></li>
                        <li><a href="login.php">تسجيل الدخول</a></li>
                    </ul>
                </div>
                <div class="col-sm-3">
                    <h5>عنا&nbsp;</h5>
                    <ul>
                        <li><a href="about.php">من نحن</a></li>
                        <li><a href="mailto:elnajar76@gmail.com">اتصل بنا</a></li>
                    </ul>
                </div>
                <div class="col-sm-3">
                    <h5>Legal</h5>
                    <ul>
                        <li><a href="https://www.iubenda.com/privacy-policy/45461267">Privacy Policy</a></li>
                        <li style="color: rgba(255,255,255,0.7);">Poto by Julia M Cameron from Pexels<br><br></li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="footer-copyright">
            <p>&nbsp;و علم ينتفع به <br></p>
        </div>
    </footer>
    <!-- End: Footer Dark -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.0/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.2.0/aos.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/baguettebox.js/1.10.0/baguetteBox.min.js"></script>
    <script src="layout/assets/js/script.min.js?h=083d07ff9c735455464600ca895b41ba"></script>
</body>

</html>