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
    
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>Home - Safety</title>
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
                    <li class="nav-item" role="presentation"><a class="nav-link active" href="index.php#features">المميزات</a></li>
                    <li class="nav-item" role="presentation"><a class="nav-link" href="login.php">تسجيل الدخول</a></li>
                    <li class="nav-item" role="presentation"><a class="nav-link" href="singup.php">انشاء حساب</a></li>
                </ul>
        </div>
        </div>
    </nav>
    <main class="page landing-page">
        <section class="clean-block clean-hero" style="color: rgba(28,25,25,0.67);background: url(layout/assets/img/tech/student.jpg?h=8f365f149661b7ef09fc4f1cfd64dda0) center / cover no-repeat;">
            <div class="text">
                <h2>ماهو سايفتي ؟</h2>
                <p>هي منصة  عربيةتتيح للمعلمين بأصافة دورات تعليمية مصورة (فديوهات )&nbsp; وأتحاحتها للطلاب بسهولة , كما يمكن بيع&nbsp;هذة الدورات عن طريق الموقع&nbsp; بأذن الله</p>
                <a class="flash animated btn btn-outline-light btn-lg" href="singup.php">
                    اشترك مجانا وانشر فديوهاتك
                </a> 
                <p class="p-2 m-2 d-sm-inline"> أو  </p>
                <a
                    class="btn btn-light btn-lg m-2" href="login.php">تسجيل الدخول<br></a>
            </div>
        </section>
        <section data-aos="fade-up" data-aos-duration="600" data-aos-once="true" id="features" class="clean-block features">
            <div class="container">
                <div class="block-heading">
                    <h2 class="text-info">المميزات&nbsp;</h2>
                </div>
                <div class="row justify-content-center">
                    <div class="col-md-5 feature-box"><i class="icon-lock icon"></i>
                        <h4>حماية الفديوهات&nbsp;</h4>
                        <p>تتيح المنة لك حماية الفديوهات من التحميل&nbsp; او السرقة ان شاء الله</p>
                    </div>
                    <div class="col-md-5 feature-box"><i class="icon-credit-card icon"></i>
                        <h4>شراء الطلاب الدورات عن طريق الموقع&nbsp;</h4>
                        <p></p>
                        <p>يستطيع الطلاب شراء الفديوهات عن طريق الموقع</p>
                    </div>
                    <div class="col-md-5 feature-box"><i class="icon-people icon"></i>
                        <h4>متابعة الطلاب&nbsp;</h4>
                        <p>نوفر لك احصائيات جميلة&nbsp; مثل ماذا شاهد كل طالب من الفدوهات واجمالي عدد الطلاب الذين شاهدوا فديو محدد&nbsp;</p>
                    </div>
                    <div class="col-md-5 feature-box"><i class="icon-screen-smartphone icon"></i>
                        <h4>فرض جهاز واحد لمشاهدة الفديو&nbsp;</h4>
                        <p>يمكنك اجبار الطلاب علي استخدام جهاز واحد&nbsp; تشاهد منه الفديوهات , ولا يمكنه المشاهدة الا من هذا الجهاز</p>
                    </div>
                    <div class="col-md-5 feature-box"><i class="icon-magic-wand icon"></i>
                        <h4>وغير ذلك الكثير بأذن الله</h4>
                    </div>
                    <div class="col-md-5 feature-box"><i class="icon-eye icon"></i>
                        <h4>تحديد عدد المشاهدات للطلاب</h4>
                    </div>
                </div>
            </div>
        </section>
        <section class="clean-block about-us">
            <div class="container" data-aos="fade-up" data-aos-duration="400" data-aos-once="true">
                <div class="block-heading">
                    <h2 class="text-info">احدث الدورات</h2>
                </div>
                <div class="row justify-content-center">
                    <div class="col-sm-6 col-lg-4">
                        <div class="card clean-card text-center">
                            <div class="card-body info">
                                <h4 class="card-title">ضريبة | الفرقة الرابعة</h4>
                                <p class="card-text">kasem El-Najar</p>
                                <div class="icons"><a href="/safety/profile/?u=1">زيارة&nbsp;</a></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-lg-4">
                        <div class="card clean-card text-center">
                            <div class="card-body info">
                                <h4 class="card-title">منشات | الفرقة الرابعة</h4>
                                <p class="card-text">kasem El-Najar<br></p>
                                <div class="icons"><a href="/safety/profile/?u=1">زيارة&nbsp;</a></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container" id="about">
                <div class="block-heading">
                    <h2 class="text-info">من نحن</h2>
                    <p>منصة مجانية تساعد المعلمين والطلاب علي التعلم والهم اجله علم ينتفع به&nbsp;<i class="fa fa-heart" style="color: #c41e3a;"></i></p>
                </div>
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